<?php 
    $path = "../../";

    require_once $path.'classes/appoint.class.php';

    require_once $path.'tools/variables.php';
    $page_title = "Consultation";
    $consultation = 'nav-current';

    session_start();

    $board_page = 1;

    if(isset($_GET['appoint_id'])) {
      // print_r($_GET['appoint_id']);
      
      $appoint = new appoint;
      $appoint-> appointId = $_GET['appoint_id'];
      $res = $appoint->validate();
      if($res){
          // print_r($res);
          $board = $res;

          $board_page = $res['board_page'];
      }

    }

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

  <section id="board-parent" class="board-parent">

    <!-- Set up your appointment -->
    <form action="consultation.php" class="form search-form" method="get">

      <!-- search appoint id  -->
      <div class="form-input-parent search-parent">
        <div class="form-input-box">
          <input type="number" name="appoint_id" placeholder="Enter your appointment number">
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

      <form action="">
        <input type="hidden" class="board-page" value="<?php echo $board_page ?>">
      </form>

      <!-- 1 -->
      <!-- Appointment -->
      <div data-board-page="1" class="appointment-stage board-page <?php echo $board_page == 1?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Set your appoinment</h2>
        </div>
        <!-- Form -->
        <form action="/" class="form" method="post">
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
            <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
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
                      <input type="text" name="firstname" id="firstname" placeholder="Enter your first name">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- middle name -->
                    <div class="form-input-box input-two">
                      <label for="middlename" class="text-capital">Middle name <span>*</span></label>
                      <input type="text" name="middlename" id="middlename" placeholder="Enter your middle name">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- last name -->
                    <div class="form-input-box input-two">
                      <label for="lastname" class="text-capital">Last name <span>*</span></label>
                      <input type="text" name="lastname" id="lastname" placeholder="Enter your last name">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- gender -->
                    <div class="gender-form form-input-box input-two">
                      <label for="gender" class="text-capital">Gender <span>*</span></label>
                      <div class="gender-con radio-box flex-center">
                        <div>
                          <input type="radio" id="male" name="gender" value="Male">
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
                      <input type="date" name="birthdate" id="birthdate">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent">
                    <!-- Mobile -->
                    <div class="form-input-box input-two">
                      <label for="reg-mob" class="text-capital">Mobile number <span>*</span></label>
                      <input type="text" name="reg-mob" id="reg-mob" placeholder="Enter your mobile number">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Email -->
                    <div class="form-input-box input-two">
                      <label for="reg-email" class="text-capital">Email address <span>*</span></label>
                      <input type="email" name="reg-email" id="reg-email" placeholder="Enter your middle name">
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
                        placeholder="Diet meal plan">
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
                        placeholder="Enter your middle name">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment time -->
                    <div class="form-input-box input-two">
                      <label for="appointment-time" class="text-capital">Appointment time <span>*</span></label>
                      <input type="time" name="appointment-time" id="appointment-time">
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
                        placeholder="Peanut, Shrimp" required>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Foods you like -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-like" class="text-capital">Foods you like <span>*</span></label>
                      <input type="text" name="appoint-food-like" id="appoint-food-like" placeholder="E.g Salad, Egg">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Foods you dislike -->
                    <div class="form-input-box input-two">
                      <label for="appoint-food-like" class="text-capital">Foods you dislike <span>*</span></label>
                      <input type="text" name="appoint-food-dislike" id="appoint-food-dislike"
                        placeholder="E.g Seaweed, Fish">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment time -->
                    <div class="form-input-box input-two">
                      <label for="appoint-type-diet">Are you on specific type of diet? <span>*</span></label>
                      <input list="list-diet" name="appoint-type-diet" id="appoint-type-diet" placeholder="Vegan Diet">
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
                          <input type="radio" id="smoke-daily" name="smoke-level" value="smoke-daily">
                          <label for="smoke-daily">Daily</label>
                        </div>
                        <!-- Weekly -->
                        <div>
                          <input type="radio" id="smoke-weekly" name="smoke-level" value="smoke-weekly">
                          <label for="smoke-weekly">Weekly</label>
                        </div>
                        <!-- Monthly -->
                        <div>
                          <input type="radio" id="smoke-monthly" name="smoke-level" value="smoke-monthly">
                          <label for="smoke-monthly">Monthly</label>
                        </div>
                        <!-- Ocassionally -->
                        <div>
                          <input type="radio" id="smoke-ocassionally" name="smoke-level" value="smoke-ocassionally">
                          <label for="smoke-ocassionally">Ocassionally</label>
                        </div>
                        <!-- Never -->
                        <div>
                          <input type="radio" id="smoke-never" name="smoke-level" value="smoke-never">
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
                          <input type="radio" id="drink-daily" name="drink-level" value="drink-daily">
                          <label for="drink-daily">Daily</label>
                        </div>
                        <!-- Weekly -->
                        <div>
                          <input type="radio" id="drink-weekly" name="drink-level" value="drink-weekly">
                          <label for="drink-weekly">Weekly</label>
                        </div>
                        <!-- Monthly -->
                        <div>
                          <input type="radio" id="drink-monthly" name="drink-level" value="drink-monthly">
                          <label for="drink-monthly">Monthly</label>
                        </div>
                        <!-- Ocassionally -->
                        <div>
                          <input type="radio" id="drink-ocassionally" name="drink-level" value="drink-ocassionally">
                          <label for="drink-ocassionally">Ocassionally</label>
                        </div>
                        <!-- Never -->
                        <div>
                          <input type="radio" id="drink-never" name="drink-level" value="drink-never">
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
                        placeholder="Enter your actual weight">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Current height -->
                    <div class="form-input-box ">
                      <label for="appoint-current-height" class="text-capital">Current height <span>*</span></label>
                      <input type="number" min='0' name="appoint-current-height" id="appoint-current-height"
                        placeholder="Enter your current height">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <!-- right -->
                  <div class="form-input-parent ">
                    <!-- Body type -->
                    <div class="form-input-box form-radio-box">
                      <p>Physical activity <span>*</span></p>
                      <div class="gender-con radio-default">
                        <!-- Endomorph -->
                        <div>
                          <input type="checkbox" id="body-type-endomorph" name="body-type" value="endomorph">
                          <label for="body-type-endomorph">Endomorph</label>
                        </div>
                        <!-- Ectomorph -->
                        <div>
                          <input type="checkbox" id="body-type-ectomorph" name="body-type" value="ectomorph">
                          <label for="body-type-ectomorph">Ectomorph</label>
                        </div>
                        <!-- Mesomorph -->
                        <div>
                          <input type="checkbox" id="body-type-mesomorph" name="body-type" value="mesomorph">
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
                          <input type="radio" id="physical-sedentary" name="physical-activity" value="sedentary">
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
                          <input type="radio" id="gain-easily" name="gain-weight-level" value="easily">
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
                          <input type="radio" id="lose-easily" name="lose-weight-level" value="easily">
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
                        placeholder="E.g Ascorbic Acid" data-role="taginput">
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
                          <input type="checkbox" id="self-conditions-diabetes" name="health-condition-one"
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
                          <input type="checkbox" id="self-conditions-diabetes" name="health-condition-one"
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
              <button class="button button-primary">Submit
              </button>
            </div>

          </div>
        </form>

        <!-- MODAl - CONFIRMATION -->
        <div class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">
          <div class="modal-container modal-notif-container sizing-secondary">
            <div class="modal-header text-center">
              <h2 class="text-uppercase">Confirm submission</h2>
            </div>
            <p class="text-center">message</p>
            <div class="modal-buttons">
              <button class="button button-previous">Go back</button>
              <button class="button button-primary">Submit</button>
            </div>
          </div>
        </div>

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
              <div class="form-input-box input-two">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $board['appoint_id'] ?>" disabled>
              </div>
              <!-- Appointment status -->
              <div class="form-input-box input-two">
                <label for="lastname">Appointment status</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $board['appoint_status'] ?>"
                  disabled>
              </div>
              <!-- Date appointment submitted -->
              <div class="form-input-box input-two ">
                <label for="middlename">Date appointment submitted</label>
                <input type="date" class="status-pending" name="middlename" id="middlename" value="1990-05-02" disabled>
              </div>
              <!-- Assigned RDN -->
              <div class="form-input-box input-two">
                <label for="lastname">Assigned RDN</label>
                <input class="status-declined" type="text" name="lastname" id="lastname"
                  value="<?php echo $board['appoint_rnd_status'] ?>" disabled>
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
                  <p>Gregory Yames RND</p>
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
              <button class="button hidden" disabled>Submit</button>
            </div>
            <!-- next -->
            <div class="button-next">
              <button class="button button-primary">Next
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
        <form action="/" class="form" method="post">
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Appointment Numbuh -->
              <div class="form-input-box ">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="#123456" disabled>
              </div>
              <!-- Upcoming schedule -->
              <div class="form-input-box schedule-container">
                <div class="container-header text-center text-uppercase">
                  <p>Upcoming schedule</p>
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
            <!-- 2 -->
            <div class="form-input-parent divider-grow">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="Diet meal plan" disabled>
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
                  <p>Gregory Yames RND</p>
                  <a href="#" class="text-uppercase text-center profile-link">view profile</a>
                </div>
              </div>
              <!-- virtual room -->
              <div class="form-input-box virtual-room-container">
                <div class="container-header text-center text-uppercase">
                  <p>in virtual room</p>
                </div>
                <div class="list-schedule">
                  <ul>
                    <li class="hidden">
                      <div class="circle"></div>
                      <p>RND Gregory Yames</p>
                    </li>
                    <li class="hiddens">
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
              <button class="button button-primary">Next
              </button>
            </div>

          </div>

        </form>

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
                <input type="text" name="firstname" id="firstname" value="#123456" disabled>
              </div>
              <!-- Upcoming schedule -->
              <div class="form-input-box input-one">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="#123456" disabled>
              </div>
            </div>
            <!-- 2 -->
            <div class="form-input-parent divider-grow">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="Diet meal plan" disabled>
              </div>
            </div>
            <!-- 3 -->
            <div class="form-input-parent flex-center">
              <!-- Appointment Numbuh -->
              <div class="form-input-box">
                <label for="firstname">Consultation result</label>
                <input type="text" name="firstname" id="firstname" value="Diet meal plan" disabled>
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
              <button class="button button-primary">Next
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
              <div class="form-input-box ">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="#123456" disabled>
              </div>
              <!-- Upcoming schedule -->
              <div class="form-input-box ">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="#123456" disabled>
              </div>
              <!-- Upcoming schedule -->
              <div class="form-input-box ">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="#123456" disabled>
              </div>
            </div>
            <!-- 2 -->
            <div class="form-input-parent divider-grow">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="Diet meal plan" disabled>
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
            <div class="button-next">
              <button class="button button-primary">Home
              </button>
            </div>

          </div>

        </form>

      </div>

    </div>

  </section>



  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>