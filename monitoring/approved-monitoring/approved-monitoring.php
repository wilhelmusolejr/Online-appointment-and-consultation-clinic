<?php 
  $path = "../../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path.'classes/consult.class.php';
  require_once $path.'classes/monitor.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Pending appointment";

  $approved = "active";

  $monitor = new monitor;
  $monitor -> user_id = $_SESSION['user_loggedIn']['user_id'];
  $result = $monitor -> getMonitorTableUser();

  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="approved-monitoring.css" />
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
                  <th>MONITORING NUMBER</th>
                  <th>APPOINTMENT NUMBER</th>
                  <th>CHIEF COMPLAINT</th>
                  <th>MONITOR DATE</th>
                  <th>CURRENT WEEK</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($result as $transact) { ?>
                <tr>
                  <!-- monitoring -->
                  <td class="appointment-number">
                    <a
                      href="<?php echo $path."homepage/monitoring/rnd/monitoring.php?monitor_id=".$transact['monitor_id']."&week_num=1" ?>">#<?php echo $transact['monitor_id'] ?></a>
                  </td>
                  <!-- appointment -->
                  <td class="appointment-number"><a
                      href="<?php echo $path."homepage/consultation/rnd/consultation.php?transact_id=".$transact['transact_id'] ?>">#<?php echo $transact['transact_id'] ?></a>
                  </td>
                  <!-- chief complaint -->
                  <td><?php echo $transact['chief_complaint'] ?></td>
                  <!-- monitor date -->
                  <td>
                    <?php echo $transact['monitor_date'] ?>
                  </td>
                  <td>
                    <?php echo $transact['current_week'] ?>
                  </td>
                </tr>
                <?php } ?>
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