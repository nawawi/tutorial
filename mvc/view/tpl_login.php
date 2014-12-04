<html>
<head>
<title>User Database</title>
<link href="asset/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>Login Page</h1>
<form action='<?php echo $this->baseurl;?>/users/login' method='post'>
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










