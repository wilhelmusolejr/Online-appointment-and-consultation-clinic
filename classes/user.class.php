<?php 
require_once 'database.php';

Class user{
    public $targetId;

    public $user_id;

    public $register_via_google;
    public $email;
    public $pass;
    public $status;

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

    function validate() {
        $sql = "SELECT * FROM tbl_user_profile WHERE user_id =:targetId;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':targetId', $this-> targetId);
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

    function register() {
        $sql = "INSERT INTO `tbl_user_profile` (`user_id`, `first_name`, `middle_name`, 
            `last_name`, `contact`, `gender`, `birthdate`, `account_info`) VALUES 
            (NULL, :first_name, :middle_name, :last_name, :contact, :gender, 
            :birthdate, NULL)";
        $query=$this->db->connect()->prepare($sql);

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
}

?>