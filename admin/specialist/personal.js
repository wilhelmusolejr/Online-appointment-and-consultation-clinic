let modalClient = document.querySelector(".modal-report-rnd");
let path = "../../";

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

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("black-overlay")) {
    e.target.classList.add("hidden");
  }
});

document.querySelector("#example").addEventListener("click", function (e) {
  console.log(e.target);

  if (e.target.closest("td").classList.contains("sorting_1")) {
    let targetId = e.target.closest("tr").getAttribute("data-user-id");

    modalClient.classList.remove("hidden");

    $.ajax({
      type: "post", //hide url
      url: `${path}php/statistics/stat-rnd-report.php`, //your form validation url
      data: { target_id: targetId },
      dataType: "json",
      success: function (response) {
        // console.log(response);
        let approvedAppoint = response.listApprovedAppoint;
        let appointStatus = response.appointStat;

        console.log(appointStatus);

        modalClient.querySelector(".modal-body").innerHTML = `
            <div class="divider ">
              <div class="chart chart-one flex-center">
                <canvas id="stat"></canvas>
              </div>
            </div>
            <p>Total appointment: ${approvedAppoint.length}</p>
            <table id="client_table" style="width: 100%">
              <thead>
                <tr>
                  <td>Appointment #</td>
                  <td>Nutritional concern</td>
                  <td>Status</td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        `;
        modalClient.querySelector(".modal-body tbody").innerHTML =
          generateMarkUpRow(approvedAppoint);

        let appointStatChart = document.querySelector("#stat");

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

        $("#client_table").DataTable();

        new Chart(appointStatChart, statusConfig);
      },
      error: function () {
        console.log("Cannot set ID");
      },
    });
  }
});
