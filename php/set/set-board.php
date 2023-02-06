<?php 
require_once '../../classes/appoint.class.php';
// require_once '../../../php/general.php';
// require_once '../../../classes/database.php';

// print_r($_POST['album'] + 1);

session_start();

$appoint = new appoint;
$appoint -> current_board_page = $_POST['board_page'] + 1;
$appoint -> transact_id = $_SESSION['transactId'];
$res = $appoint -> setBoardPage();
if($res){
  echo "success to set board";
} else {
  echo "failed to set board";
}