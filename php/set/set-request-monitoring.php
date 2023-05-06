<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';
require_once $path.'classes/email.class.php';
require_once $path.'classes/user.class.php';
require_once $path.'classes/appoint.class.php';
require_once $path.'classes/notification.class.php';

session_start();

$monitor = new monitor;
$user = new user;
$mail = new mail;
$notification = new notification;
$appoint = new appoint;

$monitor -> transact_id = $_SESSION['transact_id'];
$monitor -> monitor_date = $_POST['appointment-date'];

$isExisting = $monitor -> checkRequestMonitorId();

if($isExisting) {
  $monitor -> monitorFeedback("pending");
  echo true;
  exit();
}

$result = $monitor -> addRequestMonitor();

$appoint -> transact_id = $_SESSION['transact_id'];
$user -> user_id = $appoint -> getTransact()['user_id'];

$userData = $user -> getUserData();

// EMAIL - REQUEST MONITORING - RECEIVE BY CLIENT
if($userData['receiveNotifEmail'] == 1) {
  $mail -> receiver = $userData['email'];
  $mail -> subject = "WMSU Dietitian | #123 Appointment Monitoring Request";
  $mail -> content = "
  <div class='container-message-parent'>
    <br>
    <p>Dear Mr/Ms ".$userData['last_name'].",</p>
    <p>Your RND requested a monitoring for the appointment #".$_SESSION['transact_id']."</p>
    <br>
  </div>";
  $mail -> body = $mail -> finalTemplate();

  $mail -> sendingEmail();
}

 // NOTIF APP
 $notification -> user_id = $userData['user_id'];
 $notification -> message = "Your RND requested a monitoring for the appointment #".$_SESSION['transact_id'];
 $notification -> link = "homepage/consultation/consultation.php?transact_id=".$_SESSION['transact_id'];   
 $notification -> sendNotification();

if($result) {
  echo true;
} else {
  echo false;
}
exit();

?>