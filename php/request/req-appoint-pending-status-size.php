<?php 
require_once '../../classes/consult.class.php';

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];

$res = $consult -> getAppointPendingRndSize(); 
if($res){
  // if($res['number'] > 0) {
  //   echo "TRUE";
  // } else {
  //   echo "FALSE";
  // }
  echo $res['number'];
} else {
  echo "error";
}    