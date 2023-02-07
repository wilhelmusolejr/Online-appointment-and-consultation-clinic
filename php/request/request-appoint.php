<?php 
require_once '../../classes/appoint.class.php';
require_once '../../classes/user.class.php';
// require_once '../../../classes/database.php';

session_start();

$appoint = new appoint;
$appoint -> transact_id = $_SESSION['transactId'];

$appointStatus = $appoint -> getAppointCheckpointStatus();
$board = $appoint -> getBoardPage();
// $rndInfo = $appoint -> 
if($appointStatus && $board){
  // print_r($res);
  echo json_encode(array_merge($appointStatus, $board));
  // echo "success";
} else {
  // echo "fail";
}