<?php 
require_once 'database.php';

Class user{
    public $targetId;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function validate(){
        $sql = "SELECT * FROM tbl_user_profile WHERE user_id =:targetId;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':targetId', $this-> targetId);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }
}

?>