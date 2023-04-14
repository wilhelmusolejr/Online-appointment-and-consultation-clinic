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
  public $date;

  public $monitor_day_id;
  public $current_body_weight;

  public $physical_level;

  public $supplement_name;

  public $time_type;
  public $time;
  public $food_consumed;
  public $quantity;
  public $amount;
  public $method;

  public $monitor_week_id;

  public $transact_id;
  public $monitor_date;

  public $goal_name;

  protected $db;

  function __construct() {
        $this->db = new Database();
  }


  // Get overall data
  function getOverallDataMonitoring() {
    $sql = "SELECT * FROM `tbl_monitor`
    INNER JOIN tbl_transact ON tbl_monitor.transact_id = tbl_transact.transact_id 
    INNER JOIN tbl_transact_appoint ON tbl_transact_appoint.transact_id = tbl_transact.transact_id 
    INNER JOIN tbl_transact_appoint_consult ON tbl_transact_appoint_consult.appoint_id = tbl_transact_appoint.appoint_id 
    WHERE tbl_monitor.monitor_id = :monitor_id ;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  // get id of day
  function getIdDay() {
    $sql = "SELECT * FROM tbl_monitor 
    INNER JOIN tbl_monitor_week ON tbl_monitor.monitor_id = tbl_monitor_week.monitor_id 
    INNER JOIN tbl_monitor_day ON tbl_monitor_day.monitor_week_id = tbl_monitor_week.monitor_week_id
    WHERE tbl_monitor.monitor_id = :monitor_id 
    AND tbl_monitor_day.day_num = :day_num 
    AND tbl_monitor_week.week_num = :week_num ;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':day_num', $this-> day_num);
    $query->bindParam(':week_num', $this-> week_num);

    if($query->execute()){
        $data = $query->fetch();
    }
    return $data;
  }

  // USED
  function getGoals() {
    $sql = "SELECT * FROM `tbl_monitor_client_goal` WHERE monitor_id = :monitor_id";
    $query=$this->db->connect()->prepare($sql);
    
    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
        $data = $query->fetchAll();
    }
    return $data;
  }

  // USED
  function updateGoals() {
    $sql = "UPDATE `tbl_monitor_client_goal` SET `goal_status` = '1' WHERE `tbl_monitor_client_goal`.`monitor_client_goal_id` = (SELECT monitor_client_goal_id FROM tbl_monitor_client_goal WHERE goal_name = :goal_name);";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':goal_name', $this-> goal_name);
 
    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function getMonitoringClient() {
    $sql = "SELECT * FROM `tbl_monitor` 
    INNER JOIN tbl_transact ON tbl_monitor.transact_id = tbl_transact.transact_id 
    INNER JOIN tbl_user_profile ON tbl_user_profile.user_id = tbl_transact.user_id 
    WHERE tbl_monitor.monitor_id = :monitor_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function getMonitoringRnd() {
    $sql = "SELECT * FROM `tbl_monitor` 
    INNER JOIN tbl_transact_appoint_checkpoint_rnd_status as tbl_rnd ON tbl_monitor.transact_id = tbl_rnd.transact_id 
    INNER JOIN tbl_user_profile ON tbl_user_profile.user_id = tbl_rnd.rnd_id 
    WHERE tbl_monitor.monitor_id = :monitor_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      $data = $query->fetch();
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

  // USED
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

  // USED
  function getDayWeight() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_weight_goal ON tbl_monitor_day.monitor_day_id = tbl_monitor_weight_goal.monitor_day_id 
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
    (`monitor_weight_goal_id`, `monitor_day_id`, `current_body_weight`) 
    VALUES (NULL, :monitor_day_id, :current_body_weight)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':current_body_weight', $this-> current_body_weight);

    if($query->execute()){
      return true;
    }
    return false;
  }

  // USED
  function getDayPhysicalAction() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_physical ON tbl_monitor_day.monitor_day_id = tbl_monitor_physical.monitor_day_id 
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
    $sql = "INSERT INTO `tbl_monitor_physical` 
    (`monitor_physical_id`, `monitor_day_id`, `physical_level`) 
    VALUES (NULL, :monitor_day_id, :physical_level)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':physical_level', $this-> physical_level);

    if($query->execute()){
      return true;
    }
    return false;
  }

  // USED
  function getDaySupplement() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_supplement ON tbl_monitor_day.monitor_day_id = tbl_monitor_supplement.monitor_day_id 
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
    $sql = "INSERT INTO `tbl_monitor_supplement` 
    (`monitor_supplement_id`, `monitor_day_id`, `supplement_name`) 
    VALUES (NULL, :monitor_day_id, :supplement_name)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':supplement_name', $this-> supplement_name);

    if($query->execute()){
      return true;
    }
    return false;
  }

  // used
  function getDayFoodIntake() {
    $sql = "SELECT * FROM `tbl_monitor_week` 
    INNER JOIN tbl_monitor_day ON tbl_monitor_week.monitor_week_id = tbl_monitor_day.monitor_week_id 
    INNER JOIN tbl_monitor_food_intake ON tbl_monitor_day.monitor_day_id = tbl_monitor_food_intake.monitor_day_id 
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

  // used
  function addDayFoodIntake() {
    $sql = "INSERT INTO `tbl_monitor_food_intake` (`food_intake_id`, `monitor_day_id`, `time_type`, `time`, `food_consumed`, `quantity`, `amount`, `method`) 
    VALUES (NULL, :monitor_day_id, :time_type, :time, :food_consumed, :quantity, :amount, :method)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_day_id', $this-> monitor_day_id);
    $query->bindParam(':time_type', $this-> time_type);
    $query->bindParam(':time', $this-> time);
    $query->bindParam(':food_consumed', $this-> food_consumed);
    $query->bindParam(':quantity', $this-> quantity);
    $query->bindParam(':amount', $this-> amount);
    $query->bindParam(':method', $this-> method);

    if($query->execute()){
      return true;
    }
    return false;
  }

  function checkRequestMonitorId() {
    $sql = "SELECT * FROM `tbl_monitor_pending` WHERE transact_id = :transact_id ";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this-> transact_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
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


  // used
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
    
    if($button == "denaid") {
      $sql = "UPDATE tbl_monitor_pending SET `client_status` = 
      'DECLINED' WHERE transact_id = :transact_id;";
      $query=$this->db->connect()->prepare($sql);

      $query->bindParam(':transact_id', $this-> transact_id);

      if($query -> execute() ) {
        return true;
      } 
      return false; 
    }

    if($button == "pending") {
      $sql = "UPDATE tbl_monitor_pending SET 
      `client_status` = 'PENDING', 
      `monitor_date` = :monitor_date 
      WHERE 
      transact_id = :transact_id;";
      $query=$this->db->connect()->prepare($sql);

      $query->bindParam(':transact_id', $this-> transact_id);
      $query->bindParam(':monitor_date', $this-> monitor_date);

      if($query -> execute() ) {
        return true;
      } 
      return false; 
    }
  }

  // used
  function updateEndMonitoring() {
    $sql = "UPDATE `tbl_monitor` SET `board_page` = '2' 
    WHERE `tbl_monitor`.`monitor_id` = :monitor_id ;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      return true;
    }
    return false;
  }
  
  // used
  function setMonitoring() {
    $sql = "INSERT INTO `tbl_monitor` (`monitor_id`, `transact_id`, `monitor_date`, `total_week`, `current_week`, `current_day`, `board_page`) 
    VALUES (NULL, :transact_id, :monitor_date, '2', '1', '1', '1')";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':transact_id', $this-> transact_id);
    $query->bindParam(':monitor_date', $this-> monitor_date);

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

  function getMonitoringViaMonitorId() {
    $sql = "SELECT * from tbl_monitor WHERE monitor_id = :monitor_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function updateTotalWeekMonitoring() {
    $sql = "UPDATE `tbl_monitor` SET `total_week` = :total_week 
    WHERE `tbl_monitor`.`monitor_id` = :monitor_id;";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':total_week', $this-> total_week);

    if($query->execute()){
      return true;
    }
    return false;
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

  function updateMonitorWeek() {
    $sql = "INSERT INTO `tbl_monitor_week` 
    (`monitor_week_id`, `monitor_id`, `week_num`) 
    VALUES (NULL, :monitor_id, :week_num)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_id', $this-> monitor_id);
    $query->bindParam(':week_num', $this-> week_num);

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

  
  // monitor_day_id	monitor_week_id	day_num	date
  function setMonitorDays() {
    $sql = "INSERT INTO `tbl_monitor_day` 
    (`monitor_day_id`, `monitor_week_id`, `day_num`, `date`) 
    VALUES (NULL, :monitor_week_id, :day_num, :date)";

    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':monitor_week_id', $this-> monitor_week_id);
    $query->bindParam(':day_num', $this-> day_num);
    $query->bindParam(':date', $this-> date);

    if($query->execute()){
      return true;
    }
    return false;
  }


}