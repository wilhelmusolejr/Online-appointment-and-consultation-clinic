<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';

session_start();

$monitor = new monitor;
$monitor -> transact_id = $_SESSION['transact_id'];
$monitor -> monitor_date = $_POST['appointment-date'];

$isExisting = $monitor -> checkRequestMonitorId();

if($isExisting) {
  $monitor -> monitorFeedback("pending");
  echo true;
  exit();
}

$result = $monitor -> addRequestMonitor();

if($result) {
  echo true;
} else {
  echo false;
}
exit();

?>