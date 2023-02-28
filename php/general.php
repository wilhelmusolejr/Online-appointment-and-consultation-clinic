<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function validateInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function sendVerificationCode($userData, $veficationCode, $path) {
  require_once $path."api/phpmailer-api/src/Exception.php";
  require_once $path."api/phpmailer-api/src/PHPMailer.php";
  require_once $path."api/phpmailer-api/src/SMTP.php";

  $website = "https://wmsu-dietitianconsult.online/";
  $link = $website."/verify/verify-account.php?verif-code=".$veficationCode;

  $mail = new PHPMailer(true);

  $mail -> isSMTP();
  $mail -> Host = 'smtp.gmail.com';
  $mail -> SMTPAuth = true;
  $mail -> Username = 'roberthapizlangmalakas@gmail.com';
  $mail -> Password = 'cosrrakjdosdjuev';
  $mail -> SMTPSecure = 'ssl';
  $mail -> Port = 465;

  $mail -> setFrom('roberthapizlangmalakas@gmail.com');
  $mail -> addAddress($userData['email']);

  $mail -> isHTML(true);
  $mail -> Subject = "WMSU Dietitian | Account Verification";
  $mail -> Body = "
  <h1 style='text-transform: uppercase'>Welcome to the clinic!</h1>
  <br>
  <p>Hello <strong>".$userData['first_name']." ".$userData['last_name']."</strong>,</p>
  <p>Thanks for registering. To activate your account, please click on this <a href=".$link.">link</a> or copy/paste the link <br>provided below into the browser's address bar.</p>
  <a href='".$link."'>".$link."</a>
  ";

  $mail -> send();
}

// function setMultipleInputHelper($sql,$value, $id,$data) {
//   $sql = "INSERT INTO `tbl_transact_appoint_food_allergy` 
//   (`food_allergy_id`, `appoint_id`, `allergy_name`) VALUES ";
  
//   $values = [];

//   foreach($data as $name) {
//       array_push($test, "(NULL, $id, '$values')");
//   }

//   $final = join(",", $values);

//   return $sql.$final;
// }