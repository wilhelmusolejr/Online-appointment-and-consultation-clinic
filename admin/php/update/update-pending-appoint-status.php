<?php

$path = "../../../";

require_once $path.'classes/appoint.class.php';
require_once $path.'classes/consult.class.php';
require_once $path.'classes/user.class.php';
require_once $path.'classes/email.class.php';
require_once $path.'classes/notification.class.php';

//resume session here to fetch session values
session_start();

$appoint = new appoint;
$consult = new consult;
$user = new user;
$mail = new mail;
$notification = new notification;


$appoint -> transact_id = $_GET['transact_id'];
$consult -> transact_id = $_GET['transact_id'];

// update feedback in tbl_transact_appoint_checkpoint_appoint_status
$appoint -> btnFeedback = $_GET['button'] == "accept" ? "APPROVED" : "DECLINED";
$appoint -> updateAppointFeedback();


$user -> user_id = $appoint -> getTransact()['user_id'];
$userData =  $user -> getUserData();

$website = "wmsu-dietitianconsult.online/";

$latestTransact = $_GET['transact_id'];
$notifLink = "homepage/consultation/consultation.php?transact_id=".$latestTransact;
$anchorAppoint = "#".$latestTransact;


$notification -> user_id = $user -> user_id;
$mail -> receiver = $userData['email'];

// insert data to tbl_pending_appoint_rnd for RND to look for RND
if($_GET['button'] == "accept") {

  // send email to client for approval 
  if($userData['receiveNotifEmail'] == 1) {
    $mail -> subject = "WMSU Dietitian | #".$latestTransact." Appointment Approved";
    $mail -> content = "
    <div class='container-message-parent'>
      <br>
      <p>Dear Mr/Ms ".$userData['last_name']."</p>
      <p>Thank you for patiently waiting! Your
      appointment request with appointment <a href='".$website.$notifLink."'>".$anchorAppoint."</a> has been approved.</p>
      <br>
    </div>";

    $mail -> body = $mail -> finalTemplate();

    $mail -> sendingEmail();
  }

  // send in-app notif to client for approval
  $notification -> message = "Your appointment request with appointment ".$anchorAppoint." has been approved.";
  $notification -> link = $notifLink;   
  $notification -> sendNotification();

  $user -> transact_id = $_GET['transact_id'];
  $prefRnd = $user -> getAllPreferredRnd();
  $rnd_ids = [];
  foreach($prefRnd as $rnd) {
    array_push($rnd_ids, $rnd['rnd_id']);

    $appoint -> user_id = $rnd['rnd_id'];
    $appoint -> message = "There is a new appointment";
    $appoint -> link = "appointment/rnd/pending-appointment/pending-appointment.php";
    $appoint -> notifSetAppointment();
  }

  $consult -> rnd_id = $rnd_ids; // temporary list
  $setAppointRnd = $consult -> appointPendingRndStatus();
} else {
  // send email to client for approval 
  if($userData['receiveNotifEmail'] == 1) {
    $mail -> subject = "WMSU Dietitian | #".$latestTransact." Appointment Declined";
    $mail -> content = "
    <div class='container-message-parent'>
      <br>
      <p>Dear Mr/Ms ".$userData['last_name']."</p>
      <p>Your appointment request with appointment <a href='".$website.$notifLink."'>".$anchorAppoint."</a> has been declined. We are sorry for this unfortunate
      event. Hoping that we could serve you soon</p>
      <br>
    </div>";

    $mail -> body = $mail -> finalTemplate();

    $mail -> sendingEmail();
  }

  // send in-app notif to client for approval
  $notification -> message = "Your appointment request with appointment ".$anchorAppoint." has been declined.";
  $notification -> link = $notifLink;   
  $notification -> sendNotification();


  $appoint -> declineRnd();
}

// print_r($_GET);
header("Location:"." ".$path."admin/appointment/pending.php");
exit();
?>