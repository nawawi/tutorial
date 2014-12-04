<?php
if ( !$this->session->_session_check() ) exit;

// Query ke database
$sql = "select * from users where 1";

// search
if ( isset($this->request['search']) && $this->request['search'] != '' ) {
    $field = ( isset($this->request['opt']) && $this->request['opt'] != '' ? $this->request['opt'] : "login" );
    $sql .= " and `{$field}` like \"%{$this->request['search']}%\" ";
}

$result = $this->db->query($sql);

// pagging
$page_pagging = false;
$rowpage = 5;
$data_total  = $result->num_rows;
$page_record = $page_total = $page_first = $page_next = $page_prev = $page_last = 0;

if ( is_object($result) && $data_total > $rowpage ) { 
    $page_record = ( isset($this->request['page_record']) ? $this->request['page_record'] : 0 );
    $max_row = ( isset($this->request['max_row']) ? $this->request['max_row'] : $rowpage );
    $start_row = @($page_record * $max_row);

    $sql .= " LIMIT $start_row, $max_row";

    $result1 = $this->db->query($sql);
    $result = $result1;

    $page_total = @ceil( $data_total / $max_row );

    if ( $page_total > 1 ) {
        $page_pagging = true;

        if ( $page_record > 0 ) {
            $page_first = 0;
            $page_prev = max(0, $page_record - 1);
        }

        if ( $page_record < $page_total ) {
            $page_next = min($page_total, $page_record + 1);
            $page_last = $page_total - 1;
        }

        if ( $page_next >= $page_total ) {
            $page_next -= 1;
        }
    }
    $pagging = "index.php?";
    if ( isset($this->request['search']) ) {
        $pagging .= "search={$this->request['search']}";
    }
    if ( isset($this->request['opt']) ) {
        $pagging .= "&opt={$this->request['opt']}";
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
<h1>Home: User Database</h1>
<hr>

<!--- display data -->
<a href='addnew.php'>Add New</a><br><br>

<!--- kotak search -->
<form action='index.php' method='get'>
<select name="opt">
<?php
    foreach( array("login","fullname") as $opt ) {
        echo "<option value='{$opt}'".( isset($this->request['opt']) && $this->request['opt'] == $opt ? " selected" : "").">";
        echo "{$opt}</option>";
    }
?>
</select>
<input type="text" name="search" value="<?php echo (isset($this->request['search']) ? $this->request['search'] : ""); ?>"> 
<input type="submit" value="search"> <input type="button" value="Clear" onclick="location.href='index.php';">
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
        echo "Page ".( $page_record+1 )." of {$page_total}&nbsp;&nbsp;";
        echo "<a href='{$pagging_prev}'>Previous</a>&nbsp;&nbsp;";
        echo "<a href='{$pagging_last}'>Last</a><br><br>";
    }
}
?>
</table>
<!--- / end display data -->
<br><br>
<hr>
<a href='<?php echo $this->baseurl;?>/users/logout'>Logout</a>

<?php
$this->session->_info_login();
?>
</body>
</html>










