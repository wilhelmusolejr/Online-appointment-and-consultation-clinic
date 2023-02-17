<?php
        //we start session since we need to use session values
        session_start();
        if(isset($_SESSION['user_type']) == 'admin'){
            header('location:../dashboard.php');
        }
        //creating an array for list of users can login to the system
        $accounts = array(
            "user1" => array(
                "username" => 'wilhelmus',
                "password" => 'wilhelmus'
            ),
            "user2" => array(
                "username" => 'charity',
                "password" => 'charity'
            ),
            "user3" => array(
                "username" => 'sherinata',
                "password" => 'sherinata'
            ),
            "user4" => array(
                "username" => 'annashar',
                "password" => 'annashar'
            ),
            "user5" => array(
                "username" => 'lucy',
                "password" => 'lucy'
            )
        );
        if(isset($_POST['username']) && isset($_POST['password'])){
            //Sanitizing the inputs of the users. Mandatory to prevent injections!
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            foreach($accounts as $keys => $value){
                //check if the username and password match in the array
                if($username == $value['username'] && $password == $value['password']){
                    //if match then save username, fullname and type as session to be reused somewhere else
                    $_SESSION['logged-in'] = $value['username'];
                    $_SESSION['fullname'] = $value['firstname'] . ' ' . $value['lastname'];
                    //display the appropriate dashboard page for user
                    if($value['type'] == 'admin'){
                        header('location: ../dashboard.php');
                    }else{
                        header('location: ../dashboard.php');
                    }
                }
            }
            //set the error message if account is invalid
            $error = 'Invalid username/password. Try again.';
        }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=p, initial-scale=1.0">
    <link rel="stylesheet" href="../login/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Login</title>
</head>
<body>
    
    <div class="login-container">
        <form class="login-form" action="login.php" method="post">
            <div class="logo-details">
                <i class='bx bxs-user'></i>
                <span class="logo-name">ADMIN</span>
            </div>
            <hr class="divider">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required tabindex="1">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required tabindex="2">
            <input class="button" type="submit" value="Login" name="login" tabindex="3">
            <?php
                //Display the error message if there is any.
                if(isset($error)){
                    echo htmlspecialchars($error);
                }
                
            ?>
        </form>
    </div>
</body>
</html>