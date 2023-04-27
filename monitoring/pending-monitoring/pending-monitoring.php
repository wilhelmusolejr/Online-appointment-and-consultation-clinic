<?php 
  $path = "../../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Pending appointment";

  $pending = "active";

  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="pending-monitoring.css" />
<script src="pending-monitoring.js" defer></script>
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
      <?php require_once $path."monitoring/side-bar.php" ?>

      <!-- main content -->
      <div class="main-content">
        <!-- SECTION - List of RND -->
        <section class="pending-appoint-parent sizing-secondary text-center">

          <div class="pending-appoint-container flex-center grid-container">
            <table>
              <thead>
                <tr class="text-uppercase">
                  <th>Appointment number</th>
                  <th>Nutrional Concern</th>
                  <th>Monitoring date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

            <!-- MODAL -->
            <!-- MODAl - CONFIRMATION -->
            <div
              class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center  hidden">

              <!-- hidden - fox ajax -->
              <input type="hidden" name="submit" value='true' id="submit">

              <div class="modal-container modal-notif-container sizing-secondary ">
                <div class="modal-header text-center">
                  <h2 class="text-uppercase">Confirm monitoring</h2>
                </div>
                <p class="text-center">LOADING</p>
                <div class="modal-buttons flex-center">
                  <a class="button button-cancel">Cancel</a>
                  <button type="submit" name='submit' value="submit" class="button button-accept ">Accept</button>
                  <button type="submit" name='submit' value="submit"
                    class="button button-denaid hidden">Decline</button>
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