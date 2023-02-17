<?php 
require_once '../../classes/appoint.class.php';

session_start();

$appoint = new appoint;
$appoint -> user_id = $_SESSION['transact_client_id'];

$result = $appoint -> getAppointTable();
if($result) {
  echo json_encode($result);
} else {
  echo "error";
}