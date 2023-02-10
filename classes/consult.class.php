<?php 
require_once 'database.php';

class consult {
  public $transact_id;
  public $consult_id;

  public $client_id;
  public $rnd_id;
  public $sched_date;
  public $sched_time;
  
  protected $db;

  function __construct() {
        $this->db = new Database();
  }

  function getConsultId() {
    $sql = 'SELECT * FROM `tbl_transact_consult` where transact_id = :transact_id;';
    $query=$this->db->connect()->prepare($sql);
    $query->bindParam(':transact_id', $this-> transact_id);
    if($query->execute()){
      $data = $query->fetch();
    }
    return $data['consult_id'];
  }

  function setConsult() {
    $sql = "INSERT INTO `tbl_transact_consult` (`consult_id`, `transact_id`, `rnd_id`, 
    `consult_date_finish`) VALUES (NULL, :transact_id, :rnd_id, NULL)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this-> transact_id);
    $query->bindParam(':rnd_id', $this-> rnd_id);

    if($query->execute()){
      return true;
    }
  }

  function getSchedule() {
    $sql = "SELECT * FROM `tbl_transact_consult` AS consult_table 
    RIGHT JOIN tbl_transact_consult_schedule AS consult_schedule ON 
    consult_table.consult_id = consult_schedule.consult_id WHERE consult_table.transact_id
     = :transact_id ORDER BY consult_schedule.date 
    ASC;";
    $query=$this->db->connect()->prepare($sql);
    
    $query->bindParam(':transact_id', $this-> transact_id);

    if($query->execute()){
        $data = $query->fetchAll();
    }
    return $data;
  }

  function addSchedule() {
    $sql = "INSERT INTO `tbl_transact_consult_schedule` 
    (`consult_schedule_id`, `consult_id`, `client_id`, `rnd_id`, 
    `date`, `time`) VALUES (NULL, :consult_id, :client_id, :rnd_id,
     :sched_date, :sched_time)";

    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':consult_id', $this-> consult_id);
    $query->bindParam(':client_id', $this-> client_id);
    $query->bindParam(':rnd_id', $this-> rnd_id);
    $query->bindParam(':sched_date', $this-> sched_date);
    $query->bindParam(':sched_time', $this-> sched_time);

    if($query->execute()){
      return true;
    }
  }

  function updateSchedule() {
    $sql = "UPDATE tbl_transact_consult_schedule as consult_schedule SET `date` =
     :sched_date, `time` = :sched_time WHERE consult_schedule.consult_schedule_id = 
     :consult_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':consult_id', $this-> consult_id);
    if($query->execute()){
      return true;
    }
  }

  function deleteSchedule() {

  }

  function getConsultInfo() {
    $sql = "SELECT * FROM `tbl_transact_consult` WHERE transact_id = :transact_id";

    $query=$this->db->connect()->prepare($sql);
    
    $query->bindParam(':transact_id', $this-> transact_id);

    if($query->execute()){
        $data = $query->fetch();
    }
    return $data;
  }

  function getConsultResult() {
    $sql = "SELECT * FROM `tbl_transact_consult_checkpoint_result_status`
     WHERE transact_id = :transact_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this->transact_id);

    if($query->execute()){
        $data = $query->fetch();
    }
    return $data;
  }

  function setConsultResult() {
    $sql = "INSERT INTO `tbl_transact_consult_checkpoint_result_status`
     (`consult_result_status_id`, `transact_id`, `consult_result_status`)
      VALUES (NULL, :transact_id, 'PENDING')";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this->transact_id);

    if($query->execute()){
        return true;
    }
    return false;
  }
}