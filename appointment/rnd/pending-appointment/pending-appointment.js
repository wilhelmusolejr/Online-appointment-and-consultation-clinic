"use strict";

let path = "../../../";

let tableContainer = document.querySelector(".pending-appoint-container table");
let modalParent = document.querySelector(".modal-parent");

let targetAppointNum;
let targetBtn;

tableContainer.addEventListener("click", function (e) {
  e.preventDefault();
  // console.log(e.target);

  // accept
  if (e.target.classList.contains("button-accept")) {
    modalParent.classList.remove("hidden");
    modalParent.querySelector(".button-accept").classList.remove("hidden");
    modalParent.querySelector(".button-denaid").classList.add("hidden");

    targetAppointNum = parseInt(
      e.target
        .closest("tr")
        .querySelector(".appointment-number")
        .textContent.replace(/\D/g, "")
    );

    targetBtn = "accept";
  }

  // denaid
  if (e.target.classList.contains("button-denaid")) {
    modalParent.classList.remove("hidden");
    modalParent.querySelector(".button-denaid").classList.remove("hidden");
    modalParent.querySelector(".button-accept").classList.add("hidden");

    targetAppointNum = parseInt(
      e.target
        .closest("tr")
        .querySelector(".appointment-number")
        .textContent.replace(/\D/g, "")
    );

    targetBtn = "denaid";
  }
});

modalParent.addEventListener("click", function (e) {
  if (
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-cancel")
  ) {
    this.classList.toggle("hidden");
  }

  // accept
  if (e.target.classList.contains("button-accept")) {
    console.log(targetAppointNum, targetBtn);

    $.ajax({
      type: "POST", //hide url
      url: `${path}php/set/set-appoint-feedback.php`, //your form validation url
      data: { transact_id: targetAppointNum, targetBtn: targetBtn },
      async: false,
      success: function (response) {
        console.log(response);
        // if (response == "success") {
        $(".modal-container .button-cancel").addClass("hidden");
        $(".modal-container .button-accept").addClass("hidden");
        $(".modal-container .button-denaid").addClass("hidden");
        $(".modal-container .button-primary").removeClass("hidden");
        $(".modal-container").addClass("modal-positive");
        $(".modal-container p").text("Added successfully");
        // }
      },
      error: function () {
        console.log("fail at ajax");
      },
    });
  }

  // denaid
  if (e.target.classList.contains("button-denaid")) {
    $.ajax({
      type: "POST", //hide url
      url: `${path}php/set/set-appoint-feedback.php`, //your form validation url
      // dataType: "json",
      data: { transact_id: targetAppointNum, targetBtn: targetBtn },
      success: function (response) {
        console.log(response);
        $(".modal-container .button-cancel").addClass("hidden");
        $(".modal-container .button-accept").addClass("hidden");
        $(".modal-container .button-denaid").addClass("hidden");
        $(".modal-container .button-primary").removeClass("hidden");
        $(".modal-container").addClass("modal-negative");
        $(".modal-container p").text("Declined successfully");
      },
      error: function () {
        console.log("fail at ajax");
      },
    });
  }
});

function generatePendingMarkUp(data) {
  let markUp = "";

  data.forEach((appoint) => {
    markUp += `<tr>
          <td class="appointment-number">#${appoint.transact_id}</td>
          <td>${appoint.chief_complaint}</td>
          <td>${appoint.appoint_date} ${appoint.appoint_time}</td>
          <td>
              <div class="button-parent flex-center">
                <a href="#" class="button button-accept">Accept</a>
                <a href="#" class="button button-denaid">Decline</a>
              </div>
          </td>
        </tr>
      `;
  });

  return markUp;
}

function getPendingAppoint() {
  $.ajax({
    type: "POST", //hide url
    url: `req-pending-appointment.php`, //your form validation url
    dataType: "json",
    async: false,
    success: function (data) {
      document.querySelector("tbody").innerHTML = generatePendingMarkUp(data);
    },
    error: function () {
      console.log("ERROR to get pending");
    },
    complete: function () {
      setTimeout(getPendingAppoint, 5000);
    },
  });
}

getPendingAppoint();
