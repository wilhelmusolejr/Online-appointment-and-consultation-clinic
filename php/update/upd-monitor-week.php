<?php 
$path = "../../";
require_once $path.'classes/monitor.class.php';

session_start();

$monitor = new monitor();

$monitor -> monitor_id = $_SESSION['monitor_id'];
$monitoringData = $monitor -> getMonitoringViaMonitorId();
// print_r($_POST);

// print_r($result['total_week'] + $_POST['num_extend_week']);
$extendNumWeek = $_POST['num_extend_week'];

// -----------------
// update total_week in tbl_monitor 
$monitor -> monitor_id = $_POST['monitor_id'];
$monitor -> total_week = $monitoringData['total_week'] + $extendNumWeek;
// $monitor -> updateTotalWeekMonitoring();

// -----------------
// add week_num in tbl_monitor_week 
$weekData = $monitor -> getMonitorWeek();
$latestWeekNum = end($weekData)['week_num'];
// print_r($extendNumWeek);

for ($i = 1; $i <= $extendNumWeek; $i++) {
  // print_r($latestWeekNum + $i);
  // print_r($weekData);
  $monitor -> week_num = $latestWeekNum + $i;
  // $monitor -> updateMonitorWeek();
}

// add new row in tbl_monitor_day 
// $listOfDays = $monitor -> getDayDayData();
// print_r($listOfDays);
echo "success";
exit();
// if($res){
//   echo "success";
// } else {
//   echo "failed";
// }