<?php

$path = "../";

require_once '../functions/functions.php';
require_once $path.'../classes/appoint.class.php';

    //resume session here to fetch session values
    session_start();

    if (!isset($_SESSION['logged-in'])){
        header('location: '.$path.'login/login.php');
    }

    // $appoint = new appoint;
    // $pendingAppointment = $appoint -> getPendingAppoint();

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="../appointment/appointment.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" defer></script>
  <title>Admin</title>
  <script src="pending.js" defer></script>
</head>

<body>
  <?php require_once $path."includes/side-bar.php" ?>


  <section class="home-section">
    <i class='bx bx-menu'></i>
    <span class="text">MANAGE APPOINTMENT</span>
    <div class="home-contents">
      <div class="table-containers">
        <table class="table">
          <div class="table-heading">

            <span class="search">
              <input type="text" placeholder=" Search appointment">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>

          </div>
          <div class="divider-no-border"></div>
          <table class="table">
            <thead>
              <tr>
                <th>APPOINTMENT NUMBER</th>
                <th>NUTRIONAL CONCERN</th>
                <th>APPOINTMENT DATE</th>
                <th>REFERRAL FORM</th>
                <th>MEDICAL FORM</th>
                <!-- <th>ID STATUS</th> -->
                <th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- insert here -->
            </tbody>
          </table>
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