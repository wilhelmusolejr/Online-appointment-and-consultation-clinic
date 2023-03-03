<?php 

$path = "../../";

session_start();

require_once $path."classes/user.class.php";
require_once $path."php/general.php";

$userData = $_POST['userData'];

$veficationCode = generateVerifCode();

$user = new user;

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

emailSendEmailActivation($userData, $veficationCode, $path);

echo "success";
exit();

?>