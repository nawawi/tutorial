<?php
// check parameter
include_once("./functions-session.php");
if ( !_session_check() ) {
    echo "Sila <a href='login.php'>Login</a>!!!<br>";
    exit;
}

$error_message = "";
if ( !isset($_POST['password']) || $_POST['password'] == '' ) {
    $error_message = "Masukkan Password!!<br>";
}

if ( !isset($_POST['login']) || $_POST['login'] == '' ) {
    $error_message .= "Masukkan Login!!<br>";
}

if ( $error_message != "" ) {
    echo $error_message;
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

// check login sudah wujud atau tidak
$sql = "select login from users where login='{$_POST['login']}' ";
$result = $dblink->query($sql);
if ( is_object($result) && $result->num_rows > 0 ) {
    echo "Login {$_POST['login']} sudah wujud. <a href='addnew.php'>Back</a><br>";
    exit;
}

// Execute query untuk insert, akan return boolean TRUE or FALSE
$login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8', false);
$sql = "INSERT INTO users (id, login, password, fullname, lastlogin) ";
$sql .= "VALUES (NULL, '{$login}', MD5('{$_POST['password']}'), '{$_POST['fullname']}', NULL)";

$result = $dblink->query($sql);

// Jika bukan object dan boolean TRUE, atau number lebih dari 0
if ( !is_object($result) && $result  ) {
    echo "Data berjaya disimpan!!<br>";
    echo "<script>setTimeout( function() { self.location.href = 'index.php'; }, 1000 ); </script>";
} else {
    echo "<b style='color:red;'>Data tidak berjaya disimpan!!</b><br>";
}






















