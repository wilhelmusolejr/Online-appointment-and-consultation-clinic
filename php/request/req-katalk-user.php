<?php 
require_once '../../classes/user.class.php';

session_start();


if(isset($_POST['transactRndId'])) {
  $_SESSION['transact_rnd_id'] = $_POST['transactRndId'];
}

$user = new user;

$user -> user_id = $_SESSION['transact_client_id'];
$client = $user -> getUserData();

$user -> user_id = $_SESSION['transact_rnd_id'];
$rnd = $user -> getUserData();

if($client && $rnd){
  echo json_encode([$client, $rnd]);
  exit();
} 