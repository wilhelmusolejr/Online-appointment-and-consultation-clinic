<?php 

$path = "../../";

require_once $path."classes/user.class.php";
require_once $path."php/general.php";

session_start();

$target = "profile_img";
$file = $_FILES[$target];

$target_dir = $path."uploads/";
// $result = array("response"=> 1,"message" => null);
$result = ['response' => 1, "message" => null];

if($file['name'] != "") {
  $fileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

  if($file['size'] > 5000000) {
    $result["response"] = 0; 
    $result['message'] = "Your file is too large, only 5mb below.";
  }
  
  // Allow certain file formats
  if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
  && $fileType != "pdf" && $fileType != "docx" &&
  $fileType != "doc" && $fileType != "") {
    $result["response"] = 0; 
    $result['message'] = "Only JPG, JPEG, PNG, PDF, and DOC file types are allowed.";
  }
}

if($result['response'] == 0) {
  echo json_encode($result);
  exit(); 
}

// good
if($file['name'] != "") {
  $firstName = $_SESSION['user_loggedIn']['first_name'];
  $lastName = $_SESSION['user_loggedIn']['last_name'];
  $rand = rand(10,100);

  $temp = explode(".", $file["name"]);
  $fileName = 'profile_img'.'_file_'.$firstName.'_'.$lastName.'_'.$rand.'.' . end($temp);
  $_FILES[$target]['name'] = $fileName;

  move_uploaded_file($_FILES[$target]['tmp_name'], $target_dir.$_FILES[$target]['name']);
}



$user = new user;

$user -> user_id = intval($_POST['profile-id']);
$user -> profile_img = $file['name'] == "" ? $_SESSION['user_loggedIn']['profile_img'] : $fileName;
$user -> user_type = isset($_POST['account-type']) ? $_POST['account-type'] : "rnd";

$user -> first_name = validateInput($_POST['firstname']);
$user -> middle_name = validateInput($_POST['middlename']);
$user -> last_name = validateInput($_POST['lastname']);
$user -> gender = $_POST['gender'] == "Male"? 1 : 2;
$user -> birthdate = $_POST['birthdate'];
$user -> contact = $_POST['reg-mob'];
$user -> pass = $_POST['reg-pass-confirm'] == "" ? "" : $_POST['reg-pass-confirm'];

// CHECK IF changepassword
if($user -> pass) {
  $results = $user -> updateUserAccount();
}

$results = $user -> updateUserProfile();

if($results) {
  $userLoggedInData = $user -> getUserData();
  $_SESSION['user_loggedIn'] = $userLoggedInData;
  // header("location: ".$path."profile/profile.php");
  // exit();
}
  

echo json_encode($result);
exit(); 