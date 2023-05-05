<?php 
    session_start();

    $path = "../../";
    require_once $path.'tools/variables.php';
    $page_title = "Homepage";
    $contact = "nav-current";

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="contact.css" />
<script type="module" src="../index.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>


<body>
  <p class="path_locator hidden"><?php echo $path ?></p>

  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

    <!-- main content hero header -->
    <main>
      <div class="sizing-secondary">
        <div class="main-text text-center">
          <h1 class="text-uppercase">
            Contact us!</h1>
          <p>
            Let us get in touch.
          </p>
        </div>
      </div>

    </main>

  </header>

  <!-- contact -->
  <section class="contact-parent sizing-secondary">
    <div class="contact-container flex-center grid-container">
      <!--  -->
      <div class="flex-center grid-box card">
        <div class="quick-emoji card">
          <i class="fa-solid fa-location-pin"></i>
        </div>
        <div class="quick-text text-center">
          <h3 class="text-uppercase">Location</h3>
          <p>Department of Nutrition and Deitetics</p>
          <p>College of Home Economics</p>
          <p class="text-left">W376 + CGQ, Normal Road, Zamboanga City, 7000, Zamboanga Del Sur</p>
        </div>
        <p class="hidden">1</p>
      </div>
      <!--  -->
      <div class="flex-center grid-box card">
        <div class="quick-emoji card">
          <i class="fa-solid fa-calendar-check"></i>
        </div>
        <div class="quick-text text-center">
          <h3 class="text-uppercase">Appoint</h3>
          <p>(62) 991 1771</p>
          <p>wmsuchedean@gmail.com</p>
        </div>
        <p class="hidden">1</p>
      </div>
      <!--  -->
      <div class="flex-center grid-box card">
        <div class="quick-emoji card">
          <i class="fa-brands fa-facebook-f"></i>
        </div>
        <div class="quick-text text-center">
          <h3 class="text-uppercase">Appoint</h3>
          <p>WMSU - College of Home Economics</p>
        </div>
        <p class="hidden">1</p>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>
</body>