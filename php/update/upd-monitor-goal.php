<?php 
$path = "../../";
require_once $path.'classes/monitor.class.php';

session_start();

$monitor = new monitor;

if(!isset($_POST['body-type'])) {
  echo "success";
  exit();
}

foreach($_POST['body-type'] as $goal) {
  $monitor -> goal_name = $goal;
  $monitor -> updateGoals();
}


echo "success";
exit();