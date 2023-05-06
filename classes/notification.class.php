<?php 

require_once 'database.php';

Class notification{
  public $user_id;
  public $message;
  public $link;
  
  public $tbl_notif_id;

  protected $db;

  function __construct() {
    $this -> db = new Database();
  }

  function setNotRead() {
    $sql = "UPDATE tbl_notification 
    SET is_read = 1 
    WHERE tbl_notif_id = :tbl_notif_id";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':tbl_notif_id', $this-> tbl_notif_id);

    if($query -> execute()) {
      return true;
    }
    return false;
  }

  function markAllNotifRead() {
    $sql = "UPDATE tbl_notification SET is_read = 1 WHERE user_id = :user_id";
    $query = $this->db->connect()->prepare($sql);

    $query->bindParam(':user_id', $this-> user_id);

    if($query -> execute()) {
      return true;
    }
    return false;
  }

  function getLink() {
    $sql = "SELECT * FROM tbl_notification WHERE tbl_notif_id = :tbl_notif_id";
    $query=$this->db->connect()->prepare($sql);
    
    $query->bindParam(':tbl_notif_id', $this-> tbl_notif_id);

    if($query->execute()){
      $data = $query->fetch();
    }
    return $data;
  }

  function sendNotification() {
    $sql = "INSERT INTO `tbl_notification` (`tbl_notif_id`, `user_id`, `message`, `is_read`, `created_at`, `link`) 
    VALUES (NULL, :user_id, :message, '0', current_timestamp(), :link)";
    $query=$this->db->connect()->prepare($sql);

    $query->bindParam(':user_id', $this-> user_id);
    $query->bindParam(':message', $this-> message);
    $query->bindParam(':link', $this-> link);

    if($query->execute()){
        return true;
    }
    return false;
}

}

?>