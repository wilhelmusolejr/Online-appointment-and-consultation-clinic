<?php

require '..\functions\functions.php';

  

    //resume session here to fetch session values
    session_start();
    /*
        if user is not login then redirect to login page,
        this is to prevent users from accessing pages that requires
        authentication such as the dashboard
    */
    if (!isset($_SESSION['logged-in'])){
        header('location: ../login/login.php');
    }
    //if the above code is false then html below will be displayed

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="../specialist/specialist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
   </head>
   
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='fas fa-user-alt'></i>
      <span class="logo_name">ADMIN</span>
    </div>
    <hr class="line">
    <ul class="nav-links">
      <li>
        <a href="../dashboard.php">
          <i class='fas fa-globe' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../dashboard.php" >Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../specialist/personal.php"  class="active">
            <i class='fa-solid fa-user-doctor' ></i>
            <span class="link_name">Specialist</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../specialist/personal.php"  class="active">Specialist</a></li>
          <li><a href="personal.php" class="active">Personal Information</a></li>
          <li><a href="appointment.php">Appointment Information</a></li>
          <li><a href="patient.php">Patient Handled</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../patient/patient.php">
            <i class='fas fa-user' ></i>
            <span class="link_name">Patient</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../patient/patient.php">Patients</a></li>
          <li><a href="../patient/patient.php">Patient Information</a></li>
          <li><a href="../patient/pending.php">Pending ID Verification</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../appointment/pending.php">
            <i class='fas fa-building' ></i>
            <span class="link_name">Appointment</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../appointment/pending.php">Appointment</a></li>
          <li><a href="../appointment/pending.php">Pending Appointment</a></li>
          <li><a href="../appointment/approved.php">Approved Appointment</a></li>
        </ul>
      </li>
      <hr class="line">
      <li class="logout-link">
      <a href="../login/logout.php">
          <i class='bx bx-log-out' ></i>
          <span class="link_name">Logout</span>
        </a>
        <ul class="sub-menu">
          <li><a class="link_name" href="../login/logout.php">Logout</a></li>
        </ul>
      </li>
  </div>
  <section class="home-section">
  <i class='bx bx-menu' ></i>
      <span class="text">MANAGE INSTRUCTOR</span>
        <div class="home-contents">
            <div class="table-containers">
            <table class="table">
                <div class="table-heading">

                    <?php
                    {
                    ?>
                        <span class="search">
                        <input type ="text" placeholder=" Search instructor">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <span class="add-instructor">
                        <i class="fas fa-user-plus"></i>
                        <a href="addinstructor.php" class="button">Add Instructor</a>
                        </span>
                    <?php
                    } ?>

                </div>
                <div class="divider-no-border"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IMAGE</th>
                            <th>EMAIL ADDRESS</th>
                            <th>FIRST NAME</th>
                            <th>MIDDLE NAME</th>
                            <th>LAST NAME</th>
                            <th>PHONE NO.</th>
                            <th>MODE</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if(!isset($_SESSION['table3'])){
                                $_SESSION['table3'] = array(
                                    "0" => array(
                                        "image" => 'jpg',
                                        "email_address" => 'maryjane@gwmsu.edu.ph',
                                        "first_name" => 'Mary Jane',
                                        "middle_name" => 'Radon',
                                        "last_name" => 'Alfonso',
                                        "phone_no." => '09474747474',
                                        "mode" => 'IDLE'
                                    ),
                                    "1" => array(
                                        "image" => 'jpg',
                                        "email_address" => 'kim.jong@gwmsu.edu.ph',
                                        "first_name" => 'Kim',
                                        "middle_name" => 'Rand',
                                        "last_name" => 'Jong-un',
                                        "phone_no." => '095643729812',
                                        "mode" => 'BUSY'
                                    ),
                                    "2" => array(
                                        "image" => 'jpg',
                                        "email_address" => 'josh.harg@gwmsu.edu.ph',
                                        "first_name" => 'Joshua',
                                        "middle_name" => 'Pilaez',
                                        "last_name" => 'Hargado',
                                        "phone_no." => '097442834123',
                                        "mode" => 'AVAILABLE'
                                    ),
                                    "3" => array(
                                        "image" => 'jpg',
                                        "email_address" => 'michealranto2@gwmsu.edu.ph',
                                        "first_name" => 'Micheal',
                                        "middle_name" => 'Sanchez',
                                        "last_name" => 'Ranto',
                                        "phone_no." => '09562856123',
                                        "mode" => 'AVAILABLE'
                                    ),
                                    "4" => array(
                                        "image" => 'jpg',
                                        "email_address" => 'maria3andrade@gwmsu.edu.ph',
                                        "first_name" => 'Maria',
                                        "middle_name" => 'Resitta',
                                        "last_name" => 'Andrade',
                                        "phone_no." => '09875632461',
                                        "mode" => 'OFFLINE'
                                    )
                                );
                            }

                            //We will now fetch all the records in the array using loop
                            //use as a counter, not required but suggested for the table
                            $i = 1;
                            //loop for each record found in the array
                            foreach ($_SESSION['table3'] as $key => $value){ //start of loop
                        ?>
                            <tr>
                                <!-- always use echo to output PHP values -->
                                <td><?php echo_safe($i); ?></td>
                                <td><?php echo_safe($value['image']); ?></td>
                                <td><?php echo_safe($value['email_address']); ?></td>
                                <td><?php echo_safe($value['first_name']); ?></td>
                                <td><?php echo_safe($value['middle_name']); ?></td>
                                <td><?php echo_safe($value['last_name']); ?></td>
                                <td><?php echo_safe($value['phone_no.']); ?></td>
                                <td><?php echo_safe($value['mode']); ?></td>
                                <td class="action">
                                    <a class="action-delete" href="#<?php echo($key);?>">DELETE</a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        //end of loop
                        }
                        ?>
                    </tbody>
        </div>
    </section>

  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>
</body>
</html>