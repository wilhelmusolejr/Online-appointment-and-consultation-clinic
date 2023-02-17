<?php

$path = "../../../";

require_once $path.'classes/appoint.class.php';

//resume session here to fetch session values
session_start();

  $appoint = new appoint;
  $appoint -> transact_id = $_GET['transact_id'];
  $set = $appoint -> setAppointFeedback();

  if($set) {
    echo "added successfully";
  }

  header("Location:"." ".$path."admin2/Appointment/pending.php");