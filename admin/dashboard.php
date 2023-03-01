<?php 
  $path = "";

  session_start();

  if (!isset($_SESSION['logged-in'])){
    header('location: login/login.php');
  }

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" defer></script>
  <title>Admin</title>
</head>

<body>
  <!-- <div class="sidebar close">
    <div class="logo-details">
      <i class='fas fa-user-alt'></i>
      <span class="logo_name">ADMIN</span>
    </div>
    <hr class="line">
    <ul class="nav-links">
      <li>
        <a href="dashboard.php" class="active">
          <i class='fas fa-globe'></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="dashboard.php" class="active">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../admin2/specialist/personal.php">
            <i class='fa-solid fa-user-doctor'></i>
            <span class="link_name">Specialist</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../admin2/specialist/personal.php">Specialist</a></li>
          <li><a href="../admin2/specialist/personal.php">Personal Information</a></li>
          <li><a href="../admin2/specialist/appointment.php">Appointment Information</a></li>
          <li><a href="../admin2/specialist/patient.php">Patient Handled</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../admin2/patient/patient.php">
            <i class='fas fa-user'></i>
            <span class="link_name">Patient</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../admin2/patient/patient.php">Patients</a></li>
          <li><a href="../admin2/patient/patient.php">Patient Information"</a></li>
          <li><a href="../admin2/patient/pending.php">Pending ID Verification</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a>
            <i class='fas fa-building'></i>
            <span class="link_name">Appointment</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../admin2/appointment/pending.php">Appointment</a></li>
          <li><a href="appointment/pending.php">Pending Appointment</a></li>
          <li><a href="appointment/approved.php">Approved Appointment</a></li>
        </ul>
      </li>
      <hr class="line">
      <li class="logout-link">
        <a href="../admin2/login/logout.php">
          <i class='bx bx-log-out'></i>
          <span class="link_name">Logout</span>
        </a>
        <ul class="sub-menu">
          <li><a class="link_name" href="../admin2/login/logout.php">Logout</a></li>
        </ul>
      </li>
  </div> -->
  <?php require_once $path."includes/side-bar.php" ?>

  <section class="home-section">
    <i class='bx bx-menu'></i>
    <span class="text">DASHBOARD</span>
    <div class="home-contents">
      <div class="name">
        <div class="overview-boxes">
          <?php { ?>
          <div class="box">
            <div class="right-side">
              <div class="number">5</div>
              <div class="box-topic">TOTAL APPOINTMENT</div>
              <div class="time">Today</div>
            </div>
          </div>

          <div class="box">
            <div class="right-side">
              <div class="number">25</div>
              <div class="box-topic">TOTAL USER</div>
              <div class="time">Yesterday</div>
            </div>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="number">8</div>
              <div class="box-topic">TOTAL MONITORING</div>
              <div class="time">Last Seven Days</div>
            </div>
          </div> <?php
                 }?>

        </div>

        <div id="container"></div>


        <div class="overview-boxes">
          <?php {?>
          <div class="chart">
          </div>
          <div class="chart">
          </div>
          <?php
             }?>
        </div>
      </div>

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