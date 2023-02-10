<?php 
  $path = "../";

  // require_once $path.'classes/appoint.class.php';
  // require_once $path.'classes/user.class.php';
  // require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Consultation";
  $consultation = 'nav-current';

  session_start();



  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="profile.css" />
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

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>