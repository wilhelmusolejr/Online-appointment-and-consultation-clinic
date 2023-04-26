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
        <table class="table">
          <div class="table-heading">

            <form action="patient.php" method="get">
              <span class="search">
                <input type="text" name="search_text" placeholder="Search patient"
                  value="<?php echo isset($_GET['search_text']) ? $_GET['search_text'] : null ?>">
                <button type="submit" class="button button-primary">SEARCH</button>
              </span>
            </form>

          </div>
          <div class="divider-no-border"></div>
          <table class="table">
            <thead>
              <tr>
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
              <tr class="hiddens">
                <td class="table-id"><a
                    href="<?php echo $path."../profile/profile.php?profile-id=".$patient['user_id'] ?>">#<?php echo $patient['user_id'] ?></a>
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