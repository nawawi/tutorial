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
//$sql = "select * from users where login='{$_POST['login']}' and password='".md5($_POST['password'])."' ";

// kalau combine table. masalah, data empty jika salah satu table empty.
$sql = "select users.*,users_data.* from users,users_data where users.login='{$_POST['login']}' ";
$sql .= "and users.password='".md5($_POST['password'])."' ";

$result = $dblink->query($sql);
if ( is_object($result) && $result->num_rows <= 0 ) {
    echo "Login Id atau password tidak sah <a href='login.php'>Sila login semula</a>!";
    exit;
}

// get data
$data = array();
if ( is_object($result) ) {
    while( $row = $result->fetch_object() ) {
        //echo "<pre>";
        //print_r($row);
        //echo "</pre>";

        $data['id'] = $row->id;
        $data['login'] = $row->login;
        $data['fullname'] = $row->fullname;
        $data['lastlogin'] = $row->lastlogin;
    }
}

// test data
echo "<pre>";
print_r($data);
echo "</pre>";

// update last login
$lastlogin = date('Y-m-d H:i:s');
$sql = "UPDATE users SET lastlogin='{$lastlogin}' WHERE id='{$data['id']}'";
$dblink->query($sql);

//echo "<pre>";
//print_r($result);
//echo "</pre>";




















