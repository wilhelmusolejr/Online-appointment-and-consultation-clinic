<?php 
$path = "../../../";

require_once $path."classes/appoint.class.php";

session_start();

$appoint = new appoint;

$result = $appoint -> getAllPendingAppoint();

if($result) {
  echo json_encode($result);
} else {
  echo "No pending appointment.";
}