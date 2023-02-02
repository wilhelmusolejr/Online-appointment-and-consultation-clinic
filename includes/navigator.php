<div class="navigator-parent sizing-main">
  <!-- nav -->
  <nav class="nav-container ">
    <ul class="nav-links text-uppercase">
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
  <div class="nav-button flex-center text-uppercase <?php echo isset($_SESSION['user'])? "hidden": "" ?>">
    <a href="#">login</a>
    <a class="button button-primary" href="#">register</a>
  </div>

  <div class="nav-communication <?php echo isset($_SESSION['user'])? "": "hidden" ?>">
    <i class="fa-solid fa-envelope"></i>
    <i class="fa-solid fa-comments"></i>
  </div>
  <div class="nav-profile">

    <!-- profile -->
    <div class="nav-profile flex-center <?php echo isset($_SESSION['user'])? "": "hidden" ?>">
      <p>Sofia Andres</p>
      <img src="<?php echo $path ?>asset/char.jpg" alt="">
    </div>

  </div>



  <!-- humburger menu -->
  <div class="nav-burger cursor-pointer">
    <i class="fa-solid fa-bars"></i>
    <i class="fa-solid fa-xmark hidden"></i>
  </div>
</div>