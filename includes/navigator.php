<div class="navigator-parent sizing-main">
  <!-- nav -->
  <nav class="nav-container ">
    <ul class="nav-links text-uppercase">
      <li class="nav-profile-con flex-center<?php echo isset($_SESSION['loggedIn'])? "": "hiddens" ?>">
        <div class="nav-profile">
          <!-- profile -->
          <div class="profile-container flex-center">
            <img src="<?php echo $path ?>asset/char.jpg" alt="">
            <p>Sofia Andres</p>
          </div>

        </div>
      </li>
      <li><a class="<?php echo $home ?>" href="<?php echo $path ?>homepage/index.php">Home</a></li>
      <li><a class="<?php echo $consultation ?>"
          href="<?php echo $path ?>homepage/consultation/rnd/consultation.php">Consultation</a></li>
      <li>
        <a class="<?php echo $rnds ?>" href="<?php echo $path ?>homepage/rnds/rnds.php">RND<span
            class="text-initial">s</span></a>
      </li>
      <li>
        <div class="dropdown">
          <a class="<?php echo $tools ?>" href="<?php echo $path ?>homepage/tools/tools.php">Tools</a>
          <div class="dropdown-content hidden">
            <a>BMI Calculator</a>
            <a href="#">Tite</a>
            <a href="#">Test</a>
          </div>
        </div>
      </li>
      <li><a class="<?php echo $faq ?>" href="<?php echo $path ?>homepage/faq/faq.php">FAQ</a></li>
      <li><a class="<?php echo $about ?>" href="<?php echo $path ?>homepage/about/about.php">About us</a></li>
      <li><a class="<?php echo $contact ?>" href="<?php echo $path ?>homepage/contact/contact.php">Contact us</a></li>

    </ul>
  </nav>

  <!-- buttons -->
  <div class="nav-button flex-center text-uppercase <?php echo isset($_SESSION['loggedIn'])? "hidden": "" ?>">
    <a href="#">login</a>
    <a class="button button-primary" href="#">register</a>
  </div>

  <!-- communication -->
  <div class="nav-communication <?php echo isset($_SESSION['loggedIn'])? "": "hidden" ?>">
    <i class="fa-solid fa-bell"></i>
    <i class="fa-solid fa-comments"></i>

    <div class="notification-bar-card hidden">
      <h3>Notifications</h3>

      <ul class="notif-list">
        <li class="notif-item"><a href="#">
            <p class="notif-name">You have assigned to a new appointment</p>
            <p class="notif-time">1 hour ago</p>
          </a>
        </li>
        <li class="notif-item"><a href="#">
            <p class="notif-name">You have assigned to a new appointment</p>
            <p class="notif-time">1 hour ago</p>
          </a>
        </li>
      </ul>

      <div class="notif-show-all text-center">
        <a class='text-uppercase' href="<?php echo $path."notification/notification.php" ?>">See all</a>
      </div>
    </div>
  </div>

  <!-- profile -->
  <div class="outside-profile nav-profile <?php echo isset($_SESSION['loggedIn'])? "": "hidden" ?>">
    <div class="profile-container flex-center">
      <img src="<?php echo $path ?>asset/char.jpg" alt="">
      <p>
        <?php echo isset($_SESSION['loggedIn'])? $_SESSION['user_loggedIn']['first_name']." ".$_SESSION['user_loggedIn']['last_name']:""; ?>
      </p>
    </div>

    <div class="nav-profile-card hidden">
      <!-- profile -->
      <div class="profile-container flex-center">
        <img src="<?php echo $path ?>asset/char.jpg" alt="">
        <div>
          <p>
            <a
              href="<?php echo $path ?>profile/profile.php?profile-id=<?php echo $_SESSION['user_loggedIn']['user_id'] ?>"><?php echo isset($_SESSION['loggedIn'])? $_SESSION['user_loggedIn']['first_name']." ".$_SESSION['user_loggedIn']['last_name']:""; ?></a>
          </p>
          <select name="cars" class="cursor-pointer">
            <option value="Available">Available</option>
            <option value="Busy"> Busy</option>
          </select>
        </div>
      </div>


      <?php if($_SESSION['user_loggedIn']['user_privilege'] == "rnd") { ?>
      <!-- list of options -->
      <ul class="profile-list-options">
        <li><a href="<?php echo $path."appointment/rnd/pending-appointment/pending-appointment.php" ?>"><i
              class="fa-solid fa-heart-circle-plus"></i>
            <p>Appointment</p>
          </a>
        </li>
        <li><a href="#"><i class="fa-solid fa-tv"></i>
            <p>Monitoring</p>
          </a>
        </li>
      </ul>
      <?php } else { ?>
      <!-- list of options -->
      <ul class="profile-list-options">
        <li><a href="<?php echo $path."appointment/appointment-history.php" ?>"><i
              class="fa-solid fa-heart-circle-plus"></i>
            <p>Appointment History</p>
          </a>
        </li>
        <li><a href="#"><i class="fa-solid fa-tv"></i>
            <p>Monitoring History</p>
          </a>
        </li>
      </ul>
      <?php } ?>

      <!-- logout -->
      <a href="<?php echo $path."includes/logout.php" ?>" class="button button-logout button-secondary">Sign out</a>
    </div>

  </div>

  <!-- humburger menu -->
  <div class="nav-burger cursor-pointer">
    <i class="fa-solid fa-bars"></i>
    <i class="fa-solid fa-xmark hidden"></i>
  </div>
</div>