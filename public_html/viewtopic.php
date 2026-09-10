<?php
/*
 * Forum topic controller wrapper for structured data.
 *
 * The original Forum 2.9.1 controller is kept verbatim in the private plugin
 * include directory as viewtopic_core.php. Capturing its normal output lets
 * us add JSON-LD without changing its posting, moderation, notification or
 * legacy URL behaviour.
 */

require_once '../lib-common.php';

ob_start();
require $CONF_FORUM['path_include'] . 'viewtopic_core.php';
$forumHtml = ob_get_clean();

// Preview/editor output is explicitly NOINDEX and must never carry public
// DiscussionForumPosting markup.
$onlytopicStructured = isset($_REQUEST['onlytopic']) ? COM_applyFilter($_REQUEST['onlytopic']) : '';
$modeStructured = isset($_REQUEST['mode']) ? COM_applyFilter($_REQUEST['mode']) : '';

if ($onlytopicStructured != 1 && $modeStructured !== 'preview') {
    require_once $CONF_FORUM['path_include'] . 'forum_structured_data.php';

    if (isset($showtopic, $page, $show, $order)) {
        $structuredData = forum_buildDiscussionForumPosting(
            $showtopic,
            $page,
            $show,
            $order,
            true
        );
        $forumHtml = forum_injectDiscussionForumPosting($forumHtml, $structuredData);
    }
}

echo $forumHtml;
