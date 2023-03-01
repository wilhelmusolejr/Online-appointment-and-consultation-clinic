<?php
  $path = "../";
  require $path.'functions/functions.php';
    //resume session here to fetch session values
    session_start();
    /*
        if user is not login then redirect to login page,
        this is to prevent users from accessing pages that requires
        authentication such as the dashboard
    */
    if (!isset($_SESSION['logged-in'])){
        header('location: ../login/login.php');
    }
    //if the above code is false then html below will be displayed

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
  <title>Appointment</title>
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
              <input type="text" placeholder=" Search appointment">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <?php
                    } ?>

          </div>
          <div class="divider-no-border"></div>
          <table class="table">
            <thead>
              <tr>
                <th>APPOINTMENT NUMBER</th>
                <th>CHIEF COMPLAINT</th>
                <th>APPOINTMENT DATE</th>
                <th>PATIENT NAME</th>
                <th>DOCTOR NAME</th>
                <th>DAY</th>
              </tr>
            </thead>
            <tbody>
              <?php

                            if(!isset($_SESSION['table9'])){
                                $_SESSION['table9'] = array(
                                     array(
                                        "appointment_number" => '#046271',
                                        "chief_complaint" => 'Diet Food Meal Plan',
                                        "appointment_date" => '11/4/2022, 12:30pm',
                                        "patient_name" => 'Benjie Andyo',
                                        "doctor_name" => 'Rnd Gregory Yames',
                                        "day" => 'MONDAY'
                                    ),
                                     array(
                                      "appointment_number" => '#308967',
                                      "chief_complaint" => 'Diagestive Problem',
                                      "appointment_date" => '11/1/2022, 8:30pm',
                                      "patient_name" => 'Noemi Rando',
                                      "doctor_name" => 'Rnd Gregory Yames',
                                      "day" => 'MONDAY'
                                    ),
                                     array(
                                      "appointment_number" => '#235343',
                                      "chief_complaint" => 'Diabetes',
                                      "appointment_date" => '10/5/2022, 4:00pm',
                                      "patient_name" => 'Sofia Hando',
                                      "doctor_name" => 'Rnd Gregory Yames',
                                      "day" => 'MONDAY'
                                    ),
                                     array(
                                        "appointment_number" => '#089732',
                                        "chief_complaint" => 'Weight Loss',
                                        "appointment_date" => '9/16/2022, 1:00pm',
                                        "patient_name" => 'Jenny Kie',
                                        "doctor_name" => 'Rnd Gregory Yames',
                                        "day" => 'MONDAY'
                                     ),
                                     array(
                                      "appointment_number" => '#216633',
                                      "chief_complaint" => 'Diabetes',
                                      "appointment_date" => '9/5/2022, 10:00pm',
                                      "patient_name" => 'Estaof Poels',
                                      "doctor_name" => 'Rnd Gregory Yames',
                                      "day" => 'MONDAY'
                                    ),
                                     array(
                                      "appointment_number" => '#748361',
                                      "chief_complaint" => 'Food Lifestyle',
                                      "appointment_date" => '9/1/2022, 9:00pm',
                                      "patient_name" => 'Shanti Dope',
                                      "doctor_name" => 'Rnd Gregory Yames',
                                      "day" => 'MONDAY'
                                    )
                                );
                            }

                            //We will now fetch all the records in the array using loop
                            //use as a counter, not required but suggested for the table
                            $i = 1;
                            //loop for each record found in the array
                            foreach ($_SESSION['table9'] as $key => $value){ //start of loop
                        ?>
              <tr>
                <!-- always use echo to output PHP values -->
                <td><?php echo_safe($value['appointment_number']); ?></td>
                <td><?php echo_safe($value['chief_complaint']); ?></td>
                <td><?php echo_safe($value['appointment_date']); ?></td>
                <td><?php echo_safe($value['patient_name']); ?></td>
                <td><?php echo_safe($value['doctor_name']); ?></td>
                <td><?php echo_safe($value['day']); ?></td>
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