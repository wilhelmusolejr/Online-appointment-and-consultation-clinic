<?php 
  $path = "../../";

  session_start();

  require_once $path."classes/user.class.php";
  require_once $path."php/general.php";

  $user = new user;
  $user -> via_googol = $_POST['via-gmail'] == "true" ? true : false;

  $user -> email = validateInput($_POST['reg-email']);
  $user -> pass = validateInput($_POST['reg-pass']);
  $user -> status = $_POST['via-gmail'] == "true" ? "VERIFIED" : "UNVERIFIED";
  $user -> user_type = $_POST['account-type'];
  $user -> user_privilege = "client";
  $user -> first_name = validateInput($_POST['firstname']);
  $user -> middle_name = validateInput($_POST['middlename']);
  $user -> last_name = validateInput($_POST['lastname']);
  $user -> contact = validateInput($_POST['reg-mob']);
  $user -> gender = $_POST['gender'] == "Male"? 1:2;
  $user -> birthdate = $_POST['birthdate'];
  // $user -> profile_img = $_POST['birthdate'];

  $isEmailRegistered = $user -> checkIfEmailIsregistered();

  if($isEmailRegistered) {
    echo json_encode(array("response" => "fail", "userData" => $user));
    exit();
  }

  $result = $user -> register();
  if($result) {
    echo json_encode(array("response" => "success", "userData" => $user));
    exit();
  }
?>

<!-- > register();
  if($result) {
    echo "success";
  } -->