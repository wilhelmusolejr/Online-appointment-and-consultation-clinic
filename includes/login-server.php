<?php
    require_once '../classes/login.class.php';

    //we start session since we need to use session values
    // print_r($_POST);
    session_start();
    //creating an array for list of users can login to the system

    if(isset($_POST['username']) && isset($_POST['password'])){

        //Sanitizing the inputs of the users. Mandatory to prevent injections!
        $users = new login;
        $users->username = htmlentities($_POST['username']);
        $users->user_password = htmlentities($_POST['password']);
        $res = $users->validate();
        if($res){
            $_SESSION['acc_no'] = $res['acc_no'];
            echo "success";
        } else {
          echo "fail";
        }
        //set the error message if account is invalid
        // $error = 'Invalid username/password. Try again.';
    }
?>