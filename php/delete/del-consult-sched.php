<?php 
require_once '../../classes/consult.class.php';

session_start();

print_r($_POST);

$consult = new consult;
$consult -> consult_schedule_id = $_POST['targetSched'];

$res = $consult -> deleteSchedule();
if($res){
  echo "deleted successfully";
} else {
  echo "failed to delete";
}