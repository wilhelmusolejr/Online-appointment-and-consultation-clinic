<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';

session_start();

$monitor = new monitor();

$monitor -> monitor_id = $_SESSION['monitor_id'];
$monitoringData = $monitor -> getMonitoringViaMonitorId();

$extendNumWeek = $_POST['num_extend_week'];

// -----------------
// 1. Update total_week
// update total_week in tbl_monitor 
$monitor -> monitor_id = $_POST['monitor_id'];
$monitor -> total_week = $monitoringData['total_week'] + $extendNumWeek;
$monitor -> updateTotalWeekMonitoring();

// -----------------
// 2. Adds week_num
// add week_num in tbl_monitor_week 
$weekData = $monitor -> getMonitorWeek();
$latestWeekNum = end($weekData)['week_num'];

$monitor -> week_num = $latestWeekNum;
$listOfDays = $monitor -> getDayDayData();
$startingDate = end($listOfDays)['date'];

$index = 1;
for ($i = 1; $i <= $extendNumWeek; $i++) {
  $latestWeekNum++;
  $monitor -> week_num = $latestWeekNum;
  $monitor -> updateMonitorWeek();

  $weekData = $monitor -> getMonitorWeek();
  $latestWeekId = end($weekData)['monitor_week_id'];
  $monitor -> monitor_week_id = $latestWeekId;

  // 3. Add day 
  // add new row in tbl_monitor_day 
  for($x = 1; $x <= 7; $x++) {
    $date = date_create($startingDate);
    date_add($date, date_interval_create_from_date_string($index." days"));
    
    $monitor -> date = date_format($date,"Y-m-d");
    $monitor -> day_num = $x;
    $monitor -> setMonitorDays();

    $index++;
  }
}

echo "success";
exit();
// if($res){
//   echo "success";
// } else {
//   echo "failed";
// }