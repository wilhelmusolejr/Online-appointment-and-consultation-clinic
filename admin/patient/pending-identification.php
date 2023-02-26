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
  <link rel="stylesheet" href="../patient/patient.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" defer></script>
  <script src="pending-identification.js" defer></script>
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
          <i class='fas fa-globe'></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../dashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../specialist/patient.php">
            <i class='fa-solid fa-user-doctor'></i>
            <span class="link_name">Specialist</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../specialist/patient.php" class="active">Specialist</a></li>
          <li><a href="../speacialist/personal.php">Personal Information</a></li>
          <li><a href="../speacialist/appointment.php">Appointment Information</a></li>
          <li><a href="../speacialist/patient.php" class="active">Patient Handled</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#" class="active">
            <i class='fas fa-user'></i>
            <span class="link_name">Patient</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../patient/patient.php" class="active">Patients</a></li>
          <li><a href="patient.php">Patient Information</a></li>
          <li><a href="pending.php">Pending ID Verification</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../appointment/pending.php">
            <i class='fas fa-building'></i>
            <span class="link_name">Appointment</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../appointment/pending.php">Appointment</a></li>
          <li><a href="../appointment/pending-identification.php">Pending Appointment</a></li>
          <li><a href="../appointment/approved.php">Approved Appointment</a></li>
        </ul>
      </li>
      <hr class="line">
      <li class="logout-link">
        <a href="../login/logout.php">
          <i class='bx bx-log-out'></i>
          <span class="link_name">Logout</span>
        </a>
        <ul class="sub-menu">
          <li><a class="link_name" href="../login/logout.php">Logout</a></li>
        </ul>
      </li>
  </div>
  <section class="home-section">
    <i class='bx bx-menu'></i>
    <span class="text">MANAGE PATIENT</span>
    <div class="home-contents">
      <div class="table-containers">
        <table class="table">
          <div class="table-heading">

            <?php
                    {
                    ?>
            <span class="search">
              <input type="text" placeholder=" Search patient">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <?php
                    } ?>

          </div>
          <div class="divider-no-border"></div>
          <table class="table">
            <thead>
              <tr>
                <th>IMAGE</th>
                <th>Full name</th>
                <th>ID_IMG</th>
                <th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
      </div>
  </section>

  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
      let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
      arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });
  </script>
</body>

</html>