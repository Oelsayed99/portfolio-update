<?php

/**
 * Translation Helper
 */

function translate($msgid) {
    global $db;
    
    // Get current language from session or cookie
    $lang = $_SESSION['lang'] ?? $_COOKIE['lang'] ?? 'en';
    
    // Fetch translation from DB
    $stmt = $db->prepare("SELECT `$lang` FROM translations WHERE msgid = ?");
    $stmt->execute([$msgid]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result[$lang] ?? $msgid;
}

/**
 * Language Switcher Helper
 */
function get_current_lang() {
    return $_SESSION['lang'] ?? $_COOKIE['lang'] ?? 'en';
}

function is_rtl() {
    return get_current_lang() === 'ar';
}
