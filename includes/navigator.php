<div class="navigator-parent sizing-main">
  <!-- nav -->
  <nav class="nav-container ">
    <ul class="nav-links text-uppercase">
      <li class="nav-profile-con <?php echo isset($_SESSION['loggedIn'])? "": "hidden" ?>">
        <div class="nav-profile">
          <!-- profile -->
          <div class="nav-profile flex-center">
            <img src="<?php echo $path ?>asset/char.jpg" alt="">
            <p>Sofia Andres</p>
          </div>

        </div>
      </li>
      <li><a class="<?php echo $home ?>" href="<?php echo $path ?>homepage/index.php">Home</a></li>
      <li><a class="<?php echo $consultation ?>"
          href="<?php echo $path ?>homepage/consultation/consultation.php">Consultation</a></li>
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
  </div>

  <!-- profile -->
  <div class="nav-profile <?php echo isset($_SESSION['loggedIn'])? "": "hidden" ?>">
    <div class="nav-profile flex-center">
      <img src="<?php echo $path ?>asset/char.jpg" alt="">
      <p>
        <?php  echo isset($_SESSION['loggedIn'])? $_SESSION['user_loggedIn']['first_name']." ".$_SESSION['user_loggedIn']['last_name']:""; ?>
      </p>
    </div>

  </div>

  <!-- humburger menu -->
  <div class="nav-burger cursor-pointer">
    <i class="fa-solid fa-bars"></i>
    <i class="fa-solid fa-xmark hidden"></i>
  </div>
</div>