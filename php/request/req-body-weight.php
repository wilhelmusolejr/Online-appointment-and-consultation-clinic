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
  $dayDataPhysical = $monitor -> getDayWeight();
  array_push($data, $dayDataPhysical['current_body_weight']);
}

echo json_encode($data);

// print_r($data);