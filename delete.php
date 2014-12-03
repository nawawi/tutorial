<?php
// check parameter
if ( !isset($_GET['id']) || $_GET['id'] == '' || (int)$_GET['id'] <= 0 ) {
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

// check Id wujud atau tidak
$sql = "select id from users where id='{$_GET['id']}' ";
$result = $dblink->query($sql);
if ( is_object($result) && $result->num_rows <= 0 ) {
    echo "Id {$_GET['id']} tidak wujud<br>";
    exit;
}

// Execute query untuk delete, akan return boolean TRUE or FALSE
$sql = "delete from users where id='{$_GET['id']}' ";
$result = $dblink->query($sql);

// Jika bukan object dan boolean TRUE, atau number lebih dari 0
if ( !is_object($result) && $result  ) {
    echo "OK<br>";
    echo "<script>setTimeout( function() { self.location.href = 'view.php'; }, 1000 ); </script>";
} else {
    echo "Tak OK<br>";
}






















