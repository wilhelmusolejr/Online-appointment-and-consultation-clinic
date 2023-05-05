<?php 
$path = "../../";

require_once $path.'classes/user.class.php';

session_start();

$user = new user;
$user -> user_id = $_SESSION['user_loggedIn']['user_id'];
$user -> resetNotif();