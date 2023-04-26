<div class="side-bar ">
  <ul>
    <li class="pending-appointment <?php echo isset($pending) ? "active" :"" ?>"><a
        href="../pending-monitoring/pending-monitoring.php" class="text-uppercase">
        <p>Pending monitoring</p> <span class="number-notif flex-center">0</span>
      </a></li>
    <li class="approved-appointment <?php echo isset($approved) ? "active" :"" ?>"><a
        href="../approved-monitoring/approved-monitoring.php" class="text-uppercase">
        <p>Approved monitoring</p>
      </a></li>
  </ul>
</div>