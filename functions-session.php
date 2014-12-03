<?php

// Session
$session_timeout = 0;
$session_name = "TEST123";
$session_path = "C:/xampp/htdocs/test/sessions";
//$session_path = "/tmp/sessions";
$session_cookie_secure = false;

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

function _session_start() {
    _session_init();
    session_start();
}

function _session_login($data_last) {
    _session_start();

    $session_name = $GLOBALS['session_name'];
    // save data dari database ke session
    foreach( $data_last as $param => $value ) {
        $_SESSION[$session_name][$param] = $value;
    }
}

function _session_check() {
    _session_start();
    $session_name = $GLOBALS['session_name'];
    if ( isset($_SESSION[$session_name]) && !empty($_SESSION[$session_name]) ) {
        return true;
    }
    return false;
}

function _session_data() {
    if ( _session_check() ) {
        $session_name = $GLOBALS['session_name'];
        return $_SESSION[$session_name];
    }
    return null;
}

function _session_logout() {
    _session_start();
    @unlink(session_save_path()."/sess_".session_id());
    session_unset();
    session_destroy();
    session_write_close();
}

