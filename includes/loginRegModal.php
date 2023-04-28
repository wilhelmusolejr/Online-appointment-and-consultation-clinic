<?php 
  require_once $path.'php/config.php';
?>

<div class="modal-parent modal-data-parent modal-login-reg overlay-black flex-center hidden">

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
        <form method="post" class="form form-login sizing-main">

          <!-- path -->
          <input type="hidden" class="path" value="<?php echo $path ?>">
          <p class="form-error-message"></p>
          <!-- username -->
          <div class="username-form form-group">
            <div class="form-input-parent">
              <div class="form-input-box">
                <label for="username">Email address</label>
                <input type="text" name="username" id="username" placeholder="Enter your email" required>
              </div>
            </div>
          </div>

          <!-- password -->
          <div class="password-form form-group">
            <div class="form-input-parent">
              <div class="form-input-box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
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
              <a class="forgot-password" href="#">Forgot password?</a>
            </div>
          </div>

          <div class="stopper hidden"></div>
          <?php require $path."includes/spinner.php" ?>

          <!-- button submit -->
          <div class="text-center">
            <button type="submit" value="Login" name="login" class="button button-primary submit">Login</button>
          </div>
        </form>

        <!-- form -->
        <form method="post" class="form form-reset-password sizing-main hidden">

          <!-- path -->
          <input type="hidden" class="path" value="<?php echo $path ?>">
          <p class="form-error-message"></p>

          <!-- username -->
          <div class="username-form form-group">
            <div class="form-input-parent">
              <div class="form-input-box">
                <label for="username">Email address</label>
                <input type="text" name="username" id="username" placeholder="Enter your email" required>
              </div>
            </div>
          </div>

          <div class="stopper hidden"></div>
          <?php require $path."includes/spinner.php" ?>


          <!-- button submit -->
          <div class="text-center">
            <a class="button button-cancel ">Back</a>
            <button type="submit" value="Login" name="login" class="button button-primary submit">Reset</button>
          </div>
        </form>


        <!-- alternative login -->
        <div class="alternative-login-parent flex-center ">
          <p>Or login using: </p>
          <a href="<?php 
              $login = true;
              $client = googleClient($login);
          echo $client->createAuthUrl(); 
          ?>"><i class="fa-brands fa-google"></i></a>
        </div>

        <!-- signup button -->
        <div class="signup-parent ">
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
        <form action="/" method="post" class="form form-register-manual form-group-input sizing-main">

          <!-- path -->
          <input type="hidden" class="path" value="<?php echo $path ?>">
          <input type="hidden" class="viaManual" value="<?php echo $path ?>">

          <!-- SIGN UP USING CHUCHU -->
          <div class="form-group sign-up-button-parent">
            <div class="form-input-parent">
              <div class="form-input-box sign-up-google text-center">
                <a href="<?php 

                    $login = false;
                    $client = googleClient($login);

                echo $client->createAuthUrl(); 
                ?>"><i class="fa-brands fa-google"></i>Sign up using
                  google</a>
              </div>
            </div>
          </div>

          <!-- account type -->
          <div class="form-group">
            <div class="form-input-parent">
              <div class="form-input-box">
                <label for="account-type" class="text-capital">Account type<span>*</span></label>
                <select id="account-type" required name="account-type">
                  <option value="">--</option>
                  <option value="Student" selected>Student</option>
                  <option value="Faculty">Faculty</option>
                  <option value="Guest">Guest</option>
                  <option value="Alumni">Alumni</option>
                </select>
                <p class="form-error-message hidden">Error</p>
              </div>
            </div>
          </div>

          <!-- Personal Info -->
          <div class="username-form form-group">
            <div class="form-group-header text-uppercase">
              <p>Personal Information</p>
            </div>
            <div class="form-input-parent">
              <!-- first name -->
              <div class="form-input-box">
                <label for="firstname" class="text-capital">First name <span>*</span></label>
                <input type="text" name="firstname" id="firstname" required placeholder="Enter your first name"
                  value="<?php echo rand(10,1000) ?>">
                <!-- <p class="form-error-message hidden">Error</p> -->
              </div>
              <!-- middle name -->
              <div class="form-input-box">
                <label for="middlename" class="text-capital">Middle name </label>
                <input type="text" name="middlename" id="middlename" placeholder="Enter your middle name">
                <!-- <p class="form-error-message hidden">Error</p> -->
              </div>
              <!-- last name -->
              <div class="form-input-box">
                <label for="lastname" class="text-capital">Last name <span>*</span></label>
                <input type="text" name="lastname" id="lastname" required placeholder="Enter your last name"
                  value="Tame">
                <!-- <p class="form-error-message hidden">Error</p> -->
              </div>
              <!-- gender -->
              <div class="gender-form form-input-box">
                <label for="gender" class="text-capital">Sex <span>*</span></label>
                <div class="gender-con radio-box flex-center">
                  <div>
                    <input type="radio" id="reg-male" name="gender" checked required value="Male" checked>
                    <label for="reg-male">Male</label>
                  </div>
                  <div>
                    <input type="radio" id="reg-female" name="gender" required value="Female">
                    <label for="reg-female">Female</label>
                  </div>
                </div>
                <!-- <p class="form-error-message hidden">Error</p> -->
              </div>
              <!-- birth date -->
              <div class="form-input-box">
                <label for="birthdate" class="text-capital">Birthdate <span>*</span></label>
                <input type="date" name="birthdate" required id="birthdate" max="<?php echo date("Y-m-d") ?>"
                  value="<?php echo rand(1980, 2010) ?>-05-02">
                <!-- <p class="form-error-message hidden">Error</p> -->
              </div>
            </div>
          </div>

          <!-- Contact Info -->
          <div class="contact-info-form username-form form-group">
            <div class="form-group-header text-uppercase">
              <p>Contact Information</p>
            </div>
            <div class="form-input-parent">
              <!-- Mobile -->
              <div class="form-input-box">
                <label for="reg-mob" class="text-capital">Mobile number <span>*</span></label>
                <input type="text" name="reg-mob" id="reg-mob" value="093434343" required
                  placeholder="Enter your mobile number">
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- Email -->
              <div class="form-input-box">
                <label for="reg-email" class="text-capital">Email address <span>*</span></label>
                <input type="email" name="reg-email" id="reg-email" value="<?php echo rand(15,355)."@testdummy.com"?> "
                  required placeholder="Enter your middle name">
                <p class="form-error-message"></p>
              </div>
            </div>
          </div>

          <!-- Account Info -->
          <div class="account-info-form form-group">
            <div class="form-group-header text-uppercase">
              <p>Account Information</p>
            </div>
            <div class="form-input-parent">
              <!-- first name -->
              <div class="password form-input-box">
                <label for="reg-pass" class="text-capital">Password <span>*</span></label>
                <input type="password" name="reg-pass" id="reg-pass" value="Qw0905!Dummy" required
                  placeholder="Enter your password">
                <p class="form-error-message"></p>
              </div>
              <!-- middle name -->
              <div class="confirm-password form-input-box">
                <label for="reg-pass-confirm" class="text-capital">Confirm Password <span>*</span></label>
                <input type="password" name="reg-pass-confirm" value="Qw0905!Dummy" id="reg-pass-confirm" required
                  placeholder="Confirm your password">
                <p class="form-error-message"></p>
              </div>
            </div>
          </div>

          <!-- remember me baby -->
          <div class="remember-form form-group">
            <div class="form-input-parent">
              <input type="checkbox" name="reg-terms" id="reg-terms" checked required>
              <label for="reg-terms" class="cursor-pointer">I agree to the <a target="_blank" class="hiddens"
                  href="<?php echo $path."terms-condition.php" ?>">Terms of
                  Services and Privacy Policy</a>.</label>
            </div>
          </div>

          <input type="hidden" name="submit" value="submit">
          <input type="hidden" name="via-gmail" value="false">


          <div class="stopper hidden"></div>

          <!-- button submit -->
          <div class="text-center">
            <button class="button button-primary submit">Register</button>
          </div>
        </form>

        <?php require $path."includes/spinner.php" ?>

        <!-- alternative login -->
        <!-- <div class="alternative-login-parent flex-center hidden">
          <p>Or login using: </p>
          <a href="#"><i class="fa-brands fa-google"></i></a>
          <a href="#"><i class="fa-brands fa-facebook"></i></a>
        </div> -->

        <!-- signup button -->
        <!-- <div class="signup-parent hidden">
          <p>Not a member? <a href="#">Sign up</a></p>
        </div> -->
      </div>
    </div>

    <!-- login image -->
    <div class="modal-image card">
    </div>

    <!-- humburger menu -->
    <i class="fa-solid fa-xmark"></i>

  </div>

</div>