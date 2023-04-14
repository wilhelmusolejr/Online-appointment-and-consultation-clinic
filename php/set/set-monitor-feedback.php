<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';

session_start();


$monitor = new monitor;
$monitor -> transact_id = $_POST['transact_id'];
$monitor -> user_id = $_SESSION['user_loggedIn']['user_id'];
$pendingMonitorDetails = $monitor -> getPendingMonitor();
$monitor -> monitorFeedback($_POST['targetBtn']);

if ($_POST['targetBtn'] == "accept") {
  $monitor -> monitor_date = $pendingMonitorDetails[0]['monitor_date'];
  $res = $monitor -> setMonitoring();

  $latestMonitoring = $monitor -> getMonitoring();
  $latestMonitorId = $latestMonitoring['monitor_id'];
  // cleared
  
  $monitor -> monitor_id = $latestMonitorId;
  $monitor -> setMonitorWeek();
  // cleared
  
  $monitorWeek = $monitor -> getMonitorWeek();
  
  // starting date
  $startingDate = $latestMonitoring['monitor_date'];
  
  $index = 1;
  foreach($monitorWeek as $week) {
    $monitor -> monitor_week_id = $week['monitor_week_id'];
    for($x = 1; $x <= 7; $x++) {
      $date = date_create($startingDate);
      date_add($date, date_interval_create_from_date_string($index." days"));
      $monitor -> date = date_format($date,"Y-m-d");
      $monitor -> day_num = $x;
      $monitor -> setMonitorDays();
  
      $index++;
    }
  }

  echo $res;
}
if ($_POST['targetBtn'] == "denaid") {
  echo "wiw";
}