<?php

// Session timeout, setting dalam saat. nilai 0 = tamat bila tutup browser.
$session_timeout = 0;

// Nama session
$session_name = "TEST123";

// File untum simpan session. Jika tidak mahu gunakan default.
//$session_path = "C:/xampp/htdocs/test/sessions";
$session_path = "/tmp/sessions";

// Cookie hanya akan set untuk https sahaja. Tidak digunakan dalam banyak kes, cuma sebagai
// rujukan.
$session_cookie_secure = false;


// function untuk menetapkan setting untuk session
function _session_init() {
    if ( $GLOBALS['session_timeout'] == 0 ) {
        ini_set("session.cache_expire", 600);
        ini_set("session.gc_maxlifetime", 36000);
        ini_set("session.cookie_lifetime", 36000);
    }

    if ( isset($GLOBALS['session_name']) && $GLOBALS['session_name'] != '' ) {
        ini_set('session.name', $GLOBALS['session_name']);
    }

    if ( isset($GLOBALS['session_path']) && is_dir($GLOBALS['session_path']) ) {
        session_save_path($GLOBALS['session_path']);
        ini_set('session.gc_probability', 1);
    }

    if ( $GLOBALS['session_cookie_secure'] ) {
        ini_set('session.cookie_secure','1');
    }
}

// function untuk memulakan session. Akan digunakan pada setiap page.
function _session_start() {
    _session_init();
    session_start();
}

// function untuk menyimpan data login kedalan session
function _session_login($data_last) {
    _session_start();

    $session_name = $GLOBALS['session_name'];
    // save data dari database ke session
    foreach( $data_last as $param => $value ) {
        $_SESSION[$session_name][$param] = $value;
    }
}

// function untuk periksan session
function _session_check() {
    _session_start();
    $session_name = $GLOBALS['session_name'];
    if ( isset($_SESSION[$session_name]) && !empty($_SESSION[$session_name]) ) {
        return true;
    }
    return false;
}

// function untuk mendapatkan data session
function _session_data() {
    if ( _session_check() ) {
        $session_name = $GLOBALS['session_name'];
        return $_SESSION[$session_name];
    }
    return null;
}

// function untuk mematikan session
function _session_logout() {
    _session_start();
    @unlink(session_save_path()."/sess_".session_id());
    session_unset();
    session_destroy();
    session_write_close();
}

