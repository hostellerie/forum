<?php

/**
 * Visual editor helpers for the Forum plugin.
 *
 * The editor renders the historical Forum source (BBCode, HTML and Geeklog
 * autotags) but keeps the stored source format compatible with existing posts.
 */

function forum_editor_extractAutotags($source, &$tokens)
{
    $tokens = array();
    $codeBlocks = array();

    $source = preg_replace_callback(
        '/\[code(?:=[^\]]+)?\].*?\[\/code\]/is',
        function ($matches) use (&$codeBlocks) {
            $key = '___FORUM_EDITOR_CODE_' . count($codeBlocks) . '___';
            $codeBlocks[$key] = $matches[0];
            return $key;
        },
        $source
    );

    $source = preg_replace_callback(
        '/\[([A-Za-z][A-Za-z0-9_-]*):([^\]]+)\]/',
        function ($matches) use (&$tokens) {
            $key = '___FORUM_EDITOR_AUTOTAG_' . count($tokens) . '___';
            $tokens[$key] = $matches[0];
            return $key;
        },
        $source
    );

    if (!empty($codeBlocks)) {
        $source = strtr($source, $codeBlocks);
    }

    return $source;
}

function forum_editor_renderAutotag($token)
{
    $rendered = PLG_replaceTags($token);

    if ($rendered === $token || trim($rendered) === '') {
        $label = 'Embedded content';
        if (preg_match('/^\[([A-Za-z][A-Za-z0-9_-]*):/', $token, $matches)) {
            $label = ucfirst($matches[1]);
        }

        $rendered = '<span class="forum-editor-embed-label">'
            . htmlspecialchars($label, ENT_QUOTES, 'UTF-8')
            . '</span>';
    }

    return '<span class="forum-editor-embed" contenteditable="false" data-forum-autotag="'
        . htmlspecialchars($token, ENT_QUOTES, 'UTF-8')
        . '">' . $rendered . '</span>';
}

function forum_editor_renderSource($source, $postmode)
{
    if (!class_exists('StringParser')) {
        global $CONF_FORUM;
        require_once $CONF_FORUM['path_include'] . 'bbcode/stringparser_bbcode.class.php';
    }

    $tokens = array();
    $prepared = forum_editor_extractAutotags($source, $tokens);
    $html = gf_formatTextBlock($prepared, $postmode);

    if (!empty($tokens)) {
        foreach ($tokens as $marker => $token) {
            $html = str_replace($marker, forum_editor_renderAutotag($token), $html);
        }
    }

    return $html;
}

function forum_editor_nodeToBBCode($node)
{
    if ($node->nodeType === XML_TEXT_NODE) {
        return $node->nodeValue;
    }

    if ($node->nodeType !== XML_ELEMENT_NODE) {
        return '';
    }

    if ($node->hasAttribute('data-forum-autotag')) {
        return $node->getAttribute('data-forum-autotag');
    }

    $name = strtolower($node->nodeName);
    $content = '';

    foreach ($node->childNodes as $child) {
        $content .= forum_editor_nodeToBBCode($child);
    }

    switch ($name) {
        case 'br':
            return "\n";
        case 'p':
        case 'div':
            return rtrim($content) . "\n\n";
        case 'strong':
        case 'b':
            return '[b]' . $content . '[/b]';
        case 'em':
        case 'i':
            return '[i]' . $content . '[/i]';
        case 'u':
            return '[u]' . $content . '[/u]';
        case 's':
        case 'del':
            return '[s]' . $content . '[/s]';
        case 'blockquote':
            return '[quote]' . trim($content) . '[/quote]' . "\n\n";
        case 'pre':
            return '[code]' . trim($node->textContent) . '[/code]' . "\n\n";
        case 'code':
            return '[code]' . $node->textContent . '[/code]';
        case 'ul':
            return '[list]' . "\n" . trim($content) . "\n[/list]\n\n";
        case 'ol':
            return '[list=1]' . "\n" . trim($content) . "\n[/list]\n\n";
        case 'li':
            return '[*]' . trim($content) . "\n";
        case 'a':
            $href = $node->getAttribute('href');
            if ($href === '') {
                return $content;
            }
            return '[url=' . $href . ']' . $content . '[/url]';
        case 'img':
            $src = $node->getAttribute('src');
            return $src !== '' ? '[img]' . $src . '[/img]' : '';
        default:
            return $content;
    }
}

function forum_editor_htmlToBBCode($html)
{
    if (!class_exists('DOMDocument')) {
        return trim(strip_tags($html));
    }

    $doc = new DOMDocument('1.0', 'UTF-8');
    $previous = libxml_use_internal_errors(true);
    $doc->loadHTML(
        '<?xml encoding="UTF-8"><div id="forum-editor-root">' . $html . '</div>'
    );
    libxml_clear_errors();
    libxml_use_internal_errors($previous);

    $root = $doc->getElementById('forum-editor-root');
    if (!$root) {
        return trim(strip_tags($html));
    }

    $source = '';
    foreach ($root->childNodes as $child) {
        $source .= forum_editor_nodeToBBCode($child);
    }

    $source = preg_replace("/\n{3,}/", "\n\n", $source);
    return trim($source);
}

function forum_editor_normalizeVisualBlocks($doc, $root)
{
    // Chromium commonly serializes Enter in contenteditable as:
    //   text<div>next line</div><div>third line</div>
    // A block therefore means "start a new visual line". Insert the separator
    // BEFORE its contents; inserting it after the block merges the first two
    // lines (text + first div) and creates a blank line later.
    $blocks = array();
    foreach ($root->childNodes as $child) {
        if ($child->nodeType === XML_ELEMENT_NODE) {
            $name = strtolower($child->nodeName);
            if ($name === 'div' || $name === 'p') {
                $blocks[] = $child;
            }
        }
    }

    foreach ($blocks as $block) {
        $previous = $block->previousSibling;
        while ($previous
            && $previous->nodeType === XML_TEXT_NODE
            && trim($previous->nodeValue) === ''
        ) {
            $previous = $previous->previousSibling;
        }

        // Do not add a second break if the previous node already ends the line.
        if ($previous
            && !($previous->nodeType === XML_ELEMENT_NODE
                && strtolower($previous->nodeName) === 'br')
        ) {
            $root->insertBefore($doc->createElement('br'), $block);
        }

        while ($block->firstChild) {
            $root->insertBefore($block->firstChild, $block);
        }
        $root->removeChild($block);
    }

    // Collapse only accidental runs created by repeated round trips. Keep at
    // most two BRs so an intentional blank line is preserved.
    $run = 0;
    $children = array();
    foreach ($root->childNodes as $child) {
        $children[] = $child;
    }

    foreach ($children as $child) {
        if ($child->nodeType === XML_ELEMENT_NODE && strtolower($child->nodeName) === 'br') {
            $run++;
            if ($run > 2) {
                $root->removeChild($child);
            }
        } elseif ($child->nodeType === XML_TEXT_NODE && trim($child->nodeValue) === '') {
            continue;
        } else {
            $run = 0;
        }
    }

    while ($root->lastChild
        && $root->lastChild->nodeType === XML_ELEMENT_NODE
        && strtolower($root->lastChild->nodeName) === 'br'
    ) {
        $root->removeChild($root->lastChild);
    }
}

function forum_editor_htmlToHtml($html)
{
    if (!class_exists('DOMDocument')) {
        return $html;
    }

    $doc = new DOMDocument('1.0', 'UTF-8');
    $previous = libxml_use_internal_errors(true);
    $doc->loadHTML(
        '<?xml encoding="UTF-8"><div id="forum-editor-root">' . $html . '</div>'
    );
    libxml_clear_errors();
    libxml_use_internal_errors($previous);

    $root = $doc->getElementById('forum-editor-root');
    if (!$root) {
        return $html;
    }

    forum_editor_normalizeVisualBlocks($doc, $root);

    $autotags = array();
    $xpath = new DOMXPath($doc);
    $nodes = $xpath->query('//*[@data-forum-autotag]');

    for ($i = $nodes->length - 1; $i >= 0; $i--) {
        $node = $nodes->item($i);
        $marker = '___FORUM_EDITOR_RESTORE_' . $i . '___';
        $autotags[$marker] = $node->getAttribute('data-forum-autotag');
        $node->parentNode->replaceChild($doc->createTextNode($marker), $node);
    }

    // Keep Forum quote semantics even in HTML mode. The historical renderer
    // expects [quote] so it can output the standard quotemain markup.
    $quotes = $xpath->query('//blockquote');
    for ($i = $quotes->length - 1; $i >= 0; $i--) {
        $node = $quotes->item($i);
        $marker = '___FORUM_EDITOR_QUOTE_' . $i . '___';
        $autotags[$marker] = '[quote]' . trim($node->textContent) . '[/quote]';
        $node->parentNode->replaceChild($doc->createTextNode($marker), $node);
    }

    $output = '';
    foreach ($root->childNodes as $child) {
        $output .= $doc->saveHTML($child);
    }

    if (!empty($autotags)) {
        $output = strtr($output, $autotags);
    }

    return trim($output);
}

function forum_editor_preparePost()
{
    if (empty($_POST['forum_editor_dirty']) || !isset($_POST['forum_editor_html'])) {
        return;
    }

    // If the browser did not populate the visual payload, keep the synchronized
    // plain source field instead of replacing the comment with an empty string.
    if (trim($_POST['forum_editor_html']) === '') {
        return;
    }

    $postmode = isset($_POST['postmode']) ? strtolower($_POST['postmode']) : 'html';

    if ($postmode === 'text') {
        $_POST['comment'] = forum_editor_htmlToBBCode($_POST['forum_editor_html']);
    } else {
        $_POST['comment'] = forum_editor_htmlToHtml($_POST['forum_editor_html']);
    }
}
