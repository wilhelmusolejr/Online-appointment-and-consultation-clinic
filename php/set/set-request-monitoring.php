<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';

session_start();


$monitor = new monitor;
$monitor -> transact_id = $_SESSION['transact_id'];
$monitor -> monitor_date = $_POST['appointment-date'];

$result = $monitor -> addRequestMonitor();
$result = true;


if($result) {
  echo true;
} else {
  echo false;
}

?>