<?php 
$path = "../../";

require_once $path.'classes/user.class.php';

session_start();

$user = new user;
$user -> user_id = $_SESSION['user_loggedIn']['user_id'];
$user -> id_image = $_FILES['id-image']['name'];
$user -> id_status = "PENDING";
$user -> id_remark = "";

$res = $user -> setUploadId();
if($res){
  echo "success";
} else {
  echo "fail";
}