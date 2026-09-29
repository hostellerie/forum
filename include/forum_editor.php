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

function forum_editor_hasLegacyBBCode($source)
{
    return preg_match(
        '/\\[(?:b|i|u|s|p|quote|list(?:=[^\\]]+)?|\\*|url(?:=[^\\]]+)?|img(?:\\s+[^\\]]+)?|code(?:=[^\\]]+)?)\\]/i',
        $source
    ) === 1;
}

function forum_editor_renderSmiliesInHtml($html)
{
    if ($html === '' || !class_exists('DOMDocument')) {
        return $html;
    }

    $doc = new DOMDocument('1.0', 'UTF-8');
    $previous = libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="UTF-8"><div id="forum-editor-smilie-root">' . $html . '</div>');
    libxml_clear_errors();
    libxml_use_internal_errors($previous);

    $root = $doc->getElementById('forum-editor-smilie-root');
    if (!$root) {
        return $html;
    }

    $xpath = new DOMXPath($doc);
    $textNodes = $xpath->query('.//text()', $root);
    $nodes = array();
    foreach ($textNodes as $textNode) {
        $nodes[] = $textNode;
    }

    foreach ($nodes as $textNode) {
        $parent = $textNode->parentNode;
        if (!$parent) {
            continue;
        }

        $parentName = strtolower($parent->nodeName);
        if ($parentName === 'code' || $parentName === 'pre') {
            continue;
        }

        $rendered = forum_xchsmilies($textNode->nodeValue);
        if ($rendered === $textNode->nodeValue) {
            continue;
        }

        $fragment = $doc->createDocumentFragment();
        if (@$fragment->appendXML($rendered)) {
            $parent->replaceChild($fragment, $textNode);
        }
    }

    $output = '';
    foreach ($root->childNodes as $child) {
        $output .= $doc->saveHTML($child);
    }

    return $output;
}

function forum_editor_restoreSmilies($doc, $root)
{
    $symbols = array(
        'biggrin' => ':D',
        'smile' => ':)',
        'frown' => ':(',
        'eek' => '8O',
        'confused' => ':?',
        'cool' => 'B)',
        'lol' => ':lol:',
        'angry' => ':x',
        'razz' => ':P',
        'oops' => ':oops:',
        'surprise' => ':o',
        'cry' => ':cry:',
        'evil' => ':evil:',
        'twisted' => ':twisted:',
        'rolleye' => ':roll:',
        'wink' => ';)',
        'exclaim' => ':!:',
        'question' => ':question:',
        'idea' => ':idea:',
        'arrow' => ':arrow:',
        'neutral' => ':|',
        'green' => ':mrgreen:',
        'sick' => ':sick:',
        'tired' => ':tired:',
        'monkey' => ':monkey:'
    );

    $xpath = new DOMXPath($doc);
    $nodes = $xpath->query(
        './/img[contains(concat(" ", normalize-space(@class), " "), " frm_sml ")]',
        $root
    );
    $images = array();
    foreach ($nodes as $node) {
        $images[] = $node;
    }

    foreach ($images as $node) {
        $classes = preg_split('/\\s+/', trim($node->getAttribute('class')));
        $symbol = '';
        foreach ($classes as $class) {
            if (strpos($class, 'frm_sml_') === 0) {
                $key = substr($class, strlen('frm_sml_'));
                if (isset($symbols[$key])) {
                    $symbol = $symbols[$key];
                    break;
                }
            }
        }

        if ($symbol !== '' && $node->parentNode) {
            $node->parentNode->replaceChild($doc->createTextNode($symbol), $node);
        }
    }
}

function forum_editor_renderSource($source, $postmode)
{
    if (!class_exists('StringParser')) {
        global $CONF_FORUM;
        require_once $CONF_FORUM['path_include'] . 'bbcode/stringparser_bbcode.class.php';
    }

    $tokens = array();
    $prepared = forum_editor_extractAutotags($source, $tokens);

    // HTML produced by the visual editor is already a complete editing
    // representation. Re-parsing it through StringParser on every edit can
    // grow line breaks. Only legacy HTML posts containing Forum BBCode need
    // the historical parser once; after the next save they become canonical
    // visual-editor HTML.
    if (strtolower($postmode) === 'html' && !forum_editor_hasLegacyBBCode($prepared)) {
        $html = forum_editor_renderSmiliesInHtml($prepared);
    } else {
        $html = gf_formatTextBlock($prepared, $postmode);
    }

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

function forum_editor_nodeIsBlock($node)
{
    if (!$node || $node->nodeType !== XML_ELEMENT_NODE) {
        return false;
    }

    return in_array(
        strtolower($node->nodeName),
        array('div', 'p', 'ul', 'ol', 'blockquote', 'pre', 'table', 'hr'),
        true
    );
}

function forum_editor_normalizeVisualBlocks($doc, $root)
{
    // Enter in contenteditable is a paragraph break. Chromium commonly emits
    // top-level DIV elements for those paragraphs. Canonical Forum editor HTML
    // stores them as semantic P elements so Eclipse and other themes can apply
    // normal paragraph spacing. BR is reserved for an intentional line break
    // (for example Shift+Enter).
    $children = array();
    foreach ($root->childNodes as $child) {
        $children[] = $child;
    }

    foreach ($children as $child) {
        if ($child->nodeType !== XML_ELEMENT_NODE
            || strtolower($child->nodeName) !== 'div'
        ) {
            continue;
        }

        $paragraph = $doc->createElement('p');
        while ($child->firstChild) {
            $paragraph->appendChild($child->firstChild);
        }

        // Keep an empty paragraph editable/visible without turning it into a
        // second structural separator during the next round trip.
        if (!$paragraph->hasChildNodes()) {
            $paragraph->appendChild($doc->createElement('br'));
        }

        $root->replaceChild($paragraph, $child);
    }
}

function forum_editor_wrapTopLevelParagraphs($doc, $root)
{
    // Canonical storage uses real <p> elements for paragraphs. A single BR
    // remains an intentional line break; two consecutive BRs separate
    // paragraphs. Real block elements (lists, quotes, code, tables) remain
    // siblings and are never wrapped in a paragraph.
    $children = array();
    foreach ($root->childNodes as $child) {
        $children[] = $child;
    }

    while ($root->firstChild) {
        $root->removeChild($root->firstChild);
    }

    $paragraph = null;
    $breakRun = 0;

    $flushParagraph = function () use ($root, &$paragraph, &$breakRun) {
        if ($paragraph !== null && $paragraph->hasChildNodes()) {
            // Remove trailing BRs: they are structural separators, not content.
            while ($paragraph->lastChild
                && $paragraph->lastChild->nodeType === XML_ELEMENT_NODE
                && strtolower($paragraph->lastChild->nodeName) === 'br'
            ) {
                $paragraph->removeChild($paragraph->lastChild);
            }
            if ($paragraph->hasChildNodes()) {
                $root->appendChild($paragraph);
            }
        }
        $paragraph = null;
        $breakRun = 0;
    };

    foreach ($children as $child) {
        if (forum_editor_nodeIsBlock($child)
            && strtolower($child->nodeName) !== 'br'
            && strtolower($child->nodeName) !== 'p'
        ) {
            $flushParagraph();
            $root->appendChild($child);
            continue;
        }

        if ($child->nodeType === XML_ELEMENT_NODE
            && strtolower($child->nodeName) === 'p'
        ) {
            $flushParagraph();
            $root->appendChild($child);
            continue;
        }

        if ($child->nodeType === XML_ELEMENT_NODE
            && strtolower($child->nodeName) === 'br'
        ) {
            $breakRun++;
            if ($breakRun >= 2) {
                $flushParagraph();
            } elseif ($paragraph !== null) {
                $paragraph->appendChild($child);
            }
            continue;
        }

        if ($child->nodeType === XML_TEXT_NODE && trim($child->nodeValue) === '') {
            if ($paragraph !== null) {
                $paragraph->appendChild($child);
            }
            continue;
        }

        if ($paragraph === null) {
            $paragraph = $doc->createElement('p');
        }
        $breakRun = 0;
        $paragraph->appendChild($child);
    }

    $flushParagraph();
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
    forum_editor_wrapTopLevelParagraphs($doc, $root);
    forum_editor_restoreSmilies($doc, $root);

    $autotags = array();
    $xpath = new DOMXPath($doc);
    $nodes = $xpath->query('//*[@data-forum-autotag]');

    for ($i = $nodes->length - 1; $i >= 0; $i--) {
        $node = $nodes->item($i);
        $marker = '___FORUM_EDITOR_RESTORE_' . $i . '___';
        $autotags[$marker] = $node->getAttribute('data-forum-autotag');
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
