<?php 
require_once 'database.php';

Class appoint{
    public $user_id;
    public $transact_id;

    public $appointId;

    // appointment data
    public $appoint_id;

    // type
    public $appoint_for;

    // consult
    public $consul_complaint;
    public $consul_date;
    public $consul_time;
    public $consul_referal;
    public $consul_record;
    public $consul_more_info;

    // food
    public $food_allergies;
    public $food_like;
    public $food_dislike;
    public $type_diet;
    public $smoke_level;
    public $drink_level;


    // physical
    public $physical_weight;
    public $physical_height;
    public $body_type;
    public $physical_activity;
    public $gain_weight_level;
    public $lose_weight_level;

    // medical
    public $medical_curent;
    public $medical_past_condition;
    public $medical_family_condition;

    // client
    public $client_first_name;
    public $client_middle_name;
    public $client_last_name;
    public $client_gender;
    public $client_birthdate;
    public $client_relationship_status;
    public $client_mobile_num;
    public $client_email_add;

    // board
    public $current_board_page;

    // search
    public $search_string;

    public $rnd_id;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function validate(){
        $sql = "SELECT * FROM tbl_transact WHERE transact_id =:transact_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':transact_id', $this-> transact_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getConsultInfo() {
        $sql = "SELECT * FROM `tbl_transact_appoint_consult` LEFT JOIN tbl_transact_appoint on tbl_transact_appoint_consult.appoint_id = tbl_transact_appoint.appoint_id WHERE tbl_transact_appoint_consult.appoint_id = :appointId;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':appointId', $this->appoint_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getFoodInfo() {
        $sql = "SELECT * FROM `tbl_transact_appoint_food` LEFT JOIN tbl_transact_appoint on
         tbl_transact_appoint_food.appoint_id = tbl_transact_appoint.appoint_id WHERE
          tbl_transact_appoint_food.appoint_id = :appointId;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':appointId', $this->appoint_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getFoodAllergy() {
        $sql = "SELECT food_allergy.allergy_name, food_like.food_like_name, 
        food_dislike.food_dislike_name FROM `tbl_transact_appoint_food` AS 
        food_table INNER JOIN tbl_transact_appoint_food_allergy AS food_allergy
         ON food_table.appoint_id = food_allergy.appoint_id INNER JOIN 
         tbl_transact_appoint_food_like AS food_like ON food_table.appoint_id =
          food_like.appoint_id INNER JOIN tbl_transact_appoint_food_dislike AS
           food_dislike ON food_table.appoint_id = food_dislike.appoint_id WHERE
            food_table.appoint_id = :appointId;
        ";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':appointId', $this->appoint_id);
        
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function getPhysicalInfo() {
        $sql = "SELECT * FROM `tbl_transact_appoint_physical` LEFT JOIN tbl_transact_appoint on tbl_transact_appoint_physical.appoint_id = tbl_transact_appoint.appoint_id WHERE tbl_transact_appoint_physical.appoint_id = :appointId;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':appointId', $this->appoint_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getbodyType() {
        $sql = "SELECT physical_bodytype.body_type_name FROM `tbl_transact_appoint_physical`
        AS table_physical RIGHT JOIN tbl_transact_appoint_physical_bodytype AS 
        physical_bodytype ON table_physical.appoint_id =
         physical_bodytype.appoint_id WHERE table_physical.appoint_id = :appointId;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':appointId', $this->appoint_id);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function getMedicalInfo() {
        $sql = "SELECT * FROM `tbl_transact_appoint_medical` LEFT JOIN tbl_transact_appoint on tbl_transact_appoint_medical.appoint_id = tbl_transact_appoint.appoint_id WHERE tbl_transact_appoint_medical.appoint_id = :appointId;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':appointId', $this->appoint_id);
        
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getMedicalInfoo() {
        $sql = "SELECT med_fam.family_past_name, med_self.self_past_name, med_cur.medical_name FROM tbl_transact_appoint_medical_family_past_con as med_fam 
        INNER JOIN tbl_transact_appoint_medical_self_past_con as med_self ON med_self.appoint_id = med_fam.appoint_id 
        INNER JOIN tbl_transact_appoint_medical_current_med as med_cur ON med_cur.appoint_id = med_fam.appoint_id 
        WHERE med_cur.appoint_id = :appoint_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':appoint_id', $this->appoint_id);

        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function getClientInfo() {
        $sql = "SELECT * FROM `tbl_transact_appoint_client` LEFT JOIN tbl_transact_appoint on tbl_transact_appoint_client.appoint_id = tbl_transact_appoint.appoint_id WHERE tbl_transact_appoint_client.appoint_id = :appointId;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':appointId', $this->appoint_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function setConsultInfo() {
        $sql = "INSERT INTO `tbl_transact_appoint_consult` (`consult_id`, 
        `appoint_id`, `chief_complaint`, `appoint_date`, `appoint_time`, `referral_form_id`, 
        `medical_record_id`, `appoint_more_info`) VALUES (NULL, :appoint_id, :chief_complaint,
         :appoint_date, :appoint_time, :referral_form_id, :medical_record_id, :appoint_more_info);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':appoint_id', $this->appoint_id);
        $query->bindParam(':chief_complaint', $this->consul_complaint);
        $query->bindParam(':appoint_date', $this->consul_date);
        $query->bindParam(':appoint_time', $this->consul_time);
        $query->bindParam(':referral_form_id', $this->consul_referal);
        $query->bindParam(':medical_record_id', $this->consul_record);
        $query->bindParam(':appoint_more_info', $this->consul_more_info);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function setClientInfo() {
        $sql = "INSERT INTO `tbl_transact_appoint_client` (`client_id`, `appoint_id`, `first_name`, `middle_name`, 
        `last_name`, `gender`, `birthdate`, `mobile_num`, `email_add`, `relationship_status`) VALUES (NULL, :appoint_id,
         :first_name, :middle_name, :last_name, :gender, :birthdate, :mobile_num, :email_add, :relationship_status)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':appoint_id', $this->appoint_id);
        $query->bindParam(':first_name', $this->client_first_name);
        $query->bindParam(':middle_name', $this->client_middle_name);
        $query->bindParam(':last_name', $this->client_last_name);
        $query->bindParam(':gender', $this->client_gender);
        $query->bindParam(':birthdate', $this->client_birthdate);
        $query->bindParam(':mobile_num', $this->client_mobile_num);
        $query->bindParam(':email_add', $this->client_email_add);
        $query->bindParam(':relationship_status', $this->client_relationship_status);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function setFoodInfo() {
        // allergies
        $sql = "INSERT INTO `tbl_transact_appoint_food_allergy` 
        (`food_allergy_id`, `appoint_id`, `allergy_name`) VALUES ";
        
        $values = [];

        foreach($this -> food_allergies as $name) {
            array_push($values, "(NULL, $this->appoint_id, '$name')");
        }

        $final = join(",", $values);
        $query=$this->db->connect()->prepare($sql.$final);
        $query->execute();
        

        // likes
        $sql = "INSERT INTO `tbl_transact_appoint_food_like` (`food_like_id`, `appoint_id`, `food_like_name`) VALUES ";

        $values = [];

        foreach($this -> food_like as $name) {
            array_push($values, "(NULL, $this->appoint_id, '$name')");
        }

        $final = join(",", $values);
        $query=$this->db->connect()->prepare($sql.$final);
        $query->execute();
          

        // dislikes
        $sql = "INSERT INTO `tbl_transact_appoint_food_dislike` (`food_dislike_id`, `appoint_id`, `food_dislike_name`) VALUES ";

        $values = [];

        foreach($this -> food_dislike as $name) {
            array_push($values, "(NULL, $this->appoint_id, '$name')");
        }

        $final = join(",", $values);
        $query=$this->db->connect()->prepare($sql.$final);
        $query->execute();


        $sql = "INSERT INTO `tbl_transact_appoint_food` (`food_id`, `appoint_id`, `food_allergies_id`, `food_like_id`, 
        `food_dislike_id`, `type_diet_id`, `smoke_level_id`, `drink_level_id`) VALUES (NULL, :appoint_id, NULL, 
        NULL, NULL, :type_diet_id, :smoke_level_id, :drink_level_id)
        ";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':appoint_id', $this->appoint_id);
        // $query->bindParam(':food_allergies_id', $this->food_allergies);
        // $query->bindParam(':food_like_id', $this->food_like);
        // $query->bindParam(':food_dislike_id', $this->food_dislike);
        $query->bindParam(':type_diet_id', $this->type_diet);
        $query->bindParam(':smoke_level_id', $this->smoke_level);
        $query->bindParam(':drink_level_id', $this->drink_level);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function setPhysicalInfo() {
        // body type
        $sql = "INSERT INTO `tbl_transact_appoint_physical_bodytype` (`body_type_id`, 
        `appoint_id`, `body_type_name`) VALUES ";
        
        $values = [];

        foreach($this -> body_type as $name) {
            array_push($values, "(NULL, $this->appoint_id, '$name')");
        }

        $final = join(",", $values);
        $query=$this->db->connect()->prepare($sql.$final);
        $query->execute();
          


        $sql = "INSERT INTO `tbl_transact_appoint_physical` (`physical_id`, `appoint_id`, `actual_weight`, `current_height`, 
        `body_type_id`, `physical_activity_id`, `gain_weight_level_id`, `lose_weight_level_id`) VALUES (NULL, :appoint_id, 
        :actual_weight, :current_height, NULL, :physical_activity_id, :gain_weight_level_id, :lose_weight_level_id)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':appoint_id', $this->appoint_id);
        $query->bindParam(':actual_weight', $this->physical_weight);
        $query->bindParam(':current_height', $this->physical_height);
        // $query->bindParam(':body_type_id', $this->body_type);
        $query->bindParam(':physical_activity_id', $this->physical_activity);
        $query->bindParam(':gain_weight_level_id', $this->gain_weight_level);
        $query->bindParam(':lose_weight_level_id', $this->lose_weight_level);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function setMedicalInfo() {
        
        if(sizeof($this -> medical_curent) >= 1) {
            $sql = "INSERT INTO `tbl_transact_appoint_medical_current_med` (`medical_current_med_id`, `appoint_id`, `medical_name`) VALUES ";

            $values = [];

            foreach($this -> medical_curent as $name) {
                array_push($values, "(NULL, $this->appoint_id, '$name')");
            }

            $final = join(",", $values);
            $query=$this->db->connect()->prepare($sql.$final);
            $query->execute();
        }

        if(sizeof($this -> medical_past_condition) >= 1) {
            $sql = "INSERT INTO `tbl_transact_appoint_medical_self_past_con` (`medical_self_past_con_id`, `appoint_id`, `self_past_name`) VALUES ";

            $values = [];

            foreach($this -> medical_past_condition as $name) {
                array_push($values, "(NULL, $this->appoint_id, '$name')");
            }

            $final = join(",", $values);
            $query=$this->db->connect()->prepare($sql.$final);
            $query->execute();
        }

        if(sizeof($this -> medical_family_condition) >= 1) {
            $sql = "INSERT INTO `tbl_transact_appoint_medical_family_past_con` (`medical_family_past_con_id`, `appoint_id`, `family_past_name`) VALUES ";

            $values = [];

            foreach($this -> medical_family_condition as $name) {
                array_push($values, "(NULL, $this->appoint_id, '$name')");
            }

            $final = join(",", $values);
            $query=$this->db->connect()->prepare($sql.$final);
            $query->execute();
        }
    }

    function getAppoint() {
        $sql = "SELECT * FROM tbl_transact_appoint WHERE transact_id =:transact_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':transact_id', $this->transact_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    // add new row in appoint table
    function setAppoint() {
        $sql = "INSERT INTO `tbl_transact_appoint` (`appoint_id`, `transact_id`, `appoint_for`, `consult_info_id`, 
        `food_info_id`, `physical_info_id`, `medical_info_id`, `appoint_date_submitted`) VALUES (NULL, :transact_id, :appoint_for
        , NULL, NULL, NULL, NULL, current_timestamp())";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this->transact_id);
        $query->bindParam(':appoint_for', $this->appoint_for);

        if($query->execute()){
            $this -> appoint_id = $this -> getAppointLatest();
            return true;
        }
        else{
            return false;
        }
    }

    function getAppointLatest() {
        $sql = "SELECT * FROM tbl_transact_appoint WHERE transact_id = :transact_id ORDER BY appoint_id DESC LIMIT 1;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':transact_id', $this->transact_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data['appoint_id'];
    }

    function getTransactLatest() {
        $sql = "SELECT * FROM tbl_transact WHERE user_id = :user_id ORDER BY transact_id DESC LIMIT 1;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_id', $this->user_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data['transact_id'];
    }

    // add new row in a transact table 
    function setTransact() {
        $sql = "INSERT INTO `tbl_transact` (`transact_id`, `user_id`, `board_page`) VALUES (NULL, :user_id, 2)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this->user_id);

        if($query->execute()){
            $this -> transact_id = $this -> getTransactLatest();
            return true;
        }
        else{
            return false;
        }
    }

    function getBoardPage() {
        $sql = "SELECT * FROM `tbl_transact` WHERE transact_id = :transact_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this->transact_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function setBoardPage() {
        $sql = "UPDATE `tbl_transact` SET `board_page` = :board_page WHERE `tbl_transact`.`transact_id` = :transact_id;"; 
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':board_page', $this->current_board_page);
        $query->bindParam(':transact_id', $this->transact_id);
        
        if($query->execute()){
            return true;
        }
        return false;
    }

    // CHECKPOINT STAGE - PROGRESS
    // Returns data for appoint status and rnd status
    function getAppointCheckpointStatus() {
        $sql = "SELECT appoint_status, rnd_status, rnd_id FROM `tbl_transact_appoint_checkpoint_appoint_status`
         as ck_appoint_status INNER JOIN tbl_transact_appoint_checkpoint_rnd_status as ck_rnd_status ON 
         ck_appoint_status.transact_id = ck_rnd_status.transact_id WHERE ck_appoint_status.transact_id = :transact_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this->transact_id);

        if($query->execute()){
            $data = $query->fetch();
            // $_SESSION['transact_rnd_id'] = $data['rnd_id'];
            // $_SESSION['transact_client_id'] = $_SESSION['transact_client_id'];
        }
        return $data;
    }

    // Set for appoint status
    function setAppointCheckpointStatus() {
        $sql = "INSERT INTO `tbl_transact_appoint_checkpoint_appoint_status` 
        (`appoint_checkpoint_appoint_status_id`, `transact_id`, `appoint_status`)
         VALUES (NULL, :transact_id, 'PENDING')";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this->transact_id);

        if($query->execute()){
            return true;
        }
        return false;
    }

    // Set for rnd status
    function setRndStatus() {
        $sql = "INSERT INTO `tbl_transact_appoint_checkpoint_rnd_status`
         (`appoint_checkpoint_rnd_status_id`, `transact_id`, `rnd_status`, `rnd_id`)
          VALUES (NULL, :transact_id, 'PENDING', NULL)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this->transact_id);

        if($query->execute()){
            return true;
        }
        return false;
    }

    function getAppointTable() {
        $sql = "SELECT * FROM tbl_transact 
        INNER JOIN tbl_transact_appoint as transact_appoint ON tbl_transact.transact_id = transact_appoint.transact_id 
        INNER JOIN tbl_transact_appoint_consult AS appoint_consult ON transact_appoint.appoint_id = appoint_consult.appoint_id 
        INNER JOIN tbl_transact_appoint_checkpoint_appoint_status as ck_appoint_status ON tbl_transact.transact_id = ck_appoint_status.transact_id 
        INNER JOIN tbl_transact_appoint_checkpoint_rnd_status AS ck_appoint_rnd_status ON tbl_transact.transact_id = ck_appoint_rnd_status.transact_id 
        LEFT JOIN tbl_user_profile ON ck_appoint_rnd_status.rnd_id = tbl_user_profile.user_id 
        WHERE tbl_transact.user_id = :user_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);

        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function getTransact() {
        $sql = "SELECT * FROM tbl_transact WHERE transact_id = :transact_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this-> transact_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }


    function getAllPendingAppoint() {
        $sql = "SELECT * FROM tbl_transact INNER JOIN tbl_transact_appoint ON tbl_transact.transact_id = tbl_transact_appoint.transact_id INNER JOIN tbl_transact_appoint_consult as appoint_consult ON tbl_transact_appoint.appoint_id = appoint_consult.appoint_id INNER JOIN tbl_transact_appoint_checkpoint_appoint_status as ck_pending_appoint ON tbl_transact.transact_id = ck_pending_appoint.transact_id WHERE
         ck_pending_appoint.appoint_status = 'PENDING';";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function updateAppointFeedback() {
        $sql = "UPDATE tbl_transact_appoint_checkpoint_appoint_status SET
         appoint_status = 'APPROVED' WHERE transact_id = :transact_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this-> transact_id);

        if($query->execute()){
            return true;
        }
        return false;
    }

    function searchListAppointment() {
        $search_string = $this -> search_string;

        $sql = "SELECT * FROM tbl_transact 
        INNER JOIN tbl_transact_appoint as transact_appoint ON tbl_transact.transact_id = transact_appoint.transact_id 
        INNER JOIN tbl_transact_appoint_consult AS appoint_consult ON transact_appoint.appoint_id = appoint_consult.appoint_id 
        INNER JOIN tbl_transact_appoint_checkpoint_appoint_status as ck_appoint_status ON tbl_transact.transact_id = ck_appoint_status.transact_id 
        INNER JOIN tbl_transact_appoint_checkpoint_rnd_status AS ck_appoint_rnd_status ON tbl_transact.transact_id = ck_appoint_rnd_status.transact_id 
        LEFT JOIN tbl_user_profile ON ck_appoint_rnd_status.rnd_id = tbl_user_profile.user_id 
        WHERE tbl_transact.user_id = :user_id 
        AND 
        (chief_complaint LIKE '%".$search_string."%' 
        OR first_name LIKE '%".$search_string."%' 
        OR last_name LIKE '%".$search_string."%' 
        OR tbl_transact.transact_id = :search_string
        )";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);
        $query->bindParam(':search_string', $this-> search_string);

        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function totalAppointment() {
        $sql = "SELECT COUNT(*) FROM `tbl_transact`";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getTotalNumAppointment() {
        $sql = "SELECT COUNT(*) as total_appointment FROM `tbl_transact` 
        INNER JOIN tbl_transact_appoint_checkpoint_rnd_status as tbl_transact_ck_rnd ON tbl_transact_ck_rnd.transact_id = tbl_transact.transact_id 
        WHERE tbl_transact_ck_rnd.rnd_id = :rnd_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':rnd_id', $this-> rnd_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getTotalNumActiveAppointment() {
        $sql = "SELECT COUNT(*) as total_active_appointment FROM `tbl_transact` 
        INNER JOIN tbl_transact_appoint_checkpoint_rnd_status as tbl_transact_ck_rnd ON tbl_transact_ck_rnd.transact_id = tbl_transact.transact_id 
        WHERE tbl_transact_ck_rnd.rnd_id = :rnd_id AND tbl_transact.board_page < 5;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':rnd_id', $this-> rnd_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getTotalNumHandledPatient() {
        $sql = "SELECT COUNT(DISTINCT tbl_transact.user_id) as patient_handled FROM `tbl_transact` 
        INNER JOIN tbl_transact_appoint_checkpoint_rnd_status as tbl_transact_ck_rnd ON tbl_transact_ck_rnd.transact_id = tbl_transact.transact_id 
        WHERE tbl_transact_ck_rnd.rnd_id = :rnd_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':rnd_id', $this-> rnd_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getStatAppointStatus() {
        $data = [];

        $target = ['APPROVED', 'PENDING', 'DECLINED'];

        foreach($target as $targ) {
            $sql = "SELECT COUNT(*) FROM `tbl_transact_appoint_checkpoint_appoint_status` 
            WHERE appoint_status = '".$targ."'";

            $query=$this->db->connect()->prepare($sql);
            
            if($query->execute()){
                $result = $query->fetch();
                array_push($data, $result);
            }
        }

        return $data;
    }

    function getPhysicalActivtyForm() {
        $sql = "SELECT * FROM `tbl_physical_activity` ";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $result = $query->fetchAll();
        }
        return $result;
    }

    function getWeightForm() {
        $sql = "SELECT * FROM tbl_weight_gain_lose_status";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $result = $query->fetchAll();
        }
        return $result;
    }

    function getBodyTypeForm() {
        $sql = "SELECT * FROM tbl_physical_body_type";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $result = $query->fetchAll();
        }
        return $result;
    }

    function getOftenessForm() {
        $sql = "SELECT * FROM tbl_transact_appoint_food_status";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $result = $query->fetchAll();
        }
        return $result;
    }

    function getApprovedAppointment() {
        $sql = "SELECT * FROM `tbl_transact` 
        INNER JOIN tbl_transact_appoint ON tbl_transact_appoint.transact_id = tbl_transact.transact_id 
        INNER JOIN tbl_transact_appoint_consult ON tbl_transact_appoint_consult.appoint_id = tbl_transact_appoint.appoint_id 
        INNER JOIN tbl_user_profile ON tbl_user_profile.user_id = tbl_transact.user_id;";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $result = $query->fetchAll();
        }
        return $result;
    }
}

?>