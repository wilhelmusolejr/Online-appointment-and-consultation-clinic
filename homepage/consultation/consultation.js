"use strict";

let transact = {
  transact: {
    transact_id: null,
    appoint: {
      appoint_id: null,
    },
    consult: {
      consult_id: null,
    },
    user: {
      client_id: null,
      rnd_id: null,
    },
  },
};

// $(".form-appoint-submit").on("submit", function (e) {
//   e.preventDefault(); //prevent to reload the page

//   console.log("test");

//   $.ajax({
//     type: "post", //hide url
//     url: `php/set-appoint.php`, //your form validation url
//     data: $(".form-appoint-submit").serialize(),
//     success: function (response) {
//       console.log(response);
//       if (response == "success") {
//         console.log("sssss");
//       } else {
//         console.log("error");
//       }
//     },
//     error: function () {
//       alert("test");
//     },
//   });
// });

// setInterval(function () {}, 50000);

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

  if (e.target.closest(".mini-button")) {
    e.preventDefault();

    // if add is pressed
    if (
      e.target
        .closest(".mini-button")
        .querySelector("i")
        .classList.contains("fa-plus")
    ) {
      boardContainer
        .querySelector(".list-schedule .schedule-add")
        .classList.remove("hidden");
      console.log("plus");

      // ajax
    }
    // if edit is pressed
    else {
      boardContainer
        .querySelector(".list-schedule .schedule-edit")
        .classList.remove("hidden");
    }
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

function ajaxCaller(currentBoardPage) {
  switch (currentBoardPage) {
    // board 2
    case 2:
      const boardTwo = setInterval(() => {
        $.ajax({
          type: "POST", //hide url
          url: `../../php/request/request-appoint.php`, //your form validation url
          dataType: "json",
          success: function (response) {
            console.log(response);
            let boardParent = ".appointment-checkpoint-stage";

            // appoint status
            $(`${boardParent} input[name='appoint-status']`).val(
              response.appoint_status
            );
            // rdn
            $(`${boardParent} input[name='rdn-assigned']`).val(
              response.rnd_status
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

            // set rnf info
            if (response.rnd_id) {
              $.ajax({
                type: "POST", //hide url
                url: `../../php/request/request-profile.php`, //your form validation url
                data: { target_id: response.rnd_id },
                dataType: "json",
                success: function (response) {
                  $(`.assigned-rnd`).text(
                    `${response.first_name} ${response.last_name}`
                  );

                  // assigned-rnd
                },
                error: function (response) {
                  console.log("failed to fetch");
                },
              });
            }

            console.log(response.appoint_status);
            console.log(response.rnd_status);
            console.log(response.board_page);

            if (
              response.appoint_status == "APPROVED" &&
              response.rnd_status == "APPROVED"
            ) {
              console.log("still 2");

              // PUT LISTENER
              if (response.board_page == 2) {
                // avoid auto click
                $(`${boardParent} .button-next button`).prop("disabled", false);
                setTimeout(function () {
                  $(`${boardParent} .button-next button`).trigger("click");
                }, 5000);

                $.ajax({
                  type: "POST", //hide url
                  url: `../../php/set/set-board.php`, //your form validation url
                  data: { board_page: response.board_page },
                  success: function (response) {
                    console.log(response);
                  },
                  error: function (response) {
                    console.log("failed to fetch board");
                  },
                });

                $.ajax({
                  type: "POST", //hide url
                  url: `../../php/set/set-consult.php`, //your form validation url
                  success: function (response) {
                    console.log(response);
                  },
                  error: function (response) {
                    console.log("failed to set consult");
                  },
                });
              }

              if (response.board != 2) {
                $(`${boardParent} .button-next button`).prop("disabled", false);

                clearInterval(boardTwo);
              }
            }
          },
          error: function () {
            console.log("fail at ajax");
          },
        });
      }, 1000);
      break;

    // board 3
    case 3:
      const boardThree = setInterval(() => {
        showSchedule(".list-schedule ul");
        showSchedule(".list-sched", true);

        $.ajax({
          type: "POST", //hide url
          url: `../../php/request/request-appoint.php`, //your form validation url
          dataType: "json",
          success: function (response) {
            let boardParent = `.consultation-stage`;

            if (response.board_page > 3) {
              // PUT LISTENER
              $(`${boardParent} .button-next button`).prop("disabled", false);
              setTimeout(function () {
                $(`${boardParent} .button-next button`).trigger("click");
              }, 5000);

              clearInterval(boardThree);
            }
          },
        });
      }, 1000);
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

            // class assigned rnd
            // if (response.rnd_status == "APPROVED") {
            //   $(`${boardParent} input[name='rdn-assigned']`).addClass(
            //     "status-approved"
            //   );
            // } else if (response.rnd_status == "DECLINED") {
            //   $(`${boardParent} input[name='rdn-assigned']`).addClass(
            //     "status-declined"
            //   );
            // } else {
            //   $(`${boardParent} input[name='rdn-assigned']`).addClass(
            //     "status-pending"
            //   );
            // }

            if (response.consult_result_status == "APPROVED") {
              // PUT LISTENER
              if (response.board_page == 4) {
                $(`${boardParent} .button-next button`).prop("disabled", false);

                // avoid auto click
                setTimeout(function () {
                  $(`${boardParent} .button-next button`).trigger("click");
                }, 10000);

                $.ajax({
                  type: "POST", //hide url
                  url: `../../php/set/set-board.php`, //your form validation url
                  data: { board_page: response.board_page },
                  success: function (response) {
                    console.log(response);
                  },
                });
              }

              if (response.board != 4) {
                $(`${boardParent} .button-next button`).prop("disabled", false);

                clearInterval(boardFour);
              }
            }
          },
          error: function () {
            console.log("fail at ajaxsssss");
          },
        });
      }, 1000);
      break;
  }
}
ajaxCaller(currentBoardPage);

// ----------------------------
// ADD SCHEDULE
$(".form-add-schedule").on("submit", function (e) {
  e.preventDefault();

  console.log("pressed");

  $.ajax({
    type: "POST", //hide url
    url: `../../php/set/set-consult-schedule.php`, //your form validation url
    data: $(".form-add-schedule").serialize(),
    success: function (response) {
      if (response) {
        document.querySelectorAll(".modal-parent").forEach((modal) => {
          modal.classList.add("hidden");
        });
      }

      document.querySelectorAll(".form-add-schedule input").forEach((input) => {
        input.value = "";
      });
    },
    error: function () {
      console.log("fail at ajax");
    },
  });
});
// ----------------------------
// EDIT SCHEDULE
$(".edit-form-sched").on("submit", function (e) {
  e.preventDefault();

  console.log("pressed");

  $.ajax({
    type: "POST", //hide url
    url: `../../php/update/update-consult-schedule.php`, //your form validation url
    data: $(".edit-form-sched").serialize(),
    success: function (response) {
      console.log(response);
      // if (response) {
      //   document.querySelectorAll(".modal-parent").forEach((modal) => {
      //     modal.classList.add("hidden");
      //   });
      // }
      // document.querySelectorAll(".form-add-schedule input").forEach((input) => {
      //   input.value = "";
      // });
    },
    error: function () {
      console.log("fail at ajax");
    },
  });
});

function generateScheduleMarkUp(response, edit = false) {
  let markUp = ``;

  for (const sched in response) {
    let time = new Date(`${response[sched].date} ${response[sched].time}`);
    markUp += `<li data-schedule-id="${response[sched].consult_schedule_id}">
                      <p>${response[sched].date}</p>
                      <p>${time.toLocaleString("en-US", {
                        hour: "numeric",
                        minute: "numeric",
                        hour12: true,
                      })}</p>
                      <p>1 hour left</p>
                      <p class="cursor-pointer ${
                        edit ? "" : "hidden"
                      }"><i class="fa-solid fa-arrow-right"></i></p>
                    </li>`;
  }
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
      console.log("failed to get sched");
    },
  });
}
