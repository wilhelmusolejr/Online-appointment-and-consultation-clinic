<?php 
    // session_start();

    // if (!isset($_SESSION['logged-in'])){
    //     header('location: ../login/login.php');
    // }

    $path = "../../";
    require_once $path.'tools/variables.php';
    $page_title = "Frequently asked questions";
    $faq = "nav-current";

    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="faq.css" />
<script src="index.js" defer></script>
<?php require_once $path.'includes/starterTwo.php'; ?>


<body>
  <!-- HEADER -->
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

  </header>

  <!-- FAQ -->
  <section class="faq-parent sizing-secondary text-center">

    <div class="section-header-parent">
      <h2 class="text-capital">Frequently asked questions</h2>
    </div>

    <!-- accordian -->
    <div class="accordion-wrapper sizing-secondary">
      <!-- 1 -->
      <div class="accordion">
        <input type="radio" name="radio-a" id="check1">
        <label class="accordion-label" for="check1">What are good and bad foods?</label>
        <div class="accordion-content">
          <p>If you’re looking at improving true functional health, there really are no good or bad foods. Unless a
            person truly has to avoid some foods because of allergens or medical restrictions, I do not discourage
            certain foods. It’s always good to allow yourself to be realistic, and so much of nutrition is about
            moderation. Nutrition is like a marathon — you are always working at it.</p>
        </div>
      </div>
      <!-- 2 -->
      <div class="accordion">
        <input type="radio" name="radio-a" id="check2">
        <label class="accordion-label" for="check2">What about sugar-free or diet foods?</label>
        <div class="accordion-content">
          <p>I advise steering away from processed, diet foods because they have a number of chemical additives. Some
            artificial sweeteners can cause intestinal cramping. Seniors rely on some processed foods like frozen
            dinners, but it is really important for their diet to include more of plain, fresh, unprocessed foods.</p>
        </div>
      </div>
      <!-- 3 -->
      <div class="accordion">
        <input type="radio" name="radio-a" id="check3">
        <label class="accordion-label" for="check3">What about medication and food interactions?</label>
        <div class="accordion-content">
          <p>Always check with your doctor and pharmacist about how a specific medication interacts with food. For
            example, some leafy greens and foods high in vitamin K can affect blood thinners. If you are taking a blood
            thinner, you don’t need to avoid leafy green vegetables entirely — you just need to be consistent in your
            intake and not go overboard. Also, grapefruit can affect the absorption and metabolizing of certain drugs.
            Salt substitutes often replace salt with potassium and can decrease the effectiveness of medications for
            high blood pressure and congestive heart failure.</p>
        </div>
      </div>
    </div>

  </section>

  <!-- footer -->
  <?php require_once $path.'includes/footer.php'; ?>

  <!-- FLOATERS -->
  <!-- MODAL -->
  <?php require_once $path.'includes/loginRegModal.php'; ?>

</body>

</html>