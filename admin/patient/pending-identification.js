"use strict";

let path = "../../";

function generatePendingMarkUp(data) {
  let markUp = "";

  if (data.length == 0) {
    return `
    <tr>
      <td colspan="4">EMPTY TABLE</td>
    </tr>
    
    `;
  }

  data.forEach((id) => {
    markUp += `<tr>
        <td>${id.image.split(".")[1]}</td>
        <td>DUMMY FOR THE MEAN TIME</td>
        <td><a class ="downloadable-file" href="${path}php/request/download.php?file=${
      id.image
    }">${id.image}</a></td>
        <td class="action">
          <a class="action-approve" href="${path}admin/php/set/set-feedback-identification.php?user_id=${
      id.user_id
    }&feedback=VERIFIED">APPROVE</a>
          <a class="action-decline" href="${path}admin/php/set/set-feedback-identification.php?user_id=${
      id.user_id
    }&feedback=DECLINED">DECLINE</a>
        </td>
      </tr>
      `;
  });

  return markUp;
}

function getAllPendingIdentification() {
  $.ajax({
    type: "POST",
    url: `${path}admin/php/request/req-all-pending-identification.php`,
    dataType: "json",
    success: function (data) {
      console.log(data);
      document.querySelector("tbody").innerHTML = generatePendingMarkUp(data);
    },
    error: function (data) {
      console.log("failed to get get all pending appointment");
    },
    complete: function (data) {
      setTimeout(getAllPendingIdentification, 5000);
    },
  });
}

getAllPendingIdentification();
