"use strict";

console.log(path);

function updateNumberPendingAppoint() {
  $.ajax({
    type: "POST", //hide url
    // url: `${path}/pending-appointment/req-pending-appointment.php`, //your form validation url
    url: `${path}/monitoring/pending-monitoring/req-pending-monitor.php`, //your form validation url
    dataType: "json",
    async: false,
    success: function (response) {
      document.querySelector(".number-notif").textContent = response.length;
    },
    error: function () {
      console.log("ERROR to get pending");
    },
    complete: function () {
      setTimeout(updateNumberPendingAppoint, 5000);
    },
  });
}

updateNumberPendingAppoint();
