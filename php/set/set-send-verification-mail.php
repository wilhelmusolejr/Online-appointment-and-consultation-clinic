<?php 

$path = "../../";

session_start();

require_once $path.'classes/user.class.php';
require_once $path."php/general.php";

$user = new user;
$user -> user_id = $_POST['user_id'];
$userLoggedInData = $user -> getUserData();
$verification = $user -> getAccountVerification();

sendVerificationCode($userLoggedInData, $verification, $path);

// echo 