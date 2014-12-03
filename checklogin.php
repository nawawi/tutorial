<?php
// check parameter
if ( !isset($_POST['login']) || $_POST['login'] == '' || !isset($_POST['password']) || $_POST['password'] == '' ) {
    echo "Salah parameter!!";
    exit;
}

$dbhost = "localhost";
$dbuser = "app";
$dbpassword = "app";
$dbname = "app";

$dblink = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if ( !is_object($dblink) ) {
    echo "Connection ke database gagal!!<br>";
    exit;
}

// check login dan password
$sql = "select * from users where login='{$_POST['login']}' and password='".md5($_POST['password'])."' ";
$result = $dblink->query($sql);
if ( is_object($result) && $result->num_rows <= 0 ) {
    echo "Login Id atau password tidak sah!";
    exit;
}

echo "<pre>";
print_r($result);
echo "</pre>";




















