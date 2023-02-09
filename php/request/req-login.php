<?php 

$path = "../../";

session_start();

require_once $path.'classes/user.class.php';
require_once $path."php/general.php";


print_r($_POST);

if(isset($_POST['username']) && isset($_POST['password'])) {

  $user = new user;
  $user -> via_googol = "false";
  $user -> email = validateInput($_POST['username']);
  $user -> pass = validateInput($_POST['password']);
  print_r($user);
  $res = $user -> login();
  if($res) {
    $_SESSION['acc_no'] = $res['user_id'];
    header("Location: ".$path."homepage/index.php");
    exit();
  }
  print_r("negative");
} else {
  require_once '../config.php';

  $login = true;
  $client = googleClient($login);

  if(isset($_GET['code'])) {
    $token = $client -> fetchAccessTokenWithAuthCode($_GET['code']);
  } 

  if(isset($token['error']) != 'invalid_grant') {
    $gauth = new Google\Service\Oauth2($client);

    $userData = $gauth ->userinfo_v2_me->get();

    $user = new user;
    $user -> via_googol = true;
    $user -> email = $userData['email'];
    $user -> user_id = $user -> getUserId();
    
    $res = $user -> login();

    if($res) {
      $_SESSION['acc_no'] = $res['user_id'];
      // $_SESSION['img_url'] = $userData['picture'];
      header("Location: ../../homepage/index.php");
    }

  } else {
    header("Location: ../../homepage/index.php");
  }
}