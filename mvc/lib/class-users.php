<?php
class users {
    public $mydata = null;

    function __construct() {
        $this->handle = $GLOBALS['handle']; 
    }

    function index() {
        $this->handle->_loadtpl("index");
    }

    function details($data) {
        $this->handle->_loadtpl("details");
    }

    // sample action save
    function save($data) {
        echo "<b>Action: ".__FUNCTION__."()</b><br>";
    }

    // sample action delete
    function delete($data) {
        echo "<b>Action: ".__FUNCTION__."()</b><br>";
    }

    // sample action update
    function update($data) {
        echo "<b>Action: ".__FUNCTION__."()</b><br>";
    }

}
