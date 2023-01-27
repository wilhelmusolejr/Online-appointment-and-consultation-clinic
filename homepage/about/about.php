<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    $path = "../../";
    require_once $path.'tools/variables.php';
    $page_title = "Homepage";
    $about = "nav-current";

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="about.css" />
<script src="index.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>


<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

    <!-- main content hero header -->
    <main>
      <div class="sizing-secondary">
        <div class="main-text text-center">
          <h1 class="text-uppercase">
            About us !</h1>
          <p>
            Helping you live Stronger, Healthier and Happy
          </p>
        </div>
      </div>

    </main>

  </header>

  <!-- About -->
  <section class="about-parent sizing-secondary ">

    <div class="section-header-parent text-center">
      <h2 class="text-capital">About Online Consultation Clinic</h2>
    </div>

    <div class="about-container card">
      <p>Free, individual nutrition consultation is available to anyone who want to have a healthy lifestyle in the
        community. Services are provided by a registered dietitian who are also a professor at Western Mindanao State
        University in a supportive and positive environment. Our dietitians can help tailor your diet to meet your
        personal and cultural preferences and health needs, some of which may include:</p>

      <ul>
        <li>Diabetes</li>
        <li>High cholesterol</li>
        <li>High blood pressure</li>
        <li>Digestive disorders</li>
        <li>Eating disorders</li>
        <li>Food allergy</li>
        <li>diets, etc.</li>
      </ul>

    </div>



  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>



</html>