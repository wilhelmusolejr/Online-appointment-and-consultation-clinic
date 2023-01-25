<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    require_once '../../tools/variables.php';
    $page_title = "Consultation";
    $tools = 'nav-current';
    $path = "../../"  ;

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="rnds.css" />
<link rel="stylesheet" href="../index.css" />

<script src="../index.js" defer></script>
<script src="consultation.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <!-- SECTION - Tool Banner -->

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

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>


</body>