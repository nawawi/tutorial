<?php
include_once("./functions-session.php");
if ( !_session_check() ) {
    echo "Sila <a href='login.php'>Login</a>!!!<br>";
    exit;
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
<form action='save.php' method='post'>
<table>
<tr>
<th>Login</th>
<td>
<input type='text' name='login' value=''>
</td>
</tr>

<tr>
<th>Password</th>
<td>
<input type='password' name='password' value=''>
</td>
</tr>

<tr>
<th>Full Name</th>
<td>
<input type='text' name='fullname' value=''>
<td>
</tr>

</table>
<input type='submit' value='Save'>
</form>

<br>
<a href='view.php'>Home</a>

<br><br>
<a href='logout.php'>Logout</a>

</body>
</html>










