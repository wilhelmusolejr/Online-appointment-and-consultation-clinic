<?php 
$path = "../../";

require_once $path."classes/user.class.php";

session_start();

$user = new user;
$result = $user -> getSexStatistics();

echo json_encode($result);