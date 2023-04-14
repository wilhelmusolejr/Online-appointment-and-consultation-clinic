"use strict";

let path = "../../../";

const body = document.querySelector("body");

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
// console.log(currentBoardPage);

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

  // console.log(e.target);
  // console.log(e.target.parentElement);
  // console.log(currentBoardPage);

  // board 1

  // JOIN BUTTON
  if (e.target.closest(".button-join")) {
    // e.preventDefault();

    $.ajax({
      type: "POST", //hide url
      url: `${path}php/request/req-board-page.php`, //your form validation url
      dataType: "json",
      success: function (data) {
        if (data.board_page == 3) {
          $.ajax({
            type: "POST", //hide url
            url: `${path}php/update/update-consult-join.php`, //your form validation url
            dataType: "json",
            success: function (response) {
              console.log(response);
            },
            error: function () {
              console.log("fail in join room");
            },
          });
        }
      },
      error: function () {
        console.log("fail to fetch board page");
      },
    });
  }

  if (e.target.parentElement.classList.contains("button-semi-submit")) {
    modalNotifThree.classList.toggle("hidden");
  }

  // button confimation at consultation
  if (
    e.target.parentElement.classList.contains("button-confirmation-boardThree")
  ) {
    modalNotifThree.classList.toggle("hidden");

    body.classList.add("lock-page");
  }

  if (e.target.parentElement.classList.contains("button-upload-confirmation")) {
    e.preventDefault();

    e.target
      .closest(".consultation-checkpoint-stage ")
      .querySelector(".modal-notif-parent")
      .classList.remove("hidden");

    body.classList.add("lock-page");
  }

  if (e.target.parentElement.classList.contains("button-confirm-finalFour")) {
    // e.preventDefault();
    console.log("test");

    // // upload file to database

    // changePage(currentBoardPage, boardSets, 1);
    // changeBoardProgress(currentBoardPage + 1);
    // ajaxCaller(currentBoardPage + 1);
  }

  if (e.target.parentElement.classList.contains("button-confirm-finalThree")) {
    // button confirm final
    // board 3 -- final submission
    console.log("test");
    spinnerActivate("consultation-stage .modal-appointment-confirmation", true);

    // REQUEST BOARD PAGE
    $.ajax({
      type: "POST", //hide url
      url: `../../../php/request/req-board-page.php`, //your form validation url
      dataType: "json",
      // async: false,
      success: function (response) {
        console.log("req board", response);
        // SET BOARD PAGE
        $.ajax({
          type: "POST", //hide url
          url: `../../../php/set/set-board.php`, //your form validation url
          data: { board_page: response["board_page"] },
          // async: false,
          success: function (response) {
            console.log("set board", response);
            // SET CONSULT
            $.ajax({
              type: "POST", //hide url
              url: `../../../php/set/set-consult-checkpoint.php`, //your form validation url
              // async: false,
              success: function (response) {
                console.log("set consult", response);

                $(".button-confirmation-boardThree").remove();

                e.target.parentElement.classList.toggle("hidden");

                document
                  .querySelector(".consultation-stage .button-next")
                  .classList.toggle("hidden");

                modalAppointNotif.classList.add("hidden");
                $(".button-upload-confirmation").removeClass("hidden");
                body.classList.remove("lock-page");

                spinnerActivate(
                  "consultation-stage .modal-appointment-confirmation",
                  false
                );
              },
              error: function () {
                console.log("error set");
                return;
              },
            });
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

    // changePage(currentBoardPage, boardSets, 1);
    // changeBoardProgress(currentBoardPage + 1);
    // ajaxCaller(currentBoardPage + 1);
  }

  // request for monitor
  if (e.target.classList.contains("button-tertiary")) {
    e.preventDefault();

    document.querySelector(".request-monitor").classList.remove("hidden");
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

    // console.log("next");
    // console.log(currentBoardPage);
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

    body.classList.remove("lock-page");
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

      // ajax
    }
    // if edit is pressed
    else {
      boardContainer
        .querySelector(".list-schedule .schedule-edit")
        .classList.remove("hidden");
    }

    body.classList.add("lock-page");
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

    // console.log(target);
    // console.log(listofEditSched);
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

    spinnerActivate("edit-form-sched", true);

    $.ajax({
      type: "POST", //hide url
      url: `../../../php/delete/del-consult-sched.php`, //your form validation url
      data: { targetSched: targetSchedId },
      success: function (response) {
        location.reload();
      },
      error: function () {
        console.log("fail at ajax");
      },
    });
  }

  // client information
  if (e.target.classList.contains("button-clientInfo")) {
    this.querySelector(".modal-client-info").classList.remove("hidden");
  }

  // board 3

  // if consultation is done
});

function getBoardThreeData(stopper) {
  let boardParent = ".consultation-stage";

  // console.log("board 3", stopper);

  if (!stopper) {
    showSchedule(".list-schedule ul");
    showSchedule(".list-sched", true);

    $.ajax({
      type: "POST", //hide url
      url: `${path}php/request/req-board-page.php`, //your form validation url
      dataType: "json",
      success: function (data) {
        // console.log(data);

        if (data.board_page > 3) {
          stopper = true;

          $("#sms_chat").attr("disabled", true);
        }
      },
      error: function () {
        console.log("fail to fetch board page");
      },
    });

    $.ajax({
      type: "POST", //hide url
      url: `${path}php/request/req-consult-join.php`, //your form validation url
      dataType: "json",
      success: function (response) {
        let joinUsers = document.querySelectorAll(".join-user");

        response.forEach((user) => {
          if (user.current_in == 1) {
            let targetId = parseInt(user.current_id);

            joinUsers.forEach((join) => {
              let currentId = parseInt(join.getAttribute("data-userId"));

              if (targetId == currentId) {
                join.classList.remove("hidden");
              }
            });
          }
        });

        // clearInterval(joinRoom);
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
      // console.log(data);

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

function ajaxCaller(currentBoardPage) {
  switch (currentBoardPage) {
    // board 2
    // board 3
    case 3:
      // get who's ka talking stage ni user
      // set names in join room
      $.ajax({
        type: "POST", //hide url
        url: `${path}php/request/req-katalk-user.php`, //your form validation url
        dataType: "json",
        success: function (data) {
          $(".ka-talk-box img").attr(
            "src",
            `${path}uploads/${
              data[0].profile_img == null
                ? "dummy_user.jpg"
                : data[0].profile_img
            }`
          );

          $(`.assigned-rnd`).text(`${data[0].first_name} ${data[0].last_name}`);

          $(`.profile-link`).attr(
            "href",
            `${path}profile/profile.php?profile-id=${data[0].user_id}`
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

      // req appoint info
      $.ajax({
        type: "POST", //hide url
        url: `${path}php/request/req-appoint-info.php`, //your form validation url
        dataType: "json",
        success: function (data) {
          let parent = document.querySelector(".modal-client-info");

          let clientInfo = data.clientInfo;
          // name
          clientTabuate(
            parent,
            "client-fullName",
            `${clientInfo.first_name} ${clientInfo.last_name}`
          );
          // birthdate
          clientTabuate(parent, "client-birthdate", clientInfo.birthdate);
          // sex
          clientTabuate(parent, "client-sex", clientInfo.gender);

          let physicalInfo = data.physicalInfo;
          // height
          clientTabuate(parent, "client-height", physicalInfo.current_height);
          // weight
          clientTabuate(parent, "client-weight", physicalInfo.actual_weight);

          // contact
          clientTabuate(parent, "client-phone", clientInfo.mobile_num);
          // email
          clientTabuate(parent, "client-email", clientInfo.email_add);

          let consultInfo = data.consultInfo;
          // referral download
          document.querySelector(
            ".referral-form-download"
          ).href = `${path}php/request/download.php?file=${consultInfo.referral_form_id}`;
          document.querySelector(
            ".referral-form-download"
          ).textContent = `${consultInfo.referral_form_id}`;
          document.querySelector(
            ".medical-form-download"
          ).href = `${path}php/request/download.php?file=${consultInfo.medical_record_id}`;
          document.querySelector(
            ".medical-form-download"
          ).textContent = `${consultInfo.medical_record_id}`;

          //
        },
        error: function () {
          console.log("ERROR at getting data");
        },
      });
      break;

    // board 3
    case 4:
      break;

    case 5:
      let parent = document.querySelector(".solution-stage");

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

      break;
  }
}
ajaxCaller(currentBoardPage);

// ----------------------------
// ADD SCHEDULE
$(".form-add-schedule").on("submit", function (e) {
  e.preventDefault();

  // Show spinner
  spinnerActivate("schedule-add", true);

  $.ajax({
    type: "POST", //hide url
    url: `../../../php/set/set-consult-schedule.php`, //your form validation url
    data: $(".form-add-schedule").serialize(),
    success: function (response) {
      document.querySelectorAll(".modal-parent").forEach((modal) => {
        modal.classList.add("hidden");
      });

      // document.querySelectorAll(".form-add-schedule input").forEach((input) => {
      //   input.value = "";
      // });

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

  // Show spinner
  spinnerActivate("edit-form-sched", true);

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

      spinnerActivate("edit-form-sched", false);
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
      // console.log("failed to get sched sss");
    },
  });
}

$(".upload-consult-result").on("submit", function (e) {
  e.preventDefault();

  spinnerActivate("consultation-checkpoint-stage .upload-consult-result", true);

  let parent = document.querySelector(".consultation-checkpoint-stage");

  $.ajax({
    type: "POST", //hide url
    url: `../../../php/set/set-file-consult-result.php`, //your form validation url
    data: new FormData(this),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      console.log(data);
      if (data.response == 1) {
        // set board to + 1
        $.ajax({
          type: "POST", //hide url
          url: `../../../php/request/req-board-page.php`, //your form validation url
          dataType: "json",
          success: function (response) {
            // increment board page
            $.ajax({
              type: "POST", //hide url
              url: `../../../php/set/set-board.php`, //your form validation url
              data: { board_page: response["board_page"] },
              success: function (response) {
                console.log(response);
                parent
                  .querySelector(" .modal-parent")
                  .classList.toggle("hidden");
                parent.querySelector(".form-error-message").textContent = "";
                parent.querySelector(
                  "input[name='appointment-referral']"
                ).disabled = true;
                // POSITIVE
                $(".button-upload-confirmation").remove();
                parent.querySelector(".button-next").classList.toggle("hidden");
                body.classList.remove("lock-page");

                spinnerActivate(
                  "consultation-checkpoint-stage .upload-consult-result",
                  false
                );
              },
              error: function (response) {
                console.log("failed");
              },
            });
          },
          error: function () {
            console.log("fail");
          },
        });

        // add file to database
      } else {
        // NEGATIBO
        parent.querySelector(" .modal-parent").classList.toggle("hidden");
        parent.querySelector(".form-error-message").textContent = data.message;
        spinnerActivate("upload-consult-result", false);
      }
    },
    error: function (data) {
      console.log("error");
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
    url: `${path}php/set/set-message.php`, //your form validation url
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

function clientTabuate(parent, target, data) {
  parent.querySelector(`.${target}`).textContent = `${data}`;
}

// request monitor
$(".form-request-monitor").on("submit", function (e) {
  e.preventDefault();

  spinnerActivate("solution-stage", true);

  let parent = document.querySelector(".solution-stage");

  $.ajax({
    type: "POST", //hide url
    url: `../../../php/set/set-request-monitoring.php`, //your form validation url
    data: $(".form-request-monitor").serialize(),
    // dataType: "json",
    success: function (data) {
      if (data) {
        console.log(data);

        let parent = document.querySelector(".form-request-monitor");

        parent.querySelector(".divider").innerHTML = `
          <p class="text-center">Submitted successfully!</p>
        `;
        parent.querySelector(".divider").classList.add("flex-center");
        parent.querySelector(".button-primary").classList.add("hidden");
        parent.querySelector(".button-cancel").textContent = "DONE";
      }
      spinnerActivate("solution-stage", false);
    },
    error: function (data) {
      console.log("error");
    },
  });
});
