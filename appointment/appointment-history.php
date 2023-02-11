<?php 
  $path = "../";

  session_start();

  require_once $path.'classes/user.class.php';
  require_once $path.'tools/variables.php';
  $page_title = "Homepage";
  $home = "nav-current";

  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="index.css" />
<script type="module" src="index.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>
</body>