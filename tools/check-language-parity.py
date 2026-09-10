#!/usr/bin/env python3
"""Check the maintained French Forum translation against English defaults.

The checker parses the PHP language files as text; it never executes them.
That keeps CI independent from a Geeklog bootstrap and from constants such as
XHTML and TOPIC_*.
"""

from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
LANG_DIR = ROOT / "language"
REFERENCE = LANG_DIR / "english_utf-8.php"
TRANSLATION = LANG_DIR / "french_france_utf-8.php"

CONTAINERS = {
    "LANG_GF00", "LANG_GF01", "LANG_GF02", "LANG_GF03", "LANG_GF04",
    "LANG_GF05", "LANG_GF06", "LANG_GF07", "LANG_GF08", "LANG_GF09",
    "LANG_GF91", "LANG_GF92", "LANG_GF93", "LANG_GF95", "LANG_GF96",
    "LANG_GF_SMILIES", "LANG_configsections", "LANG_confignames",
    "LANG_configsubgroups", "LANG_tab", "LANG_fs", "LANG_configselects",
}

ARRAY_START = re.compile(
    r"^\s*\$(?P<container>[A-Za-z0-9_]+)"
    r"(?:\[['\"](?P<section>[^'\"]+)['\"]\])?\s*=\s*array\s*\("
)
ASSIGNMENT = re.compile(
    r"^\s*\$(?P<container>[A-Za-z0-9_]+)"
    r"(?:\[['\"](?P<section>[^'\"]+)['\"]\])?"
    r"\[['\"](?P<key>[^'\"]+)['\"]\]\s*=\s*(?P<value>.*?);"
    r"\s*(?://.*)?$"
)
STRING_ENTRY = re.compile(
    r"^\s*['\"](?P<key>[^'\"]+)['\"]\s*=>\s*(?P<value>.*?)(?:,\s*)?(?://.*)?$"
)
NUMERIC_ENTRY = re.compile(
    r"^\s*(?P<key>\d+)\s*=>\s*(?P<value>.*?)(?:,\s*)?(?://.*)?$"
)
PLACEHOLDER = re.compile(r"(?<!%)%(?:\d+\$)?[bcdeEfFgGosuxX]")
QUOTED_TOPIC_CONSTANT = re.compile(
    r"['\"](?:TOPIC_ALL_OPTION|TOPIC_HOMEONLY_OPTION|TOPIC_SELECTED_OPTION)['\"]"
)
PLUGIN_MESSAGE = re.compile(
    r"^\s*\$(?P<key>PLG_forum_MESSAGE\d+)\s*=\s*(?P<value>.*?);\s*(?://.*)?$"
)


def parse(path: Path):
    text = path.read_text(encoding="utf-8")
    data: dict[tuple[str, str | None], dict[str, str]] = {}
    messages: dict[str, str] = {}
    active: tuple[str, str | None] | None = None

    for line in text.splitlines():
        mm = PLUGIN_MESSAGE.match(line)
        if mm:
            messages[mm.group("key")] = mm.group("value")
            continue

        am = ASSIGNMENT.match(line)
        if am and am.group("container") in CONTAINERS:
            ident = (am.group("container"), am.group("section"))
            data.setdefault(ident, {})[am.group("key")] = am.group("value")
            continue

        sm = ARRAY_START.match(line)
        if sm and sm.group("container") in CONTAINERS:
            active = (sm.group("container"), sm.group("section"))
            data.setdefault(active, {})
            continue

        if active is not None:
            if line.strip().startswith(");"):
                active = None
                continue

            em = STRING_ENTRY.match(line) or NUMERIC_ENTRY.match(line)
            if em:
                # LANG_configselects values are nested arrays. Only their
                # top-level numeric IDs are part of the structural contract.
                if active[0] == "LANG_configselects" and not em.group("key").isdigit():
                    continue
                data[active][em.group("key")] = em.group("value")

    return text, data, messages


def placeholders(value: str) -> list[str]:
    return PLACEHOLDER.findall(value)


def label(ident: tuple[str, str | None]) -> str:
    return ident[0] + (f"['{ident[1]}']" if ident[1] else "")


def main() -> int:
    for path in (REFERENCE, TRANSLATION):
        if not path.exists():
            print(f"Language file not found: {path}", file=sys.stderr)
            return 2

    _, reference, reference_messages = parse(REFERENCE)
    french_text, french, french_messages = parse(TRANSLATION)
    errors: list[str] = []

    for ident, expected_keys in reference.items():
        actual_keys = french.get(ident, {})
        for key in sorted(set(expected_keys) - set(actual_keys)):
            errors.append(f"missing {label(ident)}[{key!r}]")
        for key in sorted(set(actual_keys) - set(expected_keys)):
            errors.append(f"extra {label(ident)}[{key!r}]")

        if ident[0] == "LANG_configselects":
            continue

        for key in sorted(set(expected_keys) & set(actual_keys)):
            expected = placeholders(expected_keys[key])
            actual = placeholders(actual_keys[key])
            if expected != actual:
                errors.append(
                    f"placeholder mismatch {label(ident)}[{key!r}]: "
                    f"expected {expected}, got {actual}"
                )

    for ident in sorted(set(french) - set(reference)):
        errors.append(f"extra language container {label(ident)}")

    for key in sorted(set(reference_messages) - set(french_messages)):
        errors.append(f"missing ${key}")
    for key in sorted(set(french_messages) - set(reference_messages)):
        errors.append(f"extra ${key}")
    for key in sorted(set(reference_messages) & set(french_messages)):
        expected = placeholders(reference_messages[key])
        actual = placeholders(french_messages[key])
        if expected != actual:
            errors.append(
                f"placeholder mismatch ${key}: expected {expected}, got {actual}"
            )

    if QUOTED_TOPIC_CONSTANT.search(french_text):
        errors.append("TOPIC_* configuration constants must not be quoted")

    if errors:
        print("French language parity check failed:\n")
        for error in errors:
            print(f" - {error}")
        print(f"\n{len(errors)} issue(s) found.")
        return 1

    key_count = sum(len(keys) for keys in reference.values())
    print(
        "French language parity check passed: "
        f"{key_count} language keys and {len(reference_messages)} plugin messages checked."
    )
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
