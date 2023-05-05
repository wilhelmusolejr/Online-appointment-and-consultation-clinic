<?php 
$path = "../../";

require_once $path.'classes/notification.class.php';

session_start();

$notif = new notification();

$notif -> tbl_notif_id = $_GET['notif_id'];
$notif -> setNotRead();

$link = $notif -> getLink()['link'];


// print_r($link);
print_r($path.$link);

header("location: ".$path.$link);
exit();