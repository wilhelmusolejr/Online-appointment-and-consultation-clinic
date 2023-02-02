<?php 
require_once 'database.php';

Class appoint{
    public $appointId;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function validate(){
        $sql = "SELECT * FROM tbl_user_appoint WHERE appoint_id =:appointId;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':appointId', $this->appointId);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }
}

?>