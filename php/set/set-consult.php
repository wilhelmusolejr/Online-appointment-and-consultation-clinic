<?php 
require_once '../../classes/consult.class.php';

session_start();


  $consult = new consult;
  $consult -> transact_id = $_SESSION['transact_id'];
  $consult -> rnd_id = $_SESSION['transact_rnd_id'];

  $res = $consult -> setConsult();
  if($res){
    echo "success set consult";
  } else {
    echo "failed set consult";
  }