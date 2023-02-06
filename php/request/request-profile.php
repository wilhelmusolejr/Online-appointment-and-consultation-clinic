<?php 
require_once '../../classes/user.class.php';

session_start();

$user = new user;
$user -> targetId = $_POST['rnd_id'];
$res = $user -> validate();
if($res){
  echo json_encode($res);
} else {
  echo "failed to fetch profile";
}