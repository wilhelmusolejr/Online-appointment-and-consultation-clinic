<?php 
require_once '../../classes/consult.class.php';
// require_once '../../../php/general.php';
// require_once '../../../classes/database.php';

// print_r($_POST['album'] + 1);

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];
$consult -> consult_id = $consult -> getConsultId();
$consult -> message_sender = $_SESSION['user_loggedIn']['user_id'];
$consult -> message = $_POST['data'];

// echo json_encode($consult);

$result = $consult -> setMessage();
echo $result;