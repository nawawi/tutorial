<?php
if ( !$this->session->_session_check() ) {
    echo "<a href='{$this->baseurl}/'>Login Semula</a><br>";
    exit;
}
?>
<html>
<head>
<title>Database</title>
<link href="asset/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>Home: User Database</h1>

<hr>
<a href='<?php echo $this->baseurl;?>/users/logout'>Logout</a>

<?php
$this->session->_info_login();
?>
</body>
</html>










