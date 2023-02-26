<?php 
$path = "../../../";

require_once $path."classes/user.class.php";

session_start();

$user = new user;

$result = $user -> getAllPendingIdentification();
echo json_encode($result);