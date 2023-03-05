<?php 
require_once 'database.php';

class consult {
  public $transact_id;
  public $consult_id;

  public $client_id;
  public $rnd_id;
  public $consult_schedule_id;
  public $sched_date;
  public $sched_time;

  public $join_time;
  public $current_id;
  public $current_in;

  public $consultResultFile;

  public $message_sender;
  public $message;

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
    $sql = "INSERT INTO `tbl_transact_consult` (`consult_id`, `transact_id`, `rnd_id`) VALUES (NULL, :transact_id, :rnd_id)";
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
     :consult_schedule_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':consult_schedule_id', $this-> consult_schedule_id);
    $query->bindParam(':sched_time', $this-> sched_time);
    $query->bindParam(':sched_date', $this-> sched_date);

    if($query->execute()){
      return true;
    }
  }

  function deleteSchedule() {
    $sql = "DELETE FROM `tbl_transact_consult_schedule`
     WHERE consult_schedule_id = :consult_schedule_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':consult_schedule_id', $this-> consult_schedule_id);

    if($query->execute()){
      return true;
    }
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
     (`consult_result_status_id`, `transact_id`, `consult_result_status`, `filename`)
      VALUES (NULL, :transact_id, 'PENDING', NULL)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this->transact_id);

    if($query->execute()){
        return true;
    }
    return false;
  }

  function updateConsultResult() {
    $sql = "UPDATE `tbl_transact_consult_checkpoint_result_status` 
    SET consult_result_status = 'APPROVED', filename = :consultResultFile WHERE transact_id = :transact_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this->transact_id);
    $query->bindParam(':consultResultFile', $this->consultResultFile);

    if($query->execute()){
      return true;
    }
    return false;
  }

  // check if appoint is already added
  function checkAppointPendingRndStatus() {
    $sql = "SELECT COUNT(transact_id) as number FROM `tbl_pending_appoint_rnd`
     WHERE transact_id = :transact_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this->transact_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function getAppointPendingRndSize() {
    $sql = "SELECT COUNT(*) AS number FROM `tbl_pending_appoint_rnd`
     WHERE status != 'PROGRESS' AND transact_id = :transact_id ;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this->transact_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  // set appoint pending for RND
  function appointPendingRndStatus() {
    $sql = "INSERT INTO `tbl_pending_appoint_rnd` (`pending_appoint_rnd_id`,
     `transact_id`, `rnd_id`, `status`) VALUES ";
        
    $values = [];

    foreach($this -> rnd_id as $rnd_id) {
        array_push($values, "(NULL, $this->transact_id, '$rnd_id', 'CURRENT')");
    }    

    $final = join(",", $values);
    $query=$this->db->connect()->prepare($sql.$final);
    if($query->execute()){
      return true;
    }       
    return false;     
  }

  // List of pending appointments
  function getListOfPendingAppoint() {
    $sql = "SELECT * FROM `tbl_pending_appoint_rnd` as pending_appoint INNER JOIN 
    tbl_transact_appoint as transact_appoint ON pending_appoint.transact_id =
     transact_appoint.transact_id INNER JOIN tbl_transact_appoint_consult as appoint_consult
      ON appoint_consult.appoint_id = transact_appoint.appoint_id WHERE rnd_id = :rnd_id AND status
       = 'CURRENT';";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':rnd_id', $this-> rnd_id);

    if($query->execute()){
      $data = $query->fetchAll();
    }
    return $data;
  }

  // get approved appointment
  function getApprovedAppoint() {
    $sql = "SELECT * FROM `tbl_transact_appoint_checkpoint_rnd_status` as ck_rnd_status INNER JOIN tbl_transact ON ck_rnd_status.transact_id = tbl_transact.transact_id 
    INNER JOIN tbl_transact_appoint as transact_appoint ON tbl_transact.transact_id = transact_appoint.transact_id INNER JOIN tbl_transact_appoint_consult as appoint_consult 
    ON transact_appoint.appoint_id = appoint_consult.appoint_id WHERE ck_rnd_status.rnd_id = :rnd_id AND ck_rnd_status.rnd_status = 'APPROVED';";
    $query=$this->db->connect()->prepare($sql);
  
    $query->bindParam(':rnd_id', $this-> rnd_id);

    if($query->execute()){
      $data = $query->fetchAll();
    }
    return $data;
  }

  // Set rnd feedback to transaction
  function appointFeedback($button) {
    if($button == "accept") {
      // change current transact to accepted
      $sql = "UPDATE tbl_pending_appoint_rnd as appoint_rnd SET `status` = 
      'ACCEPTED' WHERE rnd_id = :rnd_id AND transact_id = :transact_id;";

      // $sql = "UPDATE tbl_pending_appoint_rnd as appoint_rnd SET `status` = 
      // 'ACCEPTED' WHERE pending_appoint_rnd_id = (SELECT pending_appoint_rnd_id
      // FROM tbl_pending_appoint_rnd WHERE status = 'CURRENT' AND transact_id = :transact_id);";

      $query=$this->db->connect()->prepare($sql);

      $query->bindParam(':transact_id', $this-> transact_id);
      $query->bindParam(':rnd_id', $this-> rnd_id);

      if($query -> execute()) {
        $sql = "DELETE FROM tbl_pending_appoint_rnd WHERE status = 'CURRENT' 
        AND transact_id = :transact_id";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':transact_id', $this-> transact_id);

        if($query->execute()){
          $sql = "UPDATE `tbl_transact_appoint_checkpoint_rnd_status` SET 
          rnd_status = 'APPROVED', rnd_id = :rnd_id WHERE transact_id = :transact_id;";
          $query=$this->db->connect()->prepare($sql);

          $query->bindParam(':rnd_id', $this-> rnd_id);
          $query->bindParam(':transact_id', $this-> transact_id);

          if($query -> execute()) {
            return "accepted successfully";
          }
        }
      }
    }

    if($button == "denaid") {
      // remove current to denaid
      $sql = "UPDATE tbl_pending_appoint_rnd as appoint_rnd SET `status` = 
      'DENAID' WHERE pending_appoint_rnd_id = (SELECT pending_appoint_rnd_id
      FROM tbl_pending_appoint_rnd WHERE status = 'CURRENT' AND transact_id = :transact_id LIMIT 1);";
      $query=$this->db->connect()->prepare($sql);

      $query->bindParam(':transact_id', $this-> transact_id);

      if($query -> execute()) {
        // set to current 
        $sql = "UPDATE tbl_pending_appoint_rnd SET status = 'CURRENT' WHERE pending_appoint_rnd_id
         = (SELECT pending_appoint_rnd_id FROM `tbl_pending_appoint_rnd` WHERE status = 'PROGRESS'
          and transact_id = :transact_id LIMIT 1)";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':transact_id', $this-> transact_id);
        if($query->execute()){
          return "denaid successfully";
        }
      }
    }
    
  }

  // UPDATE

  function getJoinList() {
    $sql = "SELECT * FROM `tbl_consult_join` WHERE current_in = 1 and consult_id = :consult_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':consult_id', $this-> consult_id);

    if($query -> execute()) {
      $data = $query->fetchAll();
    }    
    return $data;
  }

  function updateJoinList() {
    $sql = "UPDATE tbl_consult_join SET current_in = :current_in, join_time = :join_time 
    WHERE consult_id = :consult_id AND current_id = :current_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':join_time', $this-> join_time);
    $query->bindParam(':current_in', $this-> current_in);
    $query->bindParam(':consult_id', $this-> consult_id);
    $query->bindParam(':current_id', $this-> current_id);

    if($query->execute()){
      return true;
    }       
    return false; 
  }
  
  function setJoin($clientId) {
    $sql = "INSERT INTO `tbl_consult_join` (`consult_join_id`, `consult_id`, `current_id`, `current_in`, `join_time`) VALUES
     (NULL, :consult_id, :current_id, 0, :join_time), (NULL, :consult_id, $clientId, 0, :join_time)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':consult_id', $this-> consult_id);
    $query->bindParam(':current_id', $this-> current_id);
    $query->bindParam(':join_time', $this-> join_time);

    if($query->execute()){
      return true;
    }       
    return false; 
  }

  function getMessage() {
    $sql = "SELECT * FROM `tbl_chat` WHERE consult_id = :consult_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':consult_id', $this-> consult_id);

    if($query -> execute()) {
      $data = $query->fetchAll();
    }    
    return $data;
  }

  function setMessage() {
    $sql = "INSERT INTO `tbl_chat` (`chat_id`, `consult_id`, `message_sender`, 
    `message`, `message_time`) VALUES (NULL, :consult_id, :message_sender, :message,
     current_timestamp())";
    $query=$this->db->connect()->prepare($sql);
    
    $query->bindParam(':consult_id', $this-> consult_id);
    $query->bindParam(':message_sender', $this-> message_sender);
    $query->bindParam(':message', $this-> message);

    if($query->execute()){
      return true;
    }       
    return false; 
  }
  
}