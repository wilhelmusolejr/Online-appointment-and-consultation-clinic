<?php 
require_once '../../classes/user.class.php';

session_start();

$user = new user;
$user -> user_id = $_POST['target_id'];
$res = $user -> getUserData();
if($res){
  echo json_encode($res);
} else {
  echo "failed to fetch profile";
}