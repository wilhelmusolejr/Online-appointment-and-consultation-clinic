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


}