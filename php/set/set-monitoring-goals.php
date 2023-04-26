<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';

session_start();


$monitor = new monitor;
$monitor -> goal_name = $_POST['specify_goal_name'];
$monitor -> monitor_id = $_POST['monitor_id'];
$result = $monitor -> setGoals();
$result = 1;

if($result) {
  header("Location: ".$path."homepage/monitoring/rnd/monitoring.php?monitor_id=".$_POST['monitor_id']."&week_num=".$_POST['week_num']);
} else {
  echo "error";
}