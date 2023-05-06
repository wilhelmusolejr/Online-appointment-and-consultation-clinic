<?php 
  $path = "../";

  session_start();

  // require_once $path.'classes/appoint.class.php';
  require_once $path.'classes/user.class.php';
  // require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Notification";
  // $consultation = 'nav-current';

  $user = new user;
  $user -> user_id = $_SESSION['user_loggedIn']['user_id'];
  $notification = $user -> getAllNotif();


  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="notification.css" />
<link rel="stylesheet" href="<?php echo $path."homepage/index.css" ?>" />
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer></script>
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
        <?php foreach($notification as $notif) { ?>
        <li class="notif-item"><a href="<?php echo $path.$notif['link'] ?>">
            <div>
              <p class="notif-name"><?php echo $notif['message'] ?></p>
              <p class="notif-time"><?php echo $notif['created_at'] ?></p>
            </div>
            <?php if($notif['is_read'] == 0) { ?>
            <span class="isRead"></span>
            <?php } ?>
          </a>
        </li>
        <?php } ?>
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