<?php 
require_once '../../classes/consult.class.php';
require_once '../../classes/appoint.class.php';

session_start();



$appoint = new appoint;
$consult = new consult;

$appoint -> transact_id = $_SESSION['transact_id'];
$consult -> transact_id = $_SESSION['transact_id'];

$board = $appoint -> getBoardPage();
$res = $consult -> getConsultResult();
if($res && $board){
  // echo $res;
  echo json_encode(array_merge($res,$board));
  // echo "success";
} else {
  echo "fail";
}