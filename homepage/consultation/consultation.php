<?php 
    $path = "../../";

    require_once $path.'classes/appoint.class.php';
    require_once $path.'classes/user.class.php';
    require_once $path.'classes/consult.class.php';

    require_once $path.'tools/variables.php';
    $page_title = "Consultation";
    $consultation = 'nav-current';

    session_start();

    $board_page = 1;
    
    $appoint = new appoint;
    $consult = new consult;
    $clientData = new user;
    
    // SEARCH BAR --- GET --- TO GENERATE 
    if(isset($_GET['transact_id'])) {

      if($_SESSION['user_loggedIn']['user_privilege'] == 'rnd') {
        header('Location: rnd/consultation.php?transact_id='.$_GET['transact_id']);
      }

      $appoint -> transact_id = $_GET['transact_id'];

      // Set $session transaction
      if(!isset($_SESSION['transact_rnd_id'])) {
        $_SESSION['transact_rnd_id'] = $appoint -> getAppointCheckpointStatus()['rnd_id'];
      }
      if(!isset($_SESSION['transact_client_id'])) {
        $_SESSION['transact_client_id'] = $appoint -> validate()['user_id'];
      }

      $_SESSION['transact_id'] = $_GET['transact_id'];
      $result = $appoint -> validate();
      if($result) {
          $board_transact_id = $result['transact_id'];
          $board_page = $result['board_page'];

          // board 1
          // GETTING DATA FOR TABULATION
          $appoint -> transact_id = $board_transact_id;
          $appointInfo = $appoint -> getAppoint();
          $appoint -> appoint_id = $appointInfo['appoint_id'];
          $consultInfo = $appoint -> getConsultInfo();
          $foodInfo = $appoint -> getFoodInfo();
          $physicalInfo = $appoint -> getPhysicalInfo();
          $medicalInfo = $appoint -> getMedicalInfo();
          $clientInfo = $appoint -> getClientInfo();

          $listFoodAllergy = [];
          $listFoodLike = [];
          $listFoodDislike = [];

          foreach($appoint -> getFoodAllergy() as $test) {
            array_push($listFoodAllergy, $test['allergy_name']);
            array_push($listFoodLike, $test['food_like_name']);
            array_push($listFoodDislike, $test['food_dislike_name']);
          }

          // body type
          $bodyType = $appoint -> getbodyType();
          $bodyTypeList = [];

          foreach($bodyType as $type) {
            array_push($bodyTypeList, $type['body_type_name']);
          }
      }


      if($board_page == 3) {
        // DATA CONSULT
        // GET USER INFO
        $consult-> transact_id = $_SESSION['transact_id'];
        $cheduleInfo = $consult -> getSchedule();
        // $consultInfo = $consult -> getConsultInfo();
      }

      if(isset($_SESSION['transact_rnd_id'])) {
        $clientData -> user_id = $_SESSION['transact_client_id'];
        $resultClientData = $clientData -> getUserData();
        print_r($resultClientData);
      }
    }
    // print_r($_SESSION);

    // getConsultInfo()
    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="consultation.css" />
<link rel="stylesheet" href="../rnds/rnds.css" />
<link rel="stylesheet" href="status.css">
<script src="../index.js" defer></script>
<script src="consultation.js" defer></script>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

    <main>
      <div class="sizing-secondary">
        <div class="main-text text-center">
          <h1 class="text-uppercase">
            Reach your RND<span class="text-initial">s</span> from anywhere
          </h1>
          <p>
            Consulting oneself in a hospital is important for early detection and treatment of illnesses or injuries. It
            also helps to keep track of one's overall health and prevent the progression of any potential health issues.
          </p>
          <a href="#board-parent" class="button button-primary">Book now!</a>
        </div>
      </div>

    </main>

  </header>


  <!-- search -->
  <?php if(isset($board_transact_id)) { ?>

  <section id="board-parent" class="board-parent ">

    <!-- Set up your appointment -->
    <form action="consultation.php" class="form search-form" method="get">

      <!-- search appoint id  -->
      <div class="form-input-parent search-parent">
        <div class="form-input-box">
          <input type="number" name="transact_id" placeholder="Enter your appointment number">
          <button type="submit" value="submit" class="button-primary">Search</button>
        </div>
      </div>

    </form>

    <div class="board-container card">
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
              <p class="text">Appointment</p>
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
              <p class="text">Consultation</p>
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
              <p class="text">Solution</p>
            </li>
          </ul>
        </div>
      </div>

      <form action="consultation.php">
        <!-- <input type="hidden" class="board-page" value="<?php echo $board_page ?>"> -->
        <input type="hidden" class="path" value="<?php echo $path ?>">
      </form>

      <!-- 1 -->
      <!-- Appointment -->
      <div data-board-page="1" class="appointment-stage board-page <?php echo $board_page == 1?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Set your appoinment</h2>
        </div>
        <!-- Form -->
        <form method="post" class="form form-appoint-submit">
          <!-- - Appointment for -->
          <div class="appointment-for">
            <div class="form-input-parent">
              <div class="form-input-box">
                <label for="appointment-for">Appointment for</label>
                <div class="radio-box flex-center">
                  <div>
                    <input type="radio" id="myself" name="appointment-for" value="myself"
                      <?php echo $clientInfo["appoint_for"] == 1?"checked":"" ?> disabled>
                    <label for="myself">Myself</label>
                  </div>
                  <div>
                    <input type="radio" id="other" name="appointment-for" value="other"
                      <?php echo $clientInfo["appoint_for"] == 1?"":"checked" ?> disabled>
                    <label for="other">Other</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Tab -->
          <div class="tabset">
            <!-- Tab 5 -->
            <input class='personal-tab <?php echo $clientInfo["appoint_for"] == 1?"hidden":"" ?>' type="radio"
              name="tabset" id="tab5" aria-controls="dunkles"
              <?php echo $clientInfo["appoint_for"] == 1?"":"checked" ?>>
            <label class='personal-tab <?php echo $clientInfo["appoint_for"] == 1?"hidden":"" ?>' for="tab5">Personal
              Information</label>
            <!-- Tab 1 -->
            <input type="radio" name="tabset" id="tab1" aria-controls="marzen"
              <?php echo $clientInfo["appoint_for"] == 1?"checked":"" ?>>
            <label for="tab1">Consultation Information</label>
            <!-- Tab 2 -->
            <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
            <label for="tab2">Food Information</label>
            <!-- Tab 3 -->
            <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
            <label for="tab3">Physical Information</label>
            <!-- Tab 4 -->
            <input type="radio" name="tabset" id="tab4" aria-controls="dunkles">
            <label for="tab4">Medical Information</label>

            <div class="tab-panels">

              <!-- Personal Information -->
              <section id="personal-tab"
                class="personal-tab tab-panel <?php echo $clientInfo["appoint_for"] == 1?"hidden":"" ?>">
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
                      <input type="text" name="firstname" id="firstname" value="<?php echo $clientInfo['first_name'] ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- middle name -->
                    <div class="form-input-box input-two">
                      <label for="middlename" class="text-capital">Middle name </label>
                      <input type="text" name="middlename" id="middlename"
                        value="<?php echo $clientInfo['middle_name'] ?>" disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- last name -->
                    <div class="form-input-box input-two">
                      <label for="lastname" class="text-capital">Last name <span>*</span></label>
                      <input type="text" name="lastname" id="lastname" value="<?php echo $clientInfo['last_name'] ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- gender -->
                    <div class="gender-form form-input-box input-two">
                      <label for="gender" class="text-capital">Gender <span>*</span></label>
                      <div class="gender-con radio-box flex-center">
                        <div>
                          <input type="radio" id="male" name="gender" value="Male"
                            <?php echo $clientInfo['gender'] == 1?"checked":"" ?> disabled>
                          <label for="male">Male</label>
                        </div>
                        <div>
                          <input type="radio" id="female" name="gender" value="Female"
                            <?php echo $clientInfo['gender'] == 1?"":"checked" ?> disabled>
                          <label for="female">Female</label>
                        </div>
                      </div>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- birth date -->
                    <div class="form-input-box input-two">
                      <label for="birthdate" class="text-capital">Birthdate <span>*</span></label>
                      <input type="date" name="birthdate" id="birthdate" value="<?php echo $clientInfo['birthdate'] ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Relationship status -->
                    <div class="form-input-box input-two">
                      <label for="relationship-status">Relationship status <span>*</span></label>
                      <input list="list-relationship" name="relationship-status" id="relationship-status"
                        placeholder="Diet meal plan" value="<?php echo $clientInfo['relationship_status'] ?>" disabled>
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
                      <input type="text" name="reg-mob" id="reg-mob" value="<?php echo $clientInfo['mobile_num'] ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Email -->
                    <div class="form-input-box input-two">
                      <label for="reg-email" class="text-capital">Email address <span>*</span></label>
                      <input type="email" name="reg-email" id="reg-email" value="<?php echo $clientInfo['email_add'] ?>"
                        disabled>
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
                    <!-- Chief complaint -->
                    <div class="form-input-box input-one">
                      <label for="appoint-chief-complaint">Chief complaint <span>*</span></label>
                      <input list="list-complaints" name="appoint-chief-complaint" id="appoint-chief-complaint"
                        placeholder="Diet meal plan" value="<?php echo $consultInfo['chief_complaint']; ?>" disabled>
                      <datalist id="list-complaints">
                        <option value="Test">
                        <option value="Test1">
                      </datalist>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment date -->
                    <div class="form-input-box input-two">
                      <label for="appointment-date" class="text-capital">Appointment date <span>*</span></label>
                      <input type="date" name="appointment-date" id="appointment-date"
                        placeholder="Enter your middle name" value="<?php echo $consultInfo['appoint_date']; ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment time -->
                    <div class="form-input-box input-two">
                      <label for="appointment-time" class="text-capital">Appointment time <span>*</span></label>
                      <input type="time" name="appointment-time" id="appointment-time"
                        value="<?php echo $consultInfo['appoint_time']; ?>" disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Referral form -->
                    <div class="form-input-box input-two">
                      <label for="appointment-referral" class="text-capital">Referral form</label>
                      <input type="file" name="appointment-referral" id="appointment-referral" disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Medical record -->
                    <div class="form-input-box input-two">
                      <label for="appointment-medical" class="text-capital">Medical record </label>
                      <input type="file" name="appointment-medical" id="appointment-medical" disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent">
                    <!-- More Information -->
                    <div class="form-input-box input-one">
                      <label for="appointment-more-info" class="text-capital">More information</label>
                      <textarea name="appointment-more-info" class="" id="appointment-more-info"
                        disabled><?php echo $consultInfo['appoint_more_info']; ?></textarea>
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
                    <!-- food allergies -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-allergies">Do you have any food allergies? <span>*</span></label>
                      <input type="text" name="appoint-food-allergies" id="appoint-food-allergies"
                        placeholder="Peanut, Shrimp" value="<?php echo join(", ", array_unique($listFoodAllergy)) ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Foods you like -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-like" class="text-capital">Foods you like <span>*</span></label>
                      <input type="text" name="appoint-food-like" id="appoint-food-like" placeholder="E.g Salad, Egg"
                        value="<?php echo join(", ", array_unique($listFoodLike)) ?>" disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Foods you dislike -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-like" class="text-capital">Foods you dislike <span>*</span></label>
                      <input type="text" name="appoint-food-dislike" id="appoint-food-dislike"
                        placeholder="E.g Seaweed, Fish" value="<?php echo join(", ", array_unique($listFoodDislike)) ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment time -->
                    <div class="form-input-box input-two">
                      <label for="appoint-type-diet">Are you on specific type of diet? <span>*</span></label>
                      <input list="list-diet" name="appoint-type-diet" id="appoint-type-diet"
                        value="<?php echo $foodInfo['type_diet_id']; ?>" disabled>
                      <datalist id="list-diet">
                        <option value="Test">
                        <option value="Test1">
                      </datalist>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent">
                    <!-- Smoke -->
                    <div class="form-input-box form-radio-box">
                      <p>How often do you smoke <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Daily -->
                        <div>
                          <input type="radio" id="smoke-daily" name="smoke-level" value="smoke-daily"
                            <?php echo $foodInfo['smoke_level_id'] == 1? 'checked':''; ?> disabled>
                          <label for="smoke-daily">Daily</label>
                        </div>
                        <!-- Weekly -->
                        <div>
                          <input type="radio" id="smoke-weekly" name="smoke-level" value="smoke-weekly"
                            <?php echo $foodInfo['smoke_level_id'] == 2? 'checked':''; ?> disabled>
                          <label for="smoke-weekly">Weekly</label>
                        </div>
                        <!-- Monthly -->
                        <div>
                          <input type="radio" id="smoke-monthly" name="smoke-level" value="smoke-monthly"
                            <?php echo $foodInfo['smoke_level_id'] == 3? 'checked':''; ?> disabled>
                          <label for="smoke-monthly">Monthly</label>
                        </div>
                        <!-- Ocassionally -->
                        <div>
                          <input type="radio" id="smoke-ocassionally" name="smoke-level" value="smoke-ocassionally"
                            <?php echo $foodInfo['smoke_level_id'] == 4? 'checked':''; ?> disabled>
                          <label for="smoke-ocassionally">Ocassionally</label>
                        </div>
                        <!-- Never -->
                        <div>
                          <input type="radio" id="smoke-never" name="smoke-level" value="smoke-never"
                            <?php echo $foodInfo['smoke_level_id'] == 5? 'checked':''; ?> disabled>
                          <label for="smoke-never">Never</label>
                        </div>
                      </div>
                    </div>
                    <!-- Drink liquor -->
                    <div class="form-input-box form-radio-box">
                      <p>How often do you drink liquor?
                        <span>*</span>
                      </p>
                      <div class="gender-con radio-default">
                        <!-- Daily -->
                        <div>
                          <input type="radio" checked id="drink-daily" name="drink-level" value="drink-daily"
                            <?php echo $foodInfo['drink_level_id'] == 1? 'checked':''; ?> disabled>
                          <label for="drink-daily">Daily</label>
                        </div>
                        <!-- Weekly -->
                        <div>
                          <input type="radio" id="drink-weekly" name="drink-level" value="drink-weekly"
                            <?php echo $foodInfo['drink_level_id'] == 2? 'checked':''; ?> disabled>
                          <label for="drink-weekly">Weekly</label>
                        </div>
                        <!-- Monthly -->
                        <div>
                          <input type="radio" id="drink-monthly" name="drink-level" value="drink-monthly"
                            <?php echo $foodInfo['drink_level_id'] == 3? 'checked':''; ?> disabled>
                          <label for="drink-monthly">Monthly</label>
                        </div>
                        <!-- Ocassionally -->
                        <div>
                          <input type="radio" id="drink-ocassionally" name="drink-level" value="drink-ocassionally"
                            <?php echo $foodInfo['drink_level_id'] == 4? 'checked':''; ?> disabled>
                          <label for="drink-ocassionally">Ocassionally</label>
                        </div>
                        <!-- Never -->
                        <div>
                          <input type="radio" id="drink-never" name="drink-level" value="drink-never"
                            <?php echo $foodInfo['drink_level_id'] == 5? 'checked':''; ?> disabled>
                          <label for="drink-never">Never</label>
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
                    <!-- Actual weight -->
                    <div class="form-input-box ">
                      <label for="appoint-actual-weight">Actual weight <span>*</span></label>
                      <input type="number" min='0' name="appoint-actual-weight" id="appoint-actual-weight"
                        placeholder="Enter your actual weight" value="<?php echo $physicalInfo['actual_weight']; ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Current height -->
                    <div class="form-input-box ">
                      <label for="appoint-current-height" class="text-capital">Current height <span>*</span></label>
                      <input type="number" min='0' name="appoint-current-height" id="appoint-current-height"
                        placeholder="Enter your current height" value="<?php echo $physicalInfo['current_height']; ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent ">
                    <!-- Body type -->
                    <div class="form-input-box form-radio-box">
                      <p>Body type <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="checkbox" id="body-type-endomorph" name="body-type" value="endomorph"
                            <?php echo in_array("endomorph", $bodyTypeList)?"checked":"" ?> disabled>
                          <label for="body-type-endomorph">Endomorph</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="checkbox" id="body-type-ectomorph" name="body-type" value="ectomorph"
                            <?php echo in_array("ectomorph", $bodyTypeList)?"checked":"" ?> disabled>
                          <label for="body-type-ectomorph">Ectomorph</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="body-type-mesomorph" name="body-type" value="mesomorph"
                            <?php echo in_array("mesomorph", $bodyTypeList)?"checked":"" ?> disabled>
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
                            <?php echo $physicalInfo['physical_activity_id'] == 1?"checked":"";?> disabled>
                          <label for="physical-sedentary">Sedentary</label>
                        </div>
                        <!-- Light -->
                        <div>
                          <input type="radio" id="physical-light" name="physical-activity" value="light"
                            <?php echo $physicalInfo['physical_activity_id'] == 2?"checked":"";?> disabled>
                          <label for="physical-light">light</label>
                        </div>
                        <!-- Moderate -->
                        <div>
                          <input type="radio" id="physical-moderate" name="physical-activity" value="moderate"
                            <?php echo $physicalInfo['physical_activity_id'] == 3?"checked":"";?> disabled>
                          <label for="physical-moderate">Moderate</label>
                        </div>
                        <!-- Very active -->
                        <div>
                          <input type="radio" id="physical-very-active" name="physical-activity" value="very-active"
                            <?php echo $physicalInfo['physical_activity_id'] == 4?"checked":"";?> disabled>
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
                          <input type="radio" id="gain-easily" name="gain-weight-level" value="easily"
                            <?php echo $physicalInfo['gain_weight_level_id'] == 1?"checked":"";?> disabled>
                          <label for="gain-easily">Easily</label>
                        </div>
                        <!-- Light -->
                        <div>
                          <input type="radio" id="gain-moderately" name="gain-weight-level" value="moderately"
                            <?php echo $physicalInfo['gain_weight_level_id'] == 2?"checked":"";?> disabled>
                          <label for="gain-moderately">Moderately</label>
                        </div>
                        <!-- Moderate -->
                        <div>
                          <input type="radio" id="gain-slowly" name="gain-weight-level" value="slowly"
                            <?php echo $physicalInfo['gain_weight_level_id'] == 3?"checked":"";?> disabled>
                          <label for="gain-slowly">Slowly</label>
                        </div>
                        <!-- Very active -->
                        <div>
                          <input type="radio" id="gain-very-slowly" name="gain-weight-level" value="very-slowly"
                            <?php echo $physicalInfo['gain_weight_level_id'] == 4?"checked":"";?> disabled>
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
                          <input type="radio" id="lose-easily" name="lose-weight-level" value="easily"
                            <?php echo $physicalInfo['lose_weight_level_id'] == 1? "checked":"";?> disabled>
                          <label for="lose-easily">Easily</label>
                        </div>
                        <!-- Light -->
                        <div>
                          <input type="radio" id="lose-moderately" name="lose-weight-level" value="moderately"
                            <?php echo $physicalInfo['lose_weight_level_id'] == 2? "checked":"";?> disabled>
                          <label for="lose-moderately">Moderately</label>
                        </div>
                        <!-- Moderate -->
                        <div>
                          <input type="radio" id="lose-slowly" name="lose-weight-level" value="slowly"
                            <?php echo $physicalInfo['lose_weight_level_id'] == 3? "checked":"";?> disabled>
                          <label for="lose-slowly">Slowly</label>
                        </div>
                        <!-- Very active -->
                        <div>
                          <input type="radio" id="lose-very-slowly" name="lose-weight-level" value="very-slowly"
                            <?php echo $physicalInfo['lose_weight_level_id'] == 4? "checked":"";?> disabled>
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
                      <label for="appoint-actual-weight">Are you currently taking any medication? <span>*</span></label>
                      <input type="text" name="appoint-medical-current-med" id="appoint-medical-current-med"
                        placeholder="E.g Ascorbic Acid" value="<?php echo $medicalInfo['current_medication'] ?>"
                        disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class=" form-input-parent ">
                    <!-- health condition -->
                    <div class="form-input-box form-radio-box">
                      <p>Do you have any health condition or have been diagnosed in the past? <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="checkbox" checked id="self-conditions-diabetes" name="health-condition-one"
                            value="Diabetes">
                          <label for="self-conditions-diabetes">Diabetes</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-hypertension" name="health-condition-one"
                            value="Hypertension">
                          <label for="self-conditions-hypertension">Hypertension</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-obese" name="health-condition-one" value="Obese">
                          <label for="self-conditions-obese">Obese</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-anemia" name="health-condition-one" value="Anemia">
                          <label for="self-conditions-anemia">Anemia</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="health-condition-one-other" name="health-condition-one"
                            value="health-condition-one-other">
                          <label for="health-condition-one-other">If others, specify</label>
                          <input type="text" id="otherValue" name="health-condition-one-other" class="hidden" />
                        </div>
                      </div>
                    </div>
                    <!-- family condition -->
                    <div class="form-input-box form-radio-box">
                      <p>Is anyone in your family has any health condition in the past? <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="checkbox" checked id="self-conditions-diabetes" name="health-condition-one"
                            value="Diabetes">
                          <label for="self-conditions-diabetes">Diabetes</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-hypertension" name="health-condition-one"
                            value="Hypertension">
                          <label for="self-conditions-hypertension">Hypertension</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-obese" name="health-condition-one" value="Obese">
                          <label for="self-conditions-obese">Obese</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-anemia" name="health-condition-one" value="Anemia">
                          <label for="self-conditions-anemia">Anemia</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="health-condition-one-other" name="health-condition-one"
                            value="health-condition-one-other">
                          <label for="health-condition-one-other">If others, specify</label>
                          <input type="text" id="otherValue" name="health-condition-one-other" class="hidden" />
                        </div>
                      </div>
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
            <div class="button-next">
              <button class="button button-primary">Next
              </button>
            </div>

          </div>



          <!-- MODAl - CONFIRMATION -->
          <div class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">
            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">Confirm submission</h2>
              </div>
              <p class="text-center">message</p>
              <div class="modal-buttons">
                <a class="button button-cancel">Go back</a>
                <button type="submit" name='submit' value="submit" class="button button-primary">Submit</button>
              </div>
            </div>
          </div>
        </form>



      </div>

      <!-- 2 -->
      <!-- Appointment checkpoint -->
      <div data-board-page="2"
        class="appointment-checkpoint-stage board-page <?php echo $board_page == 2?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Appointment details</h2>
        </div>
        <!-- Form -->
        <form action="/" class="form" method="post">
          <!-- Tab -->
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo '#'.$appoint -> transact_id ?>"
                  disabled>
              </div>
              <!-- chief complaint -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $consultInfo['chief_complaint'] ?>"
                  disabled>
              </div>
              <!-- Date appointment submitted -->
              <div class="form-input-box input-one ">
                <label for="middlename">Date appointment submitted</label>
                <input type="text" name="middlename" id="middlename"
                  value="<?php echo date('l jS \of F Y h:i a', strtotime($appointInfo['appoint_date_submitted'])); ?>"
                  disabled>
              </div>

            </div>
            <!-- 2 -->
            <div class="form-input-parent">
              <!-- Appointment status -->
              <div class="form-input-box input-one">
                <label for="lastname">Appointment status</label>
                <input type="text" class="status-pending" name="appoint-status" id="lastname" value="PENDING" disabled>
              </div>
              <!-- Assigned RDN -->
              <div class="form-input-box input-one">
                <label for="lastname">Assigned RDN</label>
                <input class="status-declineds status-pending" type="text" name="rdn-assigned" value="PENDING" disabled>
              </div>
            </div>
            <!-- 3 -->
            <div class="form-input-parent flex-center">
              <!-- img -->
              <div class="list-rnd-box grid-box card">
                <div class="list-rnd-image flex-center">
                  <img src="../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
                </div>
                <div class="list-rnd-info text-center">
                  <p class="assigned-rnd">PENDING</p>
                  <a href="#" class="text-uppercase text-center profile-link">view profile</a>
                </div>
              </div>
            </div>
          </div>

          <div class="form-button">

            <!-- prev -->
            <div class="button-prev">
              <button class="button">prev</button>
            </div>
            <!-- middle -->
            <div>
              <p class="text-uppercase appoint-status-time"><i class="fa-regular fa-clock"></i>
                <span>approximate 10 minutes</span>
              </p>
            </div>
            <!-- next -->
            <div class="button-next">
              <button class="button button-primary" disabled>Next
              </button>
            </div>

          </div>

        </form>

      </div>

      <!-- 3 -->
      <!-- consultation -->
      <div data-board-page="3" class="consultation-stage board-page <?php echo $board_page == 3?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Consultation</h2>
        </div>
        <!-- Form -->
        <div class="form">
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Appointment Numbuh -->
              <div class="form-input-box ">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo '#'.$appoint -> transact_id ?>"
                  disabled>
              </div>
              <!-- Upcoming schedule -->
              <div class="form-input-box schedule-container">
                <div class="container-header text-center flex-center text-uppercase">
                  <p>Upcoming schedule</p>
                </div>
                <div class="list-schedule">
                  <ul>
                    <?php foreach($cheduleInfo as $schedule ) { ?>
                    <li>
                      <p><?php echo $schedule['date'] ?></p>
                      <p><?php echo date('h:i a', strtotime($schedule['time'])) ?></p>
                      <p>1 hour left</p>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
            <!-- 2 -->
            <div class="form-input-parent divider-grow">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $consultInfo['chief_complaint'] ?>"
                  disabled>
              </div>

              <!-- Date appointment submitted -->
              <div class="form-input-box input-one messenger-container ">

                <!-- actual sms  -->
                <div class="actual-message-container">
                  <!-- messege 1 -->
                  <div class="message-me messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                  <!-- messege 2 -->
                  <div class="message-you messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                  <!-- messege 3 -->
                  <div class="message-you messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                  <!-- messege 1 -->
                  <div class="message-me messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                </div>

                <!-- sms box input -->
                <div class="sms-box-container">
                  <input type="text" name="middlename" id="middlename" placeholder="Your message here">
                </div>

              </div>
            </div>
            <!-- 3 -->
            <div class="form-input-parent flex-center">
              <!-- img -->
              <div class="list-rnd-box grid-box card">
                <div class="list-rnd-image flex-center">
                  <img src="../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
                </div>
                <div class="list-rnd-info text-center">
                  <p class="assigned-rnd">DUMMY</p>
                  <a href="#" class="text-uppercase text-center profile-link">view profile</a>
                </div>
              </div>
              <!-- virtual room -->
              <div class="form-input-box virtual-room-container">
                <div class="container-header text-center flex-center text-uppercase">
                  <p>in virtual room</p>
                  <a href="https://www.youtube.com/watch?v=vvFSVIy1Nqs" target="_blank"
                    class="button mini-button">JOIN</a>
                </div>
                <div class="list-schedule">
                  <ul>
                    <li class="hidden">
                      <div class="circle"></div>
                      <p>RND Gregory Yames</p>
                    </li>
                    <li class="hidden">
                      <div class="circle"></div>
                      <p>RND Gregory Yames</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="form-button">

            <!-- prev -->
            <div class="button-prev">
              <button class="button">prev</button>
            </div>
            <!-- middle -->
            <div>
              <button class="button hidden" disabled>Submit</button>
            </div>
            <!-- next -->
            <div class="button-next">
              <button class="button  button-next button-primary" disabled>Next
              </button>
            </div>

          </div>

        </div>

      </div>

      <!-- 4 -->
      <!-- consultation checkpoint -->
      <div data-board-page="4"
        class="consultation-checkpoint-stage board-page <?php echo $board_page == 4?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Consultation result</h2>
        </div>
        <!-- Form -->
        <form action="/" class="form" method="post">
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo '#'.$appoint -> transact_id ?>"
                  disabled>
              </div>
              <!-- Date appointment submitted -->
              <div class="form-input-box input-one ">
                <label for="middlename">Date appointment submitted</label>
                <input type="text" name="middlename" id="middlename"
                  value="<?php echo date('l jS \of F Y h:i a', strtotime($appointInfo['appoint_date_submitted'])); ?>"
                  disabled>
              </div>
              <!-- Date consultation finished -->
              <div class="form-input-box input-one">
                <label for="firstname">Date consultation completed</label>
                <input type="text" name="firstname" id="firstname"
                  value="<?php echo date('l jS \of F Y h:i a', strtotime($cheduleInfo[0]["consult_date_finish"])); ?>"
                  disabled>
              </div>
            </div>
            <!-- 2 -->
            <div class="form-input-parent divider-grow">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $consultInfo['chief_complaint'] ?>"
                  disabled>
              </div>
            </div>
            <!-- 3 -->
            <div class="form-input-parent flex-center">
              <!-- Consultation result -->
              <div class="form-input-box">
                <label for="firstname">Consultation result</label>
                <input type="text" name="consultation-status" id="firstname" class="status-pending" value="DUMMY"
                  disabled>
              </div>
            </div>
          </div>

          <div class="form-button">

            <!-- prev -->
            <div class="button-prev">
              <button class="button">prev</button>
            </div>
            <!-- middle -->
            <div>
              <button class="button hidden" disabled>Submit</button>
            </div>
            <!-- next -->
            <div class="button-next">
              <button class="button button-next button-primary" disabled>Next
              </button>
            </div>

          </div>

        </form>

      </div>

      <!-- 5 -->
      <!-- Solution -->
      <div data-board-page="5" class="solution-stage board-page <?php echo $board_page == 5?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Solution</h2>
        </div>
        <!-- Form -->
        <form action="/" class="form" method="post">
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo '#'.$appoint -> transact_id ?>"
                  disabled>
              </div>
              <!-- Date appointment submitted -->
              <div class="form-input-box input-one ">
                <label for="middlename">Date appointment submitted</label>
                <input type="text" name="middlename" id="middlename"
                  value="<?php echo date('l jS \of F Y h:i a', strtotime($appointInfo['appoint_date_submitted'])); ?>"
                  disabled>
              </div>
              <!-- Date consultation finished -->
              <div class="form-input-box input-one">
                <label for="firstname">Date consultation completed</label>
                <input type="text" name="firstname" id="firstname"
                  value="<?php echo date('l jS \of F Y h:i a', strtotime($cheduleInfo[0]["consult_date_finish"])); ?>"
                  disabled>
              </div>
            </div>
            <!-- 2 -->
            <div class="form-input-parent divider-grow">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $consultInfo['chief_complaint'] ?>"
                  disabled>
              </div>
            </div>
            <!-- 3 -->
            <div class="form-input-parent flex-center">
              <!-- Upcoming schedule -->
              <div class="form-input-box schedule-container">
                <div class="container-header text-center text-uppercase">
                  <p>File</p>
                </div>
                <div class="list-schedule">
                  <ul>
                    <li>
                      <p>11/14/2022</p>
                      <p>04:30pm</p>
                      <p>1 hour left</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="form-button">

            <!-- prev -->
            <div class="button-prev">
              <button class="button">prev</button>
            </div>
            <!-- middle -->
            <div>
              <button class="button hidden" disabled>Submit</button>
            </div>
            <!-- next -->
            <div class="">
              <a href="<?php echo $path.'homepage/index.php' ?>" class="button button-primary">Home
              </a>
            </div>

          </div>

        </form>

      </div>

    </div>

  </section>

  <?php } else { ?>

  <section id="board-parent" class="board-parent ">

    <!-- Set up your appointment -->
    <form action="consultation.php" class="form search-form" method="get">

      <!-- search appoint id  -->
      <div class="form-input-parent search-parent">
        <div class="form-input-box">
          <input type="number" name="transact_id" placeholder="Enter your appointment number">
          <button type="submit" value="submit" class="button-primary">Search</button>
        </div>
      </div>

    </form>

    <div class="board-container card">
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
              <p class="text">Appointment</p>
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
              <p class="text">Consultation</p>
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
              <p class="text">Solution</p>
            </li>
          </ul>
        </div>
      </div>

      <form action="consultation.php">
        <input type="hidden" class="board-page" value="<?php echo $board_page ?>">
        <input type="hidden" class="path" value="<?php echo $path ?>">
      </form>

      <!-- 1 -->
      <!-- Appointment -->
      <div data-board-page="1" class="appointment-stage board-page <?php echo $board_page == 1?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Set your appoinment</h2>
        </div>
        <!-- Form -->
        <form action="php/set-appoint.php" method="post" class="form form-appoint-submit">
          <!-- - Appointment for -->
          <div class="appointment-for">
            <div class="form-input-parent">
              <div class="form-input-box">
                <label for="appointment-for">Appointment for</label>
                <div class="radio-box flex-center">
                  <div>
                    <input type="radio" id="myself" name="appointment-for" value="myself" checked>
                    <label for="myself">Myself</label>
                  </div>
                  <div>
                    <input type="radio" id="other" name="appointment-for" value="other">
                    <label for="other">Other</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Tab -->
          <div class="tabset">
            <!-- Tab 5 -->
            <input class='personal-tab hidden' type="radio" name="tabset" id="tab5" aria-controls="dunkles">
            <label class='personal-tab hidden' for="tab5">Personal Information</label>
            <!-- Tab 1 -->
            <input type="radio" name="tabset" id="tab1" aria-controls="marzen">
            <label for="tab1">Consultation Information</label>
            <!-- Tab 2 -->
            <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
            <label for="tab2">Food Information</label>
            <!-- Tab 3 -->
            <input type="radio" name="tabset" id="tab3" aria-controls="dunkles" checked>
            <label for="tab3">Physical Information</label>
            <!-- Tab 4 -->
            <input type="radio" name="tabset" id="tab4" aria-controls="dunkles">
            <label for="tab4">Medical Information</label>

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
                    <!-- Chief complaint -->
                    <div class="form-input-box input-one">
                      <label for="appoint-chief-complaint">Chief complaint <span>*</span></label>
                      <input list="list-complaints" name="appoint-chief-complaint" id="appoint-chief-complaint"
                        placeholder="Diet meal plan" required value="chief complaint test">
                      <datalist id="list-complaints">
                        <option value="Test">
                        <option value="Test1">
                      </datalist>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment date -->
                    <div class="form-input-box input-two">
                      <label for="appointment-date" class="text-capital">Appointment date <span>*</span></label>
                      <input type="date" name="appointment-date" id="appointment-date"
                        placeholder="Enter your middle name" required value="2002-01-01">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment time -->
                    <div class="form-input-box input-two">
                      <label for="appointment-time" class="text-capital">Appointment time <span>*</span></label>
                      <input type="time" name="appointment-time" id="appointment-time" required value="01:00">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Referral form -->
                    <div class="form-input-box input-two">
                      <label for="appointment-referral" class="text-capital">Referral form</label>
                      <input type="file" name="appointment-referral" id="appointment-referral">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Medical record -->
                    <div class="form-input-box input-two">
                      <label for="appointment-medical" class="text-capital">Medical record </label>
                      <input type="file" name="appointment-medical" id="appointment-medical">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent">
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
                    <!-- food allergies -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-allergies">Do you have any food allergies? <span>*</span></label>
                      <input type="text" name="appoint-food-allergies" id="appoint-food-allergies"
                        placeholder="Peanut, Shrimp" required value="food allergy test">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Foods you like -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-like" class="text-capital">Foods you like <span>*</span></label>
                      <input type="text" name="appoint-food-like" id="appoint-food-like" placeholder="E.g Salad, Egg"
                        required value="food like test">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Foods you dislike -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-like" class="text-capital">Foods you dislike <span>*</span></label>
                      <input type="text" name="appoint-food-dislike" id="appoint-food-dislike"
                        placeholder="E.g Seaweed, Fish" required value="food dislike test">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- type of diet -->
                    <div class="form-input-box input-two">
                      <label for="appoint-type-diet">Are you on specific type of diet? <span>*</span></label>
                      <input list="list-diet" name="appoint-type-diet" id="appoint-type-diet" placeholder="Vegan Diet"
                        required value="food type diet test">
                      <datalist id="list-diet">
                        <option value="Test">
                        <option value="Test1">
                      </datalist>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent">
                    <!-- Smoke -->
                    <div class="form-input-box form-radio-box">
                      <p>How often do you smoke <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Daily -->
                        <div>
                          <input type="radio" id="smoke-daily" checked name="smoke-level" value="1">
                          <label for="smoke-daily">Daily</label>
                        </div>
                        <!-- Weekly -->
                        <div>
                          <input type="radio" id="smoke-weekly" name="smoke-level" value="2">
                          <label for="smoke-weekly">Weekly</label>
                        </div>
                        <!-- Monthly -->
                        <div>
                          <input type="radio" id="smoke-monthly" name="smoke-level" value="3">
                          <label for="smoke-monthly">Monthly</label>
                        </div>
                        <!-- Ocassionally -->
                        <div>
                          <input type="radio" id="smoke-ocassionally" name="smoke-level" value="4">
                          <label for="smoke-ocassionally">Ocassionally</label>
                        </div>
                        <!-- Never -->
                        <div>
                          <input type="radio" id="smoke-never" name="smoke-level" value="5">
                          <label for="smoke-never">Never</label>
                        </div>
                      </div>
                    </div>
                    <!-- Drink liquor -->
                    <div class="form-input-box form-radio-box">
                      <p>How often do you drink liquor?
                        <span>*</span>
                      </p>
                      <div class="gender-con radio-default">
                        <!-- Daily -->
                        <div>
                          <input type="radio" id="drink-daily" name="drink-level" value="1">
                          <label for="drink-daily">Daily</label>
                        </div>
                        <!-- Weekly -->
                        <div>
                          <input type="radio" checked id="drink-weekly" name="drink-level" value="2">
                          <label for="drink-weekly">Weekly</label>
                        </div>
                        <!-- Monthly -->
                        <div>
                          <input type="radio" id="drink-monthly" name="drink-level" value="3">
                          <label for="drink-monthly">Monthly</label>
                        </div>
                        <!-- Ocassionally -->
                        <div>
                          <input type="radio" id="drink-ocassionally" name="drink-level" value="4">
                          <label for="drink-ocassionally">Ocassionally</label>
                        </div>
                        <!-- Never -->
                        <div>
                          <input type="radio" id="drink-never" name="drink-level" value="5">
                          <label for="drink-never">Never</label>
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
                    <!-- Actual weight -->
                    <div class="form-input-box need-metric">
                      <label for="appoint-actual-weight">Actual weight <span>*</span></label>
                      <input type="number" class="need-metrics" min='0' name="appoint-actual-weight"
                        id="appoint-actual-weight" placeholder="Enter your actual weight" required value="1">
                      <select name="metric" class="metric">
                        <option value="">KG</option>
                        <option value="spider">LBS</option>
                      </select>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Current height -->
                    <div class="form-input-box need-metric">
                      <label for="appoint-current-height" class="text-capital">Current height <span>*</span></label>
                      <input type="number" min='0' name="appoint-current-height" id="appoint-current-height"
                        placeholder="Enter your current height" required value="1">
                      <select name="metric" class="metric">
                        <option value="">ft</option>
                        <option value="spider">m</option>
                        <option value="goldfish">cm</option>
                      </select>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent ">
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
                      <label for="appoint-actual-weight">Are you currently taking any medication? <span>*</span></label>
                      <input type="text" name="appoint-medical-current-med" id="appoint-medical-current-med"
                        placeholder="E.g Ascorbic Acid" required value="medical current test">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class=" form-input-parent ">
                    <!-- health condition -->
                    <div class="form-input-box form-radio-box">
                      <p>Do you have any health condition or have been diagnosed in the past? <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="checkbox" checked id="self-conditions-diabetes" name="self-condition"
                            value="Diabetes">
                          <label for="self-conditions-diabetes">Diabetes</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-hypertension" name="self-condition"
                            value="Hypertension">
                          <label for="self-conditions-hypertension">Hypertension</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-obese" name="self-condition" value="Obese">
                          <label for="self-conditions-obese">Obese</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="self-conditions-anemia" name="self-condition" value="Anemia">
                          <label for="self-conditions-anemia">Anemia</label>
                        </div>
                        <!-- Mesomorph -->
                        <div class="hidden">
                          <input type="checkbox" id="health-condition-one-other" name="self-condition"
                            value="health-condition-one-other">
                          <label for="health-condition-one-other">If others, specify</label>
                          <input type="text" id="otherValue" name="self-condition-other" class="hidden" />
                        </div>
                      </div>
                    </div>
                    <!-- family condition -->
                    <div class="form-input-box form-radio-box">
                      <p>Is anyone in your family has any health condition in the past? <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="checkbox" checked id="family-conditions-diabetes" name="family-condition"
                            value="Diabetes">
                          <label for="family-conditions-diabetes">Diabetes</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="checkbox" id="family-conditions-hypertension" name="family-condition"
                            value="Hypertension">
                          <label for="family-conditions-hypertension">Hypertension</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="family-conditions-obese" name="family-condition" value="Obese">
                          <label for="family-conditions-obese">Obese</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="family-conditions-anemia" name="family-condition" value="Anemia">
                          <label for="family-conditions-anemia">Anemia</label>
                        </div>
                        <!-- Mesomorph -->
                        <div class="hidden">
                          <input type="checkbox" id="health-condition-one-other" name="health-condition-one"
                            value="health-condition-one-other">
                          <label for="health-condition-one-other">If others, specify</label>
                          <input type="text" id="otherValue" name="health-condition-one-other" class="hidden" />
                        </div>
                      </div>
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

          </div>

          <!-- MODAl - CONFIRMATION -->
          <div class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">

            <!-- hidden - fox ajax -->
            <input type="hidden" name="submit" value='true' id="submit">

            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">Confirm submission</h2>
              </div>
              <p class="text-center">message</p>
              <div class="modal-buttons">
                <a class="button button-cancel">Go back</a>
                <button type="submit" name='submit' value="submit" class="button button-primary">Submit</button>
              </div>
            </div>
          </div>
        </form>

      </div>

    </div>

  </section>

  <?php } ?>


  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>