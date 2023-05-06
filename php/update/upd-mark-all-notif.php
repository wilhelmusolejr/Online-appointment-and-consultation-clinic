<?php 
$path = "../../";
require_once $path.'classes/notification.class.php';

session_start();

$notification = new notification;
$notification -> user_id = $_SESSION['user_loggedIn']['user_id'];
$notification -> markAllNotifRead();

header("location: ".$path."notification/notification.php");
exit();