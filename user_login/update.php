<?php
// check parameter
if ( !isset($_POST['id']) || $_POST['id'] == '' || (int)$_POST['id'] <= 0 ) {
    echo "Salah parameter!!";
    exit;
}

$error_message = "";
/*if ( !isset($_POST['password']) || $_POST['password'] == '' ) {
    $error_message = "Masukkan Password!!<br>";
}*/

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

// check Id wujud atau tidak
$sql = "select id from users where id='{$_POST['id']}' ";
$result = $dblink->query($sql);
if ( is_object($result) && $result->num_rows <= 0 ) {
    echo "Id {$_POST['id']} tidak wujud<br>";
    exit;
}

// check login sudah wujud dan tidak sama Id
$sql = "select login from users where login='{$_POST['login']}' and id!='{$_POST['id']}'";
$result = $dblink->query($sql);
if ( is_object($result) && $result->num_rows > 0 ) {
    echo "Login {$_POST['login']} sudah wujud. <a href='edit.php?id={$_POST['id']}'>Back</a><br>";
    exit;
}

// Execute query untuk update, akan return boolean TRUE or FALSE
$login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8', false);
$sql = "update users set login='{$login}',fullname='{$_POST['fullname']}'";

// jika password tidak empty, update password
if ( isset($_POST['password']) && $_POST['password'] != '' ) {
    $sql .= ",password='".md5($_POST['password'])."'";
}

$sql .= " where id='{$_POST['id']}' ";

$result = $dblink->query($sql);

// Jika bukan object dan boolean TRUE, atau number lebih dari 0
if ( !is_object($result) && $result  ) {
    echo "Data berjaya dikemaskini!!<br>";
    echo "<script>setTimeout( function() { self.location.href = 'index.php'; }, 1000 ); </script>";
} else {
    echo "<b style='color:red;'>Data tidak berjaya dikemaskini!!</b><br>";
}






















