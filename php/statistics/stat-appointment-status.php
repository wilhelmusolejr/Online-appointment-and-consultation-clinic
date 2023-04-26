<?php 
$path = "../../";

require_once $path.'classes/appoint.class.php';

session_start();

$appoint = new appoint;

$result = $appoint -> getStatAppointStatus();

echo json_encode($result);