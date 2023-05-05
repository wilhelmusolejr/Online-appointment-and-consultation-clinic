<?php

  $path = "../";

  require $path.'functions/functions.php';
  require_once $path."../classes/user.class.php";
  require_once $path."../classes/appoint.class.php";

  session_start();
    
  if (!isset($_SESSION['logged-in'])){
    header('location: '.$path.'login/login.php');
  }

  $current_page = $_SERVER['PHP_SELF'];

  $user = new user;
  $appoint = new appoint;

  // user
  $allValidRnd = $user -> getAllRnd();


  if(isset($_GET['search_text'])) {
    if ($_GET['search_text'] == "") {
      header("location: ".$current_page);
      exit();
    }
    $user -> search_string = $_GET['search_text'];
    $allValidRnd = $user -> searchRnd();
  }
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="<?php echo $path."specialist/Specialist.css" ?>">
  <link rel=" stylesheet" href="<?php echo $path."global.css" ?>">
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
  <title>Admin</title>
</head>

<body>
  <?php require_once $path."includes/side-bar.php" ?>

  <section class="home-section">
    <i class='bx bx-menu'></i>
    <span class="text">MANAGE INSTRUCTOR</span>
    <div class="home-contents">
      <div class="table-containers">

        <div class="divider-no-border table-tool-parent">

          <form action="<?php echo $current_page ?>" method="get" class="search-parent hidden">
            <input type="text" name="search_text" placeholder="Search patient"
              value="<?php echo isset($_GET['search_text']) ? $_GET['search_text'] : null ?>">
            <button type="submit" class="button button-primary">SEARCH</button>
          </form>

          <a class="button button-primary add-instructor hidden">
            <i class="fas fa-user-plus"></i>
            Add Instructor
          </a>
        </div>

        <table id="example" class="table display">
          <thead>
            <tr>
              <th>ID</th>
              <th>IMAGE</th>
              <th>FULL NAME</th>
              <th>TOTAL APPOINTMENT</th>
              <th>CURRENT NUM APPOINTMENT</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($allValidRnd as $personel) { 
                $img = $personel['profile_img'] == null ? "dummy_user.jpg" : $personel['profile_img'];
              
                $appoint -> rnd_id = $personel['user_id'];
                $totalAppointment = $appoint -> getTotalNumAppointment()[0];
                $totalActiveAppointment = $appoint -> getTotalNumActiveAppointment()[0];
              
              ?>
            <tr>
              <!-- always use echo to output PHP values -->
              <td class="table-id"><a class="button button-small button-primary"
                  href="<?php echo $path."../profile/profile.php?profile-id=".$personel['user_id'] ?>">View profile</a>
              </td>
              <td class="table-patient-img"><img src="<?php echo $path."../uploads/".$img ?>" alt=""></td>
              <td><?php echo $personel['first_name']." ".$personel['last_name'] ?></td>
              <td><?php echo $totalAppointment ?></td>
              <td><?php echo $totalActiveAppointment ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

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