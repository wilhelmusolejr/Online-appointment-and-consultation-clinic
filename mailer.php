<?php 
$path = "";
require_once "classes/email.class.php";

$user = $_SESSION['user_loggedIn'];

$date = "2023-10-10";
$time = "10:10:10";
$reason = "wala lang";
$website = "wmsu-dietitianconsult.online";


$mail = new mail;
$mail -> receiver = "gregory.yames@gmail.com";
$appoints = 123;
$mail -> subject = "WMSU Dietitian | #".$appoints." Appointment Received";
$mail -> content = "<div class='container-message-parent'>
<br>
<p>Dear John,</p>
<p>Thanks for subscribing to our newsletter. We have some exciting news to share with you. <a href='#'>Click here</a> to read our latest blog post.</p>
<br>
<p>Best regards,</p>
<p>The My Email Team</p>
</div>";
$mail -> body = $mail -> finalTemplate();

$mail -> sendingEmail();
?>