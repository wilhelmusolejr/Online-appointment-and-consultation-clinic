"use strict";

// Other Specify
const otherCheckbox = document.querySelector("#health-condition-one-other");
const otherText = document.querySelector("#otherValue");

otherCheckbox.addEventListener("change", () => {
  if (otherCheckbox.checked) {
    otherText.classList.remove("hidden");
    otherText.value = "";
  } else {
    otherText.classList.add("hidden");
  }
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

// PREV AND NEXT
const boardSets = boardContainer.querySelectorAll(".board-page");
const boardProgress = boardContainer.querySelector(".board-progress");

function changePage(current, boardSets, target) {
  let pagination = [current - 1, current + 1];

  boardSets.forEach((board) => {
    let currentPage = parseInt(board.getAttribute("data-board-page"));

    if (currentPage != pagination[target]) {
      board.classList.add("hidden");
    } else {
      board.classList.remove("hidden");
    }
  });

  if (target == 0) {
    changeBoardProgress(current - 1);
  } else {
    changeBoardProgress(current + 1);
  }
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

boardContainer.addEventListener("click", function (e) {
  let current = parseInt(
    e.target.closest(".board-page").getAttribute("data-board-page")
  );

  // pagination
  // prev
  if (e.target.parentElement.classList.contains("button-prev")) {
    e.preventDefault();
    changePage(current, boardSets, 0);
  }

  // next
  if (e.target.parentElement.classList.contains("button-next")) {
    e.preventDefault();
    changePage(current, boardSets, 1);
  }
});

let current = parseInt(boardContainer.querySelector(".board-page").value);
changeBoardProgress(current);
