<?php

class db {
    public $dbhost = "localhost";
    public $dbuser = "app";
    public $dbpassword = "app";
    public $dbname = "app";

    public function __construct() {
        $dblink = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
        if ( !is_object($dblink) ) {
            echo "Connection ke database gagal!!<br>";
            exit;
        }
        $GLOBALS['dblink'] = $dblink;
    }
}

