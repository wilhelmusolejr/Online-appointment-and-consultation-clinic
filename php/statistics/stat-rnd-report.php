<?php 
$path = "../../";

require_once $path."classes/user.class.php";
require_once $path."classes/consult.class.php";

session_start();

$user = new user;
$consult = new consult;

// $_POST['target_id'] = 75;

$consult -> rnd_id = $_POST['target_id'];
$listOfApproved = $consult -> getApprovedAppoint();
$listOfPending = $consult -> getListOfPendingAppoint();


// pending, on progress, completed
$appointStatus = [sizeof($listOfPending), 0, 0];

foreach($listOfApproved as $appoint) {
  if($appoint['board_page'] < 5) {
    $appointStatus[1]++;
  } else {
    $appointStatus[2]++;
  }
}


$response = array("listApprovedAppoint" => $listOfApproved, "appointStat" => $appointStatus);

echo json_encode($response);
exit();