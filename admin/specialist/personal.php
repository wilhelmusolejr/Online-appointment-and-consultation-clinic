<?php
  $path = "../";

  require $path.'functions/functions.php';
  require_once $path."../classes/user.class.php";

  session_start();

  if (!isset($_SESSION['logged-in'])){
    header('location: '.$path.'login/login.php');
  }

  $current_page = $_SERVER['PHP_SELF'];


  $user = new user;

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
  <link rel="stylesheet" href="<?php echo $path."global.css" ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <!-- chart -->
  <script type="module" src="<?php echo $path ?>../node_modules/chart.js/dist/chart.umd.js" defer></script>


  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

  <script src="table.js" defer></script>
  <script src="personal.js" defer></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
</head>

<body>
  <?php require_once $path."includes/side-bar.php" ?>

  <section class="home-section ">
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

          <a href="add-rnd.php" class="button button-primary add-instructor">
            <i class="fas fa-user-plus"></i>
            Add Instructor
          </a>
        </div>

        <table id="example" class="table display">
          <thead>
            <tr>
              <th>Action</th>
              <th>ID</th>
              <th>IMAGE</th>
              <th>EMAIL ADDRESS</th>
              <th>FULL NAME</th>
              <th>PHONE NO.</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($allValidRnd as $personel) { 
                $img = $personel['profile_img'] == null ? "dummy_user.jpg" : $personel['profile_img'];
              ?>
            <tr data-user-id="<?php echo $personel['user_id'] ?>">
              <td>
                <button class="button-primary"><i class="fa-solid fa-plus"></i></button>
              </td>
              <!-- ID -->
              <td class="table-id"><a class="button button-small button-primary" target="_blank"
                  href="<?php echo $path."../profile/profile.php?profile-id=".$personel['user_id'] ?>">View profile</a>
              </td>
              <!-- IMG -->
              <td class="table-patient-img"><img src="<?php echo $path."../uploads/".$img ?>" alt=""></td>
              <td><?php echo $personel['email'] ?></td>
              <td><?php echo $personel['first_name']." ".$personel['last_name'] ?></td>
              <td><?php echo $personel['contact'] ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <div class="modal-parent modal-report-rnd hidden black-overlay">
    <div class="modal-container">
      <div class="modal-header">
        <h1 class="text-center text-uppercase">RND Report</h1>
      </div>
      <div class="modal-body">
        <p>Full name: LOADING</p>
        <p>Age: LOADING</p>
        <p>Bmi: LOADING</p>
        <div class="divider hidden">
          <div class="chart chart-one flex-center">
            <canvas id="stat"></canvas>
          </div>
          <div class="chart chart-one flex-center">
            <canvas id="status"></canvas>
          </div>
        </div>
        <table style="width: 100%">
          <thead>
            <tr>
              <td>Appointment #</td>
              <td>Nutritioanl concern</td>
              <td>Status</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#1</td>
              <td>Test</td>
              <td>PENDING</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

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