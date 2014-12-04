<?php
define('ABSPATH', dirname(realpath(__FILE__)) . '/' );
define('TPLPATH', ABSPATH."tpl" );
define('LIBPATH', ABSPATH."lib" );

function autoload($name) {
    $file = LIBPATH.'/class-'.$name.'.php';
    if ( file_exists($file) ) {
        if ( !include_once($file) ) exit("Loading class '".$name."' failed!");
    }
}
spl_autoload_register('autoload');

$handle = new handle();
$handle->process();


