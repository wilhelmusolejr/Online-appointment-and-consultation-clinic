<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';

session_start();


$monitor = new monitor;
$monitor -> goal_name = $_POST['specify_goal_name'];
$monitor -> monitor_id = $_POST['monitor_id'];
$setGoalsResult = $monitor -> setGoals();

if($setGoalsResult) {
  $monitor -> desirable_bodyWeight = $_POST['monitoring_desirable_body_weight'];
  $updateBodyWeightResult = $monitor -> updateDesirableBodyWeight();
}

if($updateBodyWeightResult) {
  header("Location: ".$path."homepage/monitoring/rnd/monitoring.php?monitor_id=".$_POST['monitor_id']."&week_num=".$_POST['week_num']);
  exit();
} else {
  echo "error";
}