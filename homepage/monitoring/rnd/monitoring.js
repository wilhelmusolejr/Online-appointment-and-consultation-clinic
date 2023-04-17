"use strict";

let path = "../../../";

const body = document.querySelector("body");
let boardParent = document.querySelector(".stage-one-parent");

boardParent.addEventListener("click", function (e) {
  // plus
  if (e.target.classList.contains("fa-plus")) {
    let goalsContainer = boardParent.querySelector(".goals-container");

    goalsContainer.insertAdjacentHTML(
      "beforeend",
      `<div class="container ">

      <!-- Specify goals -->
      <div class="form-input-box input-two ">
        <label for="food-bf-consume">Specify goals <span>*</span></label>
        <input type='text' name="specify_goal_name[]" value="food consume test 1">
        <p class="form-error-message hidden">Error</p>
      </div>

      <!-- Quantity -->
      <div class="form-input-box input-two ">
        <label for="food-quantity">Type <span>*</span></label>
        <select id="food-quantity" name="specify_goal_type[]">
          <option value="volvo">Piece</option>
          <option value="saab">Once</option>
          <option value="fiat">Kg</option>
          <option value="audi">Cup</option>
        </select>
        <p class="form-error-message hidden">Error</p>
      </div>

      <!-- trash -->
      <div class="form-input-box form-button">
        <label for="food-quantity">Action</label>
        <i class="fa-solid fa-trash"></i>
      </div>

    </div>`
    );
  }

  // trash can
  if (e.target.classList.contains("fa-trash")) {
    e.target.closest(".container").remove();
  }
});

let boardParentOne = document.querySelector(".stage-one-parent");

boardParentOne.addEventListener("click", function (e) {
  // console.log(e.target);

  if (
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-cancel")
  ) {
    boardParentOne.querySelectorAll(".modal-parent").forEach((modal) => {
      modal.classList.add("hidden");
    });
    body.classList.remove("lock-page");
  }

  if (e.target.classList.contains("button-mini-submit")) {
    console.log("wiw");

    boardParentOne
      .querySelector(".modal-monitoring-one-confirmation")
      .classList.remove("hidden");
    body.classList.add("lock-page");
  }
});

// --------

let boardParentTwo = document.querySelector(".stage-two-parent");
console.log(boardParentTwo);

boardParentTwo.addEventListener("click", function (e) {
  console.log(e.target);

  if (
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-cancel")
  ) {
    boardParentTwo.querySelectorAll(".modal-parent").forEach((modal) => {
      modal.classList.add("hidden");
    });
    body.classList.remove("lock-page");
  }

  // update goals --- OPEN
  if (e.target.classList.contains("button-update-goals")) {
    e.preventDefault();

    document.querySelector(".modal-update-goal").classList.remove("hidden");
    body.classList.add("lock-page");
  }

  // update goals --- SUBMIT
  if (e.target.classList.contains("button-update-submit")) {
    let modal = document.querySelector(".modal-update-goal");

    $.ajax({
      type: "POST", //hide url
      url: `${path}php/update/upd-monitor-goal.php`, //your form validation url
      // dataType: "json",
      data: $(modal.querySelector("form")).serialize(),
      success: function (data) {
        console.log(data);
        if (data == "success") {
          modal.querySelector(
            "form"
          ).innerHTML = `<p class="text-center">Goal updated</p>`;

          modal.querySelector(".button-cancel").textContent = `done`;
          modal.querySelector(".button-update-submit").classList.add("hidden");
        }
      },
      error: function () {
        console.log("ERROR at setting message");
      },
    });
  }

  // open day info
  if (e.target.classList.contains("week-list-day-item")) {
    e.preventDefault();

    document.querySelector(".modal-client-info").classList.remove("hidden");
    body.classList.add("lock-page");

    let targetDay = parseInt(
      e.target.closest(".week-list-day-item").getAttribute("data-day")
    );

    let allDayData = boardParentTwo.querySelectorAll(
      ".modal-client-info .data-item"
    );

    allDayData.forEach((day) => {
      let currentDay = parseInt(day.getAttribute("data-day"));

      if (day.hasAttribute("data-day")) {
        if (targetDay == currentDay) {
          day.classList.remove("hidden");
        } else {
          day.classList.add("hidden");
        }
      }
    });
  }

  // extend monitoring --- OPEN
  if (e.target.classList.contains("button-extend")) {
    document.querySelector(".modal-extend-monitor").classList.remove("hidden");
    body.classList.add("lock-page");
  }

  // extend monitoring --- SUBMIT
  if (e.target.classList.contains("button-extend-submit")) {
    let modal = document.querySelector(".modal-extend-monitor");

    $.ajax({
      type: "POST", //hide url
      url: `${path}php/update/upd-monitor-week.php`, //your form validation url
      // dataType: "json",
      data: $(modal.querySelector("form")).serialize(),
      success: function (data) {
        console.log(data);
        if (data == "success") {
          modal.querySelector(
            "form"
          ).innerHTML = `<p class="text-center">Monitoring extended</p>`;

          modal.querySelector(".button-cancel").textContent = `done`;
          modal.querySelector(".button-extend-submit").classList.add("hidden");
        }
      },
      error: function () {
        console.log("ERROR at setting message");
      },
    });
  }

  // end monitoring --- OPEN
  if (e.target.classList.contains("button-end-monitoring")) {
    document.querySelector(".modal-end-monitor").classList.remove("hidden");
    body.classList.add("lock-page");
  }

  // end  monitoring --- SUBMIT
  if (e.target.classList.contains("button-end-submit")) {
    let modal = document.querySelector(".modal-end-monitor");

    $.ajax({
      type: "POST", //hide url
      url: `${path}php/update/upd-monitor-end.php`, //your form validation url
      // dataType: "json",
      data: $(modal.querySelector("form")).serialize(),
      success: function (data) {
        console.log(data);
        if (data == "success") {
          modal.querySelector(
            ".modal-message"
          ).innerHTML = `<p class="text-center">Monitoring ended</p>`;

          modal.querySelector(".button-cancel").textContent = `done`;
          modal.querySelector(".button-end-submit").classList.add("hidden");
        }
      },
      error: function () {
        console.log("ERROR at setting message");
      },
    });
  }
});
