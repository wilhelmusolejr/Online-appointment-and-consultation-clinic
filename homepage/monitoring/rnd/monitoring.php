<?php
  $path = "../../../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path."classes/monitor.class.php";
  require_once $path.'tools/variables.php';
  $page_title = "Monitoring";
  $monitoring = "nav-current";

  $currentDate = "2023-04-11";

  $monitor = new monitor;

  // print_r($_SESSION);

  if(isset($_GET['monitor_id']) && isset($_GET['week_num'])) {
    $monitor_id = $_GET['monitor_id'];
    $week_num = $_GET['week_num'];
    $_SESSION['monitor_id'] = $monitor_id;
    $_SESSION['week_num'] = $monitor_id;

    // setting variabales
    $monitor -> monitor_id = $monitor_id;
    $monitor -> week_num = $week_num;

    // get list of days
    $listOfDays = $monitor -> getDayDayData();

    // get client info
    $clientInfo = $monitor -> getMonitoringClient();

    // get goals
    $listGoals = $monitor -> getGoals();

    // get monitor info 
    $monitor -> monitor_id = $monitor_id;
    $monitorData = $monitor -> getMonitoringViaMonitorId();

    // week
    $weekData = $monitor -> getMonitorWeek();

    // get overall data
    $monitoringData = $monitor -> getOverallDataMonitoring();

    print_r($clientInfo);
  }



  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="<?php echo $path."homepage/index.css"?>" />
<link rel="stylesheet" href="../monitoring.css" />
<link rel="stylesheet" href="monitoring.css" />

<script type="module" src="<?php echo $path ?>node_modules/chart.js/dist/chart.umd.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js" defer></script>

<script type="module" src="monitoring.js" defer></script>
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer>
</script>

<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

  </header>

  <div class="side-bar-parent monitoring-parent ">

    <!-- MAIN CONTENT  -->
    <div class="main-content board-container card">
      <div class="main-content-container card">

        <!-- Progress -->
        <div class="board-progress">
          <div class="main flex-center">
            <ul class="text-center">
              <!-- 1 -->
              <li data-board-page="1" class="current">
                <i class="icon uil uil-capture"></i>
                <div class="progress one">
                  <p>1</p>
                  <i class="uil uil-check"></i>
                </div>
                <p class="text">Assessment</p>
              </li>
              <!-- - -->
              <li data-board-page="2" class="small-checkpoint">
                <i class="icon uil uil-clipboard-notes"></i>
                <div class="progress two">
                  <!-- <p>2</p> -->
                  <i class="uil uil-check"></i>
                </div>
              </li>
              <!-- 2 -->
              <li data-board-page="3">
                <i class="icon uil uil-credit-card"></i>
                <div class="progress three">
                  <p>2</p>
                  <i class="uil uil-check"></i>
                </div>
                <p class="text">Intervention</p>
              </li>
              <!-- - -->
              <li data-board-page="4" class="small-checkpoint">
                <i class="icon uil uil-exchange"></i>
                <div class="progress four">
                  <!-- <p>4</p> -->
                  <i class="uil uil-check"></i>
                </div>
              </li>
              <!-- 3 -->
              <li data-board-page="5">
                <i class="icon uil uil-map-marker"></i>
                <div class="progress five">
                  <p>3</p>
                  <i class="uil uil-check"></i>
                </div>
                <p class="text">Outcome</p>
              </li>
            </ul>
          </div>
        </div>

        <!-- page header -->
        <div class="header">
          <h2 class="text-center text-uppercase">Monitoring</h2>
        </div>

        <!-- stage one -->
        <div class="stage-one-parent hidden">

          <!-- form -->
          <div class="form">

            <div class="divider">

              <!-- LEFT -->
              <div class="form-input-parent">

                <!-- Appointment Numbuh -->
                <div class="form-input-box input-one">
                  <label for="firstname">Appointment number</label>
                  <input type="text" name="transact_id" value="#LOADING" disabled>
                </div>

                <label class="form_label">Time duration</label>

                <!-- Appointment Numbuh -->
                <div class="form-input-box input-one">
                  <label for="firstname">Start <span>*</span></label>
                  <input type="date" name="transact_id">
                </div>

                <!-- Appointment Numbuh -->
                <div class="form-input-box input-one">
                  <label for="firstname">End <span>*</span></label>
                  <input type="date" name="transact_id">
                </div>

                <div class="form-input-box input-one">
                  <label for="firstname">Desirable body weight <span>*</span></label>
                  <input type="number" name="transact_id">

                </div>
              </div>

              <!-- middle -->
              <div class="form-input-parent divider-grow">

                <!-- Appointment Numbuh -->
                <div class="form-input-box input-one">
                  <label for="firstname">Chief complain</label>
                  <input type="text" name="transact_id" value="LOADING" disabled>
                </div>

                <label class="form_label input-one">Goals</label>

                <div class="form-input-box input-one goals-container outer-container">

                  <!-- item -->
                  <div class="container">
                    <input type="hidden" name="food-take-type[]" value="<?php echo $food ?>">

                    <!-- Specify goals -->
                    <div class="form-input-box input-two ">
                      <label for="food-bf-consume">Specify goals <span>*</span></label>
                      <input type='text' name="food-bf-consume[]" value="food consume test 1">
                      <p class="form-error-message hidden">Error</p>
                    </div>

                    <!-- Quantity -->
                    <div class="form-input-box input-two ">
                      <label for="food-quantity">Quantity <span>*</span></label>
                      <select id="food-quantity" name="food-quantity[]">
                        <option value="volvo">Piece</option>
                        <option value="saab">Once</option>
                        <option value="fiat">Kg</option>
                        <option value="audi">Cup</option>
                      </select>
                      <p class="form-error-message hidden">Error</p>
                    </div>

                    <!-- trash -->
                    <div class="form-input-box form-button">
                      <label for="food-quantity">Action</label>
                      <i class="fa-solid fa-plus"></i>
                    </div>

                  </div>

                  <div class="container hidden">
                    <input type="hidden" name="food-take-type[]" value="<?php echo $food ?>">

                    <!-- Specify goals -->
                    <div class="form-input-box input-two ">
                      <label for="food-bf-consume">Specify goals <span>*</span></label>
                      <input type='text' name="food-bf-consume[]" value="food consume test 1">
                      <p class="form-error-message hidden">Error</p>
                    </div>

                    <!-- Quantity -->
                    <div class="form-input-box input-two ">
                      <label for="food-quantity">Quantity <span>*</span></label>
                      <select id="food-quantity" name="food-quantity[]">
                        <option value="volvo">Piece</option>
                        <option value="saab">Once</option>
                        <option value="fiat">Kg</option>
                        <option value="audi">Cup</option>
                      </select>
                      <p class="form-error-message hidden">Error</p>
                    </div>

                    <!-- trash -->
                    <div class="form-input-box form-button">
                      <i class="fa-solid fa-trash"></i>
                    </div>

                  </div>

                </div>

              </div>

              <!-- RIGHT -->
              <div class="form-input-parent flex-center">
                <!-- img -->
                <div class="list-rnd-box ka-talk-box grid-box card">
                  <div class="list-rnd-image flex-center">
                    <img src="<?php echo $path ?>uploads/dummy_user.jpg" alt="">
                  </div>
                  <div class="list-rnd-info text-center">
                    <p class="assigned-rnd">DUMMY</p>
                    <a target="_blank" href="#" class="text-uppercase text-center profile-link">view profile</a>
                  </div>
                </div>
              </div>

            </div>

          </div>

          <!-- button -->
          <div class="form-button">

            <!-- prev -->
            <div class="button-prev ">
              <button class="button hidden">prev</button>
            </div>
            <!-- middle -->
            <div>
              <a href="<?php echo $path ?>homepage/consultation/rnd/consultation.php?transact_id=215"
                class="button button-tertiary">Consultation result</a>
            </div>
            <!-- next -->
            <div class="button-next">
              <button class="button  button-next button-primary" disabled>Submit
              </button>
            </div>

          </div>

        </div>

        <!-- stage two -->
        <div class="stage-two-parent">

          <!-- form -->
          <div class="form">

            <div class="divider">

              <!-- left -->
              <div class="form-input-parent divider-grow">

                <div class="divider">

                  <div class="form-input-parent">
                    <!-- Appointment Numbuh -->
                    <div class="form-input-box">
                      <label for="firstname">Chief complaint</label>
                      <input type="text" name="transact_id" value="<?php echo $monitoringData['chief_complaint'] ?>"
                        disabled>
                    </div>

                    <!-- Appointment Numbuh -->
                    <div class="form-input-box">
                      <form class="form" action="monitoring.php" method="get">

                        <input type="hidden" name="monitor_id" value="<?php echo $monitor_id ?>">


                        <label for="firstname" class="hiddens">l</label>
                        <select name="week_num" id="week_num">
                          <?php foreach($weekData as $week) { ?>
                          <option value="<?php echo $week['week_num'] ?>"
                            <?php echo $week_num == $week['week_num'] ? "selected" : "" ?>>
                            <?php echo "Week ".$week['week_num'] ?>
                          </option>
                          <?php } ?>
                          <!-- <option value="mercedes">Mercedes</option> -->
                        </select>
                        <!-- button -->
                        <div class="form-button">
                          <!-- middle -->
                          <div>
                            <button type="submit" class="button">Submit
                              goals</button>
                          </div>

                        </div>
                      </form>

                    </div>

                  </div>

                </div>

                <div class="week-list-day-parent">

                  <?php forEach($listOfDays as $day) { 
                    $isBeyondDate = $currentDate < $day['date'];
                  ?>

                  <!-- day 1 -->
                  <a data-day="<?php echo $day['day_num'] ?>"
                    class="week-list-day-item text-uppercase card flex-center <?php echo  $isBeyondDate ? "lock" : "current-date" ?> cursor-pointer">
                    <?php if($isBeyondDate) { ?>
                    <i class="fa-solid fa-lock"></i>
                    <?php } else { ?>
                    <p>Day</p>
                    <p><?php echo $day['day_num'] ?></p>
                    <?php } ?>
                  </a>

                  <?php } ?>


                  <!-- day 1 -->
                  <a href="monitoring.php?monitor_id=1&week=1&day=1"
                    class="week-list-day-item text-uppercase hidden card flex-center current-date">
                    <p>Day</p>
                    <p>1</p>
                  </a>

                  <!-- day 2 -->
                  <a href="monitoring.php?monitor_id=1&week=1&day=2"
                    class="week-list-day-item text-uppercase hidden card flex-center ">
                    <i class="fa-solid fa-lock"></i>
                  </a>

                  <!-- day 3 -->
                  <div class="week-list-day-item text-uppercase hidden card flex-center ">
                    <p>Day</p>
                    <p>3</p>
                  </div>

                </div>

              </div>

              <!-- RIGHT -->
              <div class="form-input-parent ka-talk-parent flex-center">
                <!-- img -->
                <div class="list-rnd-box ka-talk-box grid-box card">
                  <div class="list-rnd-image flex-center">
                    <img src="<?php echo $path."uploads/".$clientInfo['profile_img'] ?>" alt="">
                  </div>
                  <div class="list-rnd-info text-center">
                    <p class="assigned-rnd"><?php echo $clientInfo['first_name']." ".$clientInfo['last_name'] ?></p>
                    <a target="_blank"
                      href="<?php echo $path."/profile/profile.php?profile-id=".$clientInfo['user_id'] ?>"
                      class="text-uppercase text-center profile-link">view profile</a>
                  </div>
                </div>
              </div>

            </div>

          </div>

          <!-- button -->
          <div class="form-button">

            <!-- prev -->
            <div class="button-prev ">
              <button
                class="button <?php echo $monitorData['board_page'] == 1? "button-extend":"button-disabled"?>">Extend
                monitoring</button>
            </div>
            <!-- middle -->
            <div>
              <button href="#"
                class="button button-tertiary <?php echo $monitorData['board_page'] == 1? "button-update-goals":"button-disabled"?>">Update
                goals</button>
            </div>
            <!-- next -->
            <div class="button-next">
              <button
                class="button button-next button-primary <?php echo $monitorData['board_page'] == 1? "button-end-monitoring":"button-disabled"?> ">End
                monitoring
              </button>
            </div>

          </div>

          <!-- modal for day information -->
          <div class="modal-parent modal-notif-parent modal-client-info overlay-black flex-center hidden">
            <div class="modal-container modal-notif-container sizing-secondary">


              <?php for($x = 1; $x <= 7; $x++) { 
                $monitor -> day_num = $x;

                $dayDataWeight = $monitor -> getDayWeight();
                $dayDataPhysical = $monitor -> getDayPhysicalAction();
                $dayDataSupplement = $monitor -> getDaySupplement();
                $dayDataFoodIntake = $monitor -> getDayFoodIntake();

                // print_r(sizeOf($dayDataFoodIntake));
              ?>
              <!-- day 1 -->
              <div data-day="<?php echo $x ?>" class="data-item hidden">
                <div class="modal-header text-center">
                  <h2 class="text-uppercase">Week <?php echo $week_num ?> > day <?php echo $x ?></h2>
                </div>

                <div class="modal-data">

                  <!-- Weight goal -->
                  <div class="data-container data-personal">
                    <h3 class="text-uppercase">Weight goal</h3>
                    <div class="data-box">
                      <p><span class="text-capital">Desirable body weight:</span> <span
                          class="client-fullName">LOADING</span></p>
                      <p><span class="text-capital">Current Body weight:</span> <span
                          class="client-birthdate"><?php echo $dayDataWeight['current_body_weight'] ?></span>
                      </p>
                    </div>
                  </div>

                  <!-- Food intake -->
                  <div class="data-container data-food-intake ">
                    <h3 class="text-uppercase">Food intake</h3>
                    <div class="data-box">

                      <?php $timeType = ["breakfast", "snacks", "lunch", "dinner"] ?>
                      <?php foreach($timeType as $type) { ?>
                      <!-- Lunch  -->
                      <div class="data-box-item">
                        <h4 class="text-capital"><?php echo $type ?></h4>
                        <div class="data-box-data">

                          <table>
                            <tr>
                              <th>
                                <p>Meal</p>
                              </th>
                              <th>
                                <p>Time</p>
                              </th>
                              <th>
                                <p>Food consumed</p>
                              </th>
                              <th>
                                <p>Food quantity</p>
                              </th>
                              <th>
                                <p>Method of preparation</p>
                              </th>
                            </tr>
                            <?php $i = 1; foreach($dayDataFoodIntake as $food) { ?>
                            <?php if($food['time_type'] == $type) { ?>
                            <tr>
                              <td>
                                <p>#<?php echo $i ?> Meal</p>
                              </td>
                              <td>
                                <p><?php echo $food['time'] ?></p>
                              </td>
                              <td>
                                <p><?php echo $food['food_consumed'] ?></p>
                              </td>
                              <td>
                                <p><?php echo $food['quantity'] ?></p>
                              </td>
                              <td>
                                <p><?php echo $food['method'] ?></p>
                              </td>
                            </tr>
                            <?php $i++ ;}  ?>
                            <?php } ?>

                          </table>

                        </div>
                      </div>

                      <?php } ?>

                    </div>
                  </div>

                  <!-- Physical Activity -->
                  <div class="data-container data-personal">
                    <h3 class="text-uppercase">Physical Activity</h3>
                    <div class="data-box">
                      <p><span class="text-capital">Activity level:</span> <span
                          class="client-fullName"><?php echo $dayDataPhysical['physical_level'] ?></span>
                      </p>
                    </div>
                  </div>

                  <!-- Supplement intake -->
                  <div class="data-container data-personal">
                    <h3 class="text-uppercase">Supplement intake</h3>
                    <div class="data-box">
                      <p><span class="text-capital">Supplement name:</span> <span
                          class="client-fullName"><?php echo $dayDataSupplement['supplement_name'] ?></span>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
              <?php } ?>

              <div class="modal-buttons">
                <a class="button button-cancel">Go back</a>
              </div>
            </div>
          </div>

          <!-- modal for updating goals -->
          <div class="modal-parent modal-notif-parent modal-update-goal overlay-black flex-center hidden">
            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">Update goals</h2>
              </div>

              <form class="form form">

                <div class="form-input-box form-radio-box">
                  <div class="gender-con radio-default">

                    <?php foreach($listGoals as $goal) { ?>
                    <div>
                      <input type="checkbox" id="body-type-endomorph<?php echo $goal['monitor_client_goal_id'] ?>"
                        name="body-type[]" value="<?php echo $goal['goal_name'] ?>"
                        <?php echo $goal['goal_status'] == 1? "checked disabled" : "" ?>>
                      <label
                        for="body-type-endomorph<?php echo $goal['monitor_client_goal_id'] ?>"><?php echo $goal['goal_name'] ?></label>
                    </div>
                    <?php } ?>

                    <!-- Endomorph -->
                    <div class="hidden">
                      <input type="checkbox" id="body-type-endomorph" name="body-type[]" value="endomorph">
                      <label for="body-type-endomorph">Endomorph</label>
                    </div>
                    <!-- Ectomorph -->
                    <div class="hidden">
                      <input type="checkbox" id="body-type-ectomorph" name="body-type[]" value="ectomorph">
                      <label for="body-type-ectomorph">Ectomorph</label>
                    </div>
                    <!-- Mesomorph -->
                    <div class="hidden">
                      <input type="checkbox" id="body-type-mesomorph" name="body-type[]" value="mesomorph">
                      <label for="body-type-mesomorph">Mesomorph</label>
                    </div>
                  </div>
                </div>

              </form>

              <div class="modal-buttons">
                <a class="button button-cancel">Cancel</a>
                <a class="button button-primary button-update-submit">Update</a>
              </div>
            </div>
          </div>

          <!-- modal for extending weeks -->
          <div class="modal-parent modal-notif-parent modal-extend-monitor overlay-black flex-center hidden">
            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">Extend monitoring</h2>
              </div>

              <form class="form">

                <div class="form-input-box input-two">
                  <label for="reg-mob" class="text-capital">Number of weeks <span>*</span></label>
                  <input type="number" name="num_extend_week" required id="num_extend_week" value="1"
                    placeholder="Enter your mobile number">
                </div>

                <input type="hidden" name="monitor_id" value="<?php echo $monitor_id ?>">

              </form>

              <div class="modal-buttons">
                <a class="button button-cancel">Cancel</a>
                <a class="button button-primary button-extend-submit">Extend</a>
              </div>
            </div>
          </div>

          <!-- MODAl - CONFIRMATION -->
          <div class="modal-parent modal-notif-parent modal-end-monitor overlay-black flex-center hidden">

            <!-- hidden - fox ajax -->
            <input type="hidden" name="submit" value='true' id="submit">

            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">End monitoring?</h2>
              </div>
              <div class="modal-message">
                <?php if($monitorData['board_page'] == 1) { ?>
                <p class="text-center">message</p>
                <?php } else { ?>
                <p class="text-center">Monitoring ended</p>
                <?php } ?>
              </div>
              <form class="form">
                <div class="modal-buttons">
                  <a class="button button-cancel"><?php echo $monitorData['board_page'] == 1 ? "Cancel" : "Done" ?></a>
                  <?php if($monitorData['board_page'] == 1) { ?>
                  <a type="submit" name="submit" value="submit" class="button button-primary button-end-submit">End
                    monitoring</a>
                  <?php } ?>
                </div>
              </form>


              <div class="stopper hidden"></div>

            </div>

            <?php require_once $path."includes/spinner.php" ?>

          </div>

        </div>

        <!-- IF WEEK IS CLICKED -->
        <div class="week-outside-parent hidden">
          <div class="week-list-day-parent">
            <!-- day 1 -->
            <div class="week-list-day-item text-uppercase card flex-center current-date">
              <p>Day</p>
              <p>1</p>
            </div>

            <!-- day 2 -->
            <div class="week-list-day-item text-uppercase card flex-center ">
              <p>Day</p>
              <p>2</p>
            </div>

            <!-- day 3 -->
            <div class="week-list-day-item text-uppercase card flex-center ">
              <p>Day</p>
              <p>3</p>
            </div>

            <!-- day 4 -->
            <div class="week-list-day-item text-uppercase card flex-center ">
              <p>Day</p>
              <p>4</p>
            </div>

            <!-- day 5 -->
            <div class="week-list-day-item text-uppercase card flex-center ">
              <p>Day</p>
              <p>5</p>
            </div>

            <!-- day 6 -->
            <div class="week-list-day-item text-uppercase card flex-center ">
              <p>Day</p>
              <p>6</p>
            </div>

            <!-- day 7 -->
            <div class="week-list-day-item text-uppercase card flex-center ">
              <p>Day</p>
              <p>7</p>
            </div>

          </div>

          <div class="goal-container">
            <h3 class="text-uppercase text-center card">Goals</h3>
            <div class="goal-list-parent">

              <?php foreach($listGoals as $goal) { ?>
              <div class="goal-list-item">
                <input type="checkbox" <?php echo $goal['goal_status'] ?> disabled>
                <p><?php echo $goal['goal'] ?></p>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <!-- DAY  -->
        <!-- SUBMITTING FORM for MONITORING -->
        <!-- Form -->
        <form action="php/set-appoint.php" method="post" class="form form-appoint-submit hidden"
          enctype="multipart/form-data">
          <!-- Tab -->
          <div class="tabset">
            <!-- Tab 5 -->
            <input class='personal-tab hidden' type="radio" name="tabset" id="tab5" aria-controls="dunkles">
            <label class='personal-tab hidden' for="tab5">Weight goal</label>
            <!-- Tab 1 -->
            <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
            <label for="tab1">Weight goal</label>
            <!-- Tab 2 -->
            <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
            <label for="tab2">Food intake</label>
            <!-- Tab 3 -->
            <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
            <label for="tab3">Physical activity</label>
            <!-- Tab 4 -->
            <input type="radio" name="tabset" id="tab4" aria-controls="dunkles">
            <label for="tab4">Supplement intake</label>

            <div class="tab-panels">

              <!-- Personal Information -->
              <section id="personal-tab" class="personal-tab tab-panel hidden">
                <!-- - Form Header -->
                <div class="form-header text-uppercase hidden">
                  <h3>Personal Information</h3>
                </div>
                <!-- form parent -->
                <div class="divider">
                  <!-- left -->
                  <div class="form-input-parent">
                    <!-- first name -->
                    <div class="form-input-box input-two">
                      <label for="firstname" class="text-capital">First name <span>*</span></label>
                      <input type="text" name="firstname" id="firstname" value="test"
                        placeholder="Enter your first name" required>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- middle name -->
                    <div class="form-input-box input-two">
                      <label for="middlename" class="text-capital">Middle name </label>
                      <input type="text" name="middlename" id="middlename" value="test"
                        placeholder="Enter your middle name">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- last name -->
                    <div class="form-input-box input-two">
                      <label for="lastname" class="text-capital">Last name <span>*</span></label>
                      <input type="text" name="lastname" required id="lastname" value="test"
                        placeholder="Enter your last name">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- gender -->
                    <div class="gender-form form-input-box input-two">
                      <label for="gender" class="text-capital">Gender <span>*</span></label>
                      <div class="gender-con radio-box flex-center">
                        <div>
                          <input type="radio" id="male" name="gender" value="Male" checked>
                          <label for="male">Male</label>
                        </div>
                        <div>
                          <input type="radio" id="female" name="gender" value="Female">
                          <label for="female">Female</label>
                        </div>
                      </div>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- birth date -->
                    <div class="form-input-box input-two">
                      <label for="birthdate" class="text-capital">Birthdate <span>*</span></label>
                      <input type="date" required name="birthdate" id="birthdate" value="2002-01-01">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Relationship status -->
                    <div class="form-input-box input-two">
                      <label for="relationship-status">Relationship status <span>*</span></label>
                      <input list="list-relationship" required name="relationship-status" id="relationship-status"
                        placeholder="Diet meal plan" value="relationship status">
                      <datalist id="list-relationship">
                        <option value="Husbund">
                        <option value="Mother">
                      </datalist>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent">
                    <!-- Mobile -->
                    <div class="form-input-box input-two">
                      <label for="reg-mob" class="text-capital">Mobile number <span>*</span></label>
                      <input type="text" name="reg-mob" required id="reg-mob" value="09972976807"
                        placeholder="Enter your mobile number">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Email -->
                    <div class="form-input-box input-two">
                      <label for="reg-email" class="text-capital">Email address <span>*</span></label>
                      <input type="email" required name="reg-email" id="reg-email" value="test@gmail.com"
                        placeholder="Enter your middle name">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Consultation Information -->
              <section id="consultation-tab" class="tab-panel">
                <!-- - Form Header -->
                <div class="form-header text-uppercase hidden hidden">
                  <h3>Consultation Information</h3>
                </div>
                <!-- form parent -->
                <div class="divider">
                  <!-- left -->
                  <div class="form-input-parent">
                    <!-- Desirable body weight -->
                    <div class="form-input-box input-two">
                      <label for="appoint-chief-complaint">Desirable Body Weight <span>*</span></label>
                      <input type='number' name="appoint-chief-complaint" id="appoint-chief-complaint"
                        placeholder="Enter your desirable body weight" required>
                      <p class="form-error-message hidden">Error</p>
                    </div>

                    <!-- Current body weight -->
                    <div class="form-input-box input-two">
                      <label for="appoint-chief-complaint">Current Body Weight <span>*</span></label>
                      <input type='number' name="appoint-chief-complaint" id="appoint-chief-complaint"
                        placeholder="Enter your desirable body weight" required>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent hidden">
                    <!-- More Information -->
                    <div class="form-input-box input-one">
                      <label for="appointment-more-info" class="text-capital">More information</label>
                      <textarea name="appointment-more-info" class="" id="appointment-more-info"
                        placeholder="Give additional information about your chief complaint."></textarea>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Food Information -->
              <section id="food-tab" class="tab-panel">
                <!-- - Form Header -->
                <div class="form-header text-uppercase hidden">
                  <h3>Food Information</h3>
                </div>
                <!-- form parent -->
                <div class="divider">
                  <!-- left -->
                  <div class="form-input-parent">

                    <!-- breakfast -->
                    <div class="breakfast-parent">
                      <h3 class="food-header">Breakfast</h3>

                      <div class="container-parent">
                        <div class="outer-container">
                          <div class="container">
                            <!-- time -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Time <span>*</span></label>
                              <input type='time' name="food-bf-time" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- food consumed -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Food consumed <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Quantity -->
                            <div class="form-input-box input-two ">
                              <label for="food-quantity">Quantity <span>*</span></label>
                              <select id="food-quantity" name="food-quantity">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Amount -->
                            <div class="form-input-box input-two ">
                              <label for="food-amount">Amount <span>*</span></label>
                              <select id="food-amount" name="food-amount">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Method of preparation -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Method of preparation <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>
                          </div>
                        </div>
                        <div class="button-plus flex-center">
                          <i class="fa-solid fa-plus"></i>
                        </div>
                      </div>

                    </div>

                    <!-- Lunch -->
                    <div class="breakfast-parent">
                      <h3 class="food-header">Lunch</h3>

                      <div class="container-parent">
                        <div class="outer-container">
                          <div class="container">
                            <!-- time -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Time <span>*</span></label>
                              <input type='time' name="food-bf-time" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- food consumed -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Food consumed <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Quantity -->
                            <div class="form-input-box input-two ">
                              <label for="food-quantity">Quantity <span>*</span></label>
                              <select id="food-quantity" name="food-quantity">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Amount -->
                            <div class="form-input-box input-two ">
                              <label for="food-amount">Amount <span>*</span></label>
                              <select id="food-amount" name="food-amount">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Method of preparation -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Method of preparation <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>
                          </div>
                        </div>
                        <div class="button-plus flex-center">
                          <i class="fa-solid fa-plus"></i>
                        </div>
                      </div>

                    </div>

                    <!-- Dinner -->
                    <div class="breakfast-parent">
                      <h3 class="food-header">Dinner</h3>

                      <div class="container-parent">
                        <div class="outer-container">
                          <div class="container">
                            <!-- time -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Time <span>*</span></label>
                              <input type='time' name="food-bf-time" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- food consumed -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Food consumed <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Quantity -->
                            <div class="form-input-box input-two ">
                              <label for="food-quantity">Quantity <span>*</span></label>
                              <select id="food-quantity" name="food-quantity">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Amount -->
                            <div class="form-input-box input-two ">
                              <label for="food-amount">Amount <span>*</span></label>
                              <select id="food-amount" name="food-amount">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Method of preparation -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Method of preparation <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>
                          </div>
                        </div>
                        <div class="button-plus flex-center">
                          <i class="fa-solid fa-plus"></i>
                        </div>
                      </div>

                    </div>

                    <!-- Snacks -->
                    <div class="breakfast-parent">
                      <h3 class="food-header">Snacks</h3>

                      <div class="container-parent">
                        <div class="outer-container">
                          <div class="container">
                            <!-- time -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Time <span>*</span></label>
                              <input type='time' name="food-bf-time" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- food consumed -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Food consumed <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Quantity -->
                            <div class="form-input-box input-two ">
                              <label for="food-quantity">Quantity <span>*</span></label>
                              <select id="food-quantity" name="food-quantity">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Amount -->
                            <div class="form-input-box input-two ">
                              <label for="food-amount">Amount <span>*</span></label>
                              <select id="food-amount" name="food-amount">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                              </select>
                              <p class="form-error-message hidden">Error</p>
                            </div>

                            <!-- Method of preparation -->
                            <div class="form-input-box input-two ">
                              <label for="food-time">Method of preparation <span>*</span></label>
                              <input type='text' name="food-bf-consume" id="food-time">
                              <p class="form-error-message hidden">Error</p>
                            </div>
                          </div>
                        </div>
                        <div class="button-plus flex-center">
                          <i class="fa-solid fa-plus"></i>
                        </div>
                      </div>

                    </div>


                  </div>

                </div>


              </section>

              <!-- Physical Information -->
              <section id="physical-tab" class="tab-panel">
                <!-- - Form Header -->
                <div class="form-header text-uppercase hidden">
                  <h3>Physical Information</h3>
                </div>
                <!-- form parent -->
                <div class="divider">
                  <!-- left -->
                  <div class="left-form form-input-parent">
                    <!-- Body type -->
                    <div class="form-input-box form-radio-box">
                      <p>Activity level <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="radio" checked id="body-type-endomorph" name="body-type[]" value="sedentary">
                          <label for="body-type-endomorph">Sedentary</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="radio" id="body-type-ectomorph" name="body-type[]" value="light">
                          <label for="body-type-ectomorph">Light</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="radio" id="body-type-mesomorph" name="body-type[]" value="moderate">
                          <label for="body-type-mesomorph">Moderate</label>
                        </div>
                        <!-- very active -->
                        <div>
                          <input type="radio" id="body-type-vigorous" name="body-type[]" value="vigorous">
                          <label for="body-type-vigorous">Very active or Vigorous</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent hidden  ">
                    <!-- Body type -->
                    <div class="form-input-box form-radio-box">
                      <p>Body type <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="checkbox" checked id="body-type-endomorph" name="body-type[]" value="endomorph">
                          <label for="body-type-endomorph">Endomorph</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="checkbox" id="body-type-ectomorph" name="body-type[]" value="ectomorph">
                          <label for="body-type-ectomorph">Ectomorph</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="body-type-mesomorph" name="body-type[]" value="mesomorph">
                          <label for="body-type-mesomorph">Mesomorph</label>
                        </div>
                      </div>
                    </div>
                    <!-- Physical activity -->
                    <div class="form-input-box form-radio-box">
                      <p>Physical activity <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Sedentary -->
                        <div>
                          <input type="radio" id="physical-sedentary" name="physical-activity" value="sedentary"
                            checked>
                          <label for="physical-sedentary">Sedentary</label>
                        </div>
                        <!-- Light -->
                        <div>
                          <input type="radio" id="physical-light" name="physical-activity" value="light">
                          <label for="physical-light">light</label>
                        </div>
                        <!-- Moderate -->
                        <div>
                          <input type="radio" id="physical-moderate" name="physical-activity" value="moderate">
                          <label for="physical-moderate">Moderate</label>
                        </div>
                        <!-- Very active -->
                        <div>
                          <input type="radio" id="physical-very-active" name="physical-activity" value="very-active">
                          <label for="physical-very-active">Very active</label>
                        </div>
                      </div>
                    </div>
                    <!-- Gain weight -->
                    <div class="form-input-box form-radio-box">
                      <p>Do you gain weight <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Sedentary -->
                        <div>
                          <input type="radio" checked id="gain-easily" name="gain-weight-level" value="easily">
                          <label for="gain-easily">Easily</label>
                        </div>
                        <!-- Light -->
                        <div>
                          <input type="radio" id="gain-moderately" name="gain-weight-level" value="moderately">
                          <label for="gain-moderately">Moderately</label>
                        </div>
                        <!-- Moderate -->
                        <div>
                          <input type="radio" id="gain-slowly" name="gain-weight-level" value="slowly">
                          <label for="gain-slowly">Slowly</label>
                        </div>
                        <!-- Very active -->
                        <div>
                          <input type="radio" id="gain-very-slowly" name="gain-weight-level" value="very-slowly">
                          <label for="gain-very-slowly">Very slowly</label>
                        </div>
                      </div>
                    </div>
                    <!-- Lose weight -->
                    <div class="form-input-box form-radio-box ">
                      <p>Do you lose weight <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Sedentary -->
                        <div>
                          <input type="radio" checked id="lose-easily" name="lose-weight-level" value="easily">
                          <label for="lose-easily">Easily</label>
                        </div>
                        <!-- Light -->
                        <div>
                          <input type="radio" id="lose-moderately" name="lose-weight-level" value="moderately">
                          <label for="lose-moderately">Moderately</label>
                        </div>
                        <!-- Moderate -->
                        <div>
                          <input type="radio" id="lose-slowly" name="lose-weight-level" value="slowly">
                          <label for="lose-slowly">Slowly</label>
                        </div>
                        <!-- Very active -->
                        <div>
                          <input type="radio" id="lose-very-slowly" name="lose-weight-level" value="very-slowly">
                          <label for="lose-very-slowly">Very slowly</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Medical Information -->
              <section id="medical-tab" class="tab-panel">
                <!-- - Form Header -->
                <div class="form-header text-uppercase hidden">
                  <h3>Medical Information</h3>
                </div>
                <!-- form parent -->
                <div class="divider">
                  <!-- left -->
                  <div class="left-form form-input-parent">
                    <!-- Current Medication -->
                    <div class="form-input-box ">
                      <label for="appoint-actual-weight">Are you taking any nutrional supplements?
                        <span>*</span></label>
                      <input type="text" name="appoint-medical-current-med" id="appoint-medical-current-med"
                        placeholder="E.g Ascorbic Acid" required value="N/A">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                </div>
              </section>

            </div>
          </div>

          <div class="form-button">
            <!-- prev -->
            <div class="button-prev">
              <button class="button hidden" disabled>prev</button>
            </div>
            <!-- middle -->
            <div>
              <button class="button hidden" disabled>Submit</button>
            </div>
            <!-- next -->
            <div class="button-semi-submit">
              <a class="button button-semi button-primary">Submit
              </a>
            </div>
            <div class="button-next hidden">
              <a class="button button-primary">Next
              </a>
            </div>


          </div>

          <!-- MODAl - CONFIRMATION -->
          <div class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">

            <!-- hidden - fox ajax -->
            <input type="hidden" name="submit" value='true' id="submit">

            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">Confirm appointment</h2>
              </div>
              <div class="modal-message">
                <p class="text-center">message</p>
              </div>
              <div class="modal-buttons">
                <a class="button button-cancel">Go back</a>
                <button type="submit" name='submit' value="submit" class="button button-primary">Submit</button>
              </div>

              <div class="stopper hidden"></div>

            </div>

            <?php require_once $path."includes/spinner.php" ?>

          </div>
        </form>

        <!-- INTERVENSION -->
        <div class="intervension-parent hidden">
          <div class="divider card">
            <div class="left">
              <div class="chart-parent flex-center">
                <!-- one -->
                <div class="chart chart-one flex-center">
                  <canvas id="myChart"></canvas>
                </div>
                <!-- two -->
                <div class="chart chart-two flex-center ">
                  <canvas id="myCharts"></canvas>
                </div>
              </div>
            </div>
            <div class="right">
              <div class="greeting text-center">
                <h3>Hi, Sofia</h3>
                <p>You're on track this week.</p>
              </div>
              <div id="calendar" class="calendar">
                <div class="calendar-title">
                  <div class="calendar-title-text"></div>
                  <div class="calendar-button-group">
                    <button id="prevMonth">&lt;</button>
                    <button id="today">Today</button>
                    <button id="nextMonth">&gt;</button>
                  </div>
                </div>
                <div class="calendar-day-name"></div>
                <div class="calendar-dates"></div>
              </div>
            </div>
          </div>

          <div class="goal-container">
            <h3 class="text-uppercase text-center card">Goals</h3>
            <div class="goal-list-parent">
              <!-- goal 1 -->
              <div class="goal-list-item">
                <input type="checkbox">
                <p>Lost 1-2 lbs</p>
              </div>

              <!-- goal 1 -->
              <div class="goal-list-item">
                <input type="checkbox">
                <p>Lost 1-2 lbs</p>
              </div>

              <!-- goal 1 -->
              <div class="goal-list-item">
                <input type="checkbox">
                <p>Lost 1-2 lbs</p>
              </div>
            </div>
          </div>
        </div>

        <!-- END OF MONITORING -->
        <div class="monitoring-end-parent hidden">

          <div class="greeting ">
            <h3>Nice work Sofia!</h3>
            <p>Congratulations on achieving your goals.</p>
          </div>

          <div class="divider">
            <!-- left -->
            <div class="goal-container">
              <h3 class="text-uppercase text-center card">Goals</h3>
              <div class="goal-list-parent">
                <!-- goal 1 -->
                <div class="goal-list-item">
                  <input type="checkbox">
                  <p>Lost 1-2 lbs</p>
                </div>

                <!-- goal 1 -->
                <div class="goal-list-item">
                  <input type="checkbox">
                  <p>Lost 1-2 lbs</p>
                </div>

                <!-- goal 1 -->
                <div class="goal-list-item">
                  <input type="checkbox">
                  <p>Lost 1-2 lbs</p>
                </div>
              </div>
            </div>

            <!-- right -->
            <div class="form">
              <div class="form-input-parent flex-center">
                <!-- img -->
                <div class="list-rnd-box ka-talk-box grid-box card">
                  <div class="list-rnd-image flex-center">
                    <img src="../../uploads/dummy_user.jpg" alt="">
                  </div>
                  <div class="list-rnd-info text-center">
                    <p class="assigned-rnd">LOADING</p>
                    <a target="_blank" href="#" class="text-uppercase text-center profile-link">view profile</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="buttons">
            <a href="#" class="button button-tertiary">Request for follow up</a>
            <a href="#" class="button button-primary">Request for F2F consultation</a>
          </div>

        </div>

      </div>
    </div>

  </div>


  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>