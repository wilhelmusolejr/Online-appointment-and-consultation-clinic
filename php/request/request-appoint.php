<?php 
require_once '../../classes/appoint.class.php';
// require_once '../../classes/user.class.php';
// require_once '../../../classes/database.php';

session_start();

$appoint = new appoint;
$appoint -> transact_id = $_SESSION['transact_id'];

$appointStatus = $appoint -> getAppointCheckpointStatus();

if($appointStatus){
  echo json_encode($appointStatus);
  // echo "success";
} else {
  // echo "fail";
}