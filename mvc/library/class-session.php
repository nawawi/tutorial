<?php
class session {

    // Session timeout, setting dalam saat. nilai 0 = tamat bila tutup browser.
    public $session_timeout = 0;

    // Nama session
    public $session_name = "TEST123";

    // File untuk simpan session. Jika tidak mahu gunakan default.
    public $session_path = "C:/xampp/htdocs/test/sessions";
    //public $session_path = "/tmp/sessions";

    // Cookie hanya akan set untuk https sahaja. Tidak digunakan dalam banyak kes, cuma sebagai
    // rujukan.
    public $session_cookie_secure = false;

    // function untuk menetapkan setting untuk session
    public function __construct() {
        if ( $this->session_timeout == 0 ) {
            ini_set("session.cache_expire", 600);
            ini_set("session.gc_maxlifetime", 36000);
            ini_set("session.cookie_lifetime", 36000);
        }

        if ( isset($this->session_name) && $this->session_name != '' ) {
            ini_set('session.name', $this->session_name);
        }

        if ( isset($this->session_path) && is_dir($this->session_path) ) {
            session_save_path($this->session_path);
            ini_set('session.gc_probability', 1);
        }

        if ( $this->session_cookie_secure ) {
            ini_set('session.cookie_secure','1');
        }
    }

    // function untuk memulakan session. Akan digunakan pada setiap page.
    public function _session_start() {
        @session_start();
    }

    // function untuk menyimpan data login kedalan session
    public function _session_login($data_last) {
        $this->_session_start();

        $session_name = $this->session_name;
        // save data dari database ke session
        foreach( $data_last as $param => $value ) {
            $_SESSION[$session_name][$param] = $value;
        }
    }

    // function untuk periksan session
    public function _session_check() {
        $this->_session_start();

        if ( isset($_SESSION[$this->session_name]) && !empty($_SESSION[$this->session_name]) ) {
            return true;
        }
        return false;
    }

    // function untuk mendapatkan data session
    public function _session_data() {
        if ( $this->_session_check() ) {
            return $_SESSION[$this->session_name];
        }
        return null;
    }

    // function untuk mematikan session
    public function _session_logout() {
        $this->_session_start();
        @unlink(session_save_path()."/sess_".session_id());
        session_unset();
        session_destroy();
        session_write_close();
    }

    // function info pengguna
    public function _info_login() {
        $data = $this->_session_data();
        $lastlogin = date('d/M/Y h:i A', strtotime($data['lastlogin']) );
        echo "<br><br>Login sebagai {$data['login']}, login terakhir pada {$lastlogin}<br>";
    }

}


