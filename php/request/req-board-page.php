<?php 
require_once '../../classes/appoint.class.php';

session_start();

if(isset($_POST['transact_id'])) {
  $_SESSION['transact_id'] = $_POST['transact_id'];
}

$appoint = new appoint;
$appoint -> transact_id = $_SESSION['transact_id'];

$board = $appoint -> getBoardPage();
if($board){
  echo json_encode($board);
  // echo "success";
} else {
  // echo "fail";
}