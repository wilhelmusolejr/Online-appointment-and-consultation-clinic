<?php 
$path = "../../";

require_once $path.'classes/monitor.class.php';
require_once $path.'classes/appoint.class.php';

session_start();


$monitor = new monitor;
$monitor -> transact_id = $_POST['transact_id'];
$monitor -> user_id = $_SESSION['user_loggedIn']['user_id'];
$monitor -> monitorFeedback($_POST['targetBtn']);

$appoint = new appoint;
$appoint -> transact_id = $_POST['transact_id'];
$result = $appoint -> getAppointCheckpointStatus();

$monitor -> rnd_id = $result['rnd_id'];

$res = $monitor -> setMonitoring();


if($res) {
  if ($_POST['targetBtn'] == "accept") {

    $latestMonitoring = $monitor -> getMonitoring();
    $latestMonitorId = $latestMonitoring['monitor_id'];
    // cleared
    
    $monitor -> monitor_id = $latestMonitorId;
    $monitor -> setMonitorWeek();
    // cleared
    
    $monitorWeek = $monitor -> getMonitorWeek();    
    
    // starting date
    $monitorDate = $monitor -> getMonitorDate();
    
    $index = 1;
    foreach($monitorWeek as $week) {
      $monitor -> monitor_week_id = $week['week_num'];
      for($x = 1; $x <= 7; $x++) {
        $date = date_create($monitorDate['monitor_date']);
        date_add($date,date_interval_create_from_date_string($index." days"));
        $monitor -> day_date = date_format($date,"Y-m-d");
        $monitor -> day_num = $index;
        $monitor -> setMonitorDays();
    
        $index++;
      }
    }
  
    echo $res;
  }
  if ($_POST['targetBtn'] == "denaid") {
    echo $res;
  }
}