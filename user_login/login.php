<?php
include_once("./check-security.php");
?>
<html>
<head>
<title>User Database</title>
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
<h1>Login Page</h1>
<form action='checklogin.php' method='post'>
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

</table>
<input type='submit' value='Login'>
</form>

<br>
<a href='index.php'>Home</a>
</body>
</html>










