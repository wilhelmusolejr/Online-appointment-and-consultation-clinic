<?php 
  $path = "../";

  session_start();
  
  // check if user is logged in
  if(!isset($_SESSION['loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path.'classes/user.class.php';

  require_once $path.'tools/variables.php';
  $page_title = $_SESSION['user_loggedIn']['first_name'].' '.$_SESSION['user_loggedIn']['last_name'].' | '.$page_name;

  if(isset($_GET['profile-id'])) {
    $user = new user;
    $user -> user_id = $_GET['profile-id'];

    $userData = $user -> getUserData();
    $userData['profile_img'] = $userData['profile_img'] == null? "dummy_user.jpg":$userData['profile_img'];
    $userId = $user -> getIdInfo();
  } else {
    $user = new user;
    $user -> user_id = $_SESSION['user_loggedIn']['user_id'];
    header("location: "."profile.php?profile-id=".$user -> user_id);
    exit();
  }

  // print_r($userData);
  // print_r(gettype($userId));
  // print_r($_SESSION);

  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="profile.css" />
<script type="module" src="<?php echo $path ?>homepage/index.js" defer></script>
<script src="profile.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <!-- SECTION - PROFILING -->
  <section class="profile-page-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-uppercase">Profile</h2>
    </div>

    <div class="profile-page-container flex-center grid-container card">
      <!-- divider -->
      <div class="profile-page-container-parent">
        <!-- left -->
        <div class="profile-container">
          <img src="<?php echo $path.'uploads/'.$userData['profile_img'] ?>" alt="">
          <p><?php echo $userData['first_name']." ".$userData['last_name'] ?></p>
        </div>
        <!-- right -->
        <!-- form parent -->
        <form class="form">
          <div class="divider">
            <!-- left -->
            <div class="form-input-parent">
              <!-- first name -->
              <div class="form-input-box input-two">
                <label for="firstname">Full name</label>
                <input type="text" name="firstname" id="firstname"
                  value="<?php echo $userData['first_name']." ".$userData['middle_name']." ".$userData['last_name'] ?>"
                  disabled>
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- gender -->
              <div class="gender-form form-input-box input-two">
                <label for="gender" class="text-capital">Gender</label>
                <div class="gender-con radio-box flex-center">
                  <div>
                    <input type="radio" id="male" name="gender" value="Male"
                      <?php echo $userData['gender'] == 1 ? "checked" : "" ?> disabled>
                    <label for="male">Male</label>
                  </div>
                  <div>
                    <input type="radio" id="female" name="gender" value="Female"
                      <?php echo $userData['gender'] == 1 ? "" : "checked" ?> disabled>
                    <label for="female">Female</label>
                  </div>
                </div>
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- birth date -->
              <div class="form-input-box input-two">
                <label for="birthdate" class="text-capital">Birthdate</label>
                <input type="date" name="birthdate" id="birthdate" value="<?php echo $userData['birthdate'] ?>"
                  disabled>
                <p class="form-error-message hidden">Error</p>
              </div>
            </div>
            <!-- right -->
            <div class="form-input-parent">
              <!-- Mobile -->
              <div class="form-input-box input-two">
                <label for="reg-mob" class="text-capital">Mobile number</label>
                <input type="text" name="reg-mob" id="reg-mob" value="<?php echo $userData['contact'] ?>" disabled>
                <p class="form-error-message hidden">Error</p>
              </div>
              <!-- Email -->
              <div class="form-input-box input-two">
                <label for="reg-email" class="text-capital">Email address</label>
                <input type="email" name="reg-email" id="reg-email" value="<?php echo $userData['email'] ?>" disabled>
                <p class="form-error-message hidden">Error</p>
              </div>
            </div>
          </div>
        </form>
      </div>

      <?php if($_SESSION['user_loggedIn']['user_id'] == $_GET['profile-id']) { ?>
      <!-- BUTTONS -->
      <div class="profile-buttons ">

        <?php if($_SESSION['user_loggedIn']['user_privilege'] == "client")  { ?>
        <?php if($userId == "") {?>
        <a href="#" class="button button-primary upload-id-btn">Upload Id</a>
        <?php } elseif ($userId['status'] == "VERIFIED") { ?>
        <a href="#" class="button button-primary disabled upload-id-verified">VERIFIED</a>
        <?php } elseif ($userId['status'] == "PENDING") { ?>
        <a href="#" class="button button-primary disabled upload-id-pending">PENDING</a>
        <?php } elseif ($userId['status'] == "DECLINED") { ?>
        <a href="#" class="button button-primary upload-id-btn upload-id-declined">DECLINED</a>
        <?php } ?>
        <?php } ?>

        <a href="edit-profile.php?profile-id=<?php echo $_GET['profile-id'] ?>"
          class="button button-primary edit-profile-btn">Edit profile</a>
      </div>
      <?php } ?>
    </div>
    </div>

    <!-- MODAl - UPLOAD ID -->
    <div class="modal-parent modal-notif-parent modal-upload-id overlay-black flex-center hidden">

      <!-- hidden - fox ajax -->
      <input type="hidden" name="submit" value='true' id="submit">

      <div class="modal-container modal-notif-container sizing-secondary">
        <div class="modal-header text-center">
          <h2 class="text-uppercase">Upload image</h2>
        </div>

        <form class="form form-identification " method="post" enctype="multipart/form-data">
          <div class="divider">
            <!-- left -->
            <div class="form-input-parent">
              <!-- first name -->
              <div class="form-input-box input-one">
                <input type="file" name="id-image" id="id-image" accept="image/*">
                <p class="form-error-message"></p>
              </div>
            </div>
          </div>
          <div class="modal-buttons">
            <a class="button button-cancel">Go back</a>
            <button type="submit" name='submit' value="submit" class="button button-primary">Submit</button>
          </div>
        </form>

        <div class="modal-buttons form-success hidden">
          <button class="button button-primary">Done</button>
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