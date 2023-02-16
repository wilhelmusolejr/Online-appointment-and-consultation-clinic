<?php 
  $path = "../../../";

  // require_once $path.'classes/appoint.class.php';
  // require_once $path.'classes/user.class.php';
  require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Pending appointment";
  // $consultation = 'nav-current';

  session_start();

  $consult = new consult;
  $consult -> rnd_id = $_SESSION['transact_rnd_id'];

  $listOfPending = $consult -> getListOfPendingAppoint();

  // print_r($listOfPending);

  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="pending-appointment.css" />
<script src="pending-appointment.js" defer></script>
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>


    <div class="side-bar-parent">
      <!-- sidebar -->
      <div class="side-bar">
        <ul>
          <li class="pending-appointment"><a href="../pending-appointment/pending-appointment.php"
              class="text-uppercase">
              <p>Pending appointment</p> <span class="number-notif flex-center">1</span>
            </a></li>
          <li class="approved-appointment active"><a href="../approved-appointment/approved-appointment.php"
              class="text-uppercase">
              <p>Approved appointment</p>
            </a></li>
        </ul>
      </div>

      <!-- main content -->
      <div class="main-content">
        <!-- SECTION - List of RND -->
        <section class="pending-appoint-parent sizing-secondary text-center">

          <div class="pending-appoint-container flex-center grid-container">
            <table>
              <tr class="text-uppercase">
                <th>Appointment number</th>
                <th>Chief complaint</th>
                <th>Appointment status</th>
                <th>RND assigned</th>
              </tr>
              <?php foreach($listOfPending as $transact) { ?>
              <tr class="hiddens">
                <td class="appointment-number">#<?php echo $transact['transact_id'] ?></td>
                <td><?php echo $transact['chief_complaint'] ?></td>
                <td>
                  <p class="status-approved card">APPROVED</p>
                </td>
                <td>
                  <div class="button-parent flex-center">
                    <a href="#" class="button button-accept">Accept</a>
                    <a href="#" class="button button-denaid">Denaid</a>
                  </div>
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