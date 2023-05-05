<?php
$path = "../";
require $path.'functions/functions.php';


    session_start();

    if (!isset($_SESSION['logged-in'])){
      header('location: '.$path.'login/login.php');
  }

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="../patient/patient.css">
  <link rel="stylesheet" href="<?php echo $path."global.css" ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" defer></script>
  <script src="pending-identification.js" defer></script>

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
    <span class="text">MANAGE PATIENT</span>
    <div class="home-contents">
      <div class="table-containers">
        <table class="table">
          <div class="table-heading">

            <?php
                    {
                    ?>
            <span class="search hidden">
              <input type="text" placeholder=" Search patient">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <?php
                    } ?>

          </div>
          <div class="divider-no-border"></div>
          <table id="example" class="table display">
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