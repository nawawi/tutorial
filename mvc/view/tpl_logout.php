<?php
$this->session->_session_logout();
if ( !$this->session->_session_check() ) {
    echo "Logout berjaya!! <a href='{$this->baseurl}/'>Login Semula</a><br>";
} else {
    echo "Logout tidak berjaya!!<br>";
}

