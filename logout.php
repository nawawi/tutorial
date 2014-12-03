<?php
include_once("./functions-session.php");

_session_logout();
if ( !_session_check() ) {
    echo "Logout berjaya!! <a href='login.php'>Login Semula</a><br>";
} else {
    echo "Logout tidak berjaya!!<br>";
}

