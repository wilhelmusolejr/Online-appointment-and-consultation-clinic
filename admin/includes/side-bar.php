<div class="sidebar close">
  <div class="logo-details">
    <i class='fas fa-user-alt'></i>
    <span class="logo_name">ADMIN</span>
  </div>
  <hr class="line">
  <ul class="nav-links">

    <!-- dasboard -->
    <li>
      <a href="<?php echo $path."dashboard.php" ?>" class="active">
        <i class='fas fa-globe'></i>
        <span class="link_name">Dashboard</span>
      </a>
      <ul class="sub-menu blank">
        <li><a class="link_name" href="<?php echo $path."dashboard.php" ?>" class="active">Dashboard</a></li>
      </ul>
    </li>
    <!-- specialist -->
    <li>
      <div class="iocn-link">
        <a href="<?php echo $path."specialist/personal.php" ?>">
          <i class='fa-solid fa-user-doctor'></i>
          <span class="link_name">Specialist</span>
        </a>
        <i class='bx bxs-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="<?php echo $path."specialist/personal.php" ?>">Specialist</a></li>
        <li><a href="<?php echo $path."specialist/personal.php" ?>">Personal Information</a></li>
        <li><a href="<?php echo $path."specialist/appointment.php" ?>">Appointment Information</a></li>
        <li><a href="<?php echo $path."specialist/patient.php" ?>">Patient Handled</a></li>
      </ul>
    </li>
    <!-- patient -->
    <li>
      <div class="iocn-link">
        <a href="../admin2/patient/patient.php">
          <i class='fas fa-user'></i>
          <span class="link_name">Patient</span>
        </a>
        <i class='bx bxs-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="<?php echo $path."patient/patient.php" ?>">Patients</a></li>
        <li><a href="<?php echo $path."patient/patient.php" ?>">Patient Information</a></li>
        <li><a href="<?php echo $path."patient/pending-identification.php" ?>">Pending ID Verification</a></li>
      </ul>
    </li>
    <!-- appointment -->
    <li>
      <div class="iocn-link">
        <a>
          <i class='fas fa-building'></i>
          <span class="link_name">Appointment</span>
        </a>
        <i class='bx bxs-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="<?php echo $path."appointment/pending.php" ?>">Appointment</a></li>
        <li><a href="<?php echo $path."appointment/pending.php" ?>">Pending Appointment</a></li>
        <li><a href="<?php echo $path."appointment/approved.php" ?>">Approved Appointment</a></li>
      </ul>
    </li>
    <hr class="line">
    <!-- logout -->
    <li class="logout-link">
      <a href="<?php echo $path."login/logout.php" ?>">
        <i class='bx bx-log-out'></i>
        <span class="link_name">Logout</span>
      </a>
      <ul class="sub-menu">
        <li><a class="link_name" href="<?php echo $path."login/logout.php" ?>">Logout</a></li>
      </ul>
    </li>
</div>