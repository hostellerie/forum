#!/usr/bin/env python3
"""Check Forum translations against the English UTF-8 language file.

The checker is intentionally static: language files are parsed as text and are
never executed. This keeps the check independent from Geeklog bootstrap state
and constants such as XHTML or TOPIC_*.
"""

from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
LANG_DIR = ROOT / "language"
REFERENCE = LANG_DIR / "english_utf-8.php"

# Language containers whose keys are part of the public translation contract.
CONTAINERS = (
    "LANG_GF00",
    "LANG_GF01",
    "LANG_GF02",
    "LANG_GF03",
    "LANG_GF04",
    "LANG_GF05",
    "LANG_GF06",
    "LANG_GF07",
    "LANG_GF08",
    "LANG_GF09",
    "LANG_GF91",
    "LANG_GF92",
    "LANG_GF93",
    "LANG_GF95",
    "LANG_GF96",
    "LANG_GF_SMILIES",
    "LANG_configsections",
    "LANG_confignames",
    "LANG_configsubgroups",
    "LANG_tab",
    "LANG_fs",
    "LANG_configselects",
)

ASSIGN_RE = re.compile(
    r"\$(?P<container>[A-Za-z0-9_]+)\s*"
    r"(?:\[\s*['\"](?P<section>[^'\"]+)['\"]\s*\])?\s*"
    r"\[\s*['\"](?P<key>[^'\"]+)['\"]\s*\]\s*=\s*"
    r"(?P<value>.*?);",
    re.S,
)

ARRAY_START_RE = re.compile(
    r"\$(?P<container>[A-Za-z0-9_]+)\s*"
    r"(?:\[\s*['\"](?P<section>[^'\"]+)['\"]\s*\])?\s*=\s*array\s*\(",
    re.S,
)

KEY_VALUE_RE = re.compile(
    r"(?P<quote>['\"])(?P<key>[^'\"]+)(?P=quote)\s*=>\s*(?P<value>.*?)(?=,\s*(?:\n\s*)?(?:['\"]|\d+\s*=>)|\n\s*\)\s*;)",
    re.S,
)

NUMERIC_KEY_RE = re.compile(r"(?m)^\s*(?P<key>\d+)\s*=>")
PLACEHOLDER_RE = re.compile(r"%(?:\d+\$)?[bcdeEfFgGosuxX]")
QUOTED_TOPIC_CONSTANT_RE = re.compile(
    r"['\"](?:TOPIC_ALL_OPTION|TOPIC_HOMEONLY_OPTION|TOPIC_SELECTED_OPTION)['\"]"
)


def matching_paren(text: str, open_pos: int) -> int:
    """Return the closing parenthesis position, ignoring quoted strings/comments."""
    depth = 0
    quote = None
    escaped = False
    i = open_pos
    while i < len(text):
        ch = text[i]
        nxt = text[i + 1] if i + 1 < len(text) else ""

        if quote:
            if escaped:
                escaped = False
            elif ch == "\\":
                escaped = True
            elif ch == quote:
                quote = None
            i += 1
            continue

        if ch in ("'", '"'):
            quote = ch
            i += 1
            continue

        if ch == "/" and nxt == "/":
            end = text.find("\n", i + 2)
            i = len(text) if end == -1 else end + 1
            continue
        if ch == "/" and nxt == "*":
            end = text.find("*/", i + 2)
            i = len(text) if end == -1 else end + 2
            continue
        if ch == "#":
            end = text.find("\n", i + 1)
            i = len(text) if end == -1 else end + 1
            continue

        if ch == "(":
            depth += 1
        elif ch == ")":
            depth -= 1
            if depth == 0:
                return i
        i += 1

    raise ValueError("unmatched parenthesis")


def parse(text: str):
    result: dict[tuple[str, str | None], dict[str, str]] = {}

    # Old-style assignments: $LANG_GF01['KEY'] = 'value';
    for m in ASSIGN_RE.finditer(text):
        container = m.group("container")
        if container not in CONTAINERS:
            continue
        ident = (container, m.group("section"))
        result.setdefault(ident, {})[m.group("key")] = m.group("value").strip()

    # Array declarations: $LANG_GF00 = array(...); and $LANG_x['forum'] = array(...)
    for m in ARRAY_START_RE.finditer(text):
        container = m.group("container")
        if container not in CONTAINERS:
            continue
        open_pos = text.find("(", m.start(), m.end())
        try:
            close_pos = matching_paren(text, open_pos)
        except ValueError:
            continue
        body = text[open_pos + 1 : close_pos]
        ident = (container, m.group("section"))
        bucket = result.setdefault(ident, {})

        if container == "LANG_configselects":
            # Only the top-level numeric option-set IDs are structural keys.
            for km in NUMERIC_KEY_RE.finditer(body):
                bucket[km.group("key")] = ""
        else:
            for km in KEY_VALUE_RE.finditer(body):
                bucket[km.group("key")] = km.group("value").strip()

    return result


def placeholders(value: str):
    # %% is a literal percent and is intentionally ignored by PLACEHOLDER_RE.
    return PLACEHOLDER_RE.findall(value)


def check_file(path: Path, reference):
    text = path.read_text(encoding="utf-8")
    current = parse(text)
    errors: list[str] = []

    for ident, reference_keys in reference.items():
        current_keys = current.get(ident, {})
        missing = sorted(set(reference_keys) - set(current_keys))
        extra = sorted(set(current_keys) - set(reference_keys))
        label = ident[0] + (f"['{ident[1]}']" if ident[1] else "")

        for key in missing:
            errors.append(f"{path.name}: missing {label}[{key!r}]")
        for key in extra:
            errors.append(f"{path.name}: extra {label}[{key!r}]")

        if ident[0] == "LANG_configselects":
            continue

        for key in sorted(set(reference_keys) & set(current_keys)):
            expected = placeholders(reference_keys[key])
            actual = placeholders(current_keys[key])
            if expected != actual:
                errors.append(
                    f"{path.name}: placeholder mismatch {label}[{key!r}] "
                    f"expected {expected}, got {actual}"
                )

    # Also report unexpected whole containers/sections.
    for ident in sorted(set(current) - set(reference)):
        label = ident[0] + (f"['{ident[1]}']" if ident[1] else "")
        errors.append(f"{path.name}: extra language container {label}")

    if QUOTED_TOPIC_CONSTANT_RE.search(text):
        errors.append(
            f"{path.name}: TOPIC_* configuration constants must not be quoted"
        )

    return errors


def main() -> int:
    if not REFERENCE.exists():
        print(f"Reference language file not found: {REFERENCE}", file=sys.stderr)
        return 2

    reference = parse(REFERENCE.read_text(encoding="utf-8"))
    if not reference:
        print("Unable to parse reference language keys", file=sys.stderr)
        return 2

    # UTF-8 translations are authoritative. Legacy non-UTF-8 files may be
    # compatibility wrappers and are deliberately excluded from static parity.
    translations = sorted(
        p for p in LANG_DIR.glob("*_utf-8.php") if p.name != REFERENCE.name
    )

    failures: list[str] = []
    for path in translations:
        failures.extend(check_file(path, reference))

    if failures:
        print("Language parity check failed:\n")
        for failure in failures:
            print(f" - {failure}")
        print(f"\n{len(failures)} issue(s) found.")
        return 1

    print(
        f"Language parity check passed for {len(translations)} UTF-8 translation file(s)."
    )
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
