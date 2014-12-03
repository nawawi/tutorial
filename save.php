<?php
// check parameter

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
$sql = "INSERT INTO users (id, login, password, fullname, lastlogin) ";
$sql .= "VALUES (NULL, '{$_POST['login']}', MD5('{$_POST['password']}'), '{$_POST['fullname']}', NULL)";

$result = $dblink->query($sql);

// Jika bukan object dan boolean TRUE, atau number lebih dari 0
if ( !is_object($result) && $result  ) {
    echo "OK<br>";
    echo "<script>setTimeout( function() { self.location.href = 'view.php'; }, 1000 ); </script>";
} else {
    echo "Tak OK<br>";
}






















