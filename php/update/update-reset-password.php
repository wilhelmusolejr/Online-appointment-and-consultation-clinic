<?php 
$path = "../../";

session_start();

require_once $path.'classes/user.class.php';
require_once $path.'php/general.php';

$user = new user;
$user -> email = validateInput($_POST['username']);
$isRegistered = $user -> checkIfEmailIsregistered();

if(!$isRegistered) {
  echo "Account is not yet registered";
  exit();
}

$veficationCode = generateVerifCode();

$user -> user_id = $isRegistered['user_id'];
$userData = $user -> getUserData();

$user -> verification_code = $veficationCode;
$result = $user -> deleteAllVerificationCode();
$result = $user -> setAccountVerification();
if(!$result) {
  echo "something went wrong";
  exit();
}

emailSendResetPassword($userData, $veficationCode, $path);

echo "success";
exit();