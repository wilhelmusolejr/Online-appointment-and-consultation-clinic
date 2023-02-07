<?php
    require_once '../../../classes/appoint.class.php';
    require_once '../../../php/general.php';
    require_once '../../../classes/database.php';

    session_start();

    if(isset($_POST['submit'])){
      // print_r($_POST);

      $appoint = new appoint;
      $appoint-> user_id = $_SESSION['acc_no'];

      // type
      $appoint-> appoint_for = $_POST['appointment-for'] == 'myself' ? 1:2;

      // consult
      $appoint-> consul_complaint = validateInput($_POST['appoint-chief-complaint']);
      $appoint-> consul_date = $_POST['appointment-date'];
      $appoint-> consul_time = $_POST['appointment-time'];
      $appoint-> consul_referal = isset($_POST['appointment-referral']) ? $_POST['appointment-referral']: null;
      $appoint-> consul_record = isset($_POST['appointment-medical']) ? $_POST['appointment-medical']: null;
      $appoint-> consul_more_info = isset($_POST['appointment-more-info']) ? validateInput($_POST['appointment-more-info']): null;

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
      $appoint-> medical_curent = validateInput($_POST['appoint-medical-current-med']);
      // $appoint-> medical_past_condition = $_POST['health-condition-one'];
      $appoint-> medical_past_condition = 1;
      // $appoint-> medical_family_condition = $_POST['health-condition-one'];
      $appoint-> medical_family_condition = 1;
      
      // client
      if($appoint-> appoint_for == 1) {
        $sql = "SELECT * FROM tbl_user_profile AS profile_table RIGHT JOIN 
        tbl_user_acc_info AS user_acc ON profile_table.user_id = user_acc.acc_no 
        WHERE user_acc.acc_no = :user_id;";

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


      $res = $appoint->setTransact();
      $res = $appoint->setAppoint();
      $res = $appoint->setConsultInfo();
      $res = $appoint->setClientInfo();
      $res = $appoint->setFoodInfo();
      $res = $appoint->setPhysicalInfo();
      $res = $appoint->setMedicalInfo();
      $res = $appoint->setAppointCheckpointStatus();
      $res = $appoint->setRndStatus();

      if($res){
        echo "success";
        $_SESSION['transact_id'] = $appoint -> transact_id;
        header("Location: ../consultation.php?appoint_id=".$_GET['transact_id']);
      } else {
        echo "fail";
      }
    }
    // header("Location: ../consultation.php");

?>