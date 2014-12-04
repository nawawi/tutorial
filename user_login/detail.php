<?php
include_once("./functions-session.php");
if ( !_session_check() ) {
    echo "Sila <a href='login.php'>Login</a>!!!<br>";
    exit;
}

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

// Query ke database
$result = $dblink->query("select * from users where id='{$_GET['id']}' ");
?>

<html>
<head>
<title>Database</title>
<style>
table {
    width: 100%;
    border: 1px solid black;
}
th {
    font-weight: bold;
    text-align: left;
    border: 1px solid black;
}
td {
    text-align: left;
    border: 1px solid black;
}
</style>
</head>
<body>
<h1>Details: User Database</h1>
<hr>
<a href='view.php'>Home</a> / <a href='addnew.php'>Add New</a> / <a href='edit.php?id=<?echo $_GET['id'];?>'>Edit</a> / <a href='delete.php?id=<?echo $_GET['id'];?>'>Delete</a>
<br><br>

<?php 
if ( !is_object($result) ) {
    echo "Tiada Data";
} else {
    $id = "";
    $login = "";
    $fullname = "";
    while( $row = $result->fetch_object() ) {
        $id = $row->id;
        $login = $row->login;
        $fullname = $row->fullname;
    }
    echo "<table>";

    echo "<tr>";
    echo "<th>Id</th>";
    echo "<td>";
    echo $id;
    echo "<t/d>";
    echo "</tr>";

    echo "<tr>";
    echo "<th>Login</th>";
    echo "<td>";
    echo $login;
    echo "<t/d>";
    echo "</tr>";

    echo "<tr>";
    echo "<th>Full Name</th>";
    echo "<td>";
    echo $fullname;
    echo "<t/d>";
    echo "</tr>";

    echo "</table>";
}

?>



<br><br>
<hr>
<a href='logout.php'>Logout</a>

<?php
_info_login();
?>

</body>
</html>










