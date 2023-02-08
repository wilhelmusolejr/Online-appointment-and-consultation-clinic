<?php 

  require_once $path.'google-api/vendor/autoload.php';

  $clientId = "660283226253-759r0jhhee768fa7hm0ums6db91gp1nv.apps.googleusercontent.com";
  $clientSecret = "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";
  $redirectUrl = "http://localhost/clinic/php/set/set-register.php";
  
  // Creating client request to google
  $client = new Google_Client();
  $client -> setClientId($clientId);
  $client -> setClientSecret($clientSecret);
  $client -> setRedirectUri($redirectUrl);
  $client -> addScope("profile");
  $client -> addScope("email");