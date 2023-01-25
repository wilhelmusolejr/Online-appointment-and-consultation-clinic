<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    $path = "../../";
    require_once $path.'tools/variables.php';
    $page_title = "Homepage";
    $contact = "nav-current";

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="contact.css" />
<script src="index.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>


<body>
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



  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>
</body>