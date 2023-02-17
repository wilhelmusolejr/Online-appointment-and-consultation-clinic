<?php 
    session_start();

    require_once '../../tools/variables.php';
    $page_title = "Consultation";
    $rnds = 'nav-current';
    $path = "../../"  ;

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="rnds.css" />
<script type="module" src="../index.js" defer></script>
<script src="consultation.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <!-- SECTION - List of RND -->
  <section class="list-rnd-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-capital">Meet our <span class="text-initial">RNDs</span></h2>
    </div>

    <div class="list-rnd-container flex-center grid-container">
      <!-- 1 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../../asset/deleon.jpg" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
      <!-- 2 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
      <!-- 3 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
    </div>

    <div class="list-rnd-container flex-center grid-container">
      <!-- 1 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
      <!-- 2 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
        </div>
      </div>
      <!-- 3 -->
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <img src="../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
        </div>
        <div class="list-rnd-info">
          <p>Gregory Yames RND</p>
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