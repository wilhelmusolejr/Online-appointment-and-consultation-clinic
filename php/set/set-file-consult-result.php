<?php 

$path = "../../";

require_once $path."classes/consult.class.php";

session_start();

$result = array("response"=> 1,"message" => null);


$transact_id = $_SESSION['transact_id'];

$target_dir = $path."uploads/";

$temp = explode(".", $_FILES["appointment-referral"]["name"]);
$fileName = 'result'.'_file_'.$transact_id.'.' . end($temp);
$fileType = strtolower(pathinfo($_FILES["appointment-referral"]["name"],PATHINFO_EXTENSION));

// SIZE
if($_FILES['appointment-referral']['size'] > 5000000) {
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

// update

if($result["response"] != 0) {

  $consult = new consult;
  $consult -> transact_id = $_SESSION['transact_id'];
  $consult -> consultResultFile = $_FILES['appointment-referral']['name'] == "" ? "NULL" : $fileName;

  $res = $consult -> updateConsultResult();

  if($_FILES['appointment-referral']['name'] != "") {
    move_uploaded_file($_FILES['appointment-referral']['tmp_name'], $target_dir.$fileName);
  }

  $result["response"] = 1; 
  $result['message'] = "Success";
}

echo json_encode($result); 