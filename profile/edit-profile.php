<?php 
  $path = "../";

  // require_once $path.'classes/appoint.class.php';
  require_once $path.'classes/user.class.php';
  require_once $path.'php/general.php';
  // require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Edit Profile | Name";
  // $consultation = 'nav-current';

  session_start();

  $user = new user;

  if(isset($_GET['profile-id'])) {
    $user -> user_id = $_GET['profile-id'];
    $userData = $user -> getUserData();

    // print_r($userData);
  }

  if(isset($_POST['submit'])) {
    $user -> user_id = $_GET['profile-id'];

    $user -> user_type = validateInput($_POST['account-type']);
    $user -> first_name = validateInput($_POST['firstname']);
    $user -> middle_name = validateInput($_POST['middlename']);
    $user -> last_name = validateInput($_POST['lastname']);
    $user -> gender = $_POST['gender'] == "Male"? 1 : 2;
    $user -> birthdate = $_POST['birthdate'];
    $user -> contact = $_POST['reg-mob'];

    $result = $user -> updateUserProfile();
    if($result) {
      header("location: profile.php?profile-id=".$user -> user_id);
    } else {
      echo "error updating profile";
    }

  }

  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="profile.css" />
<script type="module" src="<?php echo $path ?>homepage/index.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <section class="continue-register-parent sizing-secondary">
    <div class="section-header-parent text-center">
      <h2 class="text-uppercase">Edit profile</h2>
    </div>

    <div class="continue-register-container">
      <!-- form -->
      <form action="edit-profile.php?profile-id=<?php echo $_GET['profile-id'] ?>" method="post"
        class="form form-group-input sizing-main">
        <!-- account type -->
        <div class="form-group">
          <div class="form-input-parent">
            <div class="form-input-box">
              <label for="account-type" class="text-capital">Account type<span>*</span></label>
              <select id="account-type" required name="account-type">
                <option value="Student" <?php echo $userData['user_type'] == "Student" ? "selected":"" ?>>Student
                </option>
                <option value="Faculty" <?php echo $userData['user_type'] == "Faculty" ? "selected":"" ?>>Faculty
                </option>
                <option value="Guest" <?php echo $userData['user_type'] == "Guest" ? "selected":"" ?>>Guest</option>
                <option value="Alumni" <?php echo $userData['user_type'] == "Alumni" ? "selected":"" ?>>Alumni</option>
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
                value="<?php echo $userData['first_name'] ?>">
              <p class="form-error-message hidden">Error</p>
            </div>
            <!-- middle name -->
            <div class="form-input-box">
              <label for="middlename" class="text-capital">Middle name <span>*</span></label>
              <input type="text" name="middlename" id="middlename" placeholder="Enter your middle name"
                value="<?php echo $userData['middle_name'] ?>">
              <p class="form-error-message hidden">Error</p>
            </div>
            <!-- last name -->
            <div class="form-input-box">
              <label for="lastname" class="text-capital">Last name <span>*</span></label>
              <input type="text" name="lastname" id="lastname" required placeholder="Enter your last name"
                value="<?php echo $userData['last_name'] ?>">
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
              <input type="date" name="birthdate" required id="birthdate" max="<?php echo date("Y-m-d") ?>"
                value="<?php echo $userData['birthdate'] ?>">
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
              <input type="text" name="reg-mob" id="reg-mob" required placeholder="Enter your mobile number"
                value="<?php echo $userData['contact'] ?>">
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
            <!-- Current password -->
            <div class="form-input-box">
              <label for="reg-pass" class="text-capital">Current Password <span>*</span></label>
              <input type="password" name="reg-pass" id="reg-pass" value="test" required
                placeholder="Enter your password">
            </div>
            <!-- New password -->
            <div class="confirm-password form-input-box">
              <label for="reg-pass-confirm" class="text-capital">New Password</label>
              <input type="password" name="reg-pass-confirm" id="reg-pass-confirm" required
                placeholder="Confirm your password" value="test">
              <p class="form-error-message"></p>
            </div>
          </div>
        </div>

        <!-- reg-email hidden -->
        <input type="hidden" name="reg-email" id="reg-email" value="<?php echo $userData['email'] ?>">

        <!-- button submit -->
        <div class="text-center">
          <button class="button button-primary submit" name="submit">Save profile</button>
        </div>

      </form>
    </div>

  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>