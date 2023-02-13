<?php 
require_once '../../classes/consult.class.php';
require_once '../../classes/appoint.class.php';


session_start();

$consult = new consult;
$consult -> transact_id = $_POST['transact_id'];
$consult -> rnd_id = $_SESSION['transact_rnd_id'];

$appoint = new appoint;
$appoint -> transact_id = $_POST['transact_id'];


$res = $consult -> appointFeedback($_POST['targetBtn']);

if($res) {
  if ($_POST['targetBtn'] == "accept") {
    $currentBoard = $appoint -> getBoardPage()['board_page'];
    $appoint -> current_board_page = $currentBoard + 1;
    $setBoard = $appoint -> setBoardPage();
    $setConsult = $consult -> setConsult();
    echo $res;
  }
  if ($_POST['targetBtn'] == "denaid") {
    echo $res;
  }
}