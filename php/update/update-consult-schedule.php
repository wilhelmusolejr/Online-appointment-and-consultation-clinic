<?php 
require_once '../../classes/consult.class.php';

session_start();

print_r($_POST);

if(isset($_POST['submit'])) {
  $consult = new consult;
  $consult -> transact_id = $_SESSION['transact_id'];
  $consult -> consult_schedule_id = $_POST['targetSched'];

  $consult -> client_id = $_SESSION['transact_client_id'];
  $consult -> rnd_id =  $_SESSION['transact_rnd_id'];

  $consult -> sched_date = $_POST['appointment-date'];
  $consult -> sched_time = $_POST['appointment-time'];

  print_r($consult);

  $res = $consult -> updateSchedule();
  if($res){
    echo "success";
  } else {
    echo "failed";
  }
}

// $query->bindParam(':client_id', $this-> client_id);
// $query->bindParam(':rnd_id', $this-> rnd_id);
// $query->bindParam(':sched_date', $this-> sched_date);
// $query->bindParam(':sched_time', $this-> sched_time);