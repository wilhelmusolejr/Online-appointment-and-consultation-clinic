let path = "../../";

let appointStatChart = document.querySelector("#stat");

function generateMarkUpRow(data) {
  let markUp = "";

  data.forEach((element) => {
    markUp += `
    <tr>
      <td>#${element.transact_id}</td>
      <td>${element.chief_complaint}</td>
      <td>${element.board_page < 5 ? "ON PROGRESS" : "COMPLETED"}</td>
    </tr>
    `;
  });

  return markUp;
}

$.ajax({
  type: "post", //hide url
  url: `${path}php/statistics/stat-rnd-report.php`, //your form validation url
  data: { target_id: document.querySelector(".user-id").value },
  dataType: "json",
  success: function (response) {
    console.log(response);

    let approvedAppoint = response.listApprovedAppoint;
    let appointStatus = response.appointStat;

    document.querySelector(".approved-appointment").textContent =
      appointStatus[2];
    document.querySelector(".progress-appointment").textContent =
      appointStatus[1];
    document.querySelector(".pending-appointment").textContent =
      appointStatus[0];
    document.querySelector(".total-appointment").textContent =
      appointStatus[2] + appointStatus[1] + appointStatus[0];

    document.querySelector("table tbody").innerHTML =
      generateMarkUpRow(approvedAppoint);

    let statusConfig = {
      type: "pie",
      data: {
        labels: ["Pending", "On progress", "Completed"],
        datasets: [
          {
            label: "Appointment Status",
            data: appointStatus,
            backgroundColor: [
              "rgb(255, 205, 86)",
              "rgb(100, 19, 132)",
              "rgb(54, 162, 235)",
            ],
            hoverOffset: 4,
          },
        ],
      },
    };

    new Chart(appointStatChart, statusConfig);

    setTimeout(function () {
      window.print();
    }, 2000);
  },
  error: function () {
    console.log("Cannot set ID");
  },
});
