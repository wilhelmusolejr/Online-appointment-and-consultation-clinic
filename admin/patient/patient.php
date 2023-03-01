<?php
$path = "../";
require $path.'functions/functions.php';
    //resume session here to fetch session values
    session_start();

    if (!isset($_SESSION['logged-in'])){
        header('location: '.$path.'login/login.php');
    }
    //if the above code is false then html below will be displayed

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="../patient/patient.css">
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

            <?php
                    {
                    ?>
            <span class="search">
              <input type="text" placeholder=" Search patient">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <?php
                    } ?>

          </div>
          <div class="divider-no-border"></div>
          <table class="table">
            <thead>
              <tr>
                <th>IMAGE</th>
                <th>EMAIL ADDRESS</th>
                <th>PASSWORD</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>PHONE NO.</th>
                <th>MODE</th>
                <th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                            
                            if(!isset($_SESSION['table5'])){
                                $_SESSION['table5'] = array(
                                   array(
                                        "image" => 'jpg',
                                        "email_address" => 'arturo4sola@wmsu.edu.ph',
                                        "password" => '1234533',
                                        "first_name" => 'Arturo',
                                        "last_name" => 'Sola',
                                        "phone_no." => '09474747474',
                                        "mode" => 'AVAILABLE'
                                    ),
                                    array(
                                      "image" => 'jpg',
                                      "email_address" => 'harm.ponte@wmsu.edu.ph',
                                      "password" => '32212315',
                                      "first_name" => 'Harim',
                                      "last_name" => 'Ponte',
                                      "phone_no." => '09125384766',
                                      "mode" => 'BUSY'
                                    ),
                                    array(
                                      "image" => 'jpg',
                                      "email_address" => 'jennyharge@wmsu.edu.ph',
                                      "password" => '3213212',
                                      "first_name" => 'Jenny',
                                      "last_name" => 'Harge',
                                      "phone_no." => '09836427896',
                                      "mode" => 'AVAILABLE'
                                    ),
                                    array(
                                      "image" => 'jpg',
                                      "email_address" => 'pantos2delas@wmsu.edu.ph',
                                      "password" => '12345',
                                      "first_name" => 'Pantos',
                                      "last_name" => 'Delas',
                                      "phone_no." => '09875826341',
                                      "mode" => 'AVAILABLE'
                                    ),
                                    array(
                                      "image" => 'jpg',
                                      "email_address" => 'Kendrade Sonya@wmsu.edu.ph',
                                      "password" => '123456',
                                      "first_name" => 'Kendrade',
                                      "last_name" => 'Sonya',
                                      "phone_no." => '095637281524',
                                      "mode" => 'OFFLINE'
                                    )
                                );
                            }

                            //We will now fetch all the records in the array using loop
                            //use as a counter, not required but suggested for the table
                            $i = 1;
                            //loop for each record found in the array
                            foreach ($_SESSION['table5'] as $key => $value){ //start of loop
                        ?>
              <tr>
                <!-- always use echo to output PHP values -->
                <td><?php echo_safe($value['image']); ?></td>
                <td><?php echo_safe($value['email_address']); ?></td>
                <td><?php echo_safe($value['password']); ?></td>
                <td><?php echo_safe($value['first_name']); ?></td>
                <td><?php echo_safe($value['last_name']); ?></td>
                <td><?php echo_safe($value['phone_no.']); ?></td>
                <td><?php echo_safe($value['mode']); ?></td>
                <td class="action">
                  <a class="action-delete" href="#<?php echo($key);?>">Delete</a>
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