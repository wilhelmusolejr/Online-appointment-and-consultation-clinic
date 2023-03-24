<?php
$path = "../../";

session_start();

require_once $path."classes/monitor.class.php";

$monitor = new monitor;
$monitor -> user_id = $_SESSION['user_loggedIn']['user_id'];
$result = $monitor -> getPendingMonitor();

echo json_encode($result);