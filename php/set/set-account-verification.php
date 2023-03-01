<?php 

$path = "../../";

session_start();

require_once $path."classes/user.class.php";
require_once $path."php/general.php";

$userData = $_POST['userData'];

$randomInt = rand(1000,5000);


$randomString = generateRandomString();
$veficationCode = $randomString.$randomInt;  // OR: generateRandomString(24)

$user = new user;

$user -> first_name = $userData['first_name'];
$user -> birthdate = $userData['birthdate']; 

$user -> email = $userData['email'];
$user -> user_id = $user -> getLatestUserIdTwo();
$user -> verification_code = $veficationCode;

$result = $user -> setAccountVerification();

if(!$result) {
  echo "something went wrong";
  exit();
}


sendVerificationCode($userData, $veficationCode, $path);


// ------------------
// $link = "http://localhost/clinic/verify/verify-account.php?verif-code=".$veficationCode;

// $mail = new PHPMailer(true);

// $mail -> isSMTP();
// $mail -> Host = 'smtp.gmail.com';
// $mail -> SMTPAuth = true;
// $mail -> Username = 'roberthapizlangmalakas@gmail.com';
// $mail -> Password = 'cosrrakjdosdjuev';
// $mail -> SMTPSecure = 'ssl';
// $mail -> Port = 465;

// $mail -> setFrom('roberthapizlangmalakas@gmail.com');
// $mail -> addAddress($userData['email']);

// $mail -> isHTML(true);
// $mail -> Subject = "WMSU Dietitian | Account Verification";
// $mail -> Body = "
// <h1 style='text-transform: uppercase'>Welcome to clinic!</h1>
// <br>
// <p>Hello <strong>".$userData['first_name']." ".$userData['last_name']."</strong>,</p>
// <p>Thanks for registering, to activate your account, please click on this <a href=".$link.">link</a> or copy and paste the <br> link provided below into your browser's address bar.</p>
// <a href='".$link."'>".$link."</a>
// ";

// $mail -> send();

echo "success";
exit();

?>