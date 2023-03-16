<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "php/general.php";
require_once "api/phpmailer-api/src/Exception.php";
require_once "api/phpmailer-api/src/PHPMailer.php";
require_once "api/phpmailer-api/src/SMTP.php";

$emails = ['jenny.humbong@gmail.com', 'allaboutfarm101@gmail.com', 'wilhelmus.morales@gmail.com'];

// print_r( $text);
// exit();

$userData = array(
  'first_name' => "Wilhelmus",
  "last_name" => "Ole",
);
$link = "https://www.youtube.com/watch?v=-ff3b66PyXo&list=LL&index=6";
// $text = "
// <h1 style='text-transform: uppercase'>Welcome to clinic!</h1>
// <p>Hello <strong>".$userData['first_name']." ".$userData['last_name']."</strong>,</p>
// <p>Thanks for registering. To activate your account, please click on this <a href=".$link.">link</a> or copy/paste the link <br>provided below into the browser's address bar.</p>
// <a href='".$link."'>".$link."</a>
// ";

$email_set = 'sinobossmo@wmsu-dietitianconsult.online';

$text = "random random march 15";

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';

$mail->Username = $email_set;
$mail->Password = 'Qw09058222@!';

$mail -> setFrom($email_set, 'WMSU Dietitian');
$mail -> addReplyTo('no-reply@wmsu-dietitianconsult.online');

$mail -> addAddress("johnyhalo.l@gmail.com");
$mail -> Subject = "WMSU Dietitian | Account Verification";

$mail -> isHTML(true);
$mail -> Body = $text;

$mail -> send();

?>