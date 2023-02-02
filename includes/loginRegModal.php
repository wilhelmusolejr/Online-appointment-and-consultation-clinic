<?php 
  if(isset($_SESSION['user'])) {
    print_r($_SESSION['user']);
  }
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
                <p class="form-error-message hidden">wiw</p>
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
            <button type="submit" value="Login" name="login" class="button button-primary submit">Login</button>
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
              <!-- Mobile -->
              <div class="form-input-box">
                <label for="reg-mob" class="text-capital">Mobile number <span>*</span></label>
                <input type="text" name="reg-mob" id="reg-mob" placeholder="Enter your mobile number">
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- Email -->
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