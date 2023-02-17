"use strict";

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

const boardContainer = document.querySelector(".board-container");

// Board listener
const boardSets = boardContainer.querySelectorAll(".board-page");
const boardProgress = boardContainer.querySelector(".board-progress");

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
console.log(currentBoardPage);

// MODAL CONFIRMATION
const modalAppointNotif = document.querySelector(
  ".modal-appointment-confirmation"
);
const modalNotifThree = document.querySelector(
  ".consultation-stage .modal-appointment-confirmation"
);

modalAppointNotif.addEventListener("click", function (e) {
  if (
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-cancel")
  ) {
    this.classList.toggle("hidden");
  }
});

let currentSched;
boardContainer.addEventListener("click", function (e) {
  let currentBoardPage = getActiveBoard();

  console.log(e.target.parentElement);
  // console.log(currentBoardPage);

  if (e.target.closest(".button-join")) {
    e.preventDefault();

    $.ajax({
      type: "POST", //hide url
      url: `../../../php/update/update-consult-join.php`, //your form validation url
      dataType: "json",
      success: function (response) {
        console.log(response);
      },
      error: function () {
        console.log("fail in join room");
      },
    });
  }

  if (e.target.parentElement.classList.contains("button-semi-submit")) {
    modalNotifThree.classList.toggle("hidden");
  }

  // button confimation
  if (
    e.target.parentElement.classList.contains("button-confirmation-boardThree")
  ) {
    modalNotifThree.classList.toggle("hidden");
  }

  if (e.target.parentElement.classList.contains("button-upload-confirmation")) {
    e.preventDefault();

    e.target
      .closest(".consultation-checkpoint-stage ")
      .querySelector(".modal-notif-parent")
      .classList.remove("hidden");
  }

  if (e.target.parentElement.classList.contains("button-confirm-finalFour")) {
    e.preventDefault();
    console.log("test");

    $(".button-upload-confirmation").remove();
    // e.target.parentElement.classList.toggle("hidden");
    this.querySelector(
      ".consultation-checkpoint-stage .button-next"
    ).classList.toggle("hidden");

    // // add file to database
    this.querySelector(
      ".consultation-checkpoint-stage .modal-parent"
    ).classList.toggle("hidden");

    $.ajax({
      type: "POST", //hide url
      url: `../../../php/request/req-board-page.php`, //your form validation url
      dataType: "json",
      async: false,
      success: function (response) {
        console.log(response);

        // increment board page
        $.ajax({
          type: "POST", //hide url
          url: `../../../php/set/set-board.php`, //your form validation url
          data: { board_page: response["board_page"] },
          async: false,
          success: function (response) {
            console.log(response);
          },
          error: function (response) {
            console.log("failed ");
          },
        });
      },
      error: function () {
        console.log("fail");
      },
    });

    // set consult status to approved
    $.ajax({
      type: "POST", //hide url
      url: `../../../php/update/update-consult-result.php`, //your form validation url
      async: false,
      success: function (response) {
        console.log(response);
      },
      error: function (response) {
        console.log("failed ");
      },
    });

    // upload file to database

    changePage(currentBoardPage, boardSets, 1);
    changeBoardProgress(currentBoardPage + 1);
    ajaxCaller(currentBoardPage + 1);
  }

  if (e.target.parentElement.classList.contains("button-confirm-finalThree")) {
    // button confirm final

    console.log("test");

    $(".button-confirmation-boardThree").remove();
    e.target.parentElement.classList.toggle("hidden");
    this.querySelector(".consultation-stage .button-next").classList.toggle(
      "hidden"
    );

    modalAppointNotif.classList.add("hidden");

    $.ajax({
      type: "POST", //hide url
      url: `../../../php/request/req-board-page.php`, //your form validation url
      dataType: "json",
      async: false,
      success: function (response) {
        console.log(response);

        $.ajax({
          type: "POST", //hide url
          url: `../../../php/set/set-board.php`, //your form validation url
          data: { board_page: response["board_page"] },
          async: false,
          success: function (response) {
            console.log(response);
          },
          error: function (response) {
            console.log("failed ");
          },
        });
      },
      error: function () {
        console.log("fail");
      },
    });

    $.ajax({
      type: "POST", //hide url
      url: `../../../php/set/set-consult-checkpoint.php`, //your form validation url
      dataType: "json",
      async: false,
      success: function (response) {
        console.log(response);
      },
      error: function () {
        console.log("error set");
      },
    });

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

    console.log("prev");
    console.log(currentBoardPage);
  }
  // next
  if (e.target.parentElement.classList.contains("button-next")) {
    e.preventDefault();
    changePage(currentBoardPage, boardSets, 1);
    changeBoardProgress(currentBoardPage + 1);
    ajaxCaller(currentBoardPage + 1);

    console.log("next");
    console.log(currentBoardPage);
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
    // e.preventDefault();
    // console.log("test");
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
    // console.log("choose sched");

    // target id
    let target = parseInt(
      e.target.closest("li").getAttribute("data-schedule-id")
    );

    let listofEditSched = e.target
      .closest(".modal-container")
      .querySelectorAll(".edit-form-sched");

    console.log(target);
    console.log(listofEditSched);
    // remove something
    e.target.closest(".list-sched").classList.add("hidden");

    listofEditSched.forEach((sched) => {
      if (target == parseInt(sched.getAttribute("data-schedule-id"))) {
        sched.classList.remove("hidden");
        sched.classList.add("modal-active");
        currentSched = sched;
      } else {
        sched.classList.add("hidden");
        sched.classList.remove("modal-active");
      }
    });
  }

  // edit section - go back
  if (e.target.classList.contains("button-back")) {
    console.log("test");

    e.target
      .closest(".modal-container")
      .querySelector(".list-sched")
      .classList.remove("hidden");

    currentSched.classList.add("hidden");
  }

  // if sched is deleted
  if (e.target.classList.contains("fa-trash")) {
    e.preventDefault();

    let targetSchedId = parseInt(currentSched.getAttribute("data-schedule-id"));
    console.log(targetSchedId);

    $.ajax({
      type: "POST", //hide url
      url: `../../../php/delete/del-consult-sched.php`, //your form validation url
      data: { targetSched: targetSchedId },
      success: function (response) {
        if (response) {
          location.reload();
        }
        document
          .querySelectorAll(".form-add-schedule input")
          .forEach((input) => {
            input.value = "";
          });
      },
      error: function () {
        console.log("fail at ajax");
      },
    });
  }

  // board 3

  // if consultation is done
});

let transactRndId = 0;
let appointCheckpoint = true;
function ajaxCaller(currentBoardPage) {
  console.log("ajaxCaller");
  console.log(currentBoardPage);

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
              // console.log(response);
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

              console.log(response.rnd_id);
              console.log(response.appoint_status);
              console.log(response.rnd_status);

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
                      // setTimeout(function () {
                      //   $(`${boardParent} .button-next button`).trigger(
                      //     "click"
                      //   );
                      // }, 10000);

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
      }
      break;

    // board 3
    case 3:
      let boardParent = ".consultation-stage";
      const getSchedule = setInterval(() => {
        showSchedule(".list-schedule ul");
        showSchedule(".list-sched", true);
      }, 5000);

      const joinRoom = setInterval(() => {
        $.ajax({
          type: "POST", //hide url
          url: `../../../php/request/req-consult-join.php`, //your form validation url
          dataType: "json",
          async: false,
          success: function (response) {
            response.forEach((user) => {
              if (user.current_in == 1) {
                $.ajax({
                  type: "POST", //hide url
                  url: `../../../php/request/request-profile.php`, //your form validation url
                  dataType: "json",
                  data: { target_id: user.current_id },
                  async: false,
                  success: function (response) {
                    console.log(response);
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
      // const boardFour = setInterval(() => {
      //   console.log("test");
      //   console.log(currentBoardPage);
      //   setTimeout(boardFour);
      // }, 1000);
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
    url: `../../../php/set/set-consult-schedule.php`, //your form validation url
    data: $(".form-add-schedule").serialize(),
    async: false,
    success: function (response) {
      console.log(response);
      document.querySelectorAll(".modal-parent").forEach((modal) => {
        modal.classList.add("hidden");
      });

      document.querySelectorAll(".form-add-schedule input").forEach((input) => {
        input.value = "";
      });

      location.reload();
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

  $.ajax({
    type: "POST", //hide url
    url: `../../../php/update/update-consult-schedule.php`, //your form validation url
    data: $(".edit-form-sched.modal-active").serialize(),
    success: function (response) {
      console.log(response);
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

function formScheduleEditMarkUp(response) {
  let markUp = ``;
  response.forEach((sched) => {
    markUp += `<form data-schedule-id="${sched.consult_schedule_id}"
                        class="form edit-form-sched hidden modal-body hidden" method="post">

                        <div class="divider modal-body">
                          <div class="form-input-parent ">
                            <!-- Appointment date -->
                            <div class="form-input-box input-one">
                              <label for="appointment-date" class="text-capital">Appointment date <span>*</span></label>
                              <input type="date" name="appointment-date" id="appointment-date"
                                value="${sched.date}">
                            </div>
                            <!-- Appointment time -->
                            <div class="form-input-box input-one">
                              <label for="appointment-time" class="text-capital">Appointment time <span>*</span></label>
                              <input type="time" name="appointment-time" id="appointment-time"
                                value="${sched.time}">
                            </div>
                          </div>
                        </div>

                        <!-- hidden - fox ajax -->
                        <input type="hidden" name="submit" value='true' id="submit">
                        <input type="hidden" name="targetSched" value='${sched.consult_schedule_id}'
                          id="submit">

                        <!-- button -->
                        <div class="modal-buttons flex-center hiddens">
                          <!-- <a class="button button-cancel ">Go back</a> -->
                          <a class="button button-back">Go back</a>
                          <a href="#" class="button button-primary button-delete "><i class="fa-solid fa-trash"></i></a>
                          <button type="submit" name='submit' value="submit"
                            class="button button-primary button-submit ">UPDATE</button>
                        </div>

                      </form>
  
  `;
  });

  return markUp;
}

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
    url: `../../../php/request/req-consult-sched.php`, //your form validation url
    dataType: "json",
    async: false,
    success: function (response) {
      if (response.length < 0) {
        console.log("none");
      }

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
