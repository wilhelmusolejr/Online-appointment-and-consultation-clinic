<?php
  $path = "../";
  require $path.'functions/functions.php';
  
  session_start();

  if (!isset($_SESSION['logged-in'])){
    header('location: ../login/login.php');
  }
  
  require_once $path."../classes/appoint.class.php";
  
  $appoint = new appoint;
  $approvedAppoint = $appoint -> getApprovedAppointment();

  // print_r($approvedAppoint);

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="../appointment/appointment.css">
  <link rel="stylesheet" href="<?php echo $path."global.css" ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

  <script src="table.js" defer></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment</title>
</head>

<body>
  <?php require_once $path."includes/side-bar.php" ?>

  <section class="home-section">
    <i class='bx bx-menu'></i>
    <span class="text">MANAGE INSTRUCTOR</span>
    <div class="home-contents">
      <table id="example" class="table display">
        <thead>
          <tr>
            <th>APPOINTMENT NUMBER</th>
            <th>CHIEF COMPLAINT</th>
            <th>APPOINTMENT DATE</th>
            <th>PATIENT NAME</th>
            <th>RND NAME</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($approvedAppoint as $item) { 
            $appoint -> transact_id = $item['transact_id'];
            $result = $appoint -> getRndFromTransactId();

            if(!isset($result['first_name'])) {
              $result['first_name'] = "UNAVAILABLE";
              $result['last_name'] = "";
            }

              ?>
          <tr class="hiddens">
            <td class="table-id">
              <p>#<?php echo $item['transact_id'] ?></p>
            </td>
            <td><?php echo $item['chief_complaint'] ?></td>
            <td><?php echo $item['appoint_date_submitted'] ?></td>
            <td><?php echo $item['first_name']." ".$item['last_name'] ?></td>
            <td><?php echo $result['first_name']." ".$result['last_name'] ?></td>
            <td><?php echo $item['board_page'] == 5 ? "Completed" : "Ongoing" ?></td>
          </tr>
          <?php } ?>


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