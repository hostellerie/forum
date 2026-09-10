<?php
/*
 * Forum topic controller wrapper for structured data.
 *
 * The current Forum controller is kept verbatim in the private plugin include
 * directory as viewtopic_core.php. Capturing its normal output lets us add
 * JSON-LD without changing routing, posting, moderation, notification,
 * permission or canonical URL behaviour.
 */

require_once '../lib-common.php';

ob_start();
require $CONF_FORUM['path_include'] . 'viewtopic_core.php';
$forumHtml = ob_get_clean();

// Preview/editor output is explicitly NOINDEX and must never carry public
// DiscussionForumPosting markup.
$onlytopicStructured = isset($_REQUEST['onlytopic']) ? COM_applyFilter($_REQUEST['onlytopic']) : '';

if ($onlytopicStructured != 1) {
    require_once $CONF_FORUM['path_include'] . 'forum_structured_data.php';

    if (isset($showtopic, $page, $show, $order)) {
        $structuredData = forum_buildDiscussionForumPosting(
            $showtopic,
            $page,
            $show,
            $order,
            false
        );
        $forumHtml = forum_injectDiscussionForumPosting($forumHtml, $structuredData);
    }
}

echo $forumHtml;
