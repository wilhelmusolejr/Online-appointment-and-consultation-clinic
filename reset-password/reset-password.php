<?php

session_start();

if(!isset($_GET['verif-code'])) {
  header("location: ".$path."homepage");
  exit();
}

$path = "../";

require_once $path."classes/user.class.php";

$user = new user;
$user -> verification_code = $_GET['verif-code'];
$result = $user -> getAccountVerification();

if(!$result) {
  print_r("wesw");
  // no data
}

require_once $path.'includes/starterOne.php';  
?>
<script type="module" src="reset-password.js" defer></script>
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
      <h2 class="text-uppercase"><?php echo $result != "" ? "Reset password" : "something went wrong" ?></h2>
    </div>

    <?php if ($result != "") { ?>
    <div class="continue-register-container">
      <!-- form -->
      <form method="post" class="form form-group-input form-reset-password sizing-main">

        <!-- Account Info -->
        <div class="account-info-form form-group">
          <div class="form-input-parent">
            <!-- Current password -->
            <div class="password form-input-box">
              <label for="reg-pass" class="text-capital">Password <span>*</span></label>
              <input type="password" name="reg-pass" id="reg-pass" required placeholder="Enter your password">
              <p class="form-error-message"></p>
            </div>
            <!-- New password -->
            <div class="confirm-password form-input-box">
              <label for="reg-pass-confirm" class="text-capital">Confirm Password</label>
              <input type="password" name="reg-pass-confirm" id="reg-pass-confirm" placeholder="Confirm your password">
              <p class="form-error-message"></p>
            </div>
          </div>
        </div>

        <!-- hidden -->
        <input type="hidden" name="user_id" value="<?php echo $result['user_id'] ?>">

        <!-- button submit -->
        <div class="text-center">
          <button class="button button-primary submit" name="submit">Save</button>
        </div>

      </form>
    </div>
    <?php } else {?>
    <p class="text-center">Expired verification code. <br>Please request a new one.</p>
    <?php } ?>

  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>