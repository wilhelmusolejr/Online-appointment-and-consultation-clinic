<?php
//resume session
session_start();

//empty session
$_SESSION = array();

//destroy session
session_destroy();

//then send user to login page (`@` suppresses any error messages that may occur when sending a HTTP header using the header() function)
@header('location: ../homepage/index.php');
?>
