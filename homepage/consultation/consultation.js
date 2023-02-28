"use strict";

let path = "../../";

const body = document.querySelector("body");

// LIMIT CHECK BOX FOR BODY TYPE
$("#physical-tab input:checkbox").click(function () {
  let bol = $("#physical-tab input:checkbox:checked").length >= 2;
  $("#physical-tab input:checkbox").not(":checked").attr("disabled", bol);
});

// Appoint for
const boardContainer = document.querySelector(".board-container");

const appointmentStage = boardContainer.querySelector(".appointment-stage");
const appointFor = appointmentStage.querySelector(".appointment-for");

appointFor.addEventListener("click", function (e) {
  if (appointFor.querySelector("#myself").checked) {
    appointmentStage.querySelector("#tab1").checked = true;
    appointmentStage.querySelector("#tab5").classList.add("hidden");
    appointmentStage.querySelectorAll(".personal-tab").forEach((tab) => {
      tab.classList.add("hidden");
    });
  } else {
    appointmentStage.querySelector("#tab5").classList.remove("hidden");
    appointmentStage.querySelector("#tab1").checked = false;
    appointmentStage.querySelector("#tab5").checked = true;
    appointmentStage.querySelectorAll(".personal-tab").forEach((tab) => {
      tab.classList.remove("hidden");
    });
  }
});

// modal close
const modalAppointNotif = document.querySelector(
  ".modal-appointment-confirmation"
);

modalAppointNotif.addEventListener("click", function (e) {
  if (
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-cancel")
  ) {
    body.classList.remove("lock-page");
    this.classList.toggle("hidden");
  }
});

// FOR APPOINT BUTTON - DISABLE AND ABLE
$(boardContainer).ready(function () {
  $(".form-input-box input").keyup(function () {
    let empty = false;
    $(".form-input-box input:required").each(function () {
      if ($(this).val().length == 0) {
        empty = true;
      }
    });

    if (empty) {
      $(".button-semi-submit button").attr("disabled", "disabled");
    } else {
      $(".button-semi-submit button").attr("disabled", false);
      $(".button-semi-submit button").addClass("button-primary");
    }
  });
});

// Progresss
const one = document.querySelector(".one");
const two = document.querySelector(".two");
const three = document.querySelector(".three");
const four = document.querySelector(".four");
const five = document.querySelector(".five");

function changePage(currentBoardPage, boardSets, target) {
  let pagination = [currentBoardPage - 1, currentBoardPage + 1];

  boardSets.forEach((board) => {
    let currentPage = parseInt(board.getAttribute("data-board-page"));

    if (currentPage != pagination[target]) {
      board.classList.add("hidden");
    } else {
      board.classList.remove("hidden");
    }
  });
}
function changeBoardProgress(currentPage) {
  switch (currentPage) {
    case 1:
      one.classList.add("active");
      two.classList.remove("active");
      three.classList.remove("active");
      four.classList.remove("active");
      five.classList.remove("active");
      break;
    case 2:
      one.classList.add("active");
      two.classList.add("active");
      three.classList.remove("active");
      four.classList.remove("active");
      five.classList.remove("active");
      break;
    case 3:
      one.classList.add("active");
      two.classList.add("active");
      three.classList.add("active");
      four.classList.remove("active");
      five.classList.remove("active");
      break;
    case 4:
      one.classList.add("active");
      two.classList.add("active");
      three.classList.add("active");
      four.classList.add("active");
      five.classList.remove("active");
      break;
    case 5:
      one.classList.add("active");
      two.classList.add("active");
      three.classList.add("active");
      four.classList.add("active");
      five.classList.add("active");
      break;
  }
}

const boardSets = boardContainer.querySelectorAll(".board-page");
const boardProgress = boardContainer.querySelector(".board-progress");

boardContainer.addEventListener("click", function (e) {
  let currentBoardPage = getActiveBoard();

  // console.log(e.target);
  // console.log(document.querySelector("select[name='metric']"));
  // console.log($("select[name='metric']").val());

  // board 1

  if (e.target.parentElement.classList.contains("button-semi-submit")) {
    modalAppointNotif.classList.toggle("hidden");
    body.classList.add("lock-page");
  }

  // button confimation
  if (e.target.parentElement.classList.contains("button-confirmation")) {
    modalAppointNotif.classList.toggle("hidden");
    body.classList.add("lock-page");
  }

  if (e.target.parentElement.classList.contains("button-confirm-final")) {
    changePage(currentBoardPage, boardSets, 1);
    changeBoardProgress(currentBoardPage + 1);
    ajaxCaller(currentBoardPage + 1);
  }

  // prev
  if (e.target.parentElement.classList.contains("button-prev")) {
    e.preventDefault();
    changePage(currentBoardPage, boardSets, 0);
    changeBoardProgress(currentBoardPage - 1);
    ajaxCaller(currentBoardPage - 1);
  }
  // next
  if (e.target.parentElement.classList.contains("button-next")) {
    e.preventDefault();
    changePage(currentBoardPage, boardSets, 1);
    changeBoardProgress(currentBoardPage + 1);
    ajaxCaller(currentBoardPage + 1);
  }

  if (
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-cancel")
  ) {
    e.target
      .closest(".board-page")
      .querySelectorAll(".modal-parent")
      .forEach((modal) => {
        modal.classList.add("hidden");
      });
  }

  if (e.target.closest(".button-join")) {
    // e.preventDefault();
    $.ajax({
      type: "POST", //hide url
      url: `../../php/request/req-board-page.php`, //your form validation url
      dataType: "json",
      success: function (data) {
        if (data.board_page == 3) {
          $.ajax({
            type: "POST", //hide url
            url: `../../php/update/update-consult-join.php`, //your form validation url
            dataType: "json",
            success: function (response) {
              console.log(response);
            },
            error: function () {
              console.log("fail xxx");
            },
          });
        }
      },
      error: function () {
        console.log("fail to fetch board page");
      },
    });
  }

  // edit section - choosing of schedule
  if (e.target.closest("li")) {
    if (e.target.closest("li")) {
      console.log(e.target.closest("li").getAttribute("data-schedule-id"));
      e.target.closest(".list-sched").classList.add("hidden");
      e.target
        .closest(".modal-container")
        .querySelector(".form")
        .classList.remove("hidden");
      e.target
        .closest(".modal-container")
        .querySelector(".button-submit")
        .classList.remove("hidden");
      e.target
        .closest(".modal-container")
        .querySelector(".button-cancel")
        .classList.add("hidden");
      e.target
        .closest(".modal-container")
        .querySelector(".button-back")
        .classList.remove("hidden");
    }
  }

  if (e.target.classList.contains("button-back")) {
    console.log("test");
    e.target
      .closest(".modal-container")
      .querySelector(".form")
      .classList.add("hidden");
    e.target
      .closest(".modal-container")
      .querySelector(".list-sched")
      .classList.remove("hidden");
    e.target
      .closest(".modal-container")
      .querySelector(".button-submit")
      .classList.add("hidden");
    e.target
      .closest(".modal-container")
      .querySelector(".button-cancel")
      .classList.remove("hidden");
    e.target
      .closest(".modal-container")
      .querySelector(".button-back")
      .classList.add("hidden");
  }
});

// for searching - auto set board progress
// ONCE RUN
function getActiveBoard() {
  for (const property in boardSets) {
    if (!boardSets[property].classList.contains("hidden")) {
      let tite = parseInt(boardSets[property].getAttribute("data-board-page"));
      return tite;
    }
  }
}

let currentBoardPage = getActiveBoard();
changeBoardProgress(currentBoardPage);

// board 2
let transactRndId = 0;
let pendingRndSize;
let currentRndIndex;
let appointmentStatus = "PENDING";
let appointDateFinish;

// board 3
let isConsultDone = false;
let resultJoin;

function generateMessageMarkUp(data, current_user) {
  let markUp = "";

  data.forEach((sms) => {
    markUp += `
    <div class="${
      current_user == sms.message_sender ? "message-me" : "message-you"
    } messesage-con">
      <p class="time">04:00pm</p>
      <p class="message-text">${sms.message}</p>
    </div>
    `;
  });

  return markUp;
}

function getMessage() {
  $.ajax({
    type: "POST", //hide url
    url: `${path}php/request/req-getMessage.php`, //your form validation url
    dataType: "json",
    success: function (data) {
      console.log(data);

      document.querySelector(".actual-message-container").innerHTML =
        generateMessageMarkUp(data.message, data.current_user);

      // scroll down
      $(".actual-message-container").scrollTop(
        $(".actual-message-container")[0].scrollHeight
      );
    },
    error: function () {
      console.log("ERROR at getting message");
    },
    complete: function () {
      setTimeout(getMessage, 1000);
    },
  });
}

function getBoardTwoData(stopper) {
  // console.log("board 2", stopper);

  if (!stopper) {
    $.ajax({
      type: "POST", //hide url
      url: `../../php/request/request-appoint.php`, //your form validation url
      dataType: "json",
      success: function (data) {
        console.log(data);

        // APPROVED, DECLINED, PENDING
        // Board parent
        let boardParent = ".appointment-checkpoint-stage";

        if (data.rnd_status == "APPROVED") {
          // rdn
          $(`${boardParent} input[name='rdn-assigned']`).val(data.rnd_status);
        } else {
          if (pendingRndSize > 0) {
            $(`${boardParent} input[name='rdn-assigned']`).val(
              `SEARCHING.. ${currentRndIndex} OF ${pendingRndSize}`
            );
          } else {
            $(`${boardParent} input[name='rdn-assigned']`).val(data.rnd_status);
          }
        }

        // Set APPOINTMENT STATUS to its value
        $(`${boardParent} input[name='appoint-status']`).val(
          data.appoint_status
        );

        // Set APPOINTMENT STATUS to its corresponding class
        $(`${boardParent} input[name='appoint-status']`).addClass(
          `status-${data.appoint_status.toLowerCase()}`
        );

        // Set RND STATUS to its corresponding class
        $(`${boardParent} input[name='rdn-assigned']`).addClass(
          `status-${data.rnd_status.toLowerCase()}`
        );

        if (
          data.appoint_status == "APPROVED" &&
          data.rnd_status == "APPROVED"
        ) {
          transactRndId = data.rnd_id;

          $(`${boardParent} .appoint-status-time`).addClass("status-time-good");
          $(`${boardParent} .appoint-status-time span`).text(
            `You're good to go`
          );

          $(`.profile-link`).attr(
            "href",
            `${path}profile/profile.php?profile-id=${transactRndId}`
          );

          // change RND profile
          $.ajax({
            type: "POST", //hide url
            url: `../../php/request/req-katalk-user.php`, //your form validation url
            dataType: "json",
            data: { transactRndId: transactRndId },
            async: false,
            success: function (data) {
              // profile_img
              $(".ka-talk-box img").attr(
                "src",
                `${path}uploads/${
                  data[1].profile_img == null
                    ? "dummy_user.jpg"
                    : data[1].profile_img
                }`
              );

              $(`.assigned-rnd`).text(
                `${data[1].first_name} ${data[1].last_name}`
              );
            },
            error: function (data) {
              console.log("ERROR at getting RND profile");
            },
          });

          $.ajax({
            type: "POST", //hide url
            url: `${path}php/request/req-board-page.php`, //your form validation url
            dataType: "json",
            async: false,
            success: function (response) {
              if (data.board != 2) {
                $(`${boardParent} .button-next button`).prop("disabled", false);
              }
            },
          });

          stopper = true;
        }
      },
      error: function () {
        console.log("fail at ajax");
      },
      complete: function (data) {
        if (stopper) {
          clearTimeout(getBoardTwoData);
        } else {
          setTimeout(getBoardTwoData, 5000, stopper);
        }
      },
    });
  }
}

function getBoardThreeData(stopper) {
  // console.log("board 3", stopper);
  let current_user;

  if (!stopper) {
    showSchedule(".list-schedule ul");

    // REQ BOARD
    $.ajax({
      type: "POST", //hide url
      url: `../../php/request/req-board-page.php`, //your form validation url
      dataType: "json",
      success: function (data) {
        current_user = data.user_id;

        let boardParent = "consultation-stage";

        if (data.board_page > 3) {
          $(`.${boardParent} .button-next button`).prop("disabled", false);
          stopper = true;

          $("#sms_chat").attr("disabled", true);
        }
      },
      error: function () {
        console.log("fail to fetch board page");
      },
    });

    // JOIN
    $.ajax({
      type: "POST", //hide url
      url: `../../php/request/req-consult-join.php`, //your form validation url
      dataType: "json",
      success: function (response) {
        console.log(response);

        let joinUsers = document.querySelectorAll(".join-user");

        response.forEach((user) => {
          if (user.current_in == 1) {
            let targetId = parseInt(user.current_id);
            // console.log(targetId);

            joinUsers.forEach((join) => {
              let currentId = parseInt(join.getAttribute("data-userId"));

              if (targetId === currentId) {
                join.classList.remove("hidden");
              }
            });
          }
        });
      },
      error: function () {
        // console.log("ERROR at getting consult join");
      },
      complete: function () {
        if (stopper) {
          clearTimeout(getBoardThreeData);
        } else {
          setTimeout(getBoardThreeData, 5000, stopper);
        }
      },
    });
  }
}

function getBoardFourData(stopper) {
  console.log("board 4", stopper);

  if (!stopper) {
    $.ajax({
      type: "POST", //hide url
      url: `../../php/request/req-consult.php`, //your form validation url
      dataType: "json",
      success: function (response) {
        // console.log(response);
        let boardParent = ".consultation-checkpoint-stage";

        // appoint status
        $(`${boardParent} input[name='consultation-status']`).val(
          response.consult_result_status
        );

        // date completed
        $(`${boardParent} input[name="date-completed"]`).val(
          response.date_consultation_completed
        );

        // class appoint status
        $(`${boardParent} input[name='consultation-status']`).addClass(
          `status-${response.consult_result_status.toLowerCase()}`
        );

        if (response.consult_result_status == "APPROVED") {
          // PUT LISTENER
          $(`${boardParent} .button-next button`).prop("disabled", false);
          stopper = true;
        }
      },
      error: function () {
        console.log("fail at ajaxsssss");
      },
      complete: function () {
        if (stopper) {
          clearTimeout(getBoardFourData);
        } else {
          setTimeout(getBoardFourData, 5000, stopper);
        }
      },
    });
  }
}

let urlTransactId = new URLSearchParams(window.location.search).get(
  "transact_id"
);

function setterInfo(urlTransactId) {
  if (urlTransactId) {
    // ajax
    $.ajax({
      type: "POST", //hide url
      url: `${path}php/request/req-check-loggedin.php`, //your form validation url
      async: false,
      success: function (data) {
        console.log(data);

        if (data == 1) {
          // if current the account matches the transact id
          $.ajax({
            type: "POST", //hide url
            url: `${path}php/request/req-check-account-matches-transact-id.php`, //your form validation url
            data: { transact_id: urlTransactId },
            async: false,
            success: function (data) {
              if (data == 1) {
                // REDIRECT TO LAST TRANSACT
                $.ajax({
                  type: "POST", //hide url
                  url: `${path}php/request/req-board-page.php`, //your form validation url
                  dataType: "json",
                  data: { transact_id: urlTransactId },
                  async: false,
                  success: function (data) {
                    console.log(data);
                    let currentBoardPage = data.board_page - 1;
                    changePage(currentBoardPage, boardSets, 1);
                    changeBoardProgress(currentBoardPage + 1);
                    ajaxCaller(currentBoardPage + 1);

                    tabulateThenDisabled("transact_id", `#${urlTransactId}`);
                  },
                  error: function () {
                    console.log("ERROR at getting data for REQ BOARD");
                  },
                });

                // SETTING PRIMARY INFO
                let parent = "appointment-stage";

                $(`.${parent} .button-semi-submit`).addClass("hidden");
                $(`.${parent} .button-next`).removeClass("hidden");

                // tabulation
                $.ajax({
                  type: "POST", //hide url
                  url: `${path}php/request/req-appoint-info.php`, //your form validation url
                  dataType: "json",
                  success: function (data) {
                    // console.log(data);

                    // CONSULT
                    let consultInfo = data.consultInfo;

                    // OTHER DATA
                    tabulateThenDisabled(
                      "appoint-date-submitted",
                      consultInfo.appoint_date_submitted
                    );

                    tabulateThenDisabled(
                      "appoint-chief-complaint",
                      consultInfo.chief_complaint
                    );
                    tabulateThenDisabled(
                      "appointment-date",
                      consultInfo.appoint_date
                    );
                    tabulateThenDisabled(
                      "appointment-time",
                      consultInfo.appoint_time
                    );
                    tabulateThenDisabled(
                      "appointment-more-info",
                      consultInfo.appoint_more_info,
                      "textarea"
                    );

                    document
                      .querySelector(`.${parent}`)
                      .querySelectorAll("input[type='file']")
                      .forEach((elem) => {
                        elem.disabled = true;
                      });

                    // FOOD
                    let foodInfo = data.foodInfo;
                    tabulateThenDisabled(
                      "appoint-type-diet",
                      foodInfo.type_diet_id
                    );

                    // allegy
                    tabulateThenDisabled(
                      "appoint-food-allergies",
                      uniqueAndJoin(data.listFoodAllergy)
                    );

                    // like
                    tabulateThenDisabled(
                      "appoint-food-like",
                      uniqueAndJoin(data.listFoodLike)
                    );

                    // dislike
                    tabulateThenDisabled(
                      "appoint-food-dislike",
                      uniqueAndJoin(data.listFoodDislike)
                    );

                    disableCheckbox("smoke-level", foodInfo.smoke_level_id);
                    disableCheckbox("drink-level", foodInfo.drink_level_id);

                    //  PHYSICAL
                    let physicalInfo = data.physicalInfo;

                    tabulateThenDisabled(
                      "appoint-actual-weight",
                      physicalInfo.actual_weight
                    );
                    tabulateThenDisabled(
                      "appoint-current-height",
                      physicalInfo.current_height
                    );

                    // NEEDS FIXING
                    // VALUE OF INPUT IN CHECK BOXES AND SQL QUERY
                    // physical
                    disableCheckbox(
                      "physical-activity",
                      physicalInfo.physical_activity_id
                    );
                    // gain weight
                    disableCheckbox(
                      "gain-weight-level",
                      physicalInfo.gain_weight_level_id
                    );
                    // lose weight
                    disableCheckbox(
                      "lose-weight-level",
                      physicalInfo.lose_weight_level_id
                    );

                    // bodytype
                    document
                      .querySelectorAll("input[name='body-type[]']")
                      .forEach((elem) => {
                        elem.checked = false;
                        elem.disabled = true;
                      });

                    // MEDICAL
                    let medicalInfo = data.medicalInfo;

                    // current medication
                    tabulateThenDisabled(
                      "appoint-medical-current-med",
                      medicalInfo.current_medication
                    );

                    disableCheckbox(
                      "self-condition",
                      medicalInfo.self_past_condition_id
                    );

                    disableCheckbox(
                      "family-condition",
                      medicalInfo.family_past_condition_id
                    );
                  },
                  error: function () {
                    console.log("ERROR at getting data");
                  },
                });
              } else {
                // show error not found
                document
                  .querySelector(".board-parent")
                  .insertAdjacentHTML(
                    "beforeend",
                    generateModalNotif("Appointment number not found.")
                  );
              }
            },
            error: function () {
              console.log("ERROR at matching");
            },
          });
        }
      },
      error: function () {
        console.log("ERROR at getting data for REQ BOARD");
      },
    });
  }
}
setterInfo(urlTransactId);

function generateModalNotif(errorMessage) {
  return `
  <div class="modal-parent modal-notif-parent modal-oops-notif overlay-black flex-center">

  <!-- hidden - fox ajax -->
  <input type="hidden" name="submit" value='true' id="submit">

  <div class="modal-container modal-notif-container sizing-secondary modal-wait">
    <div class="modal-header text-center">
      <h2 class="text-uppercase">Something went wrong</h2>
    </div>
    <div class="modal-message">
      <p class="text-center">${errorMessage}</p>
    </div>
    <div class="modal-buttons">
      <a class="button button-back">Go back</a>
    </div>
  </div>
</div>

  `;
}

function ajaxCaller(currentBoardPage) {
  let parent;

  switch (currentBoardPage) {
    case 1:
      break;
    // board 2
    case 2:
      getBoardTwoData(false);
      break;
    // board 3
    case 3:
      // get who's ka talking stage ni user
      // set names in join room
      $.ajax({
        type: "POST", //hide url
        url: `${path}php/request/req-katalk-user.php`, //your form validation url
        dataType: "json",
        async: false,
        success: function (data) {
          console.log(data);

          // profile_img
          $(".ka-talk-box img").attr(
            "src",
            `${path}uploads/${
              data[1].profile_img == null
                ? "dummy_user.jpg"
                : data[1].profile_img
            }`
          );

          $(`.assigned-rnd`).text(`${data[1].first_name} ${data[1].last_name}`);

          $(`.profile-link`).attr(
            "href",
            `${path}profile/profile.php?profile-id=${data[1].user_id}`
          );

          data.forEach((user, index) => {
            let target;

            if (index == 0) {
              target = document.querySelector(".client-join p");
            }
            if (index == 1) {
              target = document.querySelector(".rnd-join p");
            }

            target.textContent = `${user.first_name} ${user.last_name}`;
            target.closest("li").setAttribute("data-userId", user.user_id);
          });
        },
        error: function (data) {
          console.log("ERROR at getting RND profile");
        },
      });

      // SET VIDEO CALL LINK TO CLIENTs
      $.ajax({
        type: "POST", //hide url
        url: `${path}php/request/req-get-video-link.php`, //your form validation url
        dataType: "json",
        success: function (data) {
          document.querySelector(".button-join").href = data.videocall_link;
        },
        error: function (data) {
          console.log("ERROR at getting RND gmeet");
        },
      });

      // MESSAGE
      getMessage();

      getBoardThreeData(false);
      break;

    // board 4
    case 4:
      getBoardFourData(false);
      break;

    case 5:
      parent = document.querySelector(".solution-stage");

      $.ajax({
        type: "POST", //hide url
        url: `${path}php/request/req-consult.php`, //your form validation url
        dataType: "json",
        success: function (data) {
          let markUp = `
                <a class="consultationSolution" href="${path}php/request/download.php?file=${data.filename}">${data.filename}</a>`;
          $(`.download-form`).html(markUp);
          $(`.download-form`).removeClass("hidden");
        },
        error: function () {
          console.log("ERROR at getting consult checkpoint");
        },
      });
  }
}
ajaxCaller(currentBoardPage);

function generateScheduleMarkUp(response, edit = false) {
  // convert milliseconds to seconds / minutes / hours etc.
  const msPerSecond = 1000;
  const msPerMinute = msPerSecond * 60;
  const msPerHour = msPerMinute * 60;
  const msPerDay = msPerHour * 24;

  // calculate remaining time

  let markUp = ``;

  for (const sched in response) {
    const now = new Date().getTime();

    let time = new Date(`${response[sched].date} ${response[sched].time}`);
    const timeleft = time - now;

    const days = Math.floor(timeleft / msPerDay);
    const hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / msPerHour);
    const minutes = Math.floor((timeleft % (1000 * 60 * 60)) / msPerMinute);
    const seconds = Math.floor((timeleft % (1000 * 60)) / msPerSecond);
    // <p>${days}d ${hours}h ${minutes}m ${seconds}s</p>

    // markUp += `<li data-schedule-id="${response[sched].consult_schedule_id}">
    //                   <p>${response[sched].date}</p>
    //                   <p>${time.toLocaleString("en-US", {
    //                     hour: "numeric",
    //                     minute: "numeric",
    //                     hour12: true,
    //                   })}</p>
    //                   <p>${hours}H ${minutes}M left</p>
    //                   <p class="cursor-pointer ${
    //                     edit ? "" : "hidden"
    //                   }"><i class="fa-solid fa-arrow-right"></i></p>
    //                 </li>`;
    markUp += `<li data-schedule-id="${response[sched].consult_schedule_id}">
                    <p>${response[sched].date}</p>
                    <p>${response[sched].time}</p>
                    <p class="cursor-pointer ${
                      edit ? "" : "hidden"
                    }"><i class="fa-solid fa-arrow-right"></i></p>
                  </li>`;
  }
  // console.log(markUp);
  return markUp;
}

function showSchedule(target, edit = false) {
  $.ajax({
    type: "POST", //hide url req-consult-sched
    url: `../../php/request/req-consult-sched.php`, //your form validation url
    dataType: "json",
    success: function (data) {
      if (data.length < 0) {
        console.log("none");
      }

      document.querySelector(`${target}`).innerHTML = generateScheduleMarkUp(
        data,
        edit
      );
      // console.log(data);
    },
    error: function () {
      // console.log("ERROR at geting schedule data");
    },
  });
}

function spinnerActivate(parent, show) {
  if (show) {
    // remove hidden stopper
    $(`.${parent} .stopper`).removeClass("hidden");
    // remove hidden loading
    $(`.${parent} .spinner`).removeClass("hidden");
  } else {
    // remove hidden stopper
    $(`.${parent} .stopper`).addClass("hidden");
    // remove hidden loading
    $(`.${parent} .spinner`).addClass("hidden");
  }
}

// SUBMIT APPOINTMENT
$(".form-appoint-submit").on("submit", function (e) {
  e.preventDefault();

  console.log("pressed");

  let parentForm = "modal-appointment-confirmation";
  // Show spinner
  spinnerActivate(parentForm, true);

  $.ajax({
    type: "POST", //hide url
    url: `php/set-appoint.php`, //your form validation url
    data: new FormData(this),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    // async: false,
    success: function (data) {
      console.log(data);

      let parent = "appointment-stage";

      // if user is not logged in
      if ("login" in data) {
        $(`.${parent} .modal-appointment-confirmation .modal-message p`).text(
          `${data.login.message}`
        );

        $(
          `.${parent} .modal-appointment-confirmation .button-primary`
        ).addClass("hidden");

        $(
          `.${parent} .modal-appointment-confirmation .modal-container`
        ).addClass("modal-error");

        spinnerActivate(parentForm, false);
        return;
      }

      let stopper = false;

      data.errorResponse.forEach((response) => {
        document
          .querySelector(`#${response.target}`)
          .closest(".form-input-box")
          .querySelector(".form-error-message").textContent = response.message;

        if (response.response == 0) {
          stopper = true;
          spinnerActivate(parentForm, false);
          $(`.${parent} .modal-appointment-confirmation`).addClass("hidden");
          body.classList.remove("lock-page");
          return;
        }
      });

      if (!stopper) {
        $(`.${parent} .modal-appointment-confirmation`).addClass("hidden");
        body.classList.remove("lock-page");

        $(`.${parent} .button-semi-submit`).addClass("hidden");
        $(`.${parent} .button-next`).removeClass("hidden");

        const url = new URL(window.location.href);
        url.searchParams.set("transact_id", data.transact_id);
        window.history.replaceState(null, null, url);

        urlTransactId = data.transact_id;
        setterInfo(urlTransactId);

        let currentBoardPage = 1;
        changePage(currentBoardPage, boardSets, 1);
        changeBoardProgress(currentBoardPage + 1);
        ajaxCaller(currentBoardPage + 1);
      }
    },
    error: function () {
      console.log("ERROR at setting appointment");
    },
  });
});

// SUBMIT MESSAGE
let smsContainer = document.querySelector(".sms-box-container");
smsContainer.addEventListener("click", function (e) {
  let inputElem = smsContainer.querySelector("input");
  let message = inputElem.value;

  if (!message) return;

  $.ajax({
    type: "POST", //hide url
    url: `../../php/set/set-message.php`, //your form validation url
    // dataType: "json",
    data: { data: message },
    success: function (data) {
      inputElem.value = "";
    },
    error: function () {
      console.log("ERROR at setting message");
    },
  });
});

function tabulateThenDisabled(target, data, type = "input") {
  data = data == "" ? "NO DATA GIVEN" : data;

  $(`${type}[name='${target}']`).val(data);
  $(`${type}[name='${target}']`).attr("disabled", true);
}

function getUniqueFromArray(data) {
  return [...new Set(data)];
}

function joinStrings(data) {
  return data.join(", ");
}

function uniqueAndJoin(data) {
  return joinStrings(getUniqueFromArray(data));
}

function disableCheckbox(target, data) {
  document.querySelectorAll(`input[name='${target}']`).forEach((elem) => {
    elem.disabled = true;
    elem.checked = false;
    if (parseInt(elem.value) == data) {
      elem.checked = true;
    }
  });
}

document.addEventListener("click", function (e) {
  // console.log(e.target);

  if (
    e.target.classList.contains("button-back") ||
    e.target.classList.contains("overlay-black")
  ) {
    if (
      e.target.closest(".modal-parent").classList.contains("modal-oops-notif")
    ) {
      e.target.closest(".modal-oops-notif").classList.add("hidden");
    }
  }
});
