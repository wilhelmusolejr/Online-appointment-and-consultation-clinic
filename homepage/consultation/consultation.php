<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    require_once '../../tools/variables.php';
    $page_title = "Consultation";
    $consultation = 'nav-current';
    $path = "../../";

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="consultation.css" />
<script src="../index.js" defer></script>
<script src="consultation.js" defer></script>
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
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
            quibusdam excepturi.
          </p>
          <a href="#" class="button button-primary">Book now!</a>
        </div>
      </div>

    </main>

  </header>

  <section class="appointment-parent appointment-process">
    <div class="appointment-container sizing-secondary card">
      <!-- step -->
      <div class="appointment-step text-center">
        <p>123</p>
      </div>
      <!-- header -->
      <div class="appointment-header text-center">
        <h2 class="text-uppercase">Set your appointment</h2>
      </div>
      <!-- appointment for -->
      <div class="appointment-for text-center">
        <p>Appointment for</p>
        <div class="option-container flex-center">
          <div class="option option1 card flex-center">
            <input type="radio" id="myself" name="appointment-for" value="myself">
            <label for="myself">Myself</label>
          </div>
          <div class="option option2 card flex-center">
            <input type="radio" id="other" name="appointment-for" value="other">
            <label for="other">Other</label>
          </div>
        </div>
      </div>
      <form action="/" class="form form-group-input">
        <div class="tabset">
          <!-- Tab 1 -->
          <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
          <label for="tab1">Consultation Information</label>
          <!-- Tab 2 -->
          <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
          <label for="tab2">Physical Information</label>
          <!-- Tab 3 -->
          <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
          <label for="tab3">Food Information</label>

          <div class="tab-panels">
            <section id="marzen" class="tab-panel">
              <!-- Consultation information -->
              <div class="form-group">
                <div class="form-group-header text-uppercase">
                  <p>Consultation Information</p>
                </div>
                <div class="appointment-board">
                  <div class="form-input-parent left">
                    <!-- Chief complaint -->
                    <div class="chief form-input-box">
                      <label for="chief-complaint">Chief complaint <span>*</span></label>
                      <input list="complaints" name="chief-complaint" placeholder="Diet meal plan">
                      <datalist id="complaints">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Chrome">
                        <option value="Opera">
                        <option value="Safari">
                      </datalist>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment date -->
                    <div class="two form-input-box">
                      <label for="appointment-date">Appointment date <span>*</span></label>
                      <input type="date" name="appointment-date" id="appointment-date" placeholder="File">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Appointment time -->
                    <div class="two form-input-box">
                      <label for="appointment-time">Appointment time <span>*</span></label>
                      <input type="time" name="appointment-time" id="appointment-time" placeholder="File">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Referral Form -->
                    <div class="two form-input-box">
                      <label for="file-upload-referral">Referral form</label>
                      <input type="file" name="file-upload-referral" id="file-upload-referral" placeholder="File">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Medical Form -->
                    <div class="two form-input-box">
                      <label for="file-upload-medical">Medical record</label>
                      <input type="file" name="file-upload-medical" id="file-upload-medical" placeholder="File">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                  <div class="form-input-parent right">
                    <!-- Additional information -->
                    <div class="form-input-box">
                      <label for="file-upload-medical">Additional information</label>
                      <textarea id="w3review" name="w3review" rows="5" class="card"
                        placeholder="Give additional information about your chief complaint."></textarea>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section id="rauchbier" class="tab-panel">
              <!-- personal information -->
              <div class="form-group">
                <div class="form-group-header text-uppercase">
                  <p>Personal Information</p>
                </div>
                <div class="form-input-parent">
                  <!-- first name -->
                  <div class="form-input-box">
                    <label for="firstname" class="text-capital">First name <span>*</span></label>
                    <input type="text" name="firstname" id="firstname" placeholder="Enter your first name">
                    <p class="form-error-message hidden">Error</p>
                  </div>
                  <!-- middle name -->
                  <div class="form-input-box">
                    <label for="middlename" class="text-capital">Middle name <span>*</span></label>
                    <input type="text" name="middlename" id="middlename" placeholder="Enter your middle name">
                    <p class="form-error-message hidden">Error</p>
                  </div>
                  <!-- last name -->
                  <div class="form-input-box">
                    <label for="lastname" class="text-capital">Last name <span>*</span></label>
                    <input type="text" name="lastname" id="lastname" placeholder="Enter your last name">
                    <p class="form-error-message hidden">Error</p>
                  </div>
                  <!-- gender -->
                  <div class="gender-form form-input-box">
                    <label for="gender" class="text-capital">Gender <span>*</span></label>
                    <div class="gender-con flex-center">
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
                  <div class="form-input-box">
                    <label for="birthdate" class="text-capital">Birthdate <span>*</span></label>
                    <input type="date" name="birthdate" id="birthdate">
                    <p class="form-error-message hidden">Error</p>
                  </div>
                </div>
              </div>
            </section>
            <section id="dunkles" class="tab-panel">
              <!-- contact information -->
              <div class="form-group">
                <div class="form-group-header text-uppercase">
                  <p>Contact Information</p>
                </div>
                <div class="form-input-parent">
                  <!-- first name -->
                  <div class="form-input-box">
                    <label for="reg-mob" class="text-capital">Mobile number <span>*</span></label>
                    <input type="text" name="reg-mob" id="reg-mob" placeholder="Enter your mobile number">
                    <p class="form-error-message hidden">Error</p>
                  </div>
                  <!-- middle name -->
                  <div class="form-input-box">
                    <label for="reg-email" class="text-capital">Email address <span>*</span></label>
                    <input type="email" name="reg-email" id="reg-email" placeholder="Enter your middle name">
                    <p class="form-error-message hidden">Error</p>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </form>
      <div class="appointment-buttons">
        <!-- previous -->
        <div class="">
          <a href="#" class="button hidden button-primary">Prev</a>
        </div>
        <!-- next -->
        <div>
          <button class="button button-disabled button-submit" disabled>Submit</button>
        </div>
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