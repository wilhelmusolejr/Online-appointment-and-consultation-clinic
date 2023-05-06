<?php 
$path = "";
require_once "classes/email.class.php";
require_once "classes/notification.class.php";

session_start();


$notification = new notification;

$notification -> user_id = 1;
$notification -> message = "Your RND requested a monitoring for the appointment #".$_SESSION['transact_id'];
$notification -> link = $path."homepage/consultation/consultation.php?transact_id=".$_SESSION['transact_id'];   
$notification -> sendNotification();
?>