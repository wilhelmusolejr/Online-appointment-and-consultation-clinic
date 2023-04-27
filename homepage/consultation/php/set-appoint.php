<?php
  $path = "../../../";

  require_once $path.'classes/appoint.class.php';
  require_once $path.'php/general.php';
  require_once $path.'classes/database.php';

  session_start();

  $resultTotal = array("errorResponse" => [], "transact_id" => null);

  if (!isset($_SESSION['user_loggedIn'])) {
    $resultTotal['login'] = array("response"=> 1,"message" => "You need to login first");
    echo json_encode($resultTotal);
    exit();
  }

  $target_dir = $path."uploads/";
  foreach($_FILES as $target => $file) {
    $result = array("response"=> 1,"message" => null, "target" => $target);

    if($_FILES[$target]['name'] != "") {
      $fileType = strtolower(pathinfo($_FILES[$target]['name'],PATHINFO_EXTENSION));
    
      if($file['size'] > 5000000) {
        $result["response"] = 0; 
        $result['message'] = "Your file is too large, only 5mb below.";
      }
      
      // Allow certain file formats
      if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
      && $fileType != "pdf" && $fileType != "docx" &&
      $fileType != "doc" && $fileType != "") {
        $result["response"] = 0; 
        $result['message'] = "Only JPG, JPEG, PNG, PDF, and DOC file types are allowed.";
      }
    }
    array_push($resultTotal['errorResponse'], $result);
  }

  // checker for error
  $stopper = 0;
  foreach($resultTotal['errorResponse'] as $result) {
    if($result['response'] == 0) {
      $stopper = 1;
    }
  }

  if($stopper != 1) {
      $appoint = new appoint;
      $appoint-> user_id = $_SESSION['user_loggedIn']['user_id'];
  
      // type
      $appoint-> appoint_for = $_POST['appointment-for'] == 'myself' ? 1:2;
  
      // food
      $appoint-> food_allergies = preg_split('/[\ \n\,]+/', validateInput($_POST['appoint-food-allergies']));
      $appoint-> food_like =  preg_split('/[\ \n\,]+/', validateInput($_POST['appoint-food-like']));
      $appoint-> food_dislike = preg_split('/[\ \n\,]+/', validateInput($_POST['appoint-food-dislike']));
      $appoint-> type_diet = validateInput($_POST['appoint-type-diet']);
      $appoint-> smoke_level = $_POST['smoke-level'];
      $appoint-> drink_level = $_POST['drink-level'];
      
      // physical
      $appoint-> physical_weight = validateInput($_POST['appoint-actual-weight']);
      $appoint-> physical_height = validateInput($_POST['appoint-current-height']);
      $appoint-> body_type = $_POST['body-type'];
      $appoint-> physical_activity = $_POST['physical-activity'];
      $appoint-> gain_weight_level = $_POST['gain-weight-level'];
      $appoint-> lose_weight_level = $_POST['lose-weight-level'];
  
      // medical
      
      $current_medication = [];
      // current med
      foreach(explode(",", $_POST['appoint-medical-current-med']) as $name) {
        $word = validateInput($name);
        if($word != "") {
          array_push($current_medication, $word);
        }
      }

      // fam
      foreach(explode(",", $_POST['family-condition-one-other']) as $name) {
        $word = validateInput($name);
        if($word != "") {
          array_push($_POST['family-condition'], $word);
        }
      }

      // self
      foreach(explode(",", $_POST['self-condition-other']) as $name) {
        $word = validateInput($name);
        if($word != "") {
          array_push($_POST['self-condition'], $word);
        }
      }
      
      $appoint-> medical_curent = $current_medication;
      $appoint-> medical_past_condition = $_POST['family-condition'];
      $appoint-> medical_family_condition = $_POST['self-condition'];
      
      // client
      if($appoint-> appoint_for == 1) {
        $sql = "SELECT * FROM tbl_user_profile AS profile_table INNER JOIN 
        tbl_user_acc_info AS user_acc ON profile_table.user_id = user_acc.user_id 
        WHERE profile_table.user_id = :user_id;";
  
        $database = new Database();
  
        $query=$database->connect()->prepare($sql);
        $query->bindParam(':user_id', $appoint->user_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        $appoint-> client_first_name = $data['first_name'] ;
        $appoint-> client_middle_name = $data['middle_name'];
        $appoint-> client_last_name = $data['last_name'];
        $appoint-> client_gender = $data['gender'] == "Male"? 1:2;
        $appoint-> client_birthdate = $data['birthdate'];
        $appoint-> client_mobile_num = $data['contact'];
        $appoint-> client_email_add = $data['email'];
      } else {
        $appoint-> client_first_name = validateInput($_POST['firstname']) ;
        $appoint-> client_middle_name = validateInput($_POST['middlename']) ;
        $appoint-> client_last_name = validateInput($_POST['lastname']) ;
        $appoint-> client_gender = $_POST['gender'] == "Male"? 1:2;
        $appoint-> client_birthdate = $_POST['birthdate'];
        $appoint-> client_mobile_num = validateInput($_POST['reg-mob']) ;
        $appoint-> client_email_add = validateInput($_POST['reg-email']) ;
      }
      $appoint-> client_relationship_status = isset($_POST['relationship-status'])? validateInput($_POST['relationship-status']):"";
  
      $res = $appoint -> setTransact();

      foreach($_FILES as $target => $file) {
        if($_FILES[$target]['name'] != "") {
          $temp = explode(".", $file["name"]);
          $naming = explode("-", $target);
          $fileName = $naming[1].'_file_'.$appoint -> transact_id.'.'.end($temp);
          $_FILES[$target]['name'] = $fileName;
        }
      }

      // echo json_encode($_FILES);
      // exit();

      // consult
      $appoint-> consul_complaint = validateInput($_POST['appoint-chief-complaint']);
      $appoint-> consul_date = $_POST['appointment-date'];
      $appoint-> consul_time = $_POST['appointment-time'];
      $appoint-> consul_referal = $_FILES['appointment-referral']['name'] != "" ? $_FILES['appointment-referral']['name']: null;
      $appoint-> consul_record = $_FILES['appointment-medical']['name'] != "" ? $_FILES['appointment-medical']['name']: null;
      $appoint-> consul_more_info = isset($_POST['appointment-more-info']) ? validateInput($_POST['appointment-more-info']): null;

      $res = $appoint->setAppoint();
      $res = $appoint->setConsultInfo();
      $res = $appoint->setClientInfo();
      $res = $appoint->setFoodInfo();
      $res = $appoint->setPhysicalInfo();
      $res = $appoint->setMedicalInfo();
      $res = $appoint->setAppointCheckpointStatus();
      $res = $appoint->setRndStatus();
  
      
      $_SESSION['transact_id'] = $appoint -> getTransactLatest();
      $_GET['transact_id'] = $_SESSION['transact_id'];
      $resultTotal['transact_id'] = $_SESSION['transact_id'];

      foreach($_FILES as $target => $file) {
        if($_FILES[$target]['name'] != "") {
          move_uploaded_file($_FILES[$target]['tmp_name'], $target_dir.$_FILES[$target]['name']);
        }
      }
  } 
  
  echo json_encode($resultTotal);
  exit();