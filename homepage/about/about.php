<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    $path = "../../";
    require_once $path.'tools/variables.php';
    $page_title = "Homepage";
    $about = "nav-current";

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="index.css" />
<script src="index.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>


<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

  </header>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>



</html>