<?php 
require_once '../../classes/consult.class.php';
// require_once '../../../php/general.php';
// require_once '../../../classes/database.php';

// print_r($_POST['album'] + 1);

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];
$consult -> consult_id = $consult -> getConsultId();

$result = $consult -> getMessage();

$array = array(
  "message" => $result,
  "current_user" => $_SESSION['user_loggedIn']['user_id'],
);

echo json_encode($array);