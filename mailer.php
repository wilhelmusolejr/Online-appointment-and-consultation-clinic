<?php 
$path = "";
require_once "classes/email.class.php";
require_once "classes/notification.class.php";
require_once "classes/user.class.php";

session_start();

$user = new user;
$user -> user_id = 3;
$result = $user -> getCommunicationLink();

print_r($result); 




?>