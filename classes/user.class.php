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

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function getUserData() {
        $sql = "SELECT * FROM tbl_user_profile WHERE user_id =:user_id;";
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
            $data = $query->fetchAll();
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
            $this -> user_id = $this -> getLatestUserId();

            $sql = "INSERT INTO `tbl_user_acc_info` (`acc_no`, `user_id`, `email`, `pass`, `status`) 
            VALUES (NULL, :user_id, :email, :pass, :status)";
            $query=$this->db->connect()->prepare($sql);

            $query->bindParam(':user_id', $this-> user_id);
            $query->bindParam(':email', $this-> email);
            $query->bindParam(':pass', $this-> pass);
            $query->bindParam(':status', $this-> status);
            
            if($query->execute()) {
                return "added successfully 2";
            }

            return "added successfully 1";
        }
        return "error adding";
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
}

?>