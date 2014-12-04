<?php

class db {
    public $dbhost = "localhost";
    public $dbuser = "app";
    public $dbpassword = "app";
    public $dbname = "app";
    public $db = null;
    public function __construct() {
        $this->db = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
        if ( !is_object($this->db) ) {
            echo "Connection ke database gagal!!<br>";
            exit;
        }
    }
}

