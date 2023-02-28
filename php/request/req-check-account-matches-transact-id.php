<?php 

$path = "../../";

require_once $path."classes/appoint.class.php";

session_start();





$appoint = new appoint;
$appoint -> transact_id = $_POST['transact_id'];

$appointStatus = $appoint -> getAppointCheckpointStatus();
$_SESSION['transact_rnd_id'] = $appointStatus['rnd_id'];


$result = $appoint -> validate();

// print_r($result);
// print_r($_SESSION);

if($result) {
  if($result['user_id'] == $_SESSION['user_loggedIn']['user_id']) {
    echo true;
  } else {
    echo false;
  }
}

// print_r($_POST);