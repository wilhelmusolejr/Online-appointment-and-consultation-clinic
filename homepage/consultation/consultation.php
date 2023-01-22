<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    require_once '../../tools/variables.php';
    $page_title = "Consultation";
    $consultation = 'nav-current';
    $path = "../../";

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="consultation.css" />
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

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

</body>

</html>