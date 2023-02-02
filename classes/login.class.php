<?php 
require_once 'database.php';

Class login{
    public $username;
    public $user_password;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function validate(){
        $sql = "SELECT * FROM tbl_user_acc_info WHERE email =:username and pass = :user_password ;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':username', $this->username);
        $query->bindParam(':user_password', $this->user_password);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }
}

?>