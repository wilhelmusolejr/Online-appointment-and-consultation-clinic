<?php
  $path = "../";
  require $path.'functions/functions.php';
  //resume session here to fetch session values
  session_start();

  if (!isset($_SESSION['logged-in'])){
    header('location: '.$path.'login/login.php');
  }  

  require_once $path."../classes/user.class.php";

  $user = new user;
  $allValidPatient = $user -> getAllValidPatient();

  if(isset($_GET['search_text'])) {
    $user -> search_string = $_GET['search_text'];
    $allValidPatient = $user -> searchPatient();
  }

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="patient.css">
  <link rel="stylesheet" href="<?php echo $path."global.css" ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

  <!-- chart -->
  <script type="module" src="<?php echo $path ?>../node_modules/chart.js/dist/chart.umd.js" defer></script>

  <script src="table.js" defer></script>
  <script src="patient.js" defer></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
</head>

<body>
  <?php require_once $path."includes/side-bar.php" ?>

  <section class="home-section">
    <i class='bx bx-menu'></i>
    <span class="text">MANAGE PATIENT</span>
    <div class="home-contents">
      <div class="table-containers">

        <table id="example" class="table display">
          <thead>
            <tr>
              <th>action</th>
              <th>ID</th>
              <th>IMAGE</th>
              <th>EMAIL ADDRESS</th>
              <th>USER TYPE</th>
              <th>Full name</th>
              <th>PHONE NO.</th>
              <th>Gender</th>
              <th>Identification</th>
              <th class="action hidden">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($allValidPatient as $patient) { 
              $img = $patient['profile_img'] == null ? "dummy_user.jpg" : $patient['profile_img'];
              $idStatus = $patient['id_status'] == null ? "UNVERIFIED" : $patient['id_status'];
              ?>
            <tr data-user-id="<?php echo $patient['user_id'] ?>" class="hiddens">
              <td class="table-show-info">
                <button class="button-primary"><i class="fa-solid fa-plus"></i></button>
              </td>
              <td class="table-id"><a class="button button-small button-primary"
                  href="<?php echo $path."../profile/profile.php?profile-id=".$patient['user_id'] ?>">View profile</a>
              </td>
              <td class="table-patient-img"><img src="<?php echo $path."../uploads/".$img ?>" alt=""></td>
              <td><?php echo $patient['email'] ?></td>
              <td><?php echo $patient['user_type'] ?></td>
              <td><?php echo $patient['first_name']." ".$patient['last_name'] ?></td>
              <td><?php echo $patient['contact'] ?></td>
              <td><?php echo $patient['gender'] = 1 ? "Male" : "Female" ?></td>
              <td><?php echo $idStatus ?></td>
              <td class="action hidden">
                <a class="button button-delete action-delete" href="#">Delete</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
  </section>

  <div class="modal-parent modal-report-client hidden black-overlay">
    <div class="modal-container">
      <div class="modal-header">
        <h1 class="text-center text-uppercase">Client Report</h1>
      </div>
      <div class="modal-body">
        <p>Full name: LOADING</p>
        <p>Age: LOADING</p>
        <p>Bmi: LOADING</p>
        <div class="divider">
          <!-- <div class="chart chart-one flex-center">
            <canvas id="sex"></canvas>
          </div> -->
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