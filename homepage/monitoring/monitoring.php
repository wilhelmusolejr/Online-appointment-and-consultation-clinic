<?php
  $path = "../../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path.'tools/variables.php';
  $page_title = "Monitoring";
  $monitoring = "nav-current";

  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="<?php echo $path."homepage/index.css"?>" />
<link rel="stylesheet" href="monitoring.css" />
<script src="monitoring.js" defer></script>
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
        <!-- week 1 -->
        <li class="active">
          <a href="../pending-appointment/pending-appointment.php" class="text-uppercase">
            <p>Week 1</p> <i class="fa-solid fa-chevron-right hidden"></i>
          </a>
          <ul class="hiddens">
            <li><a class="current-day" href="#">Day 1</a></li>
            <li><a class="lock" href="#">Day 2</a></li>
            <li><a class="lock" href="#">Day 3</a></li>
            <li><a class="lock" href="#">Day 4</a></li>
            <li><a class="lock" href="#">Day 5</a></li>
            <li><a class="lock" href="#">Day 6</a></li>
            <li><a class="lock" href="#">Day 7</a></li>
          </ul>
        </li>
        <!-- week 2 -->
        <li class="approved-appointment <?php echo isset($approved) ? "active" :"" ?>"><a
            href="../approved-appointment/approved-appointment.php" class="text-uppercase">
            <p>Week 2 </p> <i class="fa-solid fa-lock"></i>
          </a></li>
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

        <!-- Form -->
        <form action="php/set-appoint.php" method="post" class="form form-appoint-submit" enctype="multipart/form-data">
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
                    <div class="form-input-box input-one">
                      <label for="appoint-chief-complaint">Desirable Body Weight <span>*</span></label>
                      <input type='number' name="appoint-chief-complaint" id="appoint-chief-complaint"
                        placeholder="Enter your desirable body weight" required>
                      <p class="form-error-message hidden">Error</p>
                    </div>

                    <!-- Current body weight -->
                    <div class="form-input-box input-one">
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