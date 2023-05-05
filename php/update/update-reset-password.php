<?php 
$path = "../../";

session_start();

require_once $path.'classes/user.class.php';
require_once $path.'classes/email.class.php';
require_once $path.'php/general.php';

$mail = new mail;
$user = new user;

$user -> email = validateInput($_POST['username']);
$isRegistered = $user -> checkIfEmailIsregistered();

if(!$isRegistered) {
  echo "Account is not yet registered";
  exit();
}

$veficationCode = generateVerifCode();

$user -> user_id = $isRegistered['user_id'];

$user -> verification_code = $veficationCode;
$result = $user -> deleteAllVerificationCode();
$result = $user -> setAccountVerification();
if(!$result) {
  echo "something went wrong";
  exit();
}

$userData = $user -> getUserData();

$website = "wmsu-dietitianconsult.online";
$link = $website."reset-password/reset-password.php?verif-code=".$veficationCode;

$mail -> receiver = $userData['email'];
$mail -> subject = "WMSU Dietitian | Account Password Reset";
$mail -> body = "
<p>Hello <strong>".$userData['first_name']." ".$userData['last_name']."</strong>,</p>
<br>
<p>We have received your request to reset your password. To proceed, please click the link below:</p>
<br>
<a href='".$link."'>".$link."</a>
";

$mail -> sendingEmail();

echo "success";
exit();