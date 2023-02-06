<?php 
require_once 'database.php';

class consult {
  public $transact_id;
  public $consult_id;
  
  protected $db;


  function __construct() {
        $this->db = new Database();
  }

  function getConsultInfo() {

  }

  function getSchedule() {
    $sql = "SELECT * FROM `tbl_transact_consult` AS consult_table 
    RIGHT JOIN tbl_transact_consult_schedule AS consult_schedule ON 
    consult_table.consult_id = consult_schedule.consult_id WHERE consult_table.transact_id
     = :transact_id;";
    
    $query=$this->db->connect()->prepare($sql);
    $query->bindParam(':transact_id', $this-> transact_id);

    if($query->execute()){
        $data = $query->fetchAll();
    }
    return $data;
  }
}