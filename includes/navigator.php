<div class="navigator-parent sizing-main">
  <!-- nav -->
  <nav class="nav-container ">
    <ul class="nav-links text-uppercase">
      <li><a class="<?php echo $home ?>" href="<?php echo $path ?>homepage/index.php">Home</a></li>
      <li><a class="<?php echo $consultation ?>"
          href="<?php echo $path ?>homepage/consultation/consultation.php">Consultation</a></li>
      <li>
        <a class="<?php echo $rnds ?>" href="#">RND<span class="text-initial">s</span></a>
      </li>
      <li><a class="<?php echo $tools ?>" href="#">Tools</a></li>
      <li><a class="<?php echo $faq ?>" href="#">FAQ</a></li>
      <li><a class="<?php echo $about ?>" href="#">About us</a></li>
      <li><a class="<?php echo $contact ?>" href="#">Contact us</a></li>
    </ul>
  </nav>

  <!-- buttons -->
  <div class="nav-button flex-center text-uppercase">
    <a href="#">login</a>
    <a class="button button-primary" href="#">register</a>
  </div>

  <!-- humburger menu -->
  <div class="nav-burger cursor-pointer">
    <i class="fa-solid fa-bars"></i>
    <i class="fa-solid fa-xmark hidden"></i>
  </div>
</div>