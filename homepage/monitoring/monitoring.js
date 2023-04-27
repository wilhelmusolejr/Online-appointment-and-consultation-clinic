"use strict";

// import Chart from "../../node_modules/chart.js/auto";

let path = `../../`;
const body = document.querySelector("body");

// modal
const modalAppointNotif = document.querySelector(
  ".modal-appointment-confirmation"
);

if (modalAppointNotif) {
  modalAppointNotif.addEventListener("click", function (e) {
    console.log("hidden");

    if (
      e.target.classList.contains("overlay-black") ||
      e.target.classList.contains("button-cancel")
    ) {
      body.classList.remove("lock-page");
      this.classList.toggle("hidden");
    }
  });
}

// =----------------------------------

// const modalError = document.querySelector(".modal-oops-notif");

// modalError.addEventListener("click", function (e) {
//   console.log(e.target);

//   if (
//     e.target.classList.contains("overlay-black") ||
//     e.target.classList.contains("button-cancel")
//   ) {
//     body.classList.remove("lock-page");
//     this.classList.toggle("hidden");
//   }
// });

// =----------------------------------
let sideBarElem = document.querySelector(".side-bar");

sideBarElem.addEventListener("click", function (e) {
  if (e.target.classList.contains("fa-solid")) {
    e.preventDefault();

    e.target.closest(".active").querySelector("ul").classList.toggle("hidden");
  }
});

// =----------------------------------
// food
const foodTabParent = document.querySelector("#food-tab");

foodTabParent.addEventListener("click", function (e) {
  if (e.target.classList.contains("fa-plus")) {
    e.preventDefault();

    let containerParent = e.target.closest(".food-intake-parent");

    let target = containerParent
      .querySelector(".food-header")
      .textContent.toLowerCase();

    containerParent.querySelector(".outer-container").insertAdjacentHTML(
      "beforeend",
      `<div class="container">
      <input type="hidden" name="food-take-type[]" value="${target}">

      <!-- time -->
      <div class="form-input-box input-two ">
        <label for="food-bf-time">Time <span>*</span></label>
        <input type='time' name="food-bf-time[]" value="02:00">
      </div>

      <!-- food consumed -->
      <div class="form-input-box input-two ">
        <label for="food-bf-consume">Food consumed <span>*</span></label>
        <input type='text' name="food-bf-consume[]" value="food consume test 1">
        <p class="form-error-message hidden">Error</p>
      </div>

      <!-- Amount -->
      <div class="form-input-box input-two ">
        <label for="food-amount">Amount <span>*</span></label>
        <input type="text" name="food-amount[]" value="1">
        <p class="form-error-message hidden">Error</p>
      </div>

      <!-- Quantity -->
      <div class="form-input-box input-two ">
        <label for="food-quantity">Quantity <span>*</span></label>
        <select id="food-quantity" name="food-quantity[]">
          <option value="volvo">Piece</option>
          <option value="saab">Once</option>
          <option value="fiat">Kg</option>
          <option value="audi">Cup</option>
        </select>
        <p class="form-error-message hidden">Error</p>
      </div>

      <!-- Method of preparation -->
      <div class="form-input-box input-two ">
        <label for="food-time">Method of preparation <span>*</span></label>
        <input type='text' name="food-bf-method[]" id="food-time" value="method test">
        <p class="form-error-message hidden">Error</p>
      </div>

      <!-- trash -->
      <div class="form-input-box trash-parent">
        <i class="fa-solid fa-trash"></i>
      </div>

    </div>`
    );
  }

  if (e.target.classList.contains("fa-trash")) {
    e.target.closest(".container").remove();
  }
});

// =----------------------------------

// CHARTING
const physical = document.getElementById("physical");
const bodyWeight = document.getElementById("bodyWeight");
const foodFrequency = document.getElementById("foodFrequency");

const days = ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7"];

// PHYSICAL
$.ajax({
  type: "POST", //hide url
  url: `${path}php/request/req-physical-level.php`, //your form validation url
  dataType: "json",
  // data: { data: message },
  success: function (data) {
    console.log(data);

    new Chart(physical, {
      type: "bar",
      data: {
        labels: days,
        datasets: [
          {
            label: "Physical Level",
            data: data,
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  },
  error: function () {
    console.log("ERROR at setting message");
  },
});

// BODY WEIGHT
$.ajax({
  type: "POST", //hide url
  url: `${path}php/request/req-body-weight.php`, //your form validation url
  dataType: "json",
  // data: { data: message },
  success: function (data) {
    console.log(data);

    new Chart(bodyWeight, {
      type: "line",
      data: {
        labels: days,
        datasets: [
          {
            label: "Body Weight",
            data: data,
            fill: false,
            borderColor: "rgb(75, 192, 192)",
            tension: 0.1,
          },
        ],
      },
    });
  },
  error: function () {
    console.log("ERROR at setting message");
  },
});

// FOOD FREQUENCY
let food = ["Breakfast", "Lunch", "Dinner", "Snacks"];
$.ajax({
  type: "POST", //hide url
  url: `${path}php/request/req-physical-level.php`, //your form validation url
  dataType: "json",
  // data: { data: message },
  success: function (data) {
    new Chart(foodFrequency, {
      type: "pie",
      data: {
        labels: food,
        datasets: [
          {
            label: "Food activity frequency",
            data: data,
            backgroundColor: [
              "rgb(255, 99, 132)",
              "rgb(54, 162, 235)",
              "rgb(255, 205, 86)",
              "rgb(258, 125, 86)",
            ],
            hoverOffset: 4,
          },
        ],
      },
    });
  },
  error: function () {
    console.log("ERROR at setting message");
  },
});

// CALENDAR
let currentDate = dayjs();
let daysInMonth = dayjs().daysInMonth();
let firstDayPosition = dayjs().startOf("month").day();
let monthNames = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];
let weekNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
let dateElement = document.querySelector("#calendar .calendar-dates");
let calendarTitle = document.querySelector(".calendar-title-text");
let nextMonthButton = document.querySelector("#nextMonth");
let prevMonthButton = document.querySelector("#prevMonth");
let dayNamesElement = document.querySelector(".calendar-day-name");
let todayButton = document.querySelector("#today");
let dateItems = null;
let newMonth = null;

weekNames.forEach(function (item) {
  dayNamesElement.innerHTML += `<div>${item}</div>`;
});

function plotDays() {
  let count = 1;
  dateElement.innerHTML = "";

  let prevMonthLastDate = currentDate.subtract(1, "month").endOf("month").$D;
  let prevMonthDateArray = [];

  //plot prev month array
  for (let p = 1; p < firstDayPosition; p++) {
    prevMonthDateArray.push(prevMonthLastDate--);
  }
  prevMonthDateArray.reverse().forEach(function (day) {
    dateElement.innerHTML += `<button class="calendar-dates-day-empty">${day}</button>`;
  });

  //plot current month dates
  for (let i = 0; i < daysInMonth; i++) {
    dateElement.innerHTML += `<button class="calendar-dates-day">${count++}</button>`;
  }

  //next month dates
  let diff =
    42 - Number(document.querySelector(".calendar-dates").children.length);
  let nextMonthDates = 1;
  for (let d = 0; d < diff; d++) {
    document.querySelector(
      ".calendar-dates"
    ).innerHTML += `<button class="calendar-dates-day-empty">${nextMonthDates++}</button>`;
  }

  //month name and year
  calendarTitle.innerHTML = `${
    monthNames[currentDate.month()]
  } - ${currentDate.year()}`;
}

//highlight current date
function highlightCurrentDate() {
  dateItems = document.querySelectorAll(".calendar-dates-day");
  if (dateElement && dateItems[currentDate.$D - 1]) {
    dateItems[currentDate.$D - 1].classList.add("today-dates");
  }
}

//next month button event
nextMonthButton.addEventListener("click", function () {
  newMonth = currentDate.add(1, "month").startOf("month");
  setSelectedMonth();
});

//prev month button event
prevMonthButton.addEventListener("click", function () {
  newMonth = currentDate.subtract(1, "month").startOf("month");
  setSelectedMonth();
});

//today button event
todayButton.addEventListener("click", function () {
  newMonth = dayjs();
  setSelectedMonth();
  setTimeout(function () {
    highlightCurrentDate();
  }, 50);
});

//set next and prev month
function setSelectedMonth() {
  daysInMonth = newMonth.daysInMonth();
  firstDayPosition = newMonth.startOf("month").day();
  currentDate = newMonth;
  plotDays();
}

//init
plotDays();
setTimeout(function () {
  highlightCurrentDate();
}, 50);

// BUTTON
const boardContainer = document.querySelector(".main-content");

boardContainer.addEventListener("click", function (e) {
  // console.log(e.target);

  // submit form DAY
  if (e.target.classList.contains("button-semi")) {
    e.target
      .closest("form")
      .querySelector(".modal-appointment-confirmation")
      .classList.toggle("hidden");
  }
});
