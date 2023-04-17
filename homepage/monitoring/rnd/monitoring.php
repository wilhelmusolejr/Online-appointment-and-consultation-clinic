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

    // getting start and end date of monitoring
    $monitor -> week_num = end($weekData)['week_num'];
    $temporary = $monitor -> getDayDayData();

    $monitor -> week_num = $week_num;

    print_r(end($weekData)['monitor_week_id']);
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
        <div class="stage-one-parent <?php echo sizeof($listGoals) > 0? "hidden" : ""?>">

          <!-- form -->
          <form action="<?php echo $path."php/set/set-monitoring-goals.php" ?>" class="form form-monitoring-stage-one"
            method="post">

            <input type="hidden" name="monitor_id" value="<?php echo $monitor_id ?>">
            <input type="hidden" name="week_num" value="<?php echo $monitorData['current_week'] ?>">

            <div class="divider">

              <!-- LEFT -->
              <div class="form-input-parent">

                <!-- Monitoring number -->
                <div class="form-input-box input-one">
                  <label for="firstname">Monitoring number</label>
                  <input type="text" name="transact_id" value="#<?php echo $monitor_id ?>" disabled>
                </div>


                <div class="form-input-box input-one">
                  <label for="firstname">Appointment number</label>
                  <input type="text" name="transact_id" value="#<?php echo $monitoringData['transact_id'] ?>" disabled>
                </div>

                <!-- Chief complaint -->
                <div class="form-input-box input-one">
                  <label for="firstname">Chief complaint</label>
                  <input type="text" name="transact_id" value="<?php echo $monitoringData['chief_complaint'] ?>"
                    disabled>
                </div>

              </div>

              <!-- middle -->
              <div class="form-input-parent divider-grow">

                <!-- TIME -->
                <div class="form-input-box input-one time-container outer-container">

                  <!-- <label class="form_label input-one">Time duration</label> -->

                  <!-- item -->
                  <div class="container">

                    <!-- Time start -->
                    <div class="form-input-box input-one">
                      <label for="firstname">Start </label>
                      <input type="text" name="monitoring_date_start"
                        value="<?php echo date("D, d M Y", strtotime($listOfDays[0]['date']))  ?>" disabled>
                    </div>

                    <!-- Time End -->
                    <div class="form-input-box input-one">
                      <label for="firstname">End </label>
                      <input type="text" name="monitoring_date_end"
                        value="<?php echo date("D, d M Y", strtotime(end($temporary)['date'])) ?>" disabled>
                    </div>

                  </div>

                </div>

                <!-- DESIRABLE BODY WEIGHT -->
                <div class="form-input-box input-one">
                  <label for="firstname">Desirable body weight <span>*</span></label>
                  <input type="number" name="monitoring_desirable_body_weight" required value="10">
                </div>

                <!-- GOALS -->
                <div class="form-input-box input-one goals-container outer-container">

                  <!-- <label class="form_label input-one">Goals</label> -->

                  <!-- item -->
                  <div class="container">

                    <!-- Specify goals -->
                    <div class="form-input-box input-two ">
                      <label for="food-bf-consume">Specify goals <span>*</span></label>
                      <input type='text' name="specify_goal_name[]" value="food consume test 1">
                      <p class="form-error-message hidden">Error</p>
                    </div>

                    <!-- Quantity -->
                    <div class="form-input-box input-two ">
                      <label for="food-quantity">Type <span>*</span></label>
                      <select id="food-quantity" name="specify_goal_type[]">
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

                </div>

              </div>

              <!-- RIGHT -->
              <div class="form-input-parent flex-center">
                <!-- img -->
                <div class="list-rnd-box ka-talk-box grid-box card">
                  <div class="list-rnd-image flex-center ">
                    <img src="<?php echo $path."uploads/".$clientInfo['profile_img'] ?>" alt="">
                  </div>
                  <div class="list-rnd-info text-center">
                    <p class="assigned-rnd"><?php echo $clientInfo['first_name']." ".$clientInfo['last_name'] ?></p>
                    <a target="_blank"
                      href="<?php echo $path."profile/profile.php?profile-id=".$clientInfo['user_id'] ?>"
                      class="text-uppercase text-center profile-link">view profile</a>
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
                <a href="<?php echo $path."homepage/consultation/rnd/consultation.php?transact_id=".$clientInfo['transact_id'] ?>"
                  class="button button-tertiary">Consultation result</a>
              </div>
              <!-- next -->
              <div class="button-next">
                <a class="button  button-next button-primary button-mini-submit">Submit
                </a>
              </div>

            </div>

            <!-- MODAl - CONFIRMATION -->
            <div
              class="modal-parent modal-notif-parent modal-monitoring-one-confirmation overlay-black flex-center hidden">
              <div class="modal-container modal-notif-container sizing-secondary">
                <div class="modal-header text-center">
                  <h2 class="text-uppercase">Sure ka bhie?</h2>
                </div>
                <p class="text-center">Mark the transaction complete. <br><em>This action cannot be reverted</em></p>
                <div class="modal-buttons">
                  <a class="button button-cancel">Go back</a>
                  <div class="button-confirm-final button-confirm-finalFour">
                    <button type="submit" name='submit' value="submit" class="button button-primary">Submit</button>
                  </div>
                </div>

                <div class="stopper hidden"></div>
                <?php require $path."includes/spinner.php" ?>

              </div>
            </div>

          </form>

        </div>

        <!-- stage two -->
        <div class="stage-two-parent <?php echo sizeof($listGoals) > 0? "" : "hidden"?>">

          <!-- form -->
          <div class="form">

            <div class="divider">

              <!-- left -->
              <div class="form-input-parent divider-grow outer-left">

                <div class="divider">

                  <div class="form-input-parent monitoring-detail">

                    <!-- Monitoring number -->
                    <div class="form-input-box">
                      <label for="firstname">Monitoring number</label>
                      <input type="text" name="transact_id" value="#<?php echo $monitor_id ?>" disabled>
                    </div>


                    <div class="form-input-box">
                      <label for="firstname">Appointment number</label>
                      <input type="text" name="transact_id" value="#<?php echo $monitoringData['transact_id'] ?>"
                        disabled>
                    </div>

                    <!-- Chief complaint -->
                    <div class="form-input-box">
                      <label for="firstname">Chief complaint</label>
                      <input type="text" name="transact_id" value="<?php echo $monitoringData['chief_complaint'] ?>"
                        disabled>
                    </div>

                    <!-- Target week -->
                    <div class="form-input-box week-filter hidden">
                      <form class="form" action="monitoring.php" method="get">

                        <input type="hidden" name="monitor_id" value="<?php echo $monitor_id ?>">

                        <div class="">
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
                        </div>
                        <!-- button -->
                        <div class="form-button">
                          <!-- middle -->
                          <div>
                            <button type="submit" class="button button-primary">
                              Submit</button>
                          </div>

                        </div>
                      </form>

                    </div>

                  </div>

                </div>

                <div class="divider week-list-parent">
                  <div class="form-input-parent">

                    <!-- Target week -->
                    <div class="form-input-box week-filter hiddens">
                      <form class="form" action="monitoring.php" method="get">

                        <input type="hidden" name="monitor_id" value="<?php echo $monitor_id ?>">

                        <div class="">
                          <label for="firstname" class="hidden">l</label>
                          <select name="week_num" id="week_num">
                            <?php foreach($weekData as $week) { ?>
                            <option value="<?php echo $week['week_num'] ?>"
                              <?php echo $week_num == $week['week_num'] ? "selected" : "" ?>>
                              <?php echo "Week ".$week['week_num'] ?>
                            </option>
                            <?php } ?>
                            <!-- <option value="mercedes">Mercedes</option> -->
                          </select>
                        </div>
                        <!-- button -->
                        <div class="form-button">
                          <!-- middle -->
                          <div>
                            <button type="submit" class="button button-primary">
                              Submit</button>
                          </div>

                        </div>
                      </form>

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
                class="button button-fourth <?php echo $monitorData['board_page'] == 1? "button-extend":"button-disabled"?>">Extend
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

                <p style="margin-bottom: 10px;">Current number of weeks: <?php echo end($weekData)['week_num'] ?></p>

                <div class="form-input-box input-two">
                  <label for="reg-mob" class="text-capital">Number of weeks to extend <span>*</span></label>
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