<?php
$path = "../../../";

session_start();

require_once $path."classes/consult.class.php";

$consult = new consult;
$consult -> rnd_id = $_SESSION['transact_rnd_id'];
$result = $consult -> getListOfPendingAppoint();

echo json_encode($result);