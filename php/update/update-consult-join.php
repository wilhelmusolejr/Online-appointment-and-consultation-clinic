<?php 
require_once '../../classes/consult.class.php';

session_start();

date_default_timezone_set('Asia/Manila');
$consult = new consult;
$consult -> current_in = 1;
$consult -> join_time = date("Y/m/d")." ".date("h:i:sa");
$consult -> transact_id = $_SESSION['transact_id'];
$consult -> consult_id = $consult -> getConsultId();
$consult -> current_id = $_SESSION['user_loggedIn']['user_id'];

// print_r($_SESSION);
// echo json_encode($consult);

$res = $consult -> updateJoinList();
if($res){
  echo "success";
} else {
  echo "failed";
}