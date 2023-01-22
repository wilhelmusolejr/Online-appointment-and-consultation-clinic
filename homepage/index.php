<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    require_once '../tools/variables.php';
    $page_title = "Homepage";
    $home = "nav-current";
    $path = "../";

    require_once '../includes/starterOne.php';
?>
<link rel="stylesheet" href="index.css" />
<script src="index.js" defer></script>
<?php require_once '../includes/starterTwo.php'; ?>


<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once '../includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once '../includes/navigator.php'; ?>

    <!-- main content hero header -->
    <main>
      <div class="sizing-secondary">
        <div class="main-text ">
          <h1 class="text-uppercase">
            Reach your RND<span class="text-initial">s</span> from anywhere
          </h1>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
            quibusdam excepturi.
          </p>
          <a href="#" class="button button-primary">Book now!</a>
        </div>
        <div class="main-image">
          <img src="../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="" />
        </div>
      </div>
  </header>

  <!-- DATA INFO -->
  <div class="data-info-parent flex-center">
    <div class="data-info-container flex-center text-uppercase text-center">
      <div class="data-info-box flex-center card">
        <h3>18</h3>
        <p>RND<span class="text-initial">s</span></p>
      </div>
      <div class="data-info-box flex-center card">
        <h3>18</h3>
        <p>RND<span class="text-initial">s</span></p>
      </div>
    </div>
  </div>

  <!-- SECTION - Quick Solution -->
  <section class="quick-solution-parent sizing-secondary">
    <div class="section-header-parent text-center">
      <h2 class="text-capital">Quick solution for scheduling with <span class="text-initial">RNDs</span></h2>
    </div>
    <div class="quick-solution-step-container flex-center grid-container">
      <div class="quick-step-box flex-center grid-box card">
        <div class="quick-emoji card">
          <i class="fa-solid fa-globe"></i>
        </div>
        <div class="quick-text">
          <h3 class="text-uppertext">Appoint</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, laborum!</p>
        </div>
        <p class="hidden">1</p>
      </div>
      <div class="quick-step-box flex-center grid-box card">
        <div class="quick-emoji card">
          <i class="fa-solid fa-globe"></i>
        </div>
        <div class="quick-text">
          <h3 class="text-uppertext">Appoint</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, laborum!</p>
        </div>
        <p class="hidden">1</p>
      </div>
      <div class="quick-step-box flex-center grid-box card">
        <div class="quick-emoji card">
          <i class="fa-solid fa-globe"></i>
        </div>
        <div class="quick-text">
          <h3 class="text-uppertext">Appoint</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, laborum!</p>
        </div>
        <p class="hidden">1</p>
      </div>
    </div>
  </section>

  <!-- SECTION - Tool Banner -->
  <section class="tool-banner text-center">

    <div class="tool-banner-container card sizing-main">

      <div class="form-header text-center">
        <h2 class="text-uppercase">Body mass index</h2>
      </div>

      <div class="form">
        <!-- height group -->
        <div class="form-group">
          <div class="form-group-header">
            <p>Your height</p>
          </div>
          <div class="form-input-parent text-center">
            <!-- feet -->
            <div class="form-input-box">
              <input type="number" name="feet" id="feet">
              <label for="feet">feet</label>
            </div>
            <!-- inches -->
            <div class="form-input-box">
              <input type="number" name="inches" id="inches">
              <label for="inches">inches</label>
            </div>
          </div>
        </div>

        <!-- weight group -->
        <div class="form-group">
          <div class="form-group-header">
            <p>Your weight</p>
          </div>
          <div class="form-input-parent text-center">
            <div class="form-input-box">
              <input type="number" name="pounds" id="pounds">
              <label for="pounds">pounds</label>
            </div>
          </div>
        </div>
        <button class="button button-secondary">Compute bmi</button>
      </div>

    </div>
    <a href="#" class="button button-primary">See more tools</a>
  </section>

  <!-- SECTION - List of RND -->
  <section class="list-rnd-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-capital">Meet our <span class="text-initial">RNDs</span></h2>
    </div>

    <div class="list-rnd-container flex-center grid-container">
      <!-- 1 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
      <!-- 2 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
      <!-- 3 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
    </div>

    <a href="#" class="button button-primary">See more</a>
  </section>

  <!-- SECTION - SLIDE -->
  <section class="feedback-parent flex-center">
    <div class="section-header-parent text-center">
      <h2 class="text-capital">Our patients feedback about us</h2>
    </div>
    <div class="feedback-container flex-center sizing-secondary">
      <div class="feedback-box">
        <div class="feedback-image flex-center">
          <img src="../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="feedback-info">
          <h3 class="text-capital feedback-name">Wilhelmus Ole Jr</h3>
          <p class="feedback-message">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quas libero optio
            eaque doloremque architecto fugit quos ad incidunt placeat?</p>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php require_once '../includes/footer.php'; ?>


  <!-- FLOATERS -->
  <!-- MODAL -->
  <div class="modal-login-reg overlay-black flex-center hidden">

    <!-- Floating model -->
    <div class="modal-container login-container sizing-secondary">

      <!-- login form -->
      <div class="modal-form-parent login-form-parent flex-center hidden">
        <div class="modal-form-container login-form-container sizing-main">

          <!-- HEADER -->
          <div class="form-header text-center">
            <h2 class="text-uppercase">Login</h2>
          </div>

          <!-- form -->
          <form action="/" method="post" class="form sizing-main">

            <!-- username -->
            <div class="username-form form-group">
              <div class="form-input-parent">
                <div class="form-input-box">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" placeholder="Enter your email">
                  <p class="form-error-message hidden">Error</p>
                </div>
              </div>
            </div>

            <!-- password -->
            <div class="password-form form-group">
              <div class="form-input-parent">
                <div class="form-input-box">
                  <label for="password">Password</label>
                  <input type="text" name="password" id="password" placeholder="Enter your password">
                  <p class="form-error-message hidden">Error</p>
                </div>
              </div>
            </div>

            <!-- remember me baby -->
            <div class="remember-form form-group">
              <div class="form-input-parent">
                <input type="checkbox" name="remember-account" id="remember-account">
                <label for="remember-account" class="cursor-pointer">Remember me</label>
              </div>
              <div>
                <a href="#">Forgot password?</a>
              </div>
            </div>

            <!-- button submit -->
            <div class="text-center">
              <button class="button button-primary submit">Login</button>
            </div>
          </form>

          <!-- alternative login -->
          <div class="alternative-login-parent flex-center">
            <p>Or login using: </p>
            <a href="#"><i class="fa-brands fa-google"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
          </div>

          <!-- signup button -->
          <div class="signup-parent">
            <p>Not a member? <a href="#">Sign up</a></p>
          </div>
        </div>
      </div>

      <!-- Register form -->
      <div class="modal-form-parent register-form-parent flex-center hidden">
        <div class="modal-form-container register-form-container sizing-main">

          <!-- header -->
          <div class="form-header text-center">
            <h2 class="text-uppercase">Create an account</h2>
          </div>

          <!-- form -->
          <form action="/" method="post" class="form form-group-input sizing-main">

            <!-- Personal Info -->
            <div class="username-form form-group">
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

            <!-- Contact Info -->
            <div class="username-form form-group">
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

            <!-- Account Info -->
            <div class="username-form form-group">
              <div class="form-group-header text-uppercase">
                <p>Account Information</p>
              </div>
              <div class="form-input-parent">
                <!-- first name -->
                <div class="form-input-box">
                  <label for="reg-pass" class="text-capital">Password <span>*</span></label>
                  <input type="password" name="reg-pass" id="reg-pass" placeholder="Enter your password">
                  <p class="form-error-message hidden">Error</p>
                </div>
                <!-- middle name -->
                <div class="form-input-box">
                  <label for="reg-pass-confirm" class="text-capital">Email address <span>*</span></label>
                  <input type="text" name="reg-pass-confirm" id="reg-pass-confirm" placeholder="Confirm your password">
                  <p class="form-error-message hidden">Error</p>
                </div>
              </div>
            </div>

            <!-- remember me baby -->
            <div class="remember-form form-group">
              <div class="form-input-parent">
                <input type="checkbox" name="reg-terms" id="reg-terms">
                <label for="reg-terms" class="cursor-pointer">I agree to the <a class="hiddens" href="#">Terms of
                    Services and Privacy Policy</a>.</label>
              </div>
            </div>

            <!-- button submit -->
            <div class="text-center">
              <button class="button button-primary submit">Register</button>
            </div>

          </form>

          <!-- alternative login -->
          <div class="alternative-login-parent flex-center hidden">
            <p>Or login using: </p>
            <a href="#"><i class="fa-brands fa-google"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
          </div>

          <!-- signup button -->
          <div class="signup-parent hidden">
            <p>Not a member? <a href="#">Sign up</a></p>
          </div>
        </div>
      </div>

      <!-- login image -->
      <div class="modal-image card">
      </div>

      <!-- humburger menu -->
      <i class="fa-solid fa-xmark"></i>

    </div>

  </div>

</body>

</html>