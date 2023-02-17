<?php 
require_once '../../classes/consult.class.php';

session_start();

date_default_timezone_set('Asia/Manila');

$consult = new consult;
$consult -> transact_id = $_POST['transact_id'];
$consult -> consult_id = $consult -> getConsultId();
$consult -> current_id = $_SESSION['user_loggedIn']['user_id'];
$consult -> join_time = date("Y/m/d")." ".date("h:i:sa");


print_r($consult);

// $res = $consult -> setJoin();
// if($res){
//   echo "success added join";
// } else {
//   echo "failed";
// }