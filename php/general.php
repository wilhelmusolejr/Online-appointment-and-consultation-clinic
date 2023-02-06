<?php

function validateInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// function setMultipleInputHelper($sql,$value, $id,$data) {
//   $sql = "INSERT INTO `tbl_transact_appoint_food_allergy` 
//   (`food_allergy_id`, `appoint_id`, `allergy_name`) VALUES ";
  
//   $values = [];

//   foreach($data as $name) {
//       array_push($test, "(NULL, $id, '$values')");
//   }

//   $final = join(",", $values);

//   return $sql.$final;
// }