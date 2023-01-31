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

boardContainer.addEventListener("click", function (e) {
  if (e.target.parentElement.classList.contains("button-next")) {
    e.preventDefault();

    let current = parseInt(
      e.target.closest(".board-page").getAttribute("data-board-page")
    );
    let prev = current - 1;
    let next = current + 1;

    boardSets.forEach((board) => {
      let currentPage = parseInt(board.getAttribute("data-board-page"));

      if (currentPage == current) {
        board.classList.add("hidden");
        console.log("remove");
        console.log(current);

        switch (currentPage) {
          case 1:
            one.classList.add("active");
            two.classList.add("active");
            three.classList.remove("active");
            four.classList.remove("active");
            five.classList.remove("active");
            break;
          case 2:
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.remove("active");
            five.classList.remove("active");
            break;
          case 3:
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.add("active");
            five.classList.remove("active");
            break;
          case 4:
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.add("active");
            five.classList.add("active");
            break;
          case 5:
            break;
        }
      }

      if (currentPage == next) {
        board.scrollIntoView({
          behavior: "smooth",
        });

        board.classList.remove("hidden");
        console.log("added");
      }
    });
  }
});

one.onclick = function () {};

two.onclick = function () {};
three.onclick = function () {};
four.onclick = function () {};
five.onclick = function () {};
