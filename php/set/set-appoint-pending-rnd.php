<?php 
require_once '../../classes/consult.class.php';

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];
$consult -> rnd_id = $_POST['rndList'];

// print_r($_POST['rndList']);

// echo "test";
$res = $consult -> appointPendingRndStatus();
if($res){
  echo "success added pending working to rnd";
} else {
  echo "failed";
}    