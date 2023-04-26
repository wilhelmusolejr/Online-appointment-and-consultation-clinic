<?php

$path = "../../../";

require_once $path.'classes/appoint.class.php';
require_once $path.'classes/consult.class.php';
require_once $path.'classes/user.class.php';

//resume session here to fetch session values
session_start();

$appoint = new appoint;
$consult = new consult;
$user = new user;


$appoint -> transact_id = $_GET['transact_id'];
$consult -> transact_id = $_GET['transact_id'];

// update feedback in tbl_transact_appoint_checkpoint_appoint_status
$appoint -> btnFeedback = $_GET['button'] == "accept" ? "APPROVED" : "DECLINED";
$appoint -> updateAppointFeedback();


// get list of available RND
// make algorithm

// insert data to tbl_pending_appoint_rnd for RND to look for RND
if($_GET['button'] == "accept") {
  $result = $user -> getAllRnd();
  $rnd_ids = [];
  foreach($result as $rnd) {
    array_push($rnd_ids, $rnd['user_id']);
  }
  
  $consult -> rnd_id = $rnd_ids; // temporary list
  $setAppointRnd = $consult -> appointPendingRndStatus();
} else {
  $appoint -> declineRnd();
}

// print_r($_GET);
header("Location:"." ".$path."admin/appointment/pending.php");

?>