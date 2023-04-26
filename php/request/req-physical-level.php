<?php 

$path = "../../";

session_start();

require_once $path.'classes/monitor.class.php';
require_once $path."php/general.php";

$monitor = new monitor;
$monitor -> monitor_id = 1;
$monitor -> week_num = 1;

$data = [];

for($i = 1; $i <= 7; $i++) {
  $monitor -> day_num = $i;
  $dayDataPhysical = $monitor -> getDayPhysicalAction();
  array_push($data, $dayDataPhysical['physical_level']);
}

echo json_encode($data);