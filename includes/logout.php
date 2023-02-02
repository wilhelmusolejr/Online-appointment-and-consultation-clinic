<?php

    //resume session
    session_start();
    //destroy session
    session_destroy();
    //then send user to login page
    header('location: ../homepage/index.php');

?>