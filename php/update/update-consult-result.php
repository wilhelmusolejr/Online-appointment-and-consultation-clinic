<?php 
require_once '../../classes/consult.class.php';

session_start();

$consult = new consult;
$consult -> transact_id = $_SESSION['transact_id'];

$res = $consult -> updateConsultResult();
if($res){
  echo "success";
} else {
  echo "failed";
}