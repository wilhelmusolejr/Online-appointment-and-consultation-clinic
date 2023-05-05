<?php 

$path = "../../";

session_start();

require_once $path."classes/email.class.php";
require_once $path."classes/user.class.php";
require_once $path."php/general.php";

$userData = $_POST['userData'];

$veficationCode = generateVerifCode();

$user = new user;
$mail = new mail;

$user -> first_name = $userData['first_name'];
$user -> birthdate = $userData['birthdate']; 

$user -> email = $userData['email'];
$user -> user_id = $user -> getLatestUserIdTwo();
$user -> verification_code = $veficationCode;
$result = $user -> deleteAllVerificationCode();
$result = $user -> setAccountVerification();

if(!$result) {
  echo "something went wrong";
  exit();
}

$website = "https://wmsu-dietitianconsult.online/"; 
$link = $website."verify/verify-account.php?verif-code=".$veficationCode;

$mail -> receiver = $userData['email'];
$mail -> subject = "WMSU Dietitian | Account Verification";
$mail -> body = "
<h1 style='text-transform: uppercase'>Welcome to the clinic!</h1>
<br>
<p>Hello <strong>".$userData['first_name']." ".$userData['last_name']."</strong>,</p>
<br>
<p>Thanks for registering. To activate your account, please click on this <a href=".$link.">link</a> or copy and paste the link <br>provided below into your browser's address bar.</p>
<br>
<a href='".$link."'>".$link."</a>
";                   

$mail -> sendingEmail();

echo "success";
exit();

?>