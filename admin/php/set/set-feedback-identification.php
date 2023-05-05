<?php 
$path = "../../../";

require_once $path."classes/user.class.php";
require_once $path."classes/email.class.php";
require_once $path."classes/notification.class.php";

session_start();

$mail = new mail;
$user = new user;
$notification = new notification;

if(isset($_GET['user_id'])) {
  $user -> user_id = $_GET['user_id'];
  $user -> feedback = $_GET['feedback'];

  $userData = $user -> getUserData();

  $mail -> receiver = $userData['email'];
  $notification -> user_id = $userData['user_id'];

  $result = $user -> setFeedbackIdentification();
  
  if($_GET['feedback'] == "VERIFIED") {
    // email -- id -- accepted
    if($userData['receiveNotifEmail'] == 1) {
      $mail -> subject = "WMSU Dietitian | ID Verification Verified";
      $mail -> content = "
      <div class='container-message-parent'>
        <br>
        <p>Dear Mr/Ms ".$userData['last_name'].",</p>
        <p>Congratulations! Your ID has been successfully
        verified. Head on to have the full experience.</p>
        <br>
      </div>";
      $mail -> body = $mail -> finalTemplate();

      $mail -> sendingEmail();
    }

    // IN APP
    $notification -> message = "Congratulations! Your ID has been successfully verified.";
    $notification -> link = "profile/profile.php?profile-id=".$userData['user_id'];   
    $notification -> sendNotification();
  } else {
    // email -- id -- declined
    if($userData['receiveNotifEmail'] == 1) {
      $mail -> subject = "WMSU Dietitian | ID Verification declined";
      $mail -> content = "
      <div class='container-message-parent'>
        <br>
        <p>Dear Mr/Ms ".$userData['last_name'].",</p>
        <p>Unfortunately, your ID
        verification request was declined. Please
        upload another valid ID.</p>
        <br>
        <ul>
          <li>e-Card / UMID</li>
          <li>Employee’s ID / Office Id</li>
          <li>Driver’s License*</li>
          <li>Professional Regulation Commission
          (PRC) ID</li>
          <li>Passport</li>
          <li>Senior Citizen ID</li>
          <li>SSS ID</li>
        </ul>
        <br>
      </div>";
      $mail -> body = $mail -> finalTemplate();

      $mail -> sendingEmail();
    }

    // IN APP
    $notification -> message = "Unfortunately, your ID verification request was
    declined.";
    $notification -> link = "profile/profile.php?profile-id=".$userData['user_id'];   
    $notification -> sendNotification();
  }



  header("location: ".$path."admin/patient/pending-identification.php");
  exit();
}