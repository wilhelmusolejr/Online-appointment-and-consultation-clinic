<?php 
$path = "";


require_once 'php/general.php';
require_once $path.'classes/appoint.class.php';

$appoint = new appoint;


$appoint -> appoint_id = 232;

$result = $appoint -> getMedicalInfoo();

// print_r($appoint); 
print_r($result);


?>