<?php 

$path = "../../";

session_start();

require_once $path.'classes/monitor.class.php';
require_once $path."php/general.php";

$monitor = new monitor;
$monitor -> monitor_id = $_SESSION['monitor_id'];
$monitor -> week_num = $_SESSION['get_week'];

$data = [];

for($i = 1; $i <= 7; $i++) {
  $monitor -> day_num = $i;
  $dayDataPhysical = $monitor -> getDayFoodIntake();
  array_push($data, $dayDataPhysical);
}

$breakfast = 0;
$lunch = 0;
$dinner = 0;
$snacks = 0;

foreach($data as $food) {
  foreach($food as $innerFood) {
    switch($innerFood['time_type']) {
      case "breakfast":
        $breakfast++;
        break;
      case "lunch":
        $lunch++;
        break;
      case "dinner":
        $dinner++;
        break;
      case "snacks":
        $snacks++;
        break;
    }
  }
}

$data = [$breakfast, $lunch, $dinner, $snacks];
// print_r($data);
echo json_encode($data);