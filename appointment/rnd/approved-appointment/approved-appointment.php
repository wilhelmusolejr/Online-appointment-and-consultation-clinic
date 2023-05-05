<?php 
  $path = "../../../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Pending appointment";
  
  $approved = "active";

  $consult = new consult;
  $consult -> rnd_id = $_SESSION['transact_rnd_id'];
  $listOfApproved = $consult -> getApprovedAppoint();

  // print_r($listOfApproved);

  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="approved-appointment.css" />
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer></script>
<script src="approved-appointment.js" defer></script>
<script src="../side-bar.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

    <div class="side-bar-parent">
      <!-- sidebar -->
      <?php require_once $path."appointment/rnd/side-bar.php" ?>

      <!-- main content -->
      <div class="main-content">
        <!-- SECTION - List of RND -->
        <section class="pending-appoint-parent sizing-secondary text-center">

          <table id="example" class="display">
            <thead>
              <tr class="text-uppercase">
                <th>Appointment number</th>
                <th>Nutrional Concern</th>
                <th>Client</th>
                <th>Date</th>
              </tr>
            </thead>
            <?php foreach($listOfApproved as $transact) { 
                date_default_timezone_set('Asia/Manila');
                $mydate = strtotime($transact['appoint_date']." ".$transact['appoint_time']);
                ?>
            <tr class="hiddens">
              <td class="appointment-number"><a class="button button-primary button-small" target="_blank"
                  href="<?php echo $path."homepage/consultation/rnd/consultation.php?transact_id=".$transact['transact_id'] ?>">See
                  more</a></td>

              <td><?php echo $transact['chief_complaint'] ?></td>
              <td class="client_name">
                <?php echo $transact['first_name']." ".$transact['last_name'] ?>
              </td>
              <td>
                <?php echo date('D, d M Y, g:i a', $mydate) ?>
              </td>

            </tr>
            <?php } ?>
          </table>


        </section>
      </div>
    </div>
  </header>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>