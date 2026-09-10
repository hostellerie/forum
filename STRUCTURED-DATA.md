# Discussion forum structured data

This branch adds `DiscussionForumPosting` JSON-LD to public topic pages while preserving the behaviour of the underlying Forum release.

## Compatibility and safeguards

- The structured-data helper uses PHP 5.6-compatible syntax.
- Public topic rendering remains owned by the original `viewtopic.php`, preserved verbatim as `include/viewtopic_core.php`.
- Preview/editor responses remain `noindex` and do not receive structured data.
- The schema always uses the clean parent-topic URL and never publishes legacy `show`, `mode` or `lastpost` parameters as the discussion URL, avoiding the duplicate-content concern tracked upstream in issue #87.
- Replies are represented as `Comment` objects only when their text is actually present on the rendered page.
- Hidden anonymous posts are not exposed through JSON-LD.
- Deleted or banned users do not receive profile URLs in structured data.
- Forum text is normalized without running it through the Forum parser a second time, avoiding the autotag/parser concern tracked in issue #60.
- No posting, moderation, notification, subscription, permission, counters, redirects or database writes are changed by this feature.

## Model

The parent topic is represented as `DiscussionForumPosting` with `headline`, `author`, `datePublished`, canonical `url`, `commentCount`, `isPartOf` and interaction counters for views and replies. Visible replies are nested as `Comment` objects with author, publication date and text.

For paginated discussions, the `url` property always points to the first page of the discussion. The original post text is included only when that post is present on the current rendered page.
