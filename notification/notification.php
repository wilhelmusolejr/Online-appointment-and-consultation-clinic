<?php 
  $path = "../";

  // require_once $path.'classes/appoint.class.php';
  // require_once $path.'classes/user.class.php';
  // require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Notification";
  // $consultation = 'nav-current';

  session_start();


  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="notification.css" />
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <!-- SECTION - List of RND -->
  <section class="notification-page-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-uppercase">Notification</h2>
    </div>

    <div class="notification-page-container flex-center grid-container">
      <ul class="notif-list">
        <li>
          <h4>Today</h4>
        </li>
        <li class="notif-item"><a href="<?php echo $path.'pending-appointment/pending-appointment.php' ?>">
            <p class="notif-name">You have assigned to a new appointment</p>
            <p class="notif-time">1 hour ago</p>
          </a>
        </li>
        <li class="notif-item"><a href="#">
            <p class="notif-name">You have assigned to a new appointment</p>
            <p class="notif-time">1 hour ago</p>
          </a>
        </li>
      </ul>
    </div>


  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>