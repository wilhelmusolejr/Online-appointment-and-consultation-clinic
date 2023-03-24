<?php 
$path = "../../";

require_once $path.'classes/consult.class.php';
require_once $path.'classes/appoint.class.php';

session_start();

$consult = new consult;
$consult -> transact_id = $_POST['transact_id'];
$consult -> rnd_id = $_SESSION['transact_rnd_id'];

$appoint = new appoint;
$appoint -> transact_id = $_POST['transact_id'];
$clientId = $appoint -> getTransact()['user_id'];

$res = $consult -> appointFeedback($_POST['targetBtn']);

if($res) {
  if ($_POST['targetBtn'] == "accept") {
    $currentBoard = $appoint -> getBoardPage()['board_page'];
    $appoint -> current_board_page = $currentBoard + 1;
    $setBoard = $appoint -> setBoardPage();
    $setConsult = $consult -> setConsult();

    $consult -> consult_id = $consult -> getConsultId();
    $consult -> current_id = $_SESSION['user_loggedIn']['user_id'];
    $consult -> join_time = date("Y/m/d")." ".date("h:i:sa");

    $setJoin = $consult -> setJoin($clientId);
    echo $res;
  }
  if ($_POST['targetBtn'] == "denaid") {
    echo $res;
  }
}