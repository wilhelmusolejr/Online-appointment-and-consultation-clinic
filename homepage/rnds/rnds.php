<?php 
    session_start();

    $path = "../../";


    require_once $path."classes/user.class.php";
    require_once $path.'tools/variables.php';
    $page_title = "Consultation";
    $rnds = 'nav-current';

    require_once $path.'includes/starterOne.php';

    $user = new user;

    // user
    $allValidRnd = $user -> getAllRnd();

?>
<link rel="stylesheet" href="rnds.css" />
<script type="module" src="../index.js" defer></script>
<script src="consultation.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>
  </header>

  <!-- SECTION - List of RND -->
  <section class="list-rnd-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-capital">Meet our <span class="text-initial">RNDs</span></h2>
    </div>

    <div class="list-rnd-container flex-center grid-container">

      <?php foreach($allValidRnd as $rnd) {
        $img = $rnd['profile_img'] == null ? "dummy_user.jpg" : $rnd['profile_img'];
        $img_link =  $path."uploads/".$img;
        ?>
      <div class="list-rnd-box grid-box card">
        <div class="list-rnd-image">
          <a href="<?php echo $path."profile/profile.php?profile-id=".$rnd['user_id'] ?>"><img
              src="<?php echo $img_link ?>" alt=""></a>
        </div>
        <div class="list-rnd-info">
          <p>RND <?php echo $rnd['first_name']." ".$rnd['last_name'] ?></p>
        </div>
      </div>
      <?php } ?>

    </div>

  </section>


  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>