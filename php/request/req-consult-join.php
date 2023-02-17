<?php 
require_once '../../classes/consult.class.php';
// require_once '../../../php/general.php';
// require_once '../../../classes/database.php';

// print_r($_POST['album'] + 1);

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];
$consult -> consult_id = $consult -> getConsultId();


$res = $consult -> getJoinList();
if($res){
  echo  json_encode($res);
} else {
  echo "failed to set board";
}