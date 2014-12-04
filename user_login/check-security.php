<?php
// security

function array_map_recursive($func, $arr) {
	$new = array();
	foreach($arr as $key => $value) {
		$new[$key] = (is_array($value) ? array_map_recursive($func, $value) : ( is_array($func) ? call_user_func_array($func, $value) : $func($value) ) );
	}
	return $new;
}

function _escape_html($str) {
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8', false);
}

function _remove_sql_inject($str) {
    $str = urldecode($str);
    $pat[] = "/'\s+AND\s+extractvalue.*/i";
    $pat[] = "/'\s+and\(.*/i";
    $pat[] = "/select\s+.*?\s+from.*/i";
    $pat[] = "/(rand|user|version|database)\(.*/i";
    $pat[] = "/union\(.*/i";
    $pat[] = "/CONCAT\(.*/i";
    $pat[] = "/CONCAT_WS\(.*/i";
    $pat[] = "/ORDER\s+BY.*/i";
    $pat[] = "/UNION\s+SELECT.*/i";
    $pat[] = "/'\s+union\s+select\+.*/i";
    $pat[] = "/GROUP_CONCAT.*/i";
    $pat[] = "/delete\s+from.*/i";
    $pat[] = "/update\s+.*?\s+set=.*/i";
    $pat[] = "/'\s+and\s+\S+\(.*/i";
    $pat[] = "/'\s+and\s+\S+\s+\(.*/i";
    return preg_replace($pat,"", $str);
}

if ( !empty($_GET) ) {
    $_GET = array_map_recursive('_remove_sql_inject', $_GET);
    $_GET = array_map_recursive('_escape_html', $_GET);
}

if ( !empty($_POST) ) {
    $_POST = array_map_recursive('_remove_sql_inject', $_POST);
    $_POST = array_map_recursive('_escape_html', $_POST);
}

if ( !empty($_REQUEST) ) {
    $_REQUEST = array_map_recursive('_remove_sql_inject', $_REQUEST);
    $_REQUEST = array_map_recursive('_escape_html', $_REQUEST);
}

if ( !empty($_COOKIE) ) {
    $_COOKIE = array_map_recursive('_remove_sql_inject', $_COOKIE);
}


