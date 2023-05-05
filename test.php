<?php 
$path = "";

session_start();

require_once 'php/general.php';
require_once $path.'classes/appoint.class.php';
require_once $path.'classes/user.class.php';

$appoint = new appoint;
$user = new user;

$user -> user_id = 1;
$user -> resetNotif();


?>