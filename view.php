<?php
include_once("./functions-session.php");
if ( !_session_check() ) {
    echo "Sila <a href='login.php'>Login</a>!!!<br>";
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

// untuk debug
/*echo "<pre>";
print_r($dblink);
echo "</pre>";*/


// Query ke database
$sql = "select * from users";

// search
if ( isset($_GET['search']) && $_GET['search'] != '' ) {
    $field = ( isset($_GET['opt']) && $_GET['opt'] != '' ? $_GET['opt'] : "login" );
    $sql .= " where `{$field}` like \"%{$_GET['search']}%\" ";
}

$result = $dblink->query($sql);

// untuk debug
/*echo "<pre>";
print_r($result);
echo "</pre>";*/

// keluarkan data
/*while( $row = $result->fetch_object() ) {
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}*/

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

<!--- display data -->
<a href='addnew.php'>Add New</a><br><br>

<!--- kotak search -->
<form action='view.php' method='get'>
<select name="opt">
<?php
    foreach( array("login","fullname") as $opt ) {
        echo "<option value='{$opt}'".( isset($_GET['opt']) && $_GET['opt'] == $opt ? " selected" : "").">";
        echo "{$opt}</option>";
    }
?>
</select>
<input type="text" name="search" value="<?php echo (isset($_GET['search']) ? $_GET['search'] : ""); ?>"> 
<input type="submit" value="search"> <input type="button" value="Clear" onclick="location.href='view.php';">
</form>
<!--- / end kotak search -->

<table>
<tr>
<th>Id</th>
<th>Login</th>
<th>Full Name</th>
<th>Action</th>
</tr>
<?php
if ( is_object($result) ) {
    while( $row = $result->fetch_object() ) {
        echo "<tr>";
        echo "<td>{$row->id}</td>";
        echo "<td>{$row->login}</td>";
        echo "<td>{$row->fullname}</td>";
        echo "<td>";

        // delete
        echo "<a href='delete.php?id={$row->id}'>Delete</a>";

        echo "<br>";

        // edit
        echo "<a href='edit.php?id={$row->id}'>Edit</a>";

        echo "<br>";

        // show data
        echo "<a href='detail.php?id={$row->id}'>Details</a>";

        echo "</td>";
        echo "</tr>";
    }
}
?>
</table>
<!--- / end display data -->
<br><br>
<a href='logout.php'>Logout</a>
</body>
</html>










