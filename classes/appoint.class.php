<?php 
require_once 'database.php';

Class appoint{
    public $user_id;
    public $transact_id;

    public $searchTransactId;

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

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function validate(){
        $sql = "SELECT * FROM tbl_transact WHERE transact_id =:transact_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':transact_id', $this-> searchTransactId);
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
        print_r($query);
        if($query->execute()){
            echo "record allergies inserted successfully";
        }

        // likes
        $sql = "INSERT INTO `tbl_transact_appoint_food_like` (`food_like_id`, `appoint_id`, `food_like_name`) VALUES ";

        $values = [];

        foreach($this -> food_like as $name) {
            array_push($values, "(NULL, $this->appoint_id, '$name')");
        }

        $final = join(",", $values);
        $query=$this->db->connect()->prepare($sql.$final);
        if($query->execute()){
            echo "record allergies inserted successfully";
        }

        // dislikes
        $sql = "INSERT INTO `tbl_transact_appoint_food_dislike` (`food_dislike_id`, `appoint_id`, `food_dislike_name`) VALUES ";

        $values = [];

        foreach($this -> food_dislike as $name) {
            array_push($values, "(NULL, $this->appoint_id, '$name')");
        }

        $final = join(",", $values);
        $query=$this->db->connect()->prepare($sql.$final);
        if($query->execute()){
            echo "record allergies inserted successfully";
        }


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
        print_r($query);
        if($query->execute()){
            echo "record allergies inserted successfully";
        }


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
        $sql = "INSERT INTO `tbl_transact_appoint_medical` (`medical_id`, `appoint_id`, `current_medication`, 
        `self_past_condition_id`, `family_past_condition_id`) VALUES (NULL, :appoint_id, :current_medication, :self_past_condition_id,
         :family_past_condition_id)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':appoint_id', $this->appoint_id);
        $query->bindParam(':current_medication', $this->medical_curent);
        $query->bindParam(':self_past_condition_id', $this->medical_past_condition);
        $query->bindParam(':family_past_condition_id', $this->medical_family_condition);

        if($query->execute()){
            return true;
        }
        else{
            return false;
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

    function getAppointCheckpointStatus() {
        $sql = "SELECT appoint_status, rnd_status, rnd_id FROM `tbl_transact_appoint_checkpoint_appoint_status` 
        as appoint_status_table JOIN tbl_transact_appoint_checkpoint_rnd_status as rnd_status_table ON 
        appoint_status_table.transact_id = appoint_status_table.transact_id WHERE appoint_status_table.transact_id = 
        :transact_id;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':transact_id', $this->transact_id);

        if($query->execute()){
            $data = $query->fetch();
            $_SESSION['rnd_id'] = $data['rnd_id'];
        }
        return $data;
    }

    function getBoardPage() {
        $sql = "SELECT board_page FROM `tbl_transact` WHERE transact_id = :transact_id;";
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
}

?>