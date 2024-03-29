"use strict";

let path = "../";

const sex = document.getElementById("sex");
const appointment = document.getElementById("appointment");
const dateStatistics = document.getElementById("dateStat");

$.ajax({
  type: "POST", //hide url
  url: `${path}php/request/req-statistics-sex.php`, //your form validation url
  dataType: "json",
  success: function (data) {
    new Chart(sex, {
      type: "pie",
      data: {
        labels: ["Female", "Male"],
        datasets: [
          {
            label: "Sex",
            data: data,
            backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)"],
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

$.ajax({
  type: "POST", //hide url
  url: `${path}php/statistics/stat-appointment-status.php`, //your form validation url
  dataType: "json",
  success: function (data) {
    let datar = [];

    data.forEach((element) => {
      datar.push(element["COUNT(*)"]);
    });

    new Chart(appointment, {
      type: "doughnut",
      data: {
        labels: ["Approved", "Pending", "Declined"],
        datasets: [
          {
            data: datar,
            backgroundColor: ["#277043", "#c9ac35", "#c93535"],
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

let labels = [
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

$.ajax({
  type: "POST", //hide url
  url: `${path}php/statistics/stat-appointment-status.php`, //your form validation url
  dataType: "json",
  success: function (data) {
    let datar = [];

    data.forEach((element) => {
      datar.push(element["COUNT(*)"]);
    });

    new Chart(dateStatistics, {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "My First Dataset",
            data: [65, 59, 80, 81, 56, 55, 40, 20, 12, 20, 60, 100],
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
