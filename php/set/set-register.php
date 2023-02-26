<?php 
  $path = "../../";

  require_once $path."classes/user.class.php";
  require_once $path."php/general.php";

  $user = new user;

  $registerDone = false;
  $isEmailRegistered = false;


  if(isset($_POST['submit'])) {

    $user = new user;
    $user -> register_via_google = true;
    $user -> email = validateInput($_POST['reg-email']);
    $user -> pass = validateInput($_POST['reg-pass']);
    $user -> status = "VERIFIED";
    
    $user -> user_type = $_POST['account-type'];
    $user -> first_name = validateInput($_POST['firstname']);
    $user -> middle_name = validateInput($_POST['middlename']);
    $user -> last_name = validateInput($_POST['lastname']);
    $user -> contact = validateInput($_POST['reg-mob']);
    $user -> gender = $_POST['gender'] == "Male"? 1:2;
    $user -> birthdate = $_POST['birthdate'];
    // $user -> profile_img = $_POST['birthdate'];

    $result = $user -> register();
    if($result) {
      $registerDone = true;
      // header("Location: ".$path."homepage/index.php");
      // exit();
    }

  } else {
    require_once '../config.php';

    $login = false;
    $client = googleClient($login);


    if(isset($_GET['code'])) {
      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

      // echo "<pre>";
      // var_dump($token);
      // echo "<pre>";
    } 

    if(isset($token['error']) != 'invalid_grant') {
      $gauth = new Google\Service\Oauth2($client);

      $userData = $gauth ->userinfo_v2_me->get();

      // print_r($userData);
      // print_r($userData['email']);
      // print_r($userData['picture']);
      $user -> email = $userData['email'];
      $isEmailRegistered = $user -> checkIfEmailIsregistered();
    } else {
      header("Location: ../../homepage/index.php");
    }
  }

  require_once $path.'includes/starterOne.php';
?>
<script type="module" src="set-register.js" defer></script>
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

  </header>

  <section class="continue-register-parent sizing-secondary">
    <div class="section-header-parent text-center">
      <?php if($registerDone) { ?>
      <h2 class="text-capital">Registration completed!</span></h2>
      <?php } else { ?>
      <h2 class="text-capital"><?php echo !$isEmailRegistered? "You're Almost done!":"Awww."?></span></h2>
      <?php if(!$isEmailRegistered) { ?>
      <div class="continue-register-container">
        <!-- form -->
        <form action="set-register.php" method="post" class="form form-group-input sizing-main">
          <!-- account type -->
          <div class="form-group">
            <div class="form-input-parent">
              <div class="form-input-box">
                <label for="account-type" class="text-capital">Account type<span>*</span></label>
                <select id="account-type" required name="account-type">
                  <option value="">--</option>
                  <option value="Student">Student</option>
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
                  value="<?php echo $userData['givenName'] ?>">
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
                <input type="text" name="lastname" id="lastname" required placeholder="Enter your last name"
                  value="<?php echo $userData['familyName'] ?>">
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- gender -->
              <div class="gender-form form-input-box">
                <label for="gender" class="text-capital">Gender <span>*</span></label>
                <div class="gender-con radio-box flex-center">
                  <div>
                    <input type="radio" id="reg-male" name="gender" required value="Male"
                      <?php echo isset($userData['gender']) == "male" ? "checked":""?>>
                    <label for="reg-male">Male</label>
                  </div>
                  <div>
                    <input type="radio" id="reg-female" name="gender" required value="Female"
                      <?php echo isset($userData['gender']) == "female" ? "checked":""?>>
                    <label for="reg-female">Female</label>
                  </div>
                </div>
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- birth date -->
              <div class="form-input-box">
                <label for="birthdate" class="text-capital">Birthdate <span>*</span></label>
                <input type="date" name="birthdate" required id="birthdate" max="<?php echo date("Y-m-d") ?>">
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
                <input type="text" name="reg-mob" id="reg-mob" required placeholder="Enter your mobile number">
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- Email -->
              <div class="form-input-box">
                <label for="reg-emails" class="text-capital">Email address <span>*</span></label>
                <input type="email" name="reg-emails" id="reg-emails" placeholder="Enter your email address"
                  value="<?php echo $userData['email'] ?>" disabled>
                <p class="form-error-message hidden">Error</p>
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
              <div class="form-input-box">
                <label for="reg-pass" class="text-capital">Password <span>*</span></label>
                <input type="password" name="reg-pass" id="reg-pass" value="test" required
                  placeholder="Enter your password">
              </div>
              <!-- middle name -->
              <div class="confirm-password form-input-box">
                <label for="reg-pass-confirm" class="text-capital">Confirm Password <span>*</span></label>
                <input type="password" name="reg-pass-confirm" id="reg-pass-confirm" required
                  placeholder="Confirm your password" value="test">
                <p class="form-error-message"></p>
              </div>
            </div>
          </div>

          <!-- remember me baby -->
          <div class="remember-form form-group">
            <div class="form-input-parent">
              <input type="checkbox" name="reg-terms" id="reg-terms" required>
              <label for="reg-terms" class="cursor-pointer">I agree to the <a class="hiddens" href="#">Terms of
                  Services and Privacy Policy</a>.</label>
            </div>
          </div>

          <!-- reg-email hidden -->
          <input type="hidden" name="reg-email" id="reg-email" value="<?php echo $userData['email'] ?>">

          <!-- button submit -->
          <div class="text-center">
            <button class="button button-primary submit" name="submit">Register</button>
          </div>

        </form>
      </div>
      <?php } else { ?>
      <p class="text-center">The email you used is already registered na. Kindly login nalang ha.</p>
      <?php } ?>
      <?php } ?>
    </div>
  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>