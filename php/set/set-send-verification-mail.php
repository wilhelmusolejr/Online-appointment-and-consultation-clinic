<?php 

$path = "../../";

session_start();

require_once $path.'classes/user.class.php';
require_once $path."php/general.php";

$user = new user;
$user -> user_id = $_POST['user_id'];
$userLoggedInData = $user -> getUserData();
// $verification = $user -> getAccountVerification();

$veficationCode = generateVerifCode();
$user -> verification_code = $veficationCode;

$result = $user -> deleteAllVerificationCode();
$result = $user -> setAccountVerification();

emailSendEmailActivation($userLoggedInData, $veficationCode, $path);
echo "success";
exit();