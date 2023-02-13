<?php 
require_once '../../classes/consult.class.php';

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];

$res = $consult -> checkAppointPendingRndStatus();
if($res){
  // echo json_encode($res['number']);
  // echo json_encode($res['number']);

  if($res['number'] > 0) {
    echo "TRUE";
  } else {
    echo "FALSE";
  }
  
} else {
  echo "error";
}    