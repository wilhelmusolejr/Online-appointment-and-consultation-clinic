<?php
$path = "../../";

session_start();

require_once $path.'classes/user.class.php';
require_once $path.'classes/appoint.class.php';
require_once $path.'classes/consult.class.php';
require_once $path.'php/general.php';
require_once $path.'classes/database.php';

// echo json_encode($_SESSION);

if(isset($_GET['transact_id']) || isset($_SESSION['transact_id'])) {

  $appoint = new appoint;
  $consult = new consult;
  $clientData = new user;

  $appoint -> transact_id = $_SESSION['transact_id'];

  // Set $session transaction
  if(!isset($_SESSION['transact_rnd_id'])) {
    $_SESSION['transact_rnd_id'] = $appoint -> getAppointCheckpointStatus()['rnd_id'];
  }
  if(!isset($_SESSION['transact_client_id'])) {
    $_SESSION['transact_client_id'] = $appoint -> validate()['user_id'];
  }

  $result = $appoint -> validate();
  if($result) {
      $board_transact_id = $result['transact_id'];
      $board_page = $result['board_page'];

      // board 1
      // GETTING DATA FOR TABULATION
      $appoint -> transact_id = $board_transact_id;
      $appointInfo = $appoint -> getAppoint();
      $appoint -> appoint_id = $appointInfo['appoint_id'];
      $consultInfo = $appoint -> getConsultInfo();
      $foodInfo = $appoint -> getFoodInfo();
      $physicalInfo = $appoint -> getPhysicalInfo();
      $medicalInfo = $appoint -> getMedicalInfo();
      $clientInfo = $appoint -> getClientInfo();

      $listFoodAllergy = [];
      $listFoodLike = [];
      $listFoodDislike = [];

      foreach($appoint -> getFoodAllergy() as $test) {
        array_push($listFoodAllergy, $test['allergy_name']);
        array_push($listFoodLike, $test['food_like_name']);
        array_push($listFoodDislike, $test['food_dislike_name']);
      }

      // body type
      $bodyType = $appoint -> getbodyType();
      $bodyTypeList = [];

      foreach($bodyType as $type) {
        array_push($bodyTypeList, $type['body_type_name']);
      }


      // medical 
      // current med
      $currentMed = [];
      $self_condition = [];
      $family_condition = [];

      foreach($appoint -> getMedicalInfoo() as $test) {
        array_push($currentMed, $test['medical_name']);
        array_push($self_condition, $test['self_past_name']);
        array_push($family_condition, $test['family_past_name']);
      }

      $data = array(
        "appointmentInfo" => $appointInfo,
        "consultInfo" => $consultInfo,
        "foodInfo" => $foodInfo,
        "physicalInfo" => $physicalInfo,
        "medicalInfo" => $medicalInfo,
        "clientInfo" => $clientInfo,
        "listFoodAllergy" => $listFoodAllergy,
        "listFoodLike" => $listFoodLike,
        "listFoodDislike" => $listFoodDislike,
        "bodyTypeList" => $bodyTypeList,
        "listMedicalCurrentMed" => $currentMed,
        "listMedicalSelf" => $self_condition,
        "listMedicalFamily" => $family_condition
      );

      echo json_encode($data);
  }
}