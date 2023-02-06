<?php 
require_once '../../classes/appoint.class.php';
// require_once '../../../php/general.php';
// require_once '../../../classes/database.php';

session_start();

$appoint = new appoint;
$appoint -> transact_id = $_SESSION['transactId'];
// print($appoint -> transact_id);
$appointStatus = $appoint -> getAppointCheckpointStatus();
$board = $appoint -> getBoardPage();
if($appointStatus && $board){
  // print_r($res);
  echo json_encode(array_merge($appointStatus, $board));
  // echo "success";
} else {
  // echo "fail";
}

// if( $board){
//   // print_r($res);
//   echo json_encode($board);
//   // echo "success";
// } else {
//   // echo "fail";
// }

// print_r(array_merge($appointStatus, $board));