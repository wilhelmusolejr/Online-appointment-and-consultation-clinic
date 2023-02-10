<?php 

$path = "../../";

session_start();

require_once $path.'classes/user.class.php';
require_once $path."php/general.php";


if(isset($_POST['username']) && isset($_POST['password'])) {

  $user = new user;
  $user -> via_googol = "false";
  $user -> email = validateInput($_POST['username']);
  $user -> pass = validateInput($_POST['password']);
  // print_r($user);
  $result = $user -> login();
  if(!$result) {
    return;
  }
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
    
    $result = $user -> login();

    if(!$result) {
      // $_SESSION['img_url'] = $userData['picture'];
      header("Location: ".$path."homepage/index.php");
      exit();
    }
  }
}

$_SESSION['loggedIn'] = true;

$user -> user_id = $result['user_id'];
$userLoggedInData = $user -> getUserData();

$_SESSION['user_loggedIn'] = $userLoggedInData;
    
if($userLoggedInData['user_privilege'] == 'rnd') {
  $_SESSION['transact_rnd_id'] = $userLoggedInData['user_id'];
} else {
  $_SESSION['transact_client_id'] = $userLoggedInData['user_id'];
}

header("Location: ".$path."homepage/index.php");
exit();