<?php

function validateInput($data) {
  $data = trim($data, " ");
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function generateVerifCode($length = 10) {
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length).rand(1000,9999);
}

?>