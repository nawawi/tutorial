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
$sql = "select * from users where 1";

// search
if ( isset($_GET['search']) && $_GET['search'] != '' ) {
    $field = ( isset($_GET['opt']) && $_GET['opt'] != '' ? $_GET['opt'] : "login" );
    $sql .= " and `{$field}` like \"%{$_GET['search']}%\" ";
}

$result = $dblink->query($sql);

// untuk debug
//echo "<pre>";
//print_r($result);
//echo "</pre>";

// pagging
$page_pagging = false;
$rowpage = 5;
$data_total  = $result->num_rows;
if ( is_object($result) && $data_total > $rowpage ) { 
    $page_record = ( isset($_GET['page_record']) ? $_GET['page_record'] : 0 );
    $max_row = ( isset($_GET['max_row']) ? $_GET['max_row'] : $rowpage );
    $start_row = @($page_record * $max_row);

    $sql .= " LIMIT $start_row, $max_row";
    $result1 = $dblink->query($sql);
    $result = $result1;

    if ( isset($_GET['page_total']) ) {
        $page_total = @ceil( $data_total / $max_row );
    } else {
         $page_total = 1;
    }

    if ( $page_total >= 1 ) {
        $page_pagging = true;

        if ( $page_record > 0 ) {
            $page_first = 0;
            $page_prev = max(0, $page_record - 1);
        }

        if ( $page_record < $page_total ) {
            $page_next = min($page_total - 1, $page_record + 1);
            $page_last = ( $page_total - 1 );
        }
    }
    $pagging = "view.php?";
    if ( isset($_GET['search']) ) {
        $pagging .= "search={$_GET['search']}";
    }
    if ( isset($_GET['opt']) ) {
        $pagging .= "&opt={$_GET['opt']}";
    }
    $pagging .= "&max_row={$max_row}&page_total={$page_total}";
    
    $pagging_first = "{$pagging}&page_record={$page_first}";
    $pagging_next = "{$pagging}&page_record={$page_next}";
    $pagging_prev = "{$pagging}&page_record={$page_prev}";
    $pagging_last = "{$pagging}&page_record={$page_last}";
}
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
    if ( $page_pagging ) {
        echo "<a href='{$pagging_first}'>First</a>&nbsp;&nbsp;";
        echo "<a href='{$pagging_next}'>Next</a>&nbsp;&nbsp;";
        echo "<a href='{$pagging_prev}'>Previous</a>&nbsp;&nbsp;";
        echo "<a href='{$pagging_last}'>Last</a>";
    }
}
?>
</table>
<!--- / end display data -->
<br><br>
<a href='logout.php'>Logout</a>

<?php
_info_login();
?>
</body>
</html>










