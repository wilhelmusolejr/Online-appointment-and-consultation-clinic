<?php 
$path = "../../";

require_once $path.'classes/user.class.php';
require_once $path.'classes/notification.class.php';
require_once $path.'classes/email.class.php';

session_start();

$mail = new mail;
$user = new user;
$notification = new notification;

$result = array("response"=> 1,"message" => null);

$target_dir = $path."uploads/";

$temp = explode(".", $_FILES["id-image"]["name"]);

$firstName = $_SESSION['user_loggedIn']['first_name'];
$lastName = $_SESSION['user_loggedIn']['last_name'];
$rand = rand(10,100);


// $fileName = 'id'.'_file_'."wilhelmus_ole".'.' . end($temp);
$fileName = 'id'.'_file_'.$firstName.'_'.$lastName.'_'.$rand.'.' . end($temp);
$fileType = strtolower(pathinfo($_FILES["id-image"]["name"],PATHINFO_EXTENSION));

// SIZE
if($_FILES['id-image']['size'] > 5000000) {
  $result["response"] = 0; 
  $result['message'] = "Your file is too large, only 5mb below.";
}

// Allow certain file formats
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
 && $fileType != "pdf" && $fileType != "docx" &&
$fileType != "doc") {
  $result["response"] = 0; 
  $result['message'] = "Only JPG, JPEG, PNG, PDF, and DOC file types are allowed.";
}

if($result['response'] == 0) {
  echo json_encode($result);
  exit();
}

$user -> user_id = $_SESSION['user_loggedIn']['user_id'];
$user -> id_image = $fileName;
$user -> id_status = "PENDING";
$user -> id_remark = "";

move_uploaded_file($_FILES['id-image']['tmp_name'], $target_dir.$fileName);

$isExist = $user -> ifUserIdExist();

if($isExist) {
  $res = $user -> updateUpload();
} else {
  $res = $user -> setUploadId();
}

$userData = $_SESSION['user_loggedIn'];

// EMAIL 
$mail -> receiver = $userData['email'];
$mail -> subject = "WMSU Dietitian | ID Verification Submitted";
$mail -> content = "<div class='container-message-parent'>
<br>
<p>Dear Mr/Ms ".$userData['last_name'].",</p>
<p>We have received your ID verification request.
Please wait for further updates regarding the
verification process.</p>
<br>
</div>";
$mail -> body = $mail -> finalTemplate();

$mail -> sendingEmail();


// IN-APP NOTIFICATION
$notification -> user_id = $_SESSION['user_loggedIn']['user_id'];
$notification -> message = "We have received your ID Verification request.";
$notification -> link = "profile/profile.php?profile-id=".$_SESSION['user_loggedIn']['user_id'];   
$notification -> sendNotification();


echo json_encode($result);
exit();