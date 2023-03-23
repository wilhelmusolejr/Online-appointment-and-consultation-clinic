<?php
  $path = "../../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path."classes/monitor.class.php";
  require_once $path.'tools/variables.php';
  $page_title = "Monitoring";
  $monitoring = "nav-current";

  $monitor = new monitor;
  // monitor_id=1&week=1&day=1

  if(isset($_GET['monitor_id'])) {
    $monitor_id = isset($_GET['monitor_id']);
    $week = isset($_GET['week']) ? $_GET['week'] : null;
    $day = isset($_GET['day']) ? $_GET['day'] : null;

    $monitor -> monitor_id = 1;

    $listGoals = $monitor -> getGoals();
    $marketInfo = $monitor -> getMarketInfo();


    $withData = false;
    if($day && $day < $marketInfo['current_day']) {
      $monitor -> week_num = $week;
      $monitor -> day_num = $day; 

      $withData = true;
      
      $dayData = $monitor -> getDayData();
      $dayDataPhysical = $monitor -> getDayPhysicalAction();
      $dayDataSupplement = $monitor -> getDaySupplement();
      $dayDataFoodIntake = $monitor -> getDayFoodIntake();
    }


  }

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
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

  </header>

  <div class="side-bar-parent monitoring-parent ">

    <!-- SIDE BAR -->
    <div class="side-bar">
      <ul>

        <li class="text-center">
          <p>Monitoring #<?php echo $monitor_id ?></p>
        </li>

        <!-- week 1 -->
        <li class="active">
          <a href="monitoring.php?monitor_id=<?php echo $monitor_id ?>" class="text-uppercase">
            <p>Week 1</p> <i class="fa-solid fa-chevron-right hidden"></i>
          </a>
          <ul class="hiddens">

            <?php for($i = 1; $i <= 7; $i++) { 
            $link = "monitoring.php?monitor_id=".$monitor_id."&"."week="."1"."&day=".$i."";
            ?>
            <li><a class="<?php echo $day == $i? "current-day ": "" ?> 
            <?php echo $marketInfo['current_day'] < $i ? "lock": "available"?> " href="<?php echo $link ?>">Day
                <?php echo $i ?>

                <?php if($marketInfo['current_day'] < $i) { ?>
                <i class="fa-solid fa-lock"></i>
                <?php } ?>

                <?php } ?>

            <li><a class="lock" href="#">Weekly result</a></li>
          </ul>
        </li>

        <!-- week 2 -->
        <li class="approved-appointment <?php echo isset($approved) ? "active" :"" ?>"><a
            href="../approved-appointment/approved-appointment.php" class="text-uppercase">
            <p>Week 2 </p> <i class="fa-solid fa-lock"></i>
          </a>
        </li>

      </ul>
    </div>



    <!-- MAIN CONTENT  -->
    <div class="main-content">
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
          <h2 class="text-center text-uppercase">Monitoring system</h2>
        </div>

        <!-- IF WEEK IS CLICKED -->
        <div class="week-outside-parent <?php echo $day ? "hidden" : "" ?>">
          <div class="week-list-day-parent">

            <?php for($i = 1; $i <= 7; $i++) { 
            $link = "monitoring.php?monitor_id=".$monitor_id."&"."week="."1"."&day=".$i."";
            ?>

            <!-- day 1 -->
            <a href="<?php echo $link ?>" class="week-list-day-item text-uppercase card flex-center 
            <?php echo $marketInfo['current_day'] >= $i ? "current-date" : "disabled" ?> ">
              <p>Day</p>
              <p><?php echo $i ?></p>
            </a>

            <?php } ?>

            <div class="hidden">
              <!-- day 1 -->
              <a href="monitoring.php?monitor_id=1&week=1&day=1"
                class="week-list-day-item text-uppercase card flex-center current-date">
                <p>Day</p>
                <p>1</p>
              </a>

              <!-- day 2 -->
              <a href="monitoring.php?monitor_id=1&week=1&day=2"
                class="week-list-day-item text-uppercase card flex-center ">
                <p>Day</p>
                <p>2</p>
              </a>

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


        <div class="<?php echo $day ? "" : "hidden"?> ">


          <?php if($withData) { ?>
          <!-- DAY  -->
          <!-- SUBMITTING FORM for MONITORING -->
          <!-- Form -->
          <form class="form form-appoint-submit <?php echo $marketInfo['board_page'] == 1 ? "" : "hidden" ?>"
            action="submitDayMonitor.php" method="post" enctype="multipart/form-data">
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
                          placeholder="Enter your desirable body weight" value="101" disabled>
                        <p class="form-error-message hidden">Error</p>
                      </div>

                      <!-- Current body weight -->
                      <div class="form-input-box input-two">
                        <label for="appoint-chief-complaint">Current Body Weight <span>*</span></label>
                        <input type='number' name="appoint-chief-complaint" id="appoint-chief-complaint"
                          placeholder="Enter your desirable body weight"
                          value="<?php echo isset($dayData) ? $dayData['current_body_weight'] : "" ?>"
                          <?php echo isset($dayData) ? "disabled":"" ?> required>
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
                      <div class="breakfast-parent">
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
                      <div class="breakfast-parent">
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
                      <div class="breakfast-parent">
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
                          <!-- Endomorph -->
                          <div>
                            <input type="radio" checked id="body-type-endomorph" name="body-type[]" value="sedentary"
                              <?php echo $dayDataPhysical['action_level'] == 1 ? "checked" : "disabled"?>>
                            <label for="body-type-endomorph">Sedentary</label>
                          </div>
                          <!-- Ectomorph -->
                          <div>
                            <input type="radio" id="body-type-ectomorph" name="body-type[]" value="light"
                              <?php echo $dayDataPhysical['action_level'] == 2 ? "checked" : "disabled"?>>
                            <label for="body-type-ectomorph">Light</label>
                          </div>
                          <!-- Mesomorph -->
                          <div>
                            <input type="radio" id="body-type-mesomorph" name="body-type[]" value="moderate"
                              <?php echo $dayDataPhysical['action_level'] == 3 ? "checked" : "disabled"?>>
                            <label for="body-type-mesomorph">Moderate</label>
                          </div>
                          <!-- very active -->
                          <div>
                            <input type="radio" id="body-type-vigorous" name="body-type[]" value="vigorous"
                              <?php echo $dayDataPhysical['action_level'] == 4 ? "checked" : "disabled"?>>
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
                        <label for="appoint-actual-weight">Are you taking any nutrional supplements?
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
          <form class="form form-appoint-submit <?php echo $marketInfo['board_page'] == 1 ? "" : "hidden" ?>"
            action="submitDayMonitor.php" method="post" enctype="multipart/form-data">
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
                          placeholder="Enter your desirable body weight" value="101" disabled>
                        <p class="form-error-message hidden">Error</p>
                      </div>

                      <!-- Current body weight -->
                      <div class="form-input-box input-two">
                        <label for="appoint-chief-complaint">Current Body Weight <span>*</span></label>
                        <input type='number' name="appoint-chief-complaint" id="appoint-chief-complaint"
                          placeholder="Enter your desirable body weight"
                          value="<?php echo isset($dayData) ? $dayData['current_body_weight'] : "" ?>"
                          <?php echo isset($dayData) ? "disabled":"" ?> required>
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
                        <label for="appoint-actual-weight">Are you taking any nutrional supplements?
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
            <div
              class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">

              <!-- hidden - fox ajax -->
              <input type="hidden" name="submit" value='true' id="submit">

              <div class="modal-container modal-notif-container sizing-secondary">
                <div class="modal-header text-center">
                  <h2 class="text-uppercase">Confirm </h2>
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

          <!-- INTERVENSION -->
          <div class="intervension-parent <?php echo $marketInfo['board_page'] == 2 ? "" : "hidden" ?>">
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
          <div class="monitoring-end-parent <?php echo $marketInfo['board_page'] == 3 ? "" : "hidden" ?>">

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

  </div>


  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>