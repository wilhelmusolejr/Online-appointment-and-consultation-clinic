<?php
  $path = "../../";
  date_default_timezone_set('Asia/Manila');

  session_start();

  require_once $path."classes/monitor.class.php";
  require_once $path."classes/appoint.class.php";

  require_once $path.'tools/variables.php';
  $page_title = "Monitoring";
  $monitoring = "nav-current";

  $currentDate = date("Y-m-d");

  $monitor = new monitor;
  $appoint = new appoint;

  if(isset($_GET['monitor_id'])) {
    $monitor_id = $_GET['monitor_id'];
    $get_week = isset($_GET['week']) ? $_GET['week'] : null;
    $get_day = isset($_GET['day']) ? $_GET['day'] : null;
    $monitor_result = isset($_GET['monitor_result']) ? $_GET['monitor_result'] : null ;
    $_SESSION['monitor_id'] = $monitor_id;
    $_SESSION['get_week'] = $get_week;

    if($_SESSION['user_loggedIn']['user_privilege'] == "rnd") {
      header('Location: '.$path.'homepage/monitoring/rnd/monitoring.php?monitor_id='.$monitor_id.'&week_num=1');
    }

    // setting variabales
    $monitor -> monitor_id = $monitor_id;
    $monitor -> week_num = $get_week;

    // get list of days
    $listOfDays = $monitor -> getDayDayData();
    $listGoals = $monitor -> getGoals();

    $weekData = $monitor -> getMonitorWeek();
    
    $withData = false;
    if($get_day) {
      $monitor -> day_num = $get_day;
      $withData = $monitor -> getDayWeight();

      $dayDataPhysical = $monitor -> getDayPhysicalAction();
      $dayDataSupplement = $monitor -> getDaySupplement();
      $dayDataFoodIntake = $monitor -> getDayFoodIntake();
    }

    $monitoringData = $monitor -> getOverallDataMonitoring();
    $monitoringDataBasic = $monitor -> getMonitoringViaMonitorId();

    // rnd data
    $rndInfo = $monitor -> getMonitoringRnd();


    // print_r($monitoringData['desirable_body_weight']);
  }

  $page_title = $_SESSION['user_loggedIn']['first_name']." | #".$monitor -> monitor_id." Monitoring";

  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="<?php echo $path."homepage/index.css"?>" />
<link rel="stylesheet" href="monitoring.css" />
<link rel="stylesheet" href="../consultation/consultation.css" />

<script type="module" src="<?php echo $path ?>node_modules/chart.js/dist/chart.umd.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js" defer></script>


<script type="module" src="monitoring.js" defer></script>
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer>
</script>

<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <p class="path_locator hidden"><?php echo $path ?></p>


  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

    <!-- main content hero header -->
    <main class="<?php echo isset($_GET['monitor_id']) ? "hidden" :"" ?>">
      <div class="sizing-secondary">
        <div class="main-text text-center">
          <!-- Set up your appointment -->
          <form action="monitoring.php" class="form search-form flex-center" method="get">
            <!-- search appoint id  -->
            <div class="form-input-parent search-parent">
              <div class="form-input-box">
                <input type="number" name="monitor_id" placeholder="Enter your monitoring number">
                <input type="hidden" name="week" value="1">
                <button type="submit" value="submit" class="button-primary">Search</button>
              </div>
            </div>

          </form>
        </div>
      </div>

    </main>

  </header>


  <?php if(isset($_GET['monitor_id'])) { ?>
  <!-- Set up your appointment -->
  <form action="monitoring.php" class="form search-form flex-center" method="get">
    <!-- search appoint id  -->
    <div class="form-input-parent search-parent">
      <div class="form-input-box">
        <input type="number" name="monitor_id" placeholder="Enter your monitoring number" required>
        <input type="hidden" name="week" value="1">
        <button type="submit" value="submit" class="button-primary">Search</button>
      </div>
    </div>

  </form>
  <?php } ?>



  <?php if(isset($_GET['monitor_id'])) { ?>
  <div class="side-bar-parent monitoring-parent ">

    <!-- SIDE BAR -->
    <div class="side-bar">
      <ul>

        <div class="side-info <?php echo $monitoringData ? "" : "hidden"?>">
          <!-- monitor id -->
          <li class="text-centers">
            <p>Monitoring <a
                href="<?php echo "monitoring.php?monitor_id=".$monitor_id."&week=1" ?>">#<?php echo $monitor_id  ?></a>
            </p>
          </li>

          <!-- appointment id -->
          <li class="text-centers ">
            <p>Appointment <a target="_blank"
                href="<?php echo $path."homepage/consultation/consultation.php?transact_id=".$monitoringData['transact_id'] ?>">#<?php echo $monitoringData['transact_id'] ?></a>
            </p>
          </li>

          <!-- chief complaint -->
          <li class="text-centers text-capital">
            <p><?php echo $monitoringData['chief_complaint'] ?></p>
          </li>
        </div>


        <?php foreach($weekData as $week) { 
          // print_r($week);
          ?>
        <!-- week 1 -->
        <li class="<?php echo $get_week == $week['week_num'] ? "active" :  "" ?>">
          <a href="monitoring.php?monitor_id=<?php echo $monitor_id ?>&week=<?php echo $week['week_num'] ?>"
            class="text-uppercase">
            <p>Week <?php echo $week['week_num'] ?></p> <i
              class="fa-solid fa-lock <?php echo $lastDayOfPrevWeek < $currentDate ? "hidden" : ""?>"></i>
          </a>

          <ul class="<?php echo $get_week == $week['week_num'] ? "" :  "hidden" ?>">
            <!-- PENDING WORK -->
            <!-- WEEKLY RESULT  -->
            <?php $isAllFilledUp = 0; ?>

            <?php foreach($listOfDays as $day) { 
              
              // to check if day is filled up
              $monitor -> day_num = $day['day_num'];
              $isFilledUp = $monitor -> getDayWeight();
              
              $isAllFilledUp += $isFilledUp ? true : false;

              // to check if day is beyond target
              $isBeyondDate = $currentDate < $day['date'];

              // generate link for day
              $link_day = "monitoring.php?monitor_id=".$monitor_id."&week=".$get_week."&day=".$day['day_num']."";

            ?>
            <li>
              <a class="<?php echo $isBeyondDate ? "lock":"available" ?> <?php echo $get_day != null && $get_day == $day['day_num'] ? "current-day" : "" ?>"
                href="<?php echo $link_day ?>">Day
                <?php echo $day['day_num'] ?>
                <!-- lock icon -->
                <?php if($isBeyondDate) { ?>
                <i class="fa-solid fa-lock"></i>
                <?php } ?>

                <!-- warning icon -->
                <?php if(!$isBeyondDate && !$isFilledUp) { ?>
                <i class="fa-solid fa-exclamation"></i>
                <?php } ?>
              </a>
            </li>
            <?php } ?>

            <!-- https://www.youtube.com/watch?v=-X3STIvs8y4b -->

            <li><a class="hidden available" href="#">Day 1</a></li>
            <li><a class="hidden current-day " href="#">Day 2 <i class="fa-solid fa-lock"></i></a></li>
            <li><a class="hidden lock" href="#">Day 3 <i class="fa-solid fa-lock"></i></a></li>
            <li><a class="hidden lock" href="#">Day 4 <i class="fa-solid fa-lock"></i></a></li>
            <li><a class="hidden lock" href="#">Day 5 <i class="fa-solid fa-lock"></i></a></li>
            <li><a class="hidden lock" href="#">Day 6 <i class="fa-solid fa-lock"></i></a></li>
            <li><a class="hidden lock" href="#">Day 7 <i class="fa-solid fa-lock"></i></a></li>

            <li>
              <?php $link_day = "monitoring.php?monitor_id=".$monitor_id."&week=".$get_week."&intervention=true"; ?>
              <a class="<?php echo $isAllFilledUp < 7? "lock":"available" ?> <?php echo isset($_GET['intervention']) ? "current-day" : "" ?>"
                href="<?php echo $link_day ?>">Weekly
                result <?php if($isAllFilledUp < 7) { ?><i class="fa-solid fa-lock"></i><?php } ?></a>
            </li>

          </ul>
        </li>

        <?php } ?>

        <!-- Monitoring result  -->
        <li
          class="<?php echo $monitoringDataBasic['board_page'] == 2 ? "" :  "lock" ?> <?php echo isset($_GET['monitor_result']) ? "active" : "" ?> monitoring-result">
          <a href="monitoring.php?monitor_id=<?php echo $monitor_id ?>&monitor_result=true" class="text-uppercase">
            <p>Monitoring result </p> <i
              class="fa-solid fa-lock <?php echo $monitoringDataBasic['board_page'] == 2 ? "hidden" : ""?>"></i>
          </a>
        </li>
      </ul>
    </div>

    <!-- MAIN CONTENT  -->
    <div class="main-content ">
      <div class="main-content-container card">

        <!-- page header -->
        <div class="header">
          <h2 class="text-center text-uppercase">Monitoring system</h2>
        </div>

        <p class="<?php echo $monitor_result == null || $get_day == null? "hidden" : "" ?>">
          <?php echo date("D, d M Y", strtotime($listOfDays[0]['date']))." >>> ".date("D, d M Y", strtotime(end($listOfDays)['date'])) ?>
        </p>

        <?php if(!isset($_GET['intervention'])) { ?>
        <!-- IF WEEK IS CLICKED -->
        <div class="week-outside-parent <?php echo $get_day ? "hidden" : "" ?>">
          <div class="week-list-day-parent">

            <?php foreach($listOfDays as $day) { 

              // to check if day is filled up
              $monitor -> day_num = $day['day_num'];
              $isFilledUp = $monitor -> getDayWeight();
              $dayDataPhysical = $monitor -> getDayPhysicalAction();
              $dayDataSupplement = $monitor -> getDaySupplement();
              $dayDataFoodIntake = $monitor -> getDayFoodIntake();

              $physicalLevel = "";
              if($isFilledUp) {
                switch($dayDataPhysical['physical_level']) {
                  case 1:
                    $physicalLevel = "Sedentary";
                    break;
                  case 2:
                    $physicalLevel = "Light";
                    break;
                  case 3:
                    $physicalLevel = "Moderate";
                    break;
                  case 4:
                    $physicalLevel = "Very active";
                    break;
                }
              }
              
              // to check if day is beyond target
              $isBeyondDate = $currentDate >= $day['date'];

              // generate link for day
              $link_day = "monitoring.php?monitor_id=".$monitor_id."&week=".$get_week."&day=".$day['day_num']."";

        ?>

            <!-- day 1 -->
            <a href="<?php echo $link_day ?>"
              class="week-list-day-item card <?php echo $isFilledUp? "":"flex-center " ?> 
        <?php echo $isBeyondDate ? "current-date" : "disabled" ?> <?php echo $isBeyondDate && !$isFilledUp ? "card-red" : "" ?>">
              <?php if($isFilledUp) {?>
              <p class="text-center text-uppercase">Day <?php echo $day['day_num'] ?></p>
              <div class="card-data">
                <p>Weight: <?php echo $isFilledUp['current_body_weight'] ?>kg</p>
                <p>Activity: <?php echo $physicalLevel ?></p>
                <p>Supplement: <?php echo $dayDataSupplement['supplement_name'] ?></p>
              </div>
              <?php } else { ?>
              <p>Day</p>
              <p><?php echo $day['day_num'] ?></p>
              <?php } ?>
            </a>

            <?php } ?>

          </div>

          <div class="goal-container <?php echo isset($_GET['monitor_result']) ? "hidden" : "" ?>">
            <h3 class="text-uppercase text-center card">Goals</h3>
            <div class="goal-list-parent">

              <?php foreach($listGoals as $goal) { ?>
              <div class="goal-list-item">
                <input type="checkbox" <?php echo $goal['goal_status'] == 0? "" : "checked"?> disabled>
                <p><?php echo $goal['goal_name'] ?></p>
              </div>
              <?php } ?>

            </div>
          </div>
        </div>
        <?php } ?>


        <div class="<?php echo $get_day ? "" : "hidden"?> ">

          <?php if($withData) { ?>
          <!-- DAY  -->
          <!-- SUBMITTING FORM for MONITORING -->
          <!-- Form -->
          <p style="margin:50px 0 ">Date:
            <?php echo 
            date("D, d M Y", strtotime($listOfDays[$get_day - 1]['date']))
            ?></p>

          <form class="form form-appoint-submit" action="submitDayMonitor.php" method="post"
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
                        <input type='text' name="appoint-chief-complaint" id="appoint-chief-complaint"
                          placeholder="Enter your desirable body weight"
                          value="<?php echo $monitoringData['desirable_body_weight'] == null ? "NO DATA YET" : $monitoringData['desirable_body_weight']."kg" ?>"
                          disabled>
                        <p class="form-error-message hidden">Error</p>
                      </div>

                      <!-- Current body weight -->
                      <div class="form-input-box input-two">
                        <label for="appoint-chief-complaint">Current Body Weight <span>*</span></label>
                        <input type='number' name="appoint-chief-complaint" id="appoint-chief-complaint"
                          placeholder="Enter your desirable body weight"
                          value="<?php echo $withData['current_body_weight'] ?>" disabled required>
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

                      <!--  -->
                      <!-- breakfast -->
                      <div class="food-intake-parent breakfast-parent">
                        <h3 class="food-header">Breakfast</h3>

                        <div class="container-parent">
                          <div class="outer-container">

                            <?php foreach($dayDataFoodIntake as $food) { ?>


                            <?php if($food['time_type'] == 'breakfast') { ?>
                            <!-- item -->
                            <div class="container">
                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time" id="food-time"
                                  value="<?php echo $food['time'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['food_consumed'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount" value="1" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Quantity -->
                              <div class="form-input-box input-two ">
                                <label for="food-quantity">Quantity <span>*</span></label>
                                <select id="food-quantity" name="food-quantity" disabled>
                                  <option value="volvo">Piece</option>
                                  <option value="saab">Once</option>
                                  <option value="fiat">Kg</option>
                                  <option value="audi" selected>Cup</option>
                                </select>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['method'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>
                            </div>
                            <?php } ?>

                            <?php } ?>

                          </div>
                        </div>

                      </div>

                      <!-- Lunch -->
                      <div class="food-intake-parent lunch-parent">
                        <h3 class="food-header">Lunch</h3>

                        <div class="container-parent">
                          <div class="outer-container">

                            <?php foreach($dayDataFoodIntake as $food) { ?>


                            <?php if($food['time_type'] == 'lunch') { ?>
                            <!-- item -->
                            <div class="container">
                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time" id="food-time"
                                  value="<?php echo $food['time'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['food_consumed'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount" value="1" disabled>
                                <!-- <select id="food-amount" name="">
                              <option value="volvo">Volvo</option>
                              <option value="saab">Saab</option>
                              <option value="fiat">Fiat</option>
                              <option value="audi">Audi</option>
                            </select> -->
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Quantity -->
                              <div class="form-input-box input-two ">
                                <label for="food-quantity">Quantity <span>*</span></label>
                                <select id="food-quantity" name="food-quantity" disabled>
                                  <option value="volvo">Piece</option>
                                  <option value="saab">Once</option>
                                  <option value="fiat">Kg</option>
                                  <option value="audi" selected>Cup</option>
                                </select>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['method'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>
                            </div>
                            <?php } ?>

                            <?php } ?>

                          </div>
                        </div>

                      </div>

                      <!-- Dinner -->
                      <div class="food-intake-parent dinner-parent">
                        <h3 class="food-header">Dinner</h3>

                        <div class="container-parent">
                          <div class="outer-container">

                            <?php foreach($dayDataFoodIntake as $food) { ?>


                            <?php if($food['time_type'] == 'dinner') { ?>
                            <!-- item -->
                            <div class="container">
                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time" id="food-time"
                                  value="<?php echo $food['time'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['food_consumed'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount" value="1" disabled>
                                <!-- <select id="food-amount" name="">
                              <option value="volvo">Volvo</option>
                              <option value="saab">Saab</option>
                              <option value="fiat">Fiat</option>
                              <option value="audi">Audi</option>
                            </select> -->
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Quantity -->
                              <div class="form-input-box input-two ">
                                <label for="food-quantity">Quantity <span>*</span></label>
                                <select id="food-quantity" name="food-quantity" disabled>
                                  <option value="volvo">Piece</option>
                                  <option value="saab">Once</option>
                                  <option value="fiat">Kg</option>
                                  <option value="audi" selected>Cup</option>
                                </select>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['method'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>
                            </div>
                            <?php } ?>

                            <?php } ?>

                          </div>
                        </div>

                      </div>

                      <!-- Snacks -->
                      <div class="food-intake-parent snacks-parent">
                        <h3 class="food-header">Snacks</h3>

                        <div class="container-parent">
                          <div class="outer-container">

                            <?php foreach($dayDataFoodIntake as $food) { ?>


                            <?php if($food['time_type'] == 'snacks') { ?>
                            <!-- item -->
                            <div class="container">
                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time" id="food-time"
                                  value="<?php echo $food['time'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['food_consumed'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount" value="1" disabled>
                                <!-- <select id="food-amount" name="">
                              <option value="volvo">Volvo</option>
                              <option value="saab">Saab</option>
                              <option value="fiat">Fiat</option>
                              <option value="audi">Audi</option>
                            </select> -->
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Quantity -->
                              <div class="form-input-box input-two ">
                                <label for="food-quantity">Quantity <span>*</span></label>
                                <select id="food-quantity" name="food-quantity" disabled>
                                  <option value="volvo">Piece</option>
                                  <option value="saab">Once</option>
                                  <option value="fiat">Kg</option>
                                  <option value="audi" selected>Cup</option>
                                </select>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-consume" id="food-time"
                                  value="<?php echo $food['method'] ?>" disabled>
                                <p class="form-error-message hidden">Error</p>
                              </div>
                            </div>
                            <?php } ?>

                            <?php } ?>

                          </div>
                        </div>

                      </div>

                    </div>

                  </div>


                </section>

                <!-- Physical activity -->
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


                          <?php foreach($appoint -> getPhysicalActivtyForm() as $data) {
                          $name = "physical-".$data['physical_act_name'];
                        ?>
                          <div>
                            <input type="radio" id="<?php echo $name ?>" name="physical-action"
                              value="<?php echo $data['physical_activity_id'] ?>"
                              <?php echo $dayDataPhysical['physical_level'] == $data['physical_activity_id'] ? "checked" : ""?>
                              disabled>
                            <label for="<?php echo $name ?>"><?php echo $data['physical_act_name'] ?></label>
                          </div>
                          <?php } ?>


                        </div>
                      </div>
                    </div>
                    <!-- right -->
                    <div class="form-input-parent hidden">
                      <!-- Body type -->
                      <div class="form-input-box form-radio-box">
                        <p>Body type <span>*</span></p>
                        <div class="gender-con radio-default">
                          <!-- Endomorph -->
                          <div>
                            <input type="checkbox" checked id="body-type-endomorph" name="body-type[]"
                              value="endomorph">
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

                <!-- Supplement Intake -->
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
                        <label for="supplement_name">What nutrional supplements did you take for this day?
                          <span>*</span></label>
                        <input type="text" name="appoint-medical-current-med" id="appoint-medical-current-med"
                          placeholder="E.g Ascorbic Acid"
                          value="<?php echo isset($dayDataSupplement) ? $dayDataSupplement['supplement_name'] : "" ?>"
                          <?php echo isset($dayDataSupplement) ? "disabled" : "" ?> required>
                        <p class="form-error-message hidden">Error</p>
                      </div>
                    </div>
                  </div>
                </section>

              </div>
            </div>

          </form>

          <?php } else { ?>
          <!-- DAY  -->
          <!-- SUBMITTING FORM for MONITORING -->
          <!-- Form -->
          <p style="margin:50px 0 ">Date:
            <?php echo 
            date("D, d M Y", strtotime($listOfDays[$get_day - 1]['date']))
            ?></p>
          <form class="form form-appoint-submit" action="submitDayMonitor.php" method="post"
            enctype="multipart/form-data">

            <!-- HIDDEN DATA -->
            <input type="hidden" name="monitor_id" value="<?php echo $monitor_id ?>">
            <input type="hidden" name="week_num" value="<?php echo $get_week ?>">
            <input type="hidden" name="day_num" value="<?php echo $get_day ?>">

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
                        <input type='text' name="appoint-chief-complaint" id="appoint-chief-complaint"
                          placeholder="Enter your desirable body weight"
                          value="<?php echo $monitoringData['desirable_body_weight'] == null ? "NO DATA YET" : $monitoringData['desirable_body_weight']."kg" ?>"
                          disabled>
                        <p class="form-error-message hidden">Error</p>
                      </div>

                      <!-- Current body weight -->
                      <div class="form-input-box input-two">
                        <label for="current_body_weight">Current Body Weight <span>*</span></label>
                        <input type='number' name="current_body_weight" id="current_body_weight"
                          placeholder="Enter your desirable body weight" value="<?php echo $inputWeight ?>" required>
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

                      <?php $foodTypes = ['breakfast', "lunch", "dinner", "snacks"] ?>

                      <?php foreach($foodTypes as $food) { ?>
                      <div class="food-intake-parent breakfast-parent">

                        <!-- header -->
                        <div class="divider">
                          <h3 class="food-header text-capital"><?php echo $food ?></h3>
                          <a href="#" class="button button-primary fa-plus">Add row</a>
                        </div>

                        <div class="container-parent">

                          <div class="outer-container">

                            <!-- item -->
                            <div class="container">
                              <input type="hidden" name="food-take-type[]" value="<?php echo $food ?>">

                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-bf-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time[]" ">
                              </div>

                              <!-- food consumed -->
                              <div class=" form-input-box input-two ">
                                <label for=" food-bf-consume">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume[]">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount[]">
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

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-method[]" id="food-time">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- trash -->
                              <div class="form-input-box trash-parent">
                                <i class="fa-solid fa-trash"></i>
                              </div>

                            </div>

                          </div>

                        </div>

                      </div>
                      <?php } ?>

                      <?php if(isset($tesssst)) { ?>
                      <!--  -->
                      <!-- breakfast -->
                      <div class="food-intake-parent breakfast-parent hidden">
                        <div class="divider">
                          <h3 class="food-header">Breakfast</h3>
                          <a href="#" class="button button-primary fa-plus">Add row</a>
                        </div>

                        <div class="container-parent">

                          <div class="outer-container">

                            <!-- item -->
                            <div class="container">
                              <input type="hidden" name="food-take-type[]" value="breakfast">

                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-bf-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time[]" value="02:00:00">
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two ">
                                <label for="food-bf-consume">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume[]" value="food consume test 1">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount[]" value="1">
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

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-method[]" id="food-time" value="method test">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- trash -->
                              <div class="form-input-box ">
                                <i class="fa-solid fa-trash"></i>
                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                      <!-- Lunch -->
                      <div class="food-intake-parent lunch-parent hidden">
                        <div class="divider">
                          <h3 class="food-header">Lunch</h3>
                          <a href="#" class="button button-primary fa-plus">Add row</a>
                        </div>

                        <div class="container-parent">
                          <div class="outer-container">

                            <!-- item -->
                            <div class="container">
                              <input type="hidden" name="food-take-type[]" value="lunch">

                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-bf-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time[]" value="02:00:00">
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two ">
                                <label for="food-bf-consume">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume[]" value="food consume test 1">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount[]" value="1">
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

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-method[]" id="food-time" value="method test">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- trash -->
                              <div class="form-input-box ">
                                <i class="fa-solid fa-trash"></i>
                              </div>

                            </div>

                          </div>
                        </div>

                      </div>

                      <!-- Dinner -->
                      <div class="food-intake-parent dinner-parent hidden">
                        <div class="divider">
                          <h3 class="food-header">Dinner</h3>
                          <a href="#" class="button button-primary fa-plus">Add row</a>
                        </div>

                        <div class="container-parent">
                          <div class="outer-container">

                            <!-- item -->
                            <div class="container">
                              <input type="hidden" name="food-take-type[]" value="dinner">

                              <!-- time -->
                              <div class="form-input-box input-two ">
                                <label for="food-bf-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time[]" value="02:00:00">
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two ">
                                <label for="food-bf-consume">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume[]" value="food consume test 1">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two ">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount[]" value="1">
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

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-method[]" id="food-time" value="method test">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- trash -->
                              <div class="form-input-box ">
                                <i class="fa-solid fa-trash"></i>
                              </div>

                            </div>

                          </div>
                        </div>

                      </div>

                      <!-- Snacks -->
                      <div class="food-intake-parent snacks-parent hidden">
                        <div class="divider">
                          <h3 class="food-header">Snacks</h3>
                          <a href="#" class="button button-primary fa-plus">Add row</a>
                        </div>

                        <div class="container-parent">
                          <div class="outer-container">

                            <!-- item -->
                            <div class="container">
                              <input type="hidden" name="food-take-type[]" value="snacks">

                              <!-- time -->
                              <div class="form-input-box input-two">
                                <label for="food-bf-time">Time <span>*</span></label>
                                <input type='time' name="food-bf-time[]" value="02:00:00">
                              </div>

                              <!-- food consumed -->
                              <div class="form-input-box input-two">
                                <label for="food-bf-consume">Food consumed <span>*</span></label>
                                <input type='text' name="food-bf-consume[]" value="food consume test 1">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Amount -->
                              <div class="form-input-box input-two">
                                <label for="food-amount">Amount <span>*</span></label>
                                <input type="text" name="food-amount[]" value="1">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Quantity -->
                              <div class="form-input-box input-two">
                                <label for="food-quantity">Quantity <span>*</span></label>
                                <select id="food-quantity" name="food-quantity[]">
                                  <option value="volvo">Piece</option>
                                  <option value="saab">Once</option>
                                  <option value="fiat">Kg</option>
                                  <option value="audi">Cup</option>
                                </select>
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- Method of preparation -->
                              <div class="form-input-box input-two ">
                                <label for="food-time">Method of preparation <span>*</span></label>
                                <input type='text' name="food-bf-method[]" id="food-time" value="method test">
                                <p class="form-error-message hidden">Error</p>
                              </div>

                              <!-- trash -->
                              <div class="form-input-box ">
                                <i class="fa-solid fa-trash"></i>
                              </div>

                            </div>

                          </div>
                        </div>

                      </div>
                      <?php } ?>

                    </div>

                  </div>


                </section>

                <!-- Physical activity -->
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
                            <input type="radio" id="body-type-endomorph" name="physical_action" value="sedentary">
                            <label for="body-type-endomorph">Sedentary</label>
                          </div>
                          <!-- Ectomorph -->
                          <div>
                            <input type="radio" id="body-type-ectomorph" name="physical_action" value="light">
                            <label for="body-type-ectomorph">Light</label>
                          </div>
                          <!-- Mesomorph -->
                          <div>
                            <input type="radio" id="body-type-mesomorph" name="physical_action" value="moderate">
                            <label for="body-type-mesomorph">Moderate</label>
                          </div>
                          <!-- very active -->
                          <div>
                            <input type="radio" id="body-type-vigorous" name="physical_action" value="vigorous">
                            <label for="body-type-vigorous">Very active or Vigorous</label>
                          </div>

                        </div>
                      </div>
                    </div>
                    <!-- right -->
                    <div class="form-input-parent hidden">
                      <!-- Body type -->
                      <div class="form-input-box form-radio-box">
                        <p>Body type <span>*</span></p>
                        <div class="gender-con radio-default">
                          <!-- Endomorph -->
                          <div>
                            <input type="checkbox" checked id="body-type-endomorph" name="body-type[]"
                              value="endomorph">
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

                <!-- Supplement Intake -->
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
                        <label for="supplement_name">Are you taking any nutrional supplements?
                          <span>*</span></label>
                        <input type="text" name="supplement_name" id="supplement_name" placeholder="E.g Ascorbic Acid"
                          value="<?php echo $sampleText  ?>">
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
              <div>
                <a class="button button-semi button-disabled button-primary">Submit
                </a>
              </div>
              <!-- class="button-semi-submit" -->
              <div class="button-next hidden">
                <a class="button button-primary">Next
                </a>
              </div>


            </div>

            <!-- MODAl - CONFIRMATION -->
            <div
              class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">

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
          <?php } ?>

        </div>


        <div class="<?php echo isset($_GET['intervention']) ? "" : "hidden" ?>">
          <!-- INTERVENSION -->
          <div class="intervension-parent <?php echo $_GET['intervention'] == "true" ? "" : "hidden" ?>">
            <div class="divider card">
              <div class="left">
                <div class="chart-parent flex-center">
                  <!-- one -->
                  <div class="chart chart-one flex-center">
                    <canvas id="physical"></canvas>
                  </div>
                  <!-- two -->
                  <div class="chart chart-two flex-center hiddens">
                    <canvas id="bodyWeight"></canvas>
                  </div>
                  <!-- three -->
                  <div class="chart chart-two flex-center hiddens">
                    <canvas id="foodFrequency"></canvas>
                  </div>
                </div>
              </div>
              <div class="right hiddens">
                <div class="greeting text-center">
                  <h3>Hi, <?php echo $_SESSION['user_loggedIn']['first_name'] ?></h3>
                  <p>Your track for this week.</p>
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

          </div>
        </div>

        <!-- END OF MONITORING -->
        <div class="monitoring-end-parent <?php echo isset($_GET['monitor_result']) ? "" : "hidden" ?>">

          <div class="greeting ">
            <h3>Nice work <?php echo $_SESSION['user_loggedIn']['first_name'] ?>!</h3>
            <p>Congratulations on achieving your goals.</p>
          </div>

          <div class="divider">
            <!-- left -->
            <div class="goal-container">
              <h3 class="text-uppercase text-center card">Goals</h3>
              <div class="goal-list-parent">
                <?php foreach($listGoals as $goal) { ?>
                <div class="goal-list-item">
                  <input type="checkbox" <?php echo $goal['goal_status'] == 0? "" : "checked"?> disabled>
                  <p><?php echo $goal['goal_name'] ?></p>
                </div>
                <?php } ?>
              </div>
            </div>

            <!-- right -->
            <div class="form">
              <div class="form-input-parent flex-center">
                <!-- img -->
                <div class="list-rnd-box ka-talk-box grid-box card">
                  <div class="list-rnd-image flex-center">
                    <img src="<?php echo $path."uploads/".$rndInfo['profile_img'] ?>" alt="">
                  </div>
                  <div class="list-rnd-info text-center">
                    <p class="assigned-rnd"><?php echo $rndInfo['first_name']." ".$rndInfo['last_name'] ?></p>
                    <a target="_blank" href="<?php echo $path."/profile/profile.php?profile-id=".$rndInfo['user_id'] ?>"
                      class="text-uppercase text-center profile-link">view profile</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="buttons ">
            <a href="#" class="button button-tertiary hidden">Request for follow up</a>
            <a href="#" class="button button-primary hidden">Request for F2F consultation</a>
          </div>

        </div>

      </div>
    </div>

    <!-- MODAl - OTHER ACCOUNT IS LOGGED IN -->
    <div
      class="modal-parent modal-notif-parent modal-oops-notif overlay-black flex-center <?php echo $monitoringData ? "hidden" : "" ?>">

      <!-- hidden - fox ajax -->
      <input type="hidden" name="submit" value='true' id="submit">

      <div class="modal-container modal-notif-container sizing-secondary modal-wait">
        <div class="modal-header text-center">
          <h2 class="text-uppercase">Something went wrong</h2>
        </div>
        <div class="modal-message">
          <p class="text-center">Monitoring number not found.
          </p>
        </div>
        <div class="modal-buttons">
          <a href="<?php echo "monitoring.php" ?>" class="button button-back">Go back</a>
        </div>
      </div>
    </div>

  </div>
  <?php } ?>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>