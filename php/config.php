<?php 

  require_once $path.'google-api/vendor/autoload.php';

  function googleClient($login = false) {
    $clientId = "660283226253-759r0jhhee768fa7hm0ums6db91gp1nv.apps.googleusercontent.com";
    $clientSecret = "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";

    $login_redirectUrl = "http://localhost/clinic/php/request/req-login.php";
    $register_redirectUrl = "http://localhost/clinic/php/set/set-register.php";

    $client = new Google_Client();
    $client -> setClientId($clientId);
    $client -> setClientSecret($clientSecret);
    $client -> setRedirectUri($login?$login_redirectUrl:$register_redirectUrl);
    $client -> addScope("profile");
    $client -> addScope("email");

    return $client;
  }