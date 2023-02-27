<?php 

session_start();
  
$path = "../";

require_once $path."classes/user.class.php";


if(!isset($_GET['verif-code'])) {
  header("location: ".$path."homepage");
  exit();
} 

$user = new user;

$user -> verification_code = $_GET['verif-code'];

$result = $user -> getAccountVerification();

if(!$result) {
  header("location: ".$path."homepage");
  exit();
}

$user -> user_id = $result['user_id'];
$user -> feedback = "VERIFIED";
$result = $user -> updateAccountVerification();

if($result) {
  $response = "Activated successfully";
} 


require_once $path.'includes/starterOne.php';
?>
<script type="module" src="../homepage/index.js" defer></script>
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
      <h2 class="text-uppercase"><?php echo $response ?></h2>
    </div>

  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>