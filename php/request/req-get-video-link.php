<?php 
require_once '../../classes/user.class.php';

session_start();

$user = new user;
$user -> user_id = $_SESSION['transact_rnd_id'];

$result = $user -> getVideoCallLink();
echo json_encode($result);