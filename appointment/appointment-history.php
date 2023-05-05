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

  if(isset($_GET['search_text'])) {
    $appoint -> search_string = $_GET['search_text'];
    $result = $appoint -> searchListAppointment();
  }

  // print_r($result);

  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="<?php echo $path."homepage/index.css"?>" />
<link rel="stylesheet" href="appointment-history.css">

<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer>
</script>
<script src="appointment-history.js" defer></script>

<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <p class="path_locator hidden"><?php echo $path ?></p>


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

    <div class="appointment-container flex-center grid-container hidden">
      <!-- Set up your appointment -->
      <form action="appointment-history.php?" class="form search-form" method="get">
        <!-- search appoint id  -->
        <div class="form-input-parent search-parent">
          <div class="form-input-box">
            <input type="text" name="search_text" placeholder="Enter appointment text"
              value="<?php echo isset($_GET['search_text']) ? $_GET['search_text'] : "" ?>">
            <button type="submit" value="submit" class="button-primary">Search</button>
          </div>
        </div>
      </form>
    </div>

    <table id="example" class="display">
      <thead>
        <tr class="text-uppercase">
          <th>Appointment number</th>
          <th>Chief complaint</th>
          <th>Appointment status</th>
          <th>RND assigned</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($result as $transact) { ?>
        <tr>
          <td class="appointment-number"><a class="button button-primary button-small"
              href="<?php echo $path."homepage/consultation/consultation.php?transact_id=".$transact['transact_id'] ?>">See
              more</a>
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
      </tbody>
    </table>

    </div>

  </section>



  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>