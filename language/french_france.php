<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | Geeklog Forums Plugin 2.9.1                                               |
// +---------------------------------------------------------------------------+
// | french_france.php                                                         |
// | Legacy French language adapter                                            |
// +---------------------------------------------------------------------------+
//
// The UTF-8 file is the canonical French translation. This legacy language
// file loads it and converts only the Forum plugin strings to ISO-8859-1.
// Keeping a single translation source prevents the legacy and UTF-8 files
// from drifting apart while preserving compatibility with older Geeklog
// installations that request the non-UTF-8 language file.
//

require __DIR__ . '/french_france_utf-8.php';

if (!function_exists('FORUM_convertLanguageToLegacyCharset')) {
    function FORUM_convertLanguageToLegacyCharset(&$value)
    {
        if (is_array($value)) {
            foreach ($value as &$item) {
                FORUM_convertLanguageToLegacyCharset($item);
            }
            unset($item);
            return;
        }

        if (!is_string($value) || $value === '') {
            return;
        }

        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $value);
            if ($converted !== false) {
                $value = $converted;
                return;
            }
        }

        // utf8_decode is available on the PHP versions targeted by legacy
        // Geeklog installations and provides a safe fallback for Latin-1.
        if (function_exists('utf8_decode')) {
            $value = utf8_decode($value);
        }
    }
}

$forumLanguageArrays = array(
    'LANG_GF00',
    'LANG_GF01',
    'LANG_GF02',
    'LANG_GF03',
    'LANG_GF04',
    'LANG_GF05',
    'LANG_GF06',
    'LANG_GF07',
    'LANG_GF08',
    'LANG_GF09',
    'LANG_GF91',
    'LANG_GF92',
    'LANG_GF93',
    'LANG_GF95',
    'LANG_GF96',
    'LANG_GF_SMILIES'
);

foreach ($forumLanguageArrays as $forumLanguageArray) {
    if (isset($GLOBALS[$forumLanguageArray])) {
        FORUM_convertLanguageToLegacyCharset($GLOBALS[$forumLanguageArray]);
    }
}

$forumConfigLanguageArrays = array(
    'LANG_configsections',
    'LANG_confignames',
    'LANG_configsubgroups',
    'LANG_tab',
    'LANG_fs',
    'LANG_configselects'
);

foreach ($forumConfigLanguageArrays as $forumConfigLanguageArray) {
    if (isset($GLOBALS[$forumConfigLanguageArray]['forum'])) {
        FORUM_convertLanguageToLegacyCharset($GLOBALS[$forumConfigLanguageArray]['forum']);
    }
}

$forumLanguageMessages = array(
    'PLG_forum_MESSAGE1',
    'PLG_forum_MESSAGE2',
    'PLG_forum_MESSAGE5'
);

foreach ($forumLanguageMessages as $forumLanguageMessage) {
    if (isset($GLOBALS[$forumLanguageMessage])) {
        FORUM_convertLanguageToLegacyCharset($GLOBALS[$forumLanguageMessage]);
    }
}

unset(
    $forumLanguageArrays,
    $forumLanguageArray,
    $forumConfigLanguageArrays,
    $forumConfigLanguageArray,
    $forumLanguageMessages,
    $forumLanguageMessage
);
?>
