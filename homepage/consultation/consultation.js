"use strict";

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

  if (e.target.parentElement.classList.contains("button-semi-submit")) {
    modalAppointNotif.classList.toggle("hidden");
  }

  // button confimation
  if (e.target.parentElement.classList.contains("button-confirmation")) {
    modalAppointNotif.classList.toggle("hidden");
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
    e.preventDefault();

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

let transactRndId = 0;
let appointCheckpoint = true;

// board 2
let pendingRndSize;
let currentRndIndex;
let appointmentStatus = "PENDING";
let appointDateFinish;

// board 3
let isConsultDone = false;
let resultJoin;

function ajaxCaller(currentBoardPage) {
  switch (currentBoardPage) {
    // board 2
    case 2:
      if (appointCheckpoint) {
        const boardTwo = setInterval(() => {
          $.ajax({
            type: "POST", //hide url
            url: `../../php/request/request-appoint.php`, //your form validation url
            dataType: "json",
            success: function (response) {
              console.log(response);
              let boardParent = ".appointment-checkpoint-stage";

              if (response.rnd_status == "APPROVED") {
                // rdn
                $(`${boardParent} input[name='rdn-assigned']`).val(
                  response.rnd_status
                );
                clearInterval(checkRndFeedback);
              } else {
                if (pendingRndSize > 0) {
                  $(`${boardParent} input[name='rdn-assigned']`).val(
                    `SEARCHING.. ${currentRndIndex} OF ${pendingRndSize}`
                  );
                } else {
                  $(`${boardParent} input[name='rdn-assigned']`).val(
                    response.rnd_status
                  );
                }
              }

              // appoint status
              $(`${boardParent} input[name='appoint-status']`).val(
                response.appoint_status
              );

              // class appoint status
              if (response.appoint_status == "APPROVED") {
                $(`${boardParent} input[name='appoint-status']`).addClass(
                  "status-approved"
                );
              } else if (response.appoint_status == "DECLINED") {
                $(`${boardParent} input[name='appoint-status']`).addClass(
                  "status-declined"
                );
              } else {
                $(`${boardParent} input[name='appoint-status']`).addClass(
                  "status-pending"
                );
              }

              // class assigned rnd
              if (response.rnd_status == "APPROVED") {
                $(`${boardParent} input[name='rdn-assigned']`).addClass(
                  "status-approved"
                );
              } else if (response.rnd_status == "DECLINED") {
                $(`${boardParent} input[name='rdn-assigned']`).addClass(
                  "status-declined"
                );
              } else {
                $(`${boardParent} input[name='rdn-assigned']`).addClass(
                  "status-pending"
                );
              }

              // console.log(response.rnd_id);
              // console.log(response.appoint_status);
              // console.log(response.rnd_status);

              if (response.appoint_status == "APPROVED") {
                appointmentStatus = "APPROVED";
              }

              if (
                response.appoint_status == "APPROVED" &&
                response.rnd_status == "APPROVED"
              ) {
                transactRndId = response.rnd_id;
                appointCheckpoint = false;

                clearInterval(boardTwo);

                $(`${boardParent} .appoint-status-time`).addClass(
                  "status-time-good"
                );
                $(`${boardParent} .appoint-status-time span`).text(
                  `You're good to go`
                );

                $.ajax({
                  type: "POST", //hide url
                  url: `../../php/request/req-board-page.php`, //your form validation url
                  dataType: "json",
                  success: function (response) {
                    // PUT LISTENER
                    if (response.board_page == 2) {
                      // avoid auto click
                      $(`${boardParent} .button-next button`).prop(
                        "disabled",
                        false
                      );
                    }

                    if (response.board != 2) {
                      $(`${boardParent} .button-next button`).prop(
                        "disabled",
                        false
                      );
                    }
                  },
                });
              }
            },
            error: function () {
              console.log("fail at ajax");
            },
          });
        }, 1000);

        const setPendingForRnd = setInterval(() => {
          if (appointmentStatus == "APPROVED") {
            $.ajax({
              type: "POST", //hide url
              url: `../../php/request/req-check-appoint-pending-rnd.php`, //your form validation url
              // dataType: "json",
              async: false,
              success: function (response) {
                pendingRndSize = response;
              },
              error: function (response) {
                console.log("failed to set consult");
              },
            });

            if (pendingRndSize == 0) {
              let rndList = [3, 17, 8];
              $.ajax({
                type: "POST", //hide url
                url: `../../php/set/set-appoint-pending-rnd.php`, //your form validation url
                dataType: "json",
                data: { rndList: rndList },
                async: false,
                success: function (response) {
                  console.log("working");
                  return true;
                },
                error: function (response) {
                  console.log("failed");
                },
              });
            }
            clearInterval(setPendingForRnd);
          }
        }, 1000);

        const checkRndFeedback = setInterval(() => {
          if (pendingRndSize > 0) {
            $.ajax({
              type: "POST", //hide url
              url: `../../php/request/req-appoint-pending-status-size.php`, //your form validation url
              dataType: "json",
              async: false,
              success: function (response) {
                currentRndIndex = response;
              },
              error: function (response) {
                console.log("failed aaa");
              },
            });
          }
        }, 1000);

        const profileChatter = setInterval(() => {
          // set rnf info
          if (transactRndId) {
            $.ajax({
              type: "POST", //hide url
              url: `../../php/request/request-profile.php`, //your form validation url
              data: { target_id: transactRndId },
              dataType: "json",
              success: function (response) {
                $(`.assigned-rnd`).text(
                  `${response.first_name} ${response.last_name}`
                );
                clearInterval(profileChatter);
              },
              error: function (response) {
                console.log("failed to fetch");
              },
            });
          }
        }, 1000);

        const dateCompleted = setInterval(() => {
          if (!appointDateFinish) {
            $.ajax({
              type: "POST", //hide url
              url: `../../php/request/req-date-appoint-completed.php`, //your form validation url
              dataType: "json",
              async: false,
              success: function (response) {
                $(`input[name='appoint-date-submitted']`).val(
                  response.appoint_date_submitted
                );
                clearInterval(dateCompleted);
                appointDateFinish = !appointDateFinish;
              },
              error: function (response) {
                console.log("failed aaa");
              },
            });
          }
        }, 1000);
      }

      break;

    // board 3
    case 3:
      // schedule
      const getSchedule = setInterval(() => {
        showSchedule(".list-schedule ul");
      }, 1000);

      if (!isConsultDone) {
        const boardChecker = setInterval(() => {
          $.ajax({
            type: "POST", //hide url
            url: `../../php/request/req-board-page.php`, //your form validation url
            dataType: "json",
            success: function (response) {
              let boardParent = "consultation-stage";

              if (response.board_page > 3) {
                $(`.${boardParent} .button-next button`).prop(
                  "disabled",
                  false
                );

                clearInterval(boardChecker);
                isConsultDone = true;
              }
            },
            error: function () {
              console.log("fail to fetch board page");
            },
          });
        }, 1000);
      }

      const profileChatter = setInterval(() => {
        $.ajax({
          type: "POST", //hide url
          url: `../../php/request/request-appoint.php`, //your form validation url
          dataType: "json",
          success: function (response) {
            console.log(response);
            transactRndId = response.rnd_id;
          },
          error: function () {
            console.log("fail at ajax");
          },
        });

        // set rnf info
        $.ajax({
          type: "POST", //hide url
          url: `../../php/request/request-profile.php`, //your form validation url
          data: { target_id: transactRndId },
          dataType: "json",
          success: function (response) {
            $(`.assigned-rnd`).text(
              `${response.first_name} ${response.last_name}`
            );
            clearInterval(profileChatter);
          },
          error: function (response) {
            console.log("failed to fetch");
          },
        });
      }, 1000);

      const boardThree = setInterval(() => {
        $.ajax({
          type: "POST", //hide url
          url: `../../php/request/request-appoint.php`, //your form validation url
          dataType: "json",
          success: function (response) {
            let boardParent = `.consultation-stage`;
            // console.log("tite");
            // PUT LISTENER

            // to be checked

            clearInterval(boardThree);
          },
        });
      }, 1000);

      const joinRoom = setInterval(() => {
        $.ajax({
          type: "POST", //hide url
          url: `../../php/request/req-consult-join.php`, //your form validation url
          dataType: "json",
          async: false,
          success: function (response) {
            console.log(response);
            response.forEach((user) => {
              if (user.current_in == 1) {
                $.ajax({
                  type: "POST", //hide url
                  url: `../../php/request/request-profile.php`, //your form validation url
                  dataType: "json",
                  data: { target_id: user.current_id },
                  async: false,
                  success: function (response) {
                    if (response.user_privilege == "client") {
                      document
                        .querySelector(".client-join")
                        .classList.remove("hidden");
                      document.querySelector(
                        ".client-join p"
                      ).textContent = `${response.first_name} ${response.last_name}`;
                    } else {
                      document
                        .querySelector(".rnd-join")
                        .classList.remove("hidden");
                      document.querySelector(
                        ".rnd-join p"
                      ).textContent = `${response.first_name} ${response.last_name}`;
                    }
                  },
                  error: function () {
                    console.log("error");
                  },
                });
              }
              // if(user.join_time )
            });

            // clearInterval(joinRoom);
          },
          error: function () {
            console.log("error");
          },
        });
      }, 5000);
      break;

    // board 3
    case 4:
      const boardFour = setInterval(() => {
        $.ajax({
          type: "POST", //hide url
          url: `../../php/request/req-consult.php`, //your form validation url
          dataType: "json",
          success: function (response) {
            console.log(response);
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
            if (response.consult_result_status == "APPROVED") {
              $(`${boardParent} input[name='consultation-status']`).addClass(
                "status-approved"
              );
            } else if (response.consult_result_status == "DECLINED") {
              $(`${boardParent} input[name='consultation-status']`).addClass(
                "status-declined"
              );
            } else {
              $(`${boardParent} input[name='consultation-status']`).addClass(
                "status-pending"
              );
            }

            if (response.consult_result_status == "APPROVED") {
              // PUT LISTENER
              $(`${boardParent} .button-next button`).prop("disabled", false);
              clearInterval(boardFour);
            }
          },
          error: function () {
            console.log("fail at ajaxsssss");
          },
        });
      }, 1000);

      const dateCompleted = setInterval(() => {
        if (!appointDateFinish) {
          $.ajax({
            type: "POST", //hide url
            url: `../../php/request/req-date-appoint-completed.php`, //your form validation url
            dataType: "json",
            async: false,
            success: function (response) {
              $(`input[name='appoint-date-submitted']`).val(
                response.appoint_date_submitted
              );
              clearInterval(dateCompleted);
              appointDateFinish = !appointDateFinish;
            },
            error: function (response) {
              console.log("failed aaa");
            },
          });
        }
      }, 1000);

      break;
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
    success: function (response) {
      document.querySelector(`${target}`).innerHTML = generateScheduleMarkUp(
        response,
        edit
      );
    },
    error: function () {
      console.log("failed to get sched sss");
    },
  });
}
