<?php

require_once '../lib-common.php';

if (!in_array('forum', $_PLUGINS)) {
    COM_handle404();
    exit;
}

header('Content-Type: application/json; charset=UTF-8');

$token = isset($_POST['token']) ? trim(COM_stripslashes($_POST['token'])) : '';

if ($token === '' || strlen($token) > 2048
    || !preg_match('/^\[[A-Za-z][A-Za-z0-9_-]*:[^\]]+\]$/', $token)
) {
    echo json_encode(array('html' => ''));
    exit;
}

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

echo json_encode(array('html' => $rendered));
