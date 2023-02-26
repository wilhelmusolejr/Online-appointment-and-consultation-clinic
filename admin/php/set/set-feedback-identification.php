<?php 
$path = "../../../";

require_once $path."classes/user.class.php";

session_start();

print_r($_GET);

if(isset($_GET['user_id'])) {
  $user = new user;
  $user -> user_id = $_GET['user_id'];
  $user -> feedback = $_GET['feedback'];

  $result = $user -> setFeedbackIdentification();
  header("location: ".$path."admin/patient/pending-identification.php");
}