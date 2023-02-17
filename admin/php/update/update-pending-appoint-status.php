<?php

$path = "../../../";

require_once $path.'classes/appoint.class.php';
require_once $path.'classes/consult.class.php';

//resume session here to fetch session values
session_start();

$appoint = new appoint;
$consult = new consult;

$appoint -> transact_id = $_GET['transact_id'];
$consult -> transact_id = $_GET['transact_id'];

// update feedback in tbl_transact_appoint_checkpoint_appoint_status
$updateFeedback = $appoint -> updateAppointFeedback();


// get list of available RND
// make algorithm

// insert data to tbl_pending_appoint_rnd for RND to look for RND
$consult -> rnd_id = $rndList = [3, 17, 8]; // temporary list
$setAppointRnd = $consult -> appointPendingRndStatus();

header("Location:"." ".$path."admin/appointment/pending.php");