<?php 
$path = "../../";
require_once $path.'classes/monitor.class.php';

session_start();

$monitor = new monitor;

// print_r($_POST);

// echo json_encode($_POST['body-type']);
// exit();

if(!isset($_POST['body-type'])) {
  echo "success";
  exit();
}

foreach($_POST['body-type'] as $goal) {
  $monitor -> monitor_client_goal_id = $goal;
  $monitor -> updateGoals();
}


echo "success";
exit();