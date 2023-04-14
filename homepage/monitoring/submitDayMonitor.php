<?php 

$path = "../../";

session_start();

require_once $path."classes/monitor.class.php";

$monitor = new monitor;


$monitor -> monitor_id = $_POST['monitor_id'];
$monitor -> week_num = $_POST['week_num'];
$monitor -> day_num = $_POST['day_num'];
$result = $monitor -> getIdDay();

$monitor -> monitor_day_id = $result['monitor_day_id'];

// adds data to food intake
$index = 0;
foreach($_POST['food-take-type'] as $food) {
  $monitor -> time_type = $_POST['food-take-type'][$index];
  $monitor -> time = $_POST['food-bf-time'][$index];
  $monitor -> food_consumed = $_POST['food-bf-consume'][$index];
  $monitor -> quantity = $_POST['food-quantity'][$index];
  $monitor -> amount = $_POST['food-amount'][$index];
  $monitor -> method = $_POST['food-bf-method'][$index];

  $result = $monitor -> addDayFoodIntake();

  print_r("added");
  $index++;
}

// adds data to weight goal
$monitor -> current_body_weight = $_POST['current_body_weight'];
$result = $monitor -> addDayWeight();

// adds data to physical action
$monitor -> physical_level = $_POST['physical_action'];
$result = $monitor -> addDayPhysicalAction();

// adds data to supplement
$monitor -> supplement_name = $_POST['supplement_name'];
$result = $monitor -> addDaySupplment();

header("location: monitoring.php?monitor_id=".$_POST['monitor_id']."&week=".$_POST['week_num']);
exit();


?>