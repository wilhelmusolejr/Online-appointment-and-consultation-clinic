<?php

$path = "../";

require_once '../functions/functions.php';
require_once $path.'../classes/appoint.class.php';
require_once $path."../classes/user.class.php";

    session_start();

    if (!isset($_SESSION['logged-in'])){
        header('location: '.$path.'login/login.php');
    }

    if(isset($_GET['user_id'])) {
      $user_id = $_GET['user_id'];

      $user = new user;
      $user -> user_id = $user_id;
      $userData = $user -> getUserData();
    } 

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="test.css">
  <link rel="stylesheet" href="<?php echo $path."global.css" ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>


  <!-- chart -->
  <script type="module" src="<?php echo $path ?>../node_modules/chart.js/dist/chart.umd.js" defer></script>

  <script src="client.js" defer></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" defer></script>
  <title>Client Information for <?php echo $userData['first_name']." ".$userData['last_name'] ?></title>
</head>

<body>
  <input type="hidden" name="user_id" value="<?php echo $user_id ?>" class="user-id">

  <section class="print-parent">
    <div class="header text-center">
      <h1>CLIENT REPORT</h1>
    </div>

    <div class="client-pic-parent">
      <img class="client-pic" src="../../asset/deleon.jpg" alt="">
    </div>

    <br>

    <div class="client-info-parent">
      <p class="text-uppercase">Client basic information</p>

      <div class="divider">
        <div class="left">
          <p>Full name:</p>
        </div>
        <div class="right">
          <p>LOADING</p>
        </div>
      </div>

      <div class="divider">
        <div class="left">
          <p>Age:</p>
        </div>
        <div class="right">
          <p>LOADING</p>
        </div>
      </div>

      <div class="divider">
        <div class="left">
          <p>Sex:</p>
        </div>
        <div class="right">
          <p>LOADING</p>
        </div>
      </div>

      <div class="divider">
        <div class="left">
          <p>Email:</p>
        </div>
        <div class="right">
          <p>LOADING</p>
        </div>
      </div>
    </div>

    <br>
    <br>

    <div class="divider">
      <div class="chart chart-one flex-center">
        <canvas id="stat"></canvas>
      </div>
      <div class="chart chart-one flex-center">
        <canvas id="status"></canvas>
      </div>
    </div>

    <br>
    <br>

    <p>Total approved appointment: <span class="approved-appointment">LOADING</span></p>
    <p>Total declined appointment: <span class="declined-appointment">LOADING</span></p>
    <p>Total pending appointment: <span class="pending-appointment">LOADING</span></p>
    <p>Total appointment: <span class="total-appointment">LOADING</span></p>
    <br>
    <table style="width: 100%">
      <thead>
        <tr>
          <td>Appointment #</td>
          <td>Nutritioanl concern</td>
          <td>Status</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>LOADING</td>
          <td>LOADING</td>
          <td>LOADING</td>
        </tr>
      </tbody>
    </table>

  </section>
</body>

</html>