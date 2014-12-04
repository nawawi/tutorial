<?php

class handle {
    public $request = null;
    public $db = null;

    public function __construct() {
        $this->request = array_merge($_GET, $_POST);

        $dblink = new db();
        $this->db = $GLOBALS['dblink'];
        $GLOBALS['handle'] = &$this;
    }

    public function _loadtpl($file) {
        $file = TPLPATH."/tpl_".$file.".php";
        $content = "";
        if ( file_exists($file) ) {
            ob_start();
            include_once($file);
            $content = ob_get_contents();
            ob_end_clean();
        }
        exit($content);
    }

    public function process() {
        $path = explode("/", $this->request['req']);
        $class = $path[0];
        $method = ( isset($path[1]) && $path[1] !='' ? $path[1] : "index" );
        if ( class_exists( $class) ) {
            $object = new $class();
            if ( method_exists($object, $method) ) {
                $object->{$method}($this->request);
            }
        }
        $this->_loadtpl("default");
    }
}
