<?php 
  $path = "../../";

  session_start();

  if(!isset($_SESSION['user_loggedIn'])) {
    header('Location: '.$path.'homepage/index.php');
  }

  require_once $path.'classes/user.class.php';
  require_once $path.'classes/monitor.class.php';
  
  require_once $path.'tools/variables.php';
  $page_title = "Monitoring History";

  $monitor = new monitor;
  $monitor -> rnd_id = $_SESSION['transact_rnd_id'];
  $result = $monitor -> getMonitorTable();


  if(isset($_GET['search_text'])) {
    $monitor -> search_string = $_GET['search_text'];
    $result = $monitor -> searchListMonitor();
  }

  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="<?php echo $path."homepage/index.css"?>" />
<link rel="stylesheet" href="monitoring-history.css">
<script type="module" src="<?php echo $path."homepage/index.js" ?>" defer>
</script>
<script src="monitoring-history.js" defer></script>
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
      <h2 class="text-uppercase">Monitoring History</h2>
    </div>

    <div class="appointment-container flex-center grid-container hidden ">
      <!-- Set up your appointment -->
      <form action="monitoring-history.php?" class="form search-form" method="get">
        <!-- search appoint id  -->
        <div class="form-input-parent search-parent">
          <div class="form-input-box">
            <input type="text" name="search_text" placeholder="Enter monitor text"
              value="<?php echo isset($_GET['search_text']) ? $_GET['search_text'] : "" ?>">
            <button type="submit" value="submit" class="button-primary">Search</button>
          </div>
        </div>
      </form>
    </div>

    <table id="example" class="display">
      <thead>
        <tr class="text-uppercase">
          <th>Monitoring number</th>
          <th>Appointment number</th>
          <th>Full Name</th>
          <th>Chief complaint</th>
          <th>Monitor date</th>
          <th>Current Week</th>
        </tr>
      </thead>
      <?php foreach($result as $transact) { ?>
      <tr>
        <!-- monitoring -->
        <td class="appointment-number">
          <a class="button button-primary button-small"
            href="<?php echo $path."homepage/monitoring/rnd/monitoring.php?monitor_id=".$transact['monitor_id']."&week_num=1" ?>">See
            more</a>
        </td>
        <!-- appointment -->
        <td class="appointment-number">
          <a class="button button-primary button-small"
            href="<?php echo $path."homepage/consultation/rnd/consultation.php?transact_id=".$transact['transact_id'] ?>">See
            more</a>
        </td>
        <!-- Full name -->
        <td><?php echo $transact['first_name']." ".$transact['last_name'] ?></td>
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
    </table>
    </div>

  </section>


  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>