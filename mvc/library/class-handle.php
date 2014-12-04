<?php

class handle extends db {
    public $request = null;
    public $session = null;
    public $baseurl = null;

    public function __construct() {
        $this->request = array_merge($_GET, $_POST);
        parent::__construct();
        $this->session = new session();
        $this->baseurl = $this->_baseurl();
        $GLOBALS['handle'] = &$this;
    }

    public function _basehost() {
	    if ( empty($_SERVER) || !isset($_SERVER["HTTP_HOST"]) || is_null($_SERVER["HTTP_HOST"]) ) return null;
	    $schema = ( isset($_SERVER["HTTPS"]) && !is_null($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] = "on") ? "https://": "http://";
	    $host = $_SERVER["HTTP_HOST"];
	    return $schema.$host;
    }
    public function _baseurl() {
	    if ( php_sapi_name() != 'cli' && !is_null($_SERVER['SCRIPT_NAME']) ) {
		    $base = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
		    if ( $base != '/') $base = rtrim($base,'/');
		    $host = $this->_basehost();
		    $base = ( !is_null($host) ? ( ( $base != '/' ) ? $host.$base : $host."/".$base ) : ( ( $base != '/' ) ? $base : "" ) );
		    return rtrim($base,'/');
	    }
	    return null;
    }

    public function _loadtpl($file) {
        $file = TPLPATH."/tpl_".$file.".php";
        $content = "";
        if ( file_exists($file) ) {
            ob_start();
            include_once($file);
            $content = ob_get_contents();
            $content = preg_replace("/@@BASEURL@@/", $this->baseurl, $content );
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
        $this->_loadtpl("login");
    }
}
