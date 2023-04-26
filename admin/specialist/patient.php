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
  <link rel="stylesheet" href="<?php echo $path."specialist/specialist.css" ?>">
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
    <span class="text">MANAGE RND</span>
    <div class="home-contents">
      <div class="table-containers">

        <div class="divider-no-border table-tool-parent">

          <form action="<?php echo $current_page ?>" method="get" class="search-parent">
            <input type="text" name="search_text" placeholder="Search patient"
              value="<?php echo isset($_GET['search_text']) ? $_GET['search_text'] : null ?>">
            <button type="submit" class="button button-primary">SEARCH</button>
          </form>

          <a class="button button-primary add-instructor hidden">
            <i class="fas fa-user-plus"></i>
            Add Instructor
          </a>
        </div>



        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>IMAGE</th>
              <th>Full NAME</th>
              <th>TOTAL PATIENT</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($allValidRnd as $personel) { 
                $img = $personel['profile_img'] == null ? "dummy_user.jpg" : $personel['profile_img'];
                
                $appoint -> rnd_id = $personel['user_id'];
                $patient_handled = $appoint -> getTotalNumHandledPatient()[0];
              ?>
            <tr>
              <!-- ID -->
              <td class="table-id"><a target="_blank"
                  href="<?php echo $path."../profile/profile.php?profile-id=".$personel['user_id'] ?>">#<?php echo $personel['user_id'] ?></a>
              </td>
              <!-- IMG -->
              <td class="table-patient-img"><img src="<?php echo $path."../uploads/".$img ?>" alt=""></td>
              <!-- full name -->
              <td><?php echo $personel['first_name']." ".$personel['last_name'] ?></td>
              <!-- total patient handled -->
              <td><?php echo $patient_handled ?></td>
            </tr>
            <?php } ?>
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