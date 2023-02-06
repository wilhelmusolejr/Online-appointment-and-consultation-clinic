"use strict";

// Other Specify
// const otherCheckbox = document.querySelector("#health-condition-one-other");
// const otherText = document.querySelector("#otherValue");

// otherCheckbox.addEventListener("change", () => {
//   if (otherCheckbox.checked) {
//     otherText.classList.remove("hidden");
//     otherText.value = "";
//   } else {
//     otherText.classList.add("hidden");
//   }
// });

// LIMIT CHECK BOX
$("#physical-tab input:checkbox").click(function () {
  let bol = $("#physical-tab input:checkbox:checked").length >= 2;
  $("#physical-tab input:checkbox").not(":checked").attr("disabled", bol);
});

// Progresss
const one = document.querySelector(".one");
const two = document.querySelector(".two");
const three = document.querySelector(".three");
const four = document.querySelector(".four");
const five = document.querySelector(".five");

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

const interval = setInterval(() => {
  $.ajax({
    type: "POST", //hide url
    url: `../../php/request/request-appoint.php`, //your form validation url
    dataType: "json",
    success: function (response) {
      console.log("board 2 - outside");

      let boardParent = ".appointment-checkpoint-stage";

      // appoint status
      $(`${boardParent} input[name='appoint-status']`).val(
        response.appoint_status
      );
      // rdn
      $(`${boardParent} input[name='rdn-assigned']`).val(response.rnd_status);

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

      // class assgined rnd
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

      if (
        response.appoint_status == "APPROVED" &&
        response.rnd_status == "APPROVED"
      ) {
        console.log("test");
        // PUT LISTENER
        if (response.board_page == 2) {
          // avoid auto click
          setTimeout(function () {
            $(`${boardParent} .button-next button`).trigger("click");
          }, 500);

          console.log("board 2 - inside");

          $.ajax({
            type: "POST", //hide url
            url: `../../php/set/set-board.php`, //your form validation url
            data: { board_page: response.board_page },
            success: function (response) {
              console.log(response);
            },
          });
        }

        if (response.board != 2) {
          $(`${boardParent} .button-next button`).prop("disabled", false);

          clearInterval(interval);
        }
      }
    },
    error: function () {
      console.log("fail at ajax");
    },
  });
}, 1000);

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
  let currentBoardPage = parseInt(
    e.target.closest(".board-page").getAttribute("data-board-page")
  );

  // prev
  if (e.target.parentElement.classList.contains("button-prev")) {
    e.preventDefault();
    changePage(currentBoardPage, boardSets, 0);
    changeBoardProgress(currentBoardPage - 1);
    currentBoardPage--;
  }

  // next
  if (e.target.parentElement.classList.contains("button-next")) {
    e.preventDefault();
    changePage(currentBoardPage, boardSets, 1);
    changeBoardProgress(currentBoardPage + 1);
    currentBoardPage++;
  }
});

// for searching - auto set board progress
boardSets.forEach((board) => {
  if (!board.classList.contains("hidden")) {
    let tite = parseInt(board.getAttribute("data-board-page"));
    changeBoardProgress(tite);
  }
});
