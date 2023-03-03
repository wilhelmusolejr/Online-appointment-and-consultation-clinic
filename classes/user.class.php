<?php 
require_once 'database.php';

Class user{
    public $user_id;

    public $via_googol;

    public $register_via_google;
    public $email;
    public $pass;
    public $status;

    public $user_type;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $contact;
    public $gender;
    public $birthdate;

    public $id_image;
    public $id_status;
    public $id_remark;

    public $profile_img;

    public $feedback;

    public $verification_code;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function getUserData() {
        $sql = "SELECT * FROM tbl_user_profile INNER JOIN tbl_user_acc_info ON tbl_user_profile.user_id = tbl_user_acc_info.user_id
         WHERE tbl_user_profile.user_id = :user_id;";
        $query=$this->db->connect()->prepare($sql);
        
        $query->bindParam(':user_id', $this-> user_id);
        
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getLatestUserId() {
        $sql = "SELECT * FROM `tbl_user_profile` WHERE first_name =
         :first_name AND birthdate = :birthdate;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':first_name', $this-> first_name);
        $query->bindParam(':birthdate', $this-> birthdate);

        if($query->execute()){
            $data = $query -> fetch();
        }
        return $data['user_id'];
    }

    function getLatestUserIdTwo() {
        $sql = "SELECT user_id FROM tbl_user_acc_info WHERE email = :email";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':email', $this-> email);

        if($query->execute()){
            $data = $query -> fetch();
        }
        return $data['user_id'];
    }

    function getUserId() {
        $sql = "SELECT * FROM `tbl_user_acc_info` WHERE email = :email;";
        $query=$this->db->connect()->prepare($sql);
        
        $query->bindParam(':email', $this-> email);
        
        if($query->execute()){
            $data = $query -> fetch();
        }
        return $data['user_id'];
    }

    function checkIfEmailIsregistered() {
        $sql = "SELECT * FROM `tbl_user_acc_info` WHERE email = :email ;";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':email', $this-> email);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function register() {
        $sql = "INSERT INTO `tbl_user_profile` (`user_id`, `user_privilege`, `user_type`,
        `first_name`, `middle_name`, `last_name`, `contact`, `gender`, `birthdate`, `profile_img`) 
        VALUES (NULL, 'client', :user_type, :first_name, :middle_name, :last_name, :contact, 
            :gender, :birthdate, NULL)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_type', $this-> user_type);
        $query->bindParam(':first_name', $this-> first_name);
        $query->bindParam(':middle_name', $this-> middle_name);
        $query->bindParam(':last_name', $this-> last_name);
        $query->bindParam(':contact', $this-> contact);
        $query->bindParam(':gender', $this-> gender);
        $query->bindParam(':birthdate', $this-> birthdate);

        if($query->execute()){
            $this -> user_id =  $this -> getLatestUserId();

            $sql = "INSERT INTO `tbl_user_acc_info` (`acc_no`, `user_id`, `email`, `pass`, `status`) 
            VALUES (NULL, :user_id, :email, :pass, :status)";
            $query=$this->db->connect()->prepare($sql);

            $query->bindParam(':user_id', $this-> user_id);
            $query->bindParam(':email', $this-> email);
            $query->bindParam(':pass', $this-> pass);
            $query->bindParam(':status', $this-> status);
            
            if($query->execute()) {
                return true;
            }
            return false;
        }
        return false;
    }

    function login() {
        if($this -> via_googol == "true") {
            $sql = "SELECT * FROM `tbl_user_profile` WHERE user_id = :user_id";
            $query=$this->db->connect()->prepare($sql);

            $query->bindParam(':user_id', $this-> user_id);
        } else {
            $sql = "SELECT * FROM tbl_user_acc_info WHERE email =:email and pass = :pass;";
            $query=$this->db->connect()->prepare($sql);

            $query->bindParam(':email', $this-> email);
            $query->bindParam(':pass', $this-> pass);
        }
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function updateUserProfile() {
        $sql = "UPDATE tbl_user_profile SET user_type = :user_type, first_name = :first_name, middle_name =
         :middle_name, last_name = :last_name, contact = :contact, gender = :gender, 
         birthdate = :birthdate, profile_img = :profile_img WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_type', $this-> user_type);
        $query->bindParam(':first_name', $this-> first_name);
        $query->bindParam(':middle_name', $this-> middle_name);
        $query->bindParam(':last_name', $this-> last_name);
        $query->bindParam(':contact', $this-> contact);
        $query->bindParam(':gender', $this-> gender);
        $query->bindParam(':birthdate', $this-> birthdate);
        $query->bindParam(':user_id', $this-> user_id);
        $query->bindParam(':profile_img', $this-> profile_img);
        
        if($query->execute()) {
            return true;
        }
        return false;
    }

    function updateUserAccount() {
        $sql = "UPDATE tbl_user_acc_info SET pass = :pass WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);
        $query->bindParam(':pass', $this-> pass);

        if($query -> execute()) {
            return true;
        }
        return false;
    }

    function setUploadId() {
        $sql = "INSERT INTO `tbl_user_identification` (`identification_id`, `user_id`, 
        `image`, `status`, `remark`) VALUES (NULL, :user_id, :id_image, :id_status, 
        :id_remark)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);
        $query->bindParam(':id_image', $this-> id_image);
        $query->bindParam(':id_status', $this-> id_status);
        $query->bindParam(':id_remark', $this-> id_remark);

        if($query -> execute()) {
            return true;
        }
        return false;
    }   

    function updateUpload() {
        $sql = "UPDATE tbl_user_identification SET image = :image, 
        status = :status WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':image', $this-> id_image);
        $query->bindParam(':status', $this-> id_status);
        $query->bindParam(':user_id', $this-> user_id);

        if($query -> execute()) {
            return true;
        }
        return false;
    }

    function ifUserIdExist() {
        $sql = "SELECT * FROM `tbl_user_identification` WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getIdInfo() {
        $sql = "SELECT * FROM tbl_user_identification WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getAllPendingIdentification() {
        $sql = "SELECT * FROM `tbl_user_identification` WHERE status = 'PENDING';";
        $query=$this->db->connect()->prepare($sql);

        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function setFeedbackIdentification() {
        $sql = "UPDATE tbl_user_identification SET status = :feedback WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);
        $query->bindParam(':feedback', $this-> feedback);

        if($query -> execute()) {
            return true;
        }
        return false;
    }

    function getVideoCallLink() {
        $sql = "SELECT videocall_link FROM
         tbl_user_videocall WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function setAccountVerification() {
        $sql = "INSERT INTO tbl_user_email_verification (`email_vericiation_id`, `user_id`, `verification_code`)
        VALUES (NULL, :user_id, :verification_code)";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);
        $query->bindParam(':verification_code', $this-> verification_code);

        if($query -> execute()) {
            return true;
        }
        return false;
    }

    function getAccountVerification() {
        if(isset($this -> verification_code)) {
            $sql = "SELECT * from tbl_user_email_verification WHERE verification_code = :verification_code";
            $query=$this->db->connect()->prepare($sql);

            $query->bindParam(':verification_code', $this-> verification_code);

            if($query->execute()){
                $data = $query->fetch();
            }
            return $data;
        }

        if(isset($this -> user_id)) {
            $sql = "SELECT * from tbl_user_email_verification WHERE 
            user_id = :user_id";
            $query=$this->db->connect()->prepare($sql);

            $query->bindParam(':user_id', $this-> user_id);

            if($query->execute()){
                $data = $query->fetch();
            }
            return $data;
        }
    }

    function getAccountVerifications() {
        $sql = "SELECT * from tbl_user_email_verification WHERE
         verification_code = :verification_code";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':verification_code', $this-> verification_code);

        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function updateAccountVerification() {
        $sql = "UPDATE tbl_user_acc_info SET status = :feedback WHERE user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);
        $query->bindParam(':feedback', $this-> feedback);

        if($query -> execute()) {
            return true;
        }
        return false;
    }

    function deleteAllVerificationCode() {
        $sql = "DELETE FROM tbl_user_email_verification where user_id = :user_id";
        $query=$this->db->connect()->prepare($sql);

        $query->bindParam(':user_id', $this-> user_id);

        if($query -> execute()) {
            return true;
        }
        return false;
    }
}

?>