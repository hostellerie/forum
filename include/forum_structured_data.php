<?php
/*
 * DiscussionForumPosting structured data helpers.
 *
 * This file is intentionally PHP 5.6 compatible so the same implementation
 * can be used by the Forum 2.9.1 / Geeklog 2.1.1 line and the current Forum
 * line. It only reads Forum data and never changes posting, moderation,
 * notification, URL-routing or permission behaviour.
 */

if (strpos(strtolower($_SERVER['PHP_SELF']), 'forum_structured_data.php') !== false) {
    die('This file can not be used on its own.');
}

function forum_structuredDataText($text)
{
    $text = preg_replace('/<\s*br\s*\/?>/i', "\n", $text);
    $text = preg_replace('/<\/(p|div|li|blockquote|pre|h[1-6])\s*>/i', "\n", $text);
    $text = strip_tags($text);
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

    // Remove common BBCode wrappers without running the Forum parser again.
    // This deliberately avoids the parser path involved in upstream issue #60.
    $text = preg_replace('/\[(?:\/?(?:b|i|u|s|quote|code|list|size|color|url|img)|\*)(?:=[^\]]*)?\]/i', '', $text);
    $text = preg_replace('/[\t ]+/', ' ', $text);
    $text = preg_replace('/\s*\n\s*/', "\n", $text);
    $text = preg_replace('/\n{3,}/', "\n\n", $text);

    return trim($text);
}

function forum_structuredDataAuthor($record)
{
    global $_CONF, $_TABLES, $LANG_GF01;

    $uid = isset($record['uid']) ? (int) $record['uid'] : 1;
    $name = '';
    $userExists = false;
    $isBanned = false;

    if ($uid > 1) {
        $userExists = (int) DB_getItem($_TABLES['users'], 'uid', 'uid=' . $uid) === $uid;
        if ($userExists) {
            $name = COM_getDisplayName($uid);
            if (function_exists('USER_isBanned')) {
                $isBanned = USER_isBanned($uid);
            }
        }
    }

    if ($name === '' && !empty($record['name'])) {
        $name = urldecode($record['name']);
    }
    if ($name === '') {
        $name = isset($LANG_GF01['ANON']) ? $LANG_GF01['ANON'] : 'Anonymous';
    }

    $author = array(
        '@type' => 'Person',
        'name' => strip_tags($name)
    );

    // Do not publish profile URLs for anonymous, deleted or banned users.
    if ($uid > 1 && $userExists && !$isBanned) {
        $author['url'] = rtrim($_CONF['site_url'], '/') . '/users.php?mode=profile&uid=' . $uid;
    }

    return $author;
}

function forum_buildDiscussionForumPosting($topicId, $page, $show, $order, $legacyStopAtHiddenAnonymous)
{
    global $_CONF, $_TABLES, $CONF_FORUM;

    $topicId = (int) $topicId;
    $page = max(1, (int) $page);
    $show = max(1, (int) $show);
    $order = (strtoupper($order) === 'DESC') ? 'DESC' : 'ASC';

    if ($topicId < 1) {
        return array();
    }

    $parentResult = DB_query("SELECT * FROM {$_TABLES['forum_topic']} WHERE id=$topicId AND pid=0");
    if (DB_numRows($parentResult) !== 1) {
        return array();
    }
    $parent = DB_fetchArray($parentResult);

    // If anonymous posts are configured as hidden, never expose their content
    // through structured data when the main post itself is anonymous.
    if (empty($CONF_FORUM['show_anonymous_posts']) && (int) $parent['uid'] === 1) {
        return array();
    }

    $canonical = rtrim($_CONF['site_url'], '/') . '/forum/viewtopic.php?showtopic=' . $topicId;
    $forumUrl = rtrim($_CONF['site_url'], '/') . '/forum/index.php?forum=' . (int) $parent['forum'];
    $offset = ($page - 1) * $show;

    // Mirror the page slice used by viewtopic.php. This lets us include only
    // comments whose text is actually present on the rendered page.
    $pageSql = "(SELECT * FROM {$_TABLES['forum_topic']} WHERE id='$topicId') "
        . "UNION ALL (SELECT * FROM {$_TABLES['forum_topic']} WHERE pid='$topicId') "
        . "ORDER BY id $order LIMIT $offset, $show";
    $pageResult = DB_query($pageSql);

    $rows = array();
    $parentVisible = false;
    while ($row = DB_fetchArray($pageResult)) {
        if (empty($CONF_FORUM['show_anonymous_posts']) && (int) $row['uid'] === 1) {
            if ($legacyStopAtHiddenAnonymous) {
                break;
            }
            continue;
        }
        $rows[] = $row;
        if ((int) $row['id'] === $topicId) {
            $parentVisible = true;
        }
    }

    $data = array(
        '@context' => 'https://schema.org',
        '@type' => 'DiscussionForumPosting',
        'mainEntityOfPage' => $canonical,
        'headline' => isset($parent['subject']) ? strip_tags($parent['subject']) : '',
        'url' => $canonical,
        'author' => forum_structuredDataAuthor($parent),
        'datePublished' => date(DATE_ATOM, (int) $parent['date']),
        'commentCount' => isset($parent['replies']) ? (int) $parent['replies'] : 0,
        'isPartOf' => array(
            '@type' => 'WebPage',
            'url' => $forumUrl
        )
    );

    // Google permits omitting text when the original post is represented from
    // another page of a multi-page discussion. Never duplicate hidden text.
    if ($parentVisible) {
        $parentText = forum_structuredDataText(isset($parent['comment']) ? $parent['comment'] : '');
        if ($parentText !== '') {
            $data['text'] = $parentText;
        }
    }

    $statistics = array();
    if (isset($parent['views'])) {
        $statistics[] = array(
            '@type' => 'InteractionCounter',
            'interactionType' => 'https://schema.org/ViewAction',
            'userInteractionCount' => (int) $parent['views']
        );
    }
    $statistics[] = array(
        '@type' => 'InteractionCounter',
        'interactionType' => 'https://schema.org/ReplyAction',
        'userInteractionCount' => isset($parent['replies']) ? (int) $parent['replies'] : 0
    );
    $data['interactionStatistic'] = $statistics;

    $comments = array();
    foreach ($rows as $row) {
        if ((int) $row['id'] === $topicId || (int) $row['pid'] !== $topicId) {
            continue;
        }

        $commentText = forum_structuredDataText(isset($row['comment']) ? $row['comment'] : '');
        if ($commentText === '') {
            continue;
        }

        $comments[] = array(
            '@type' => 'Comment',
            'author' => forum_structuredDataAuthor($row),
            'datePublished' => date(DATE_ATOM, (int) $row['date']),
            'text' => $commentText
        );
    }
    if (!empty($comments)) {
        $data['comment'] = $comments;
    }

    return $data;
}

function forum_injectDiscussionForumPosting($html, $data)
{
    if (empty($data) || !is_string($html) || $html === '') {
        return $html;
    }

    $flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
    $json = json_encode($data, $flags);
    if ($json === false) {
        return $html;
    }

    $position = stripos($html, '</head>');
    if ($position === false) {
        return $html;
    }

    $markup = '<script type="application/ld+json">' . $json . '</script>' . "\n";
    return substr($html, 0, $position) . $markup . substr($html, $position);
}
