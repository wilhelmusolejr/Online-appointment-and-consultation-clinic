<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function validateInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function setMail() {
  $mail = new PHPMailer(true);

  $mail -> isSMTP();
  $mail -> Host = 'smtp.hostinger.com';
  $mail -> Port = 587;
  $mail -> SMTPAuth = true;

  $mail->Username = 'admin@wmsu-dietitianconsult.online';
  $mail->Password = 'Qw09058222!';
  return $mail;
}

function emailSendEmailActivation($userData, $veficationCode, $path) {
  require_once $path."api/phpmailer-api/src/Exception.php";
  require_once $path."api/phpmailer-api/src/PHPMailer.php";
  require_once $path."api/phpmailer-api/src/SMTP.php";

  $website = "https://wmsu-dietitianconsult.online/"; 
  // $link = $website."verify/verify-account.php?verif-code=".$veficationCode;
  $link = "http://localhost/clinic/verify/verify-account.php?verif-code=".$veficationCode;

  $mail = setMail();

  $mail -> setFrom('admin@wmsu-dietitianconsult.online', 'WMSU Dietitian');
  $mail -> addReplyTo('no-reply@wmsu-dietitianconsult.online');

  $mail -> addAddress($userData['email']);
  $mail -> isHTML(true);

  $mail -> Subject = "WMSU Dietitian | Account Verification";
  $mail -> Body = "
  <h1 style='text-transform: uppercase'>Welcome to the clinic!</h1>
  <br>
  <p>Hello <strong>".$userData['first_name']." ".$userData['last_name']."</strong>,</p>
  <br>
  <p>Thanks for registering. To activate your account, please click on this <a href=".$link.">link</a> or copy and paste the link <br>provided below into your browser's address bar.</p>
  <br>
  <a href='".$link."'>".$link."</a>
  ";

  $mail -> send();
}

function emailSendResetPassword($userData, $veficationCode, $path) {
  require_once $path."api/phpmailer-api/src/Exception.php";
  require_once $path."api/phpmailer-api/src/PHPMailer.php";
  require_once $path."api/phpmailer-api/src/SMTP.php";

  $website = "https://wmsu-dietitianconsult.online/"; 
  $link = $website."verify/verify-account.php?verif-code=".$veficationCode;
  $link = "http://localhost/clinic/reset-password/reset-password.php?verif-code=".$veficationCode;

  $mail = setMail();

  $mail -> setFrom('account@wmsu-dietitianconsult.online', 'WMSU Dietitian');
  $mail -> addReplyTo('no-reply@wmsu-dietitianconsult.online');

  $mail -> addAddress($userData['email']);
  $mail -> isHTML(true);

  $mail -> Subject = "WMSU Dietitian | Account Verification";
  $mail -> Body = "
  <h1 style='text-transform: uppercase'>Welcome to the clinic!</h1>
  <br>
  <p>Hello <strong>".$userData['first_name']." ".$userData['last_name']."</strong>,</p>
  <br>
  <p>Thanks for registering. To activate your account, please click on this <a href=".$link.">link</a> or copy and paste the link <br>provided below into your browser's address bar.</p>
  <a href='".$link."'>".$link."</a>
  ";

  $mail -> send();
}

function generateVerifCode($length = 10) {
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length).rand(1000,9999);
}