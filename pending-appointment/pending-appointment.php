<?php 
  $path = "../";

  // require_once $path.'classes/appoint.class.php';
  // require_once $path.'classes/user.class.php';
  // require_once $path.'classes/consult.class.php';

  require_once $path.'tools/variables.php';
  $page_title = "Notification";
  // $consultation = 'nav-current';

  session_start();


  require_once $path.'includes/starterOne.php';  
?>
<link rel="stylesheet" href="pending-appointment.css" />
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <!-- SECTION - List of RND -->
  <section class="pending-appoint-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-uppercase">Pending appointment</h2>
    </div>

    <div class="pending-appoint-container flex-center grid-container">
      <table>
        <tr class="text-uppercase">
          <th>Appointment number</th>
          <th>Chief complaint</th>
          <th>Appointment status</th>
          <th>RND assigned</th>
        </tr>
        <tr>
          <td class="appointment-number">#123123</td>
          <td>Food complaint</td>
          <td>
            <p class="status-pending card">PENDING</p>
          </td>
          <td>
            <p class="status-pending card">PENDING</p>
          </td>
        </tr>
        <tr>
          <td class="appointment-number">#123123</td>
          <td>Food complaint</td>
          <td>
            <p class="status-approved card">APPROVED</p>
          </td>
          <td>
            <div class="button-parent">
              <a href="#" class="button button-accept">Accept</a><a href="#" class="button button-denaid">Denaid</a>
            </div>
          </td>
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

</html>