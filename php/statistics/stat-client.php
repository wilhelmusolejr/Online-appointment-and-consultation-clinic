<?php 
$path = "../../";

require_once $path."classes/user.class.php";
require_once $path."classes/appoint.class.php";

session_start();

$user = new user;
$appoint = new appoint;

// $_POST['target_id'] = 1;

$user -> user_id = $_POST['target_id'];
$res = $user -> getUserData();

$appoint -> user_id = $_POST['target_id'];
$appointList = $appoint -> getAppointTable();

$month = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

$appointName = [];

$appointStatus = [0,0,0];

foreach($appointList as $appoint) {
  array_push($appointName, array($appoint['transact_id'], $appoint['chief_complaint'], $appoint['appoint_status']));

  switch($appoint['appoint_status']) {
    case "APPROVED":
      $appointStatus[0]++;
      break;
    case "PENDING":
      $appointStatus[1]++;
      break;
    case "DECLINED":
      $appointStatus[2]++;
      break;
    }

  $dates = date("F",strtotime($appoint['appoint_date']));
  switch($dates) {
    case "January";
      $month[0]++;
      break;
    case "February";
      $month[1]++;
      break;
    case "March";
      $month[2]++;
      break;
    case "April";
      $month[3]++;
      break;
    case "May";
      $month[4]++;
      break;
    case "June";
      $month[5]++;
      break;
    case "July";
      $month[6]++;
      break;
    case "August";
      $month[7]++;
      break;
    case "September";
      $month[8]++;
      break;
    case "October";
      $month[9]++;
      break;
    case "November";
      $month[10]++;
      break;
    case "December";
      $month[11]++;
      break;
    
  }
}

$response = array("userData" => $res, "statData" => $month, "listAppointment" => $appointName, "listAppointmentStatus" => $appointStatus);

if($res){
  echo json_encode($response);
} else {
  echo "failed to fetch profile";
}