<?php 
require_once '../../classes/consult.class.php';

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];

$res = $consult -> getSchedule();
if($res){
  // echo $res;
  echo json_encode($res);
  // echo "success";
} else {
  echo "fail";
}