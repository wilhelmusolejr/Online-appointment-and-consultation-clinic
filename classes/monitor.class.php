<?php 
require_once 'database.php';

class monitor {
  public $monitor_id;
  public $current_week;
  public $total_week;
  public $board_page;
  public $user_id;
  public $rnd_id;


  public $week_num;
  public $day_num;
  public $day_date;

  public $monitor_day_id;
  public $current_body_weight;

  public $action_level;

  public $supplement_name;

  public $time_type;
  public $time;
  public $food_consumed;
  public $quanitity;
  public $amount;
  public $method;

  public $monitor_week_id;

  public $transact_id;
  public $monitor_date;

  protected $db;

  function __construct() {
        $this->db = new Database();
  }

  function getGoals() {
    $sql = "SELECT * FROM `tbl_monitor_goals` WHERE monitor_id = :monitor_id";
    $query=$this->db->connect()->prepare($sql);
    
    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
        $data = $query->fetchAll();
    }
    return $data;
  }

  function getMarketInfo() {
    $sql = "SELECT * FROM tbl_monitor WHERE monitor_id = :monitor_id";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function getDayData() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_weight_goal ON tbl_monitor_day.day_num = tbl_monitor_weight_goal.monitor_day_id 
    WHERE tbl_monitor_week.monitor_id = :monitor_id 
    AND tbl_monitor_week.week_num = :week_num 
    AND tbl_monitor_day.day_num = :day_num;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':week_num', $this-> week_num);
    $query->bindParam(':day_num', $this-> day_num);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function getDayDayData() {
    $sql = "SELECT * FROM `tbl_monitor_day` 
    INNER JOIN tbl_monitor_week ON 
    tbl_monitor_day.monitor_week_id = tbl_monitor_week.monitor_week_id 
    WHERE tbl_monitor_week.monitor_id = :monitor_id 
    AND tbl_monitor_week.week_num = :week_num;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':week_num', $this-> week_num);

    if($query->execute()){
      $data = $query->fetchAll();
    }
    return $data;
  }


  function getDayWeight() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_weight_goal ON tbl_monitor_day.day_num = tbl_monitor_weight_goal.monitor_day_id 
    WHERE tbl_monitor_week.monitor_id = :monitor_id 
    AND tbl_monitor_week.week_num = :week_num 
    AND tbl_monitor_day.day_num = :day_num;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':week_num', $this-> week_num);
    $query->bindParam(':day_num', $this-> day_num);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function addDayWeight() {
    $sql = "INSERT INTO `tbl_monitor_weight_goal` 
    (`weight_goal_id`, `monitor_day_id`, `current_body_weight`) 
    VALUES (NULL, :monitor_day_id, :current_body_weight)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':current_body_weight', $this-> current_body_weight);

    if($query->execute()){
      return true;
    }
    return false;
  }

  function getDayPhysicalAction() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_physical_action ON tbl_monitor_day.day_num = tbl_monitor_physical_action.monitor_day_id 
    WHERE tbl_monitor_week.monitor_id = :monitor_id 
    AND tbl_monitor_week.week_num = :week_num 
    AND tbl_monitor_day.day_num = :day_num;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':week_num', $this-> week_num);
    $query->bindParam(':day_num', $this-> day_num);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function addDayPhysicalAction() {
    $sql = "INSERT INTO `tbl_monitor_physical_action` 
    (`physical_action_id`, `monitor_day_id`, `action_level`) 
    VALUES (NULL, :monitor_day_id, :action_level)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':action_level', $this-> action_level);

    if($query->execute()){
      return true;
    }
    return false;
  }


  function getDaySupplement() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_supplement ON tbl_monitor_day.day_num = tbl_supplement.monitor_day_id 
    WHERE tbl_monitor_week.monitor_id = :monitor_id 
    AND tbl_monitor_week.week_num = :week_num 
    AND tbl_monitor_day.day_num = :day_num;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':week_num', $this-> week_num);
    $query->bindParam(':day_num', $this-> day_num);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function addDaySupplment() {
    $sql = "INSERT INTO `tbl_supplement` 
    (`supplement_id`, `monitor_day_id`, `supplement_name`) 
    VALUES (NULL, :monitor_day_id, :supplement_name)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':supplement_name', $this-> supplement_name);

    if($query->execute()){
      return true;
    }
    return false;
  }


  function getDayFoodIntake() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_food_intake ON tbl_monitor_day.day_num = tbl_monitor_food_intake.monitor_day_id 
    WHERE tbl_monitor_week.monitor_id = :monitor_id 
    AND tbl_monitor_week.week_num = :week_num 
    AND tbl_monitor_day.day_num = :day_num;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':week_num', $this-> week_num);
    $query->bindParam(':day_num', $this-> day_num);

    if($query->execute()){
      $data = $query->fetchAll();
    }
    return $data;
  }

  function addDayFoodIntake() {
    $sql = "INSERT INTO `tbl_monitor_food_intake` (`food_intake_id`, `monitor_day_id`, `time_type`, `time`, `food_consumed`, `quanitity`, `amount`, `method`) 
    VALUES (NULL, :monitor_day_id, :time_type, :time, :food_consumed, :quanitity, :amount, :method)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':time_type', $this-> time_type);
    $query->bindParam(':time', $this-> time);
    $query->bindParam(':food_consumed', $this-> food_consumed);
    $query->bindParam(':quanitity', $this-> quanitity);
    $query->bindParam(':amount', $this-> amount);
    $query->bindParam(':method', $this-> method);

    if($query->execute()){
      return true;
    }
    return false;
  }


  function addRequestMonitor() {
    $sql =  "INSERT INTO `tbl_monitor_pending` 
    (`monitor_pending_id`, `transact_id`, `client_status`, `monitor_date`) 
    VALUES (NULL, :transact_id, 'PENDING', :monitor_date)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this-> transact_id);
    $query->bindParam(':monitor_date', $this-> monitor_date);

    if($query->execute()){
      return true;
    }
    return false;
  }

  function getPendingMonitor() {
    $sql = "SELECT * FROM `tbl_monitor_pending` INNER JOIN tbl_transact 
    ON tbl_monitor_pending.transact_id = tbl_transact.transact_id 
    INNER JOIN tbl_transact_appoint ON tbl_transact_appoint.transact_id = tbl_transact.transact_id 
    INNER JOIN tbl_transact_appoint_consult ON tbl_transact_appoint_consult.appoint_id = tbl_transact_appoint.appoint_id
    WHERE tbl_transact.user_id = :user_id AND tbl_monitor_pending.client_status = 'PENDING';";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':user_id', $this-> user_id);

    if($query->execute()){
      $data = $query->fetchAll();
    }
    return $data;
  }

  function getPendingMonitorDate() {
    $sql = 'SELECT * FROM `tbl_monitor_day` WHERE monitor_week_id = :monitor_week_id LIMIT 1;';
    $query=$this->db->connect()->prepare($sql);
  
    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }


  function monitorFeedback($button) {
    if($button == "accept") {
      $sql = "UPDATE tbl_monitor_pending SET `client_status` = 
      'ACCEPTED' WHERE transact_id = :transact_id;";
      $query=$this->db->connect()->prepare($sql);

      $query->bindParam(':transact_id', $this-> transact_id);

      if($query -> execute() ) {
        return true;
      } 
      return false;
    }
  }

  function setMonitoring() {
    $sql = "INSERT INTO `tbl_monitor` (`monitor_id`, `transact_id`, `current_week`, `total_week`, `current_day`, `board_page`, `user_Id`, `rnd_id`) 
    VALUES (NULL, :transact_id, '1', '2', '1', '1', :user_Id, :rnd_id);";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this-> transact_id);
    $query->bindParam(':user_Id', $this-> user_id);
    $query->bindParam(':rnd_id', $this-> rnd_id);

    if($query->execute()){
      return true;
    }
    return false;
  }

  function getMonitoring() {
    $sql = "SELECT * from tbl_monitor WHERE transact_id = :transact_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this-> transact_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function setMonitorWeek() {
    $sql = "INSERT INTO `tbl_monitor_week` 
    (`monitor_week_id`, `monitor_id`, `week_num`) 
    VALUES (NULL, :monitor_id, '1'), (NULL, :monitor_id, '2')";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      return true;
    }
    return false;
  }

  function getMonitorWeek() {
    $sql = "SELECT * FROM tbl_monitor_week WHERE monitor_id = :monitor_id";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      $data = $query->fetchAll();
    }
    return $data;
  }

  function getMonitorDate() {
    $sql = "SELECT * FROM tbl_monitor_pending WHERE transact_id = :transact_id";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this-> transact_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function setMonitorDays() {
    $sql = "INSERT INTO `tbl_monitor_day` 
    (`monitor_day_id`, `monitor_week_id`, `day_date`, `day_num`) 
    VALUES (NULL, :monitor_week_id, :day_date, :day_num)";

    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_week_id', $this-> monitor_week_id);
    $query->bindParam(':day_date', $this-> day_date);
    $query->bindParam(':day_num', $this-> day_num);

    if($query->execute()){
      $data = $query->fetchAll();
    }
    return $data;
  }


}