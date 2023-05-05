<?php 
  $path = "../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path.'classes/user.class.php';
  require_once $path.'classes/appoint.class.php';
  
  require_once $path.'tools/variables.php';
  $page_title = "Appointment History";

  $appoint = new appoint;
  $appoint -> user_id = $_SESSION['transact_client_id'];
  $result = $appoint -> getAppointTable();

  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="<?php echo $path."homepage/index.css"?>" />
<link rel="stylesheet" href="monitoring.css">
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer>
</script>
<script src="appointment-history.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <!-- SECTION - List of RND -->
  <section class="appointment-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-uppercase">appointment history</h2>
    </div>

    <div class="appointment-container flex-center grid-container">
      <!-- Set up your appointment -->
      <form action="consultation.php" class="form search-form" method="get">
        <!-- search appoint id  -->
        <div class="form-input-parent search-parent">
          <div class="form-input-box">
            <input type="number" name="transact_id" placeholder="Enter your appointment number">
            <button type="submit" value="submit" class="button-primary">Search</button>
          </div>
        </div>
      </form>
    </div>

    <table id="example" class="display">
      <tr class="text-uppercase">
        <th>Appointment number</th>
        <th>Chief complaint</th>
        <th>Appointment status</th>
        <th>RND assigned</th>
      </tr>
      <?php foreach($result as $transact) { ?>
      <tr>
        <td class="appointment-number"><a
            href="<?php echo $path."homepage/consultation/consultation.php?transact_id=".$transact['transact_id'] ?>">#<?php echo $transact['transact_id'] ?></a>
        </td>
        <td><?php echo $transact['chief_complaint'] ?></td>
        <td>
          <p class="status-<?php echo strtolower($transact['appoint_status']) ?> card">
            <?php echo $transact['appoint_status'] ?></p>
        </td>
        <?php if($transact['rnd_status'] == 'APPROVED') { ?>
        <td><a href="<?php echo $path."profile/profile.php?profile-id=".$transact['user_id'] ?>">RND
            <?php echo $transact['first_name']." ".$transact['last_name'] ?></a></td>
        <?php } else { ?>
        <td>
          <p class="status-pending card">PENDING</p>
        </td>
        <?php } ?>
      </tr>
      <?php } ?>
    </table>
    </div>

  </section>


  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>