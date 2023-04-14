<?php 
$path = "../../";
require_once $path.'classes/monitor.class.php';

session_start();

$monitor = new monitor();
$monitor -> monitor_id = $_SESSION['monitor_id'];
$updateEndResult = $monitor -> updateEndMonitoring();


echo "success";
exit();
// if($res){
//   echo "success";
// } else {
//   echo "failed";
// }