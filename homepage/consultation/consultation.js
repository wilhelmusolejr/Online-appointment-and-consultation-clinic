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

one.onclick = function () {
  one.classList.add("active");
  two.classList.remove("active");
  three.classList.remove("active");
  four.classList.remove("active");
  five.classList.remove("active");
};

two.onclick = function () {
  one.classList.add("active");
  two.classList.add("active");
  three.classList.remove("active");
  four.classList.remove("active");
  five.classList.remove("active");
};
three.onclick = function () {
  one.classList.add("active");
  two.classList.add("active");
  three.classList.add("active");
  four.classList.remove("active");
  five.classList.remove("active");
};
four.onclick = function () {
  one.classList.add("active");
  two.classList.add("active");
  three.classList.add("active");
  four.classList.add("active");
  five.classList.remove("active");
};
five.onclick = function () {
  one.classList.add("active");
  two.classList.add("active");
  three.classList.add("active");
  four.classList.add("active");
  five.classList.add("active");
};

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
