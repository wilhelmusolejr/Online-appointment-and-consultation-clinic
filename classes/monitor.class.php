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


}