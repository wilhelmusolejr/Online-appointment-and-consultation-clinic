<?php 
  $path = "../";

  session_start();

  require_once $path.'classes/user.class.php';
  require_once $path.'tools/variables.php';
  $page_title = "Appointment History";
  // $home = "nav-current";

  require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="<?php echo $path."homepage/index.css"?>" />
<link rel="stylesheet" href="appointment-history.css">
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
    <table>
      <tr class="text-uppercase">
        <th>Appointment number</th>
        <th>Chief complaint</th>
        <th>Appointment status</th>
        <th>RND assigned</th>
      </tr>
      <tr>
        <td class="appointment-number"><a href="#">#123123</a></td>
        <td>Food complaint</td>
        <td>
          <p class="status-pending card">PENDING</p>
        </td>
        <td>
          <p class="status-pending card">PENDING</p>
        </td>
      </tr>
      <tr>
        <td class="appointment-number"><a href="#">#123123</a></td>
        <td>Food complaint</td>
        <td>
          <p class="status-approved card">APPROVED</p>
        </td>
        <td><a href="#">RND Gregory Yames</a></td>
      </tr>
    </table>
    </div>

  </section>


  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>