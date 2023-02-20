<?php 
    $path = "../../../";
    
    session_start();

    require_once $path.'classes/appoint.class.php';
    require_once $path.'classes/user.class.php';
    require_once $path.'classes/consult.class.php';

    require_once $path.'tools/variables.php';
    $page_title = "Consultation";
    $consultation = 'nav-current';


    if($_SESSION['user_loggedIn']['user_privilege'] == 'client') {
      header('Location: ../consultation.php?transact_id='.$_GET['transact_id']);
      exit();
    }

    $board_page = 1;
    
    $appoint = new appoint;
    $consult = new consult;
    $clientData = new user;

    // SEARCH BAR --- GET --- TO GENERATE 
    if(isset($_GET['transact_id'])) {
      $appoint -> transact_id = $_GET['transact_id'];

      // Set $session transaction
      if(!isset($_SESSION['transact_rnd_id'])) {
        $_SESSION['transact_rnd_id'] = $appoint -> getAppointCheckpointStatus()['rnd_id'];
      }
      if(!isset($_SESSION['transact_client_id'])) {
        $_SESSION['transact_client_id'] = $appoint -> validate()['user_id'];
      }

      $_SESSION['transact_id'] = $_GET['transact_id'];
      $result = $appoint -> validate();
      if($result) {
          $board_transact_id = $result['transact_id'];
          $board_page = $result['board_page'];

          // board 1
          // GETTING DATA FOR TABULATION
          $appoint -> transact_id = $board_transact_id;
          $appointInfo = $appoint -> getAppoint();
          $appoint -> appoint_id = $appointInfo['appoint_id'];
          $consultInfo = $appoint -> getConsultInfo();
          $foodInfo = $appoint -> getFoodInfo();
          $physicalInfo = $appoint -> getPhysicalInfo();
          $medicalInfo = $appoint -> getMedicalInfo();
          $clientInfo = $appoint -> getClientInfo();

          $listFoodAllergy = [];
          $listFoodLike = [];
          $listFoodDislike = [];

          foreach($appoint -> getFoodAllergy() as $test) {
            array_push($listFoodAllergy, $test['allergy_name']);
            array_push($listFoodLike, $test['food_like_name']);
            array_push($listFoodDislike, $test['food_dislike_name']);
          }

          // body type
          $bodyType = $appoint -> getbodyType();
          $bodyTypeList = [];

          foreach($bodyType as $type) {
            array_push($bodyTypeList, $type['body_type_name']);
          }
      }

      $cheduleInfo = [];
      if($board_page == 3) {
        // DATA CONSULT
        // GET USER INFO
        $consult-> transact_id = $_SESSION['transact_id'];
        $cheduleInfo = $consult -> getSchedule();
        // $consultInfo = $consult -> getConsultInfo();
      }

      if(isset($_SESSION['transact_rnd_id'])) {
        $clientData -> user_id = $_SESSION['transact_client_id'];
        $resultClientData = $clientData -> getUserData();
        // print_r($resultClientData);
      }
    }
    // print_r($_SESSION);

    // getConsultInfo()
    require_once $path.'includes/starterOne.php';
?>
<link rel="stylesheet" href="consultation.css">
<link rel="stylesheet" href="../consultation.css" />
<link rel="stylesheet" href="../../rnds/rnds.css" />
<link rel="stylesheet" href="../status.css">
<script type="module" src="../../index.js" defer></script>
<script src="consultation.js" defer></script>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<?php require_once $path.'includes/starterTwo.php'; ?>

<body>
  <header>
    <!-- website tag -->
    <?php require_once $path.'includes/websitetag.php'; ?>
    <!-- navigator -->
    <?php require_once $path.'includes/navigator.php'; ?>

    <main>
      <div class="sizing-secondary">
        <div class="main-text text-center">
          <h1 class="text-uppercase">
            Reach your RND<span class="text-initial">s</span> from anywhere
          </h1>
          <p>
            Consulting oneself in a hospital is important for early detection and treatment of illnesses or injuries. It
            also helps to keep track of one's overall health and prevent the progression of any potential health issues.
          </p>
          <a href="#board-parent" class="button button-primary">Book now!</a>
        </div>
      </div>

    </main>

  </header>

  <!-- RND STUFF - ADMIN  -->
  <section id="board-parent" class="board-parent ">

    <!-- Set up your appointment -->
    <form action="consultation.php" class="form search-form" method="get">

      <!-- search appoint id  -->
      <div class="form-input-parent search-parent">
        <div class="form-input-box">
          <input type="number" name="transact_id" placeholder="Enter your appointment number">
          <button type="submit" value="submit" class="button-primary">Search</button>
        </div>
      </div>

    </form>

    <div class="board-container card">
      <!-- Progress -->
      <div class="board-progress">
        <div class="main flex-center">
          <ul class="text-center">
            <!-- 1 -->
            <li data-board-page="1" class="current">
              <i class="icon uil uil-capture"></i>
              <div class="progress one">
                <p>1</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text">Appointment</p>
            </li>
            <!-- - -->
            <li data-board-page="2" class="small-checkpoint">
              <i class="icon uil uil-clipboard-notes"></i>
              <div class="progress two">
                <!-- <p>2</p> -->
                <i class="uil uil-check"></i>
              </div>
            </li>
            <!-- 2 -->
            <li data-board-page="3">
              <i class="icon uil uil-credit-card"></i>
              <div class="progress three">
                <p>2</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text">Consultation</p>
            </li>
            <!-- - -->
            <li data-board-page="4" class="small-checkpoint">
              <i class="icon uil uil-exchange"></i>
              <div class="progress four">
                <!-- <p>4</p> -->
                <i class="uil uil-check"></i>
              </div>
            </li>
            <!-- 3 -->
            <li data-board-page="5">
              <i class="icon uil uil-map-marker"></i>
              <div class="progress five">
                <p>3</p>
                <i class="uil uil-check"></i>
              </div>
              <p class="text">Solution</p>
            </li>
          </ul>
        </div>
      </div>

      <form action="consultation.php">
        <!-- <input type="hidden" class="board-page" value="<?php echo $board_page ?>"> -->
        <input type="hidden" class="path" value="<?php echo $path ?>">
      </form>

      <!-- 3 -->
      <!-- consultation -->
      <div data-board-page="3" class="consultation-stage board-page <?php echo $board_page == 3?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Consultation</h2>
        </div>
        <!-- Form -->
        <div class="form">
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Appointment Numbuh -->
              <div class="form-input-box ">
                <label for="firstname">Appointment number</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo '#'.$appoint -> transact_id ?>"
                  disabled>
              </div>
              <!-- Upcoming schedule -->
              <div class="form-input-box schedule-container">
                <div class="container-header text-center flex-center text-uppercase">
                  <p>Upcoming schedule</p>
                </div>
                <div class="list-schedule">
                  <ul>
                  </ul>

                  <div class="schedule-button flex-center <?php echo $board_page > 3? 'hidden':"" ?> ?>">
                    <a href="#" class="button mini-button"><i class="fa-solid fa-plus"></i></a>
                    <a href="#" class="button mini-button"><i class="fa-solid fa-pen"></i></a>
                  </div>

                  <!-- MODAl - ADD  -->
                  <div class="modal-parent modal-notif-parent modal-tool schedule-add overlay-black flex-center hidden">

                    <!-- modal -->
                    <div class="modal-container modal-notif-container sizing-secondary">
                      <!-- header -->
                      <div class="modal-header text-center">
                        <h2 class="text-uppercase">Add schedule</h2>
                      </div>
                      <!-- form -->
                      <form class="form form-add-schedule" method="post">
                        <div class="divider modal-body">
                          <div class="form-input-parent">
                            <!-- Appointment date -->
                            <div class="form-input-box input-one">
                              <label for="appointment-date" class="text-capital">Appointment date <span>*</span></label>
                              <input type="date" name="appointment-date" required id="appointment-date"
                                min="<?php echo date("Y-m-d") ?>">
                            </div>
                            <!-- Appointment time -->
                            <div class="form-input-box input-one">
                              <label for="appointment-time" class="text-capital">Appointment time <span>*</span></label>
                              <input type="time" name="appointment-time" id="appointment-time" required>
                            </div>
                          </div>
                        </div>

                        <!-- hidden - fox ajax -->
                        <input type="hidden" name="submit" value='true' id="submit">
                        <!-- button -->
                        <div class="modal-buttons">
                          <a class="button button-cancel">Go back</a>
                          <button type="submit" name='submit' value="submit"
                            class="button button-primary">Submit</button>

                        </div>
                      </form>

                    </div>

                    <!-- modal confirmation -->


                  </div>
                  <!-- MODAL - EDIT -->
                  <div
                    class="modal-parent modal-notif-parent modal-tool schedule-edit overlay-black flex-center hidden">

                    <!-- hidden - fox ajax -->
                    <input type="hidden" name="submit" value='true' id="submit">

                    <!-- modal -->
                    <div class="modal-container modal-notif-container sizing-secondary">
                      <!-- header -->
                      <div class="modal-header text-center">
                        <h2 class="text-uppercase">Edit schedule</h2>
                      </div>
                      <!-- list of sched -->
                      <ul class="list-sched modal-body">
                        <?php foreach($cheduleInfo as $schedule ) { ?>
                        <li data-schedule-id="<?php echo $schedule['consult_schedule_id'] ?>">
                          <p><?php echo $schedule['date'] ?></p>
                          <p><?php echo date('h:i a', strtotime($schedule['time'])) ?></p>
                          <p>1 hour left</p>
                          <p class="cursor-pointer hidden"><i class="fa-solid fa-arrow-right"></i></p>
                        </li>
                        <?php } ?>
                      </ul>

                      <!-- edit -->
                      <div class="sched-edit-parent">
                        <?php foreach($cheduleInfo as $schedule ) { ?>
                        <form data-schedule-id="<?php echo $schedule['consult_schedule_id'] ?>"
                          class="form edit-form-sched hidden modal-body hidden" method="post">

                          <div class="divider modal-body">
                            <div class="form-input-parent ">
                              <!-- Appointment date -->
                              <div class="form-input-box input-one">
                                <label for="appointment-date" class="text-capital">Appointment date
                                  <span>*</span></label>
                                <input type="date" name="appointment-date" id="appointment-date"
                                  value="<?php echo $schedule['date'] ?>">
                              </div>
                              <!-- Appointment time -->
                              <div class="form-input-box input-one">
                                <label for="appointment-time" class="text-capital">Appointment time
                                  <span>*</span></label>
                                <input type="time" name="appointment-time" id="appointment-time"
                                  value="<?php echo $schedule['time'] ?>">
                              </div>
                            </div>
                          </div>

                          <!-- hidden - fox ajax -->
                          <input type="hidden" name="submit" value='true' id="submit">
                          <input type="hidden" name="targetSched" value='<?php echo $schedule['consult_schedule_id'] ?>'
                            id="submit">

                          <!-- button -->
                          <div class="modal-buttons flex-center hiddens">
                            <!-- <a class="button button-cancel ">Go back</a> -->
                            <a class="button button-back">Go back</a>
                            <a href="#" class="button button-primary button-delete "><i
                                class="fa-solid fa-trash"></i></a>
                            <button type="submit" name='submit' value="submit"
                              class="button button-primary button-submit ">UPDATE</button>
                          </div>

                        </form>
                        <?php } ?>
                      </div>

                    </div>

                  </div>

                </div>
              </div>
            </div>
            <!-- 2 -->
            <div class="form-input-parent divider-grow">
              <!-- Appointment Numbuh -->
              <div class="form-input-box input-one">
                <label for="firstname">Chief complaint</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $consultInfo['chief_complaint'] ?>"
                  disabled>
              </div>

              <!-- Date appointment submitted -->
              <div class="form-input-box input-one messenger-container ">

                <!-- actual sms  -->
                <div class="actual-message-container">
                  <!-- messege 1 -->
                  <div class="message-me messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                  <!-- messege 2 -->
                  <div class="message-you messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                  <!-- messege 3 -->
                  <div class="message-you messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                  <!-- messege 1 -->
                  <div class="message-me messesage-con">
                    <p class="time">04:00pm</p>
                    <p class="message-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, a!</p>
                  </div>
                </div>

                <!-- sms box input -->
                <div class="sms-box-container">
                  <input type="text" name="middlename" id="middlename" placeholder="Your message here"
                    <?php echo $board_page > 3? 'disabled':"" ?>>
                </div>

              </div>
            </div>
            <!-- 3 -->
            <div class="form-input-parent flex-center">
              <!-- img -->
              <div class="list-rnd-box grid-box card">
                <div class="list-rnd-image flex-center">
                  <img src="../../../asset/doctor-bulk-billing-doctors-chapel-hill-health-care-medical-3.png" alt="">
                </div>
                <div class="list-rnd-info text-center">
                  <p class="assigned-rnd">
                    <?php echo $resultClientData['first_name'].' '.$resultClientData['last_name'] ?></p>
                  <a href="#" class="text-uppercase text-center profile-link">view profile</a>
                </div>
              </div>
              <!-- virtual room -->
              <div class="form-input-box virtual-room-container">
                <div class="container-header text-center flex-center text-uppercase">
                  <p>in virtual room</p>
                  <a href="https://www.youtube.com/watch?v=vvFSVIy1Nqs" target="_blank"
                    class="button button-join mini-button">JOIN</a>
                </div>
                <div class="list-schedule">
                  <ul>
                    <li data-userId="0" class="client-join join-user hidden">
                      <div class="circle"></div>
                      <p>RND Gregory Yames</p>
                    </li>
                    <li data-userId="0" class="rnd-join join-user hidden">
                      <div class="circle"></div>
                      <p>RND Gregory Yames</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="form-button">

            <!-- prev -->
            <div class="button-prev ">
              <button class="button hidden">prev</button>
            </div>
            <!-- middle -->
            <div>
              <button class="button button-tertiary button-clientInfo">Client information</button>
            </div>

            <!-- next -->
            <div class="button-next <?php echo $board_page > 3 ? "":"hidden" ?>">
              <button class="button button-next button-primary">Next
              </button>
            </div>
            <!-- next -->
            <div
              class="button-confirmation button-confirmation-boardThree <?php echo $board_page == 3 ? "":"hidden" ?>">
              <button class="button button-next button-primary">Complete
              </button>
            </div>
          </div>

          <!-- MODAl - CONFIRMATION -->
          <div class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">
            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">Sure ka bhie?</h2>
              </div>
              <p class="text-center">Mark the transaction complete. <br><em>This action cannot be reverted</em></p>
              <div class="modal-buttons">
                <a class="button button-cancel">Go back</a>
                <div class="button-confirm-final button-confirm-finalThree">
                  <a type="submit" name='submit' value="submit" class="button button-primary">Submit</a>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL - CLIENT INFO -->
          <div class="modal-parent modal-notif-parent modal-client-info overlay-black flex-center hidden">
            <div class="modal-container modal-notif-container sizing-secondary">
              <div class="modal-header text-center">
                <h2 class="text-uppercase">Client information</h2>
              </div>

              <div class="modal-data">

                <!-- Personal information -->
                <div class="data-container data-personal">
                  <h3 class="text-uppercase">Personal information</h3>
                  <p>Full name: Sofia Libero Andres</p>
                  <p>Birthdate: May 15, 2000</p>
                  <p>Gender: Female</p>
                </div>

                <!-- Contact information -->
                <div class="data-container data-contact">
                  <h3 class="text-uppercase">Contact information</h3>
                  <p>Phone number: 09976936708</p>
                  <p>Email address: tite@titeng-galet.xyz</p>
                </div>


                <!-- Health information -->
                <div class="data-container data-health">
                  <h3 class="text-uppercase">Health information</h3>
                  <p>Current height: 160 cm</p>
                  <p>Current weight: 160 lbs</p>
                </div>


                <!-- Consultation information -->
                <div class="data-container data-consultation">
                  <h3 class="text-uppercase">Consultation information</h3>
                  <p>Referral form: <a href="#">test.pdf</a></p>
                  <p>Medical form: <a href="#">test.pdf</a></p>
                  <p>Current weight: tite@titeng-galet.xyz</p>
                </div>

                <!-- Consultation information -->
                <div class="data-container data-nutritional">
                  <h3 class="text-uppercase">Nutritional information</h3>
                  <p>Referral form: <a href="#">test.pdf</a></p>
                  <p>Medical form: <a href="#">test.pdf</a></p>
                  <p>Current weight: tite@titeng-galet.xyz</p>
                </div>

              </div>

              <div class="modal-buttons">
                <a class="button button-cancel">Go back</a>
              </div>
            </div>
          </div>


        </div>

      </div>

      <!-- 4 -->
      <!-- consultation checkpoint -->
      <div data-board-page="4"
        class="consultation-checkpoint-stage board-page <?php echo $board_page == 4?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Upload consultation result</h2>
        </div>
        <!-- Form -->
        <form action="/" class="form" method="post">
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Upcoming schedule -->
              <div class="form-input-box schedule-container upload-box">
                <div class="container-header text-center flex-center text-uppercase">
                  <p>Files</p>
                </div>
                <div class="divider">
                  <div class="form-input-parent">
                    <!-- Referral form -->
                    <div class="form-input-box input-one">
                      <label for="appointment-referral">Consultation result file</label>
                      <input type="file" name="appointment-referral" id="appointment-referral">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Medical record -->
                    <div class="form-input-box input-one hidden">
                      <label for="appointment-medical" class="text-capital">Conversation transcript</label>
                      <input type="file" name="appointment-medical" id="appointment-medical" disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="form-button">

            <!-- prev -->
            <div class="button-prev">
              <button class="button">prev</button>
            </div>
            <!-- middle -->
            <div>
              <button class="button hidden" disabled>Submit</button>
            </div>

            <!-- next -->
            <div class="button-next <?php echo $board_page > 4 ? "":"hidden" ?>">
              <button class="button button-next button-primary">Next
              </button>
            </div>
            <!-- next -->
            <div class="button-upload-confirmation <?php echo $board_page == 4 ? "":"hidden" ?>">
              <button class="button button-next button-primary">Upload
              </button>
            </div>


          </div>
        </form>

        <!-- MODAl - CONFIRMATION -->
        <div class="modal-parent modal-notif-parent modal-appointment-confirmation overlay-black flex-center hidden">
          <div class="modal-container modal-notif-container sizing-secondary">
            <div class="modal-header text-center">
              <h2 class="text-uppercase">Sure ka bhie?</h2>
            </div>
            <p class="text-center">Mark the transaction complete. <br><em>This action cannot be reverted</em></p>
            <div class="modal-buttons">
              <a class="button button-cancel">Go back</a>
              <div class="button-confirm-final button-confirm-finalFour">
                <a type="submit" name='submit' value="submit" class="button button-primary">Upload</a>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- 5 -->
      <!-- Solution -->
      <div data-board-page="5" class="solution-stage board-page <?php echo $board_page == 5?"":"hidden" ?>">
        <!-- Board Header -->
        <div class="board-header text-uppercase text-center">
          <h2>Solution</h2>
        </div>

        <!-- Form -->
        <form action="/" class="form" method="post">
          <div class="divider">
            <!-- 1 -->
            <div class="form-input-parent">
              <!-- Upcoming schedule -->
              <div class="form-input-box schedule-container upload-box">
                <div class="container-header text-center flex-center text-uppercase">
                  <p>Files</p>
                </div>
                <div class="divider">
                  <div class="form-input-parent">
                    <!-- Referral form -->
                    <div class="form-input-box input-one">
                      <label for="appointment-referral">Consultation result file</label>
                      <input type="file" name="appointment-referral" id="appointment-referral">
                      <p class="form-error-message hidden">Error</p>
                    </div>
                    <!-- Medical record -->
                    <div class="form-input-box input-one hidden">
                      <label for="appointment-medical" class="text-capital">Conversation transcript</label>
                      <input type="file" name="appointment-medical" id="appointment-medical" disabled>
                      <p class="form-error-message hidden">Error</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="form-button">

            <!-- prev -->
            <div class="button-prev">
              <button class="button">prev</button>
            </div>
            <!-- middle -->
            <div>
              <button class="button hidden" disabled>Submit</button>
            </div>
            <!-- next -->
            <div class="">
              <a href="<?php echo $path.'homepage/index.php' ?>" class="button button-primary">Home
              </a>
            </div>
          </div>
        </form>

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