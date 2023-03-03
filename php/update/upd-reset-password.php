<?php 

$path = "../../";

session_start();

require_once $path."classes/user.class.php";
require_once $path."php/general.php";

$user = new user;
$user -> user_id = validateInput($_POST['user_id']);
$user -> pass = validateInput($_POST['reg-pass']);
$result = $user -> updateUserAccount();
if(!$result) {
  echo "fail";
  exit();
}
$result = $user -> deleteAllVerificationCode();

echo "success"; 
exit();