<?php
    require_once '../../../classes/appoint.class.php';

    session_start();

    // print_r();

    //we start session since we need to use session values
    //creating an array for list of users can login to the system

    if(isset($_POST['submits'])){

      $appoint = new appoint;

      $appoint-> user_id = $_SESSION['acc_no'];

      // type
      $appoint-> appoint_for = $_POST['appointment-for'] == 'myself' ? 1:2;

      // consult
      $appoint-> consul_complaint = $_POST['appoint-chief-complaint'];
      $appoint-> consul_date = $_POST['appointment-date'];
      $appoint-> consul_time = $_POST['appointment-time'];
      $appoint-> consul_referal = isset($_POST['appointment-referral']) ? $_POST['appointment-referral']: null;
      $appoint-> consul_record = isset($_POST['appointment-medical']) ? $_POST['appointment-medical']: null;
      $appoint-> consul_more_info = isset($_POST['appointment-more-info']) ? $_POST['appointment-more-info']: null;
  
      // food
      $appoint-> food_allergies = $_POST['appoint-food-allergies'];
      $appoint-> food_like = $_POST['appoint-food-like'];
      $appoint-> food_dislike = $_POST['appoint-food-dislike'];
      $appoint-> type_diet = $_POST['appoint-type-diet'];
      $appoint-> smoke_level = $_POST['smoke-level'];
      $appoint-> drink_level = $_POST['drink-level'];

      // physical
      $appoint-> physical_weight = $_POST['appoint-actual-weight'];
      $appoint-> physical_height = $_POST['appoint-current-height'];
      $appoint-> body_type = $_POST['body-type'];
      $appoint-> physical_activity = $_POST['physical-activity'];
      $appoint-> gain_weight_level = $_POST['gain-weight-level'];
      $appoint-> lose_weight_level = $_POST['lose-weight-level'];

      // medical
      $appoint-> medical_curent = $_POST['appoint-medical-current-med'];
      $appoint-> medical_past_condition = $_POST['health-condition-one'];
      $appoint-> medical_family_condition = $_POST['health-condition-one'];

      // client
      $appoint-> client_first_name = $_POST['firstname'];
      $appoint-> client_middle_name = $_POST['middlename'];
      $appoint-> client_last_name = $_POST['lastname'];
      $appoint-> client_gender = $_POST['gender'] == "Male"? 1:2;
      $appoint-> client_birthdate = $_POST['birthdate'];
      $appoint-> client_relationship_status = $_POST['relationship-status'] == 'Husbund' ? 1:2;
      $appoint-> client_mobile_num = $_POST['reg-mob'];
      $appoint-> client_email_add = $_POST['reg-email'];

      $res = $appoint->setTransact();
      $res = $appoint->setAppoint();
      $res = $appoint->setConsultInfo();
      $res = $appoint->setClientInfo();
      $res = $appoint->setFoodInfo();
      $res = $appoint->setPhysicalInfo();
      $res = $appoint->setMedicalInfo();

      if($res){
        echo "success";
        $_GET['appoint_id'] = $appoint -> appoint_id;
        header("Location: ../consultation.php?appoint_id=".$_GET['appoint_id']);
        // return $_GET['appoint_id'];
      } else {
        echo "fail";
      }
    }
    // header("Location: ../consultation.php");

?>