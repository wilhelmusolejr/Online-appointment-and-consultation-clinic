<div class="side-bar ">
  <ul>
    <li class="pending-appointment <?php echo isset($pending) ? "active" :"" ?>"><a
        href="../pending-appointment/pending-appointment.php" class="text-uppercase">
        <p>Pending monitoring</p> <span class="number-notif flex-center">0</span>
      </a></li>
    <li class="approved-appointment <?php echo isset($approved) ? "active" :"" ?>"><a
        href="../approved-appointment/approved-appointment.php" class="text-uppercase">
        <p>Approved monitoring</p>
      </a></li>
  </ul>
</div>