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
  <link rel="stylesheet" href="../specialist/specialist.css">
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
    <span class="text">MANAGE INSTRUCTOR</span>
    <div class="home-contents">
      <div class="table-containers">
        <table class="table">
          <div class="table-heading">

            <?php
                    {
                    ?>
            <span class="search">
              <input type="text" placeholder=" Search instructor">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <span class="add-instructor">
              <i class="fas fa-user-plus"></i>
              <a href="addinstructor.php" class="button">Add Instructor</a>
            </span>
            <?php
                    } ?>

          </div>
          <div class="divider-no-border"></div>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>IMAGE</th>
                <th>TOTAL PATIENT</th>
                <th class="action">ACTION</th>
              </tr>
            </thead>
            <tbody>
              <?php
                            if(!isset($_SESSION['table2'])){
                                $_SESSION['table2'] = array(
                                    "0" => array(
                                        "image" => 'jpg',
                                        "total_patient" => '10',
                                    ),
                                    "1" => array(
                                      "image" => 'jpg',
                                      "total_patient" => '23',
                                    ),
                                    "2" => array(
                                      "image" => 'jpg',
                                      "total_patient" => '18',
                                    ),
                                    "3" => array(
                                      "image" => 'jpg',
                                      "total_patient" => '23'
                                    ),
                                    "4" => array(
                                      "image" => 'jpg',
                                      "total_patient" => '20'
                                    )
                                );
                            }

                            //We will now fetch all the records in the array using loop
                            //use as a counter, not required but suggested for the table
                            $i = 1;
                            //loop for each record found in the array
                            foreach ($_SESSION['table2'] as $key => $value){ //start of loop
                        ?>
              <tr>
                <!-- always use echo to output PHP values -->
                <td><?php echo_safe($i); ?></td>
                <td><?php echo_safe($value['image']); ?></td>
                <td><?php echo_safe($value['total_patient']); ?></td>
                <td class="action">
                  <a class="action-delete" href="#<?php echo($key);?>">DELETE</a>
                </td>
              </tr>
              <?php
                            $i++;
                        //end of loop
                        }
                        ?>
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