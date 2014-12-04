<?php
class users {
    public $mydata = null;
    private $db = null;

    public function __construct() {
        $this->handle = $GLOBALS['handle']; 
        $this->db = $this->handle->db;
    }

    public function index() {
        $this->handle->_loadtpl("index");
    }

    public function login($data) {
        if ( !isset($data['login']) || $data['login'] == '' 
            || !isset($data['password']) || $data['password'] == '' ) {
            echo "Salah parameter!!";
            exit;
        }
        $sql = "select * from users where login='{$data['login']}' and ";
        $sql .= "password='".md5($data['password'])."' ";

        $result = $this->db->query($sql);
        if ( is_object($result) && $result->num_rows <= 0 ) {
            echo "Login Id atau password tidak sah <a href='{$this->handle->baseurl}'>Sila login semula</a>!";
            exit;
        }
        $data = array();
        if ( is_object($result) ) {
            while( $row = $result->fetch_object() ) {
                $data['id'] = $row->id;
                $data['login'] = $row->login;
                $data['fullname'] = $row->fullname;
                $data['lastlogin'] = $row->lastlogin;
            }
        }
        // dapatkan data dari table kedua
        if ( !empty($data) ) {
            $sql = "select * from users_data where users_id='{$data['id']}' ";
            $result = $this->db->query($sql);
            $data2 = array();
            if ( is_object($result) ) {
                while( $row = $result->fetch_object() ) {
                    $data2['mobile'] = $row->mobile;
                }
            }
        }
        $data_last = array();
        $data_last = array_merge($data, $data2);
        
        // update last login
        $lastlogin = date('Y-m-d H:i:s');
        $sql = "UPDATE users SET lastlogin='{$lastlogin}' WHERE id='{$data['id']}'";
        $this->db->query($sql);
        
        $this->handle->session->_session_login($data_last);

        if ( $this->handle->session->_session_check() ) {
            $this->handle->_loadtpl("index");
        }
        echo "Login Id atau password tidak sah <a href='{$this->handle->baseurl}'>Sila login semula</a>!";
        exit;
    }

    public function logout() {
        $this->handle->_loadtpl("logout");
    }

    public function details($data) {
        $this->handle->_loadtpl("details");
    }

    // sample action save
    public function save($data) {
        echo "<b>Action: ".__FUNCTION__."()</b><br>";
    }

    // sample action delete
    public function delete($data) {
        echo "<b>Action: ".__FUNCTION__."()</b><br>";
    }

    // sample action update
    public function update($data) {
        echo "<b>Action: ".__FUNCTION__."()</b><br>";
    }

}
