"use strict";

let path = "../";

const getAge = (birthDate) =>
  Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e10);

// APPOINTMENT
function generatePendingMarkUp(data) {
  let markUp = "";

  data.forEach((appoint) => {
    markUp += `<tr>
          <td>#${appoint.transact_id}</td>
          <td>${appoint.chief_complaint}</td>
          <td>${appoint.first_name} ${appoint.last_name}</td>
          <td>${appoint.gender == "1" ? "Male" : "Female"}</td>
          <td>${getAge(appoint.birthdate)}</td>
          <td>${appoint.appoint_date} ${appoint.appoint_time}</td>
          <td><a target="_blank" class="downloadable-file" href="${path}../php/request/download.php?file=${
      appoint.referral_form_id
    }">${appoint.referral_form_id}</a></td>
          <td><a target="_blank" class="downloadable-file" href="${path}../php/request/download.php?file=${
      appoint.medical_record_id
    }">${appoint.medical_record_id}</a></td>
          <td class="action">
            <a class="action-accept" href="../php/update/update-pending-appoint-status.php?transact_id=${
              appoint.transact_id
            }&button=accept">ACCEPT</a>
            <a class="action-declined" href="../php/update/update-pending-appoint-status.php?transact_id=${
              appoint.transact_id
            }&button=decline">DECLINE</a>
          </td>
        </tr>
      `;
  });

  return markUp;
}

function getAllPendingAppoint() {
  $.ajax({
    type: "POST",
    url: `${path}php/request/req-all-pending-appoint.php`,
    dataType: "json",
    success: function (data) {
      // console.log(data);

      // tabulate data in table
      document.querySelector("tbody").innerHTML = generatePendingMarkUp(data);
    },
    error: function (data) {
      console.log("failed to get get all pending appointment");
    },
    complete: function (data) {
      setTimeout(getAllPendingAppoint, 5000);
    },
  });
}

// starter
setTimeout(getAllPendingAppoint, 1000);
