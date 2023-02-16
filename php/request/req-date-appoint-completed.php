<?php 
require_once '../../classes/appoint.class.php';

session_start();

$appoint = new appoint;
$appoint -> transact_id = $_SESSION['transact_id'];

$result = $appoint -> getAppoint(); 
if($result) {
  echo json_encode($result);
} else {
  echo "error";
}