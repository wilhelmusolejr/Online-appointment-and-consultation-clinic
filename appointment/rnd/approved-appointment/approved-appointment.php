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
<script src="approved-appointment.js" defer></script>
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer></script>
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

          <div class="pending-appoint-container flex-center grid-container">
            <table>
              <tr class="text-uppercase">
                <th>Appointment number</th>
                <th>Chief complaint</th>
                <th>Date</th>
                <th>Client</th>
              </tr>
              <?php foreach($listOfApproved as $transact) { 
                date_default_timezone_set('Asia/Manila');
                $mydate = strtotime($transact['appoint_date']." ".$transact['appoint_time']);
                ?>
              <tr class="hiddens">
                <td class="appointment-number"><a target="_blank"
                    href="<?php echo $path."homepage/consultation/rnd/consultation.php?transact_id=".$transact['transact_id'] ?>">#<?php echo $transact['transact_id'] ?>
                </td></a>

                <td><?php echo $transact['chief_complaint'] ?></td>
                <td>
                  <?php echo date('D, d M Y, g:i a', $mydate) ?>
                </td>
                <td class="client_name">
                  <?php echo $transact['first_name']." ".$transact['last_name'] ?>
                </td>
              </tr>
              <?php } ?>
            </table>

            <!-- MODAL -->
            <!-- MODAl - CONFIRMATION -->
            <div
              class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center  hidden">

              <!-- hidden - fox ajax -->
              <input type="hidden" name="submit" value='true' id="submit">

              <div class="modal-container modal-notif-container sizing-secondary ">
                <div class="modal-header text-center">
                  <h2 class="text-uppercase">Are you sure?</h2>
                </div>
                <p class="text-center">message</p>
                <div class="modal-buttons flex-center">
                  <a class="button button-cancel">Go back</a>
                  <button type="submit" name='submit' value="submit" class="button button-accept ">Accept</button>
                  <button type="submit" name='submit' value="submit" class="button button-denaid hidden">Denaid</button>
                  <a href="<?php echo $_SERVER['PHP_SELF'] ?>" class="button button-primary hidden">Done</a>
                </div>
              </div>
            </div>
          </div>


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