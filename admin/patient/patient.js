// const { Chart } = require("chart.js");

let path = "../../";

function age(birthdate) {
  const today = new Date();
  const age =
    today.getFullYear() -
    birthdate.getFullYear() -
    (today.getMonth() < birthdate.getMonth() ||
      (today.getMonth() === birthdate.getMonth() &&
        today.getDate() < birthdate.getDate()));
  return age;
}

function generateMarkUpRow(data) {
  let markUp = "";

  data.forEach((element) => {
    markUp += `
    <tr>
      <td>#${element[0]}</td>
      <td>${element[1]}</td>
      <td>${element[2]}</td>
    </tr>
    `;
  });

  return markUp;
}

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

document.addEventListener("click", function (e) {
  // console.log(e.target);

  if (e.target.classList.contains("black-overlay")) {
    e.target.classList.add("hidden");
  }
});

let modalClient = document.querySelector(".modal-report-client");

document.querySelector("#example").addEventListener("click", function (e) {
  // console.log(e.target);

  if (e.target.closest("td").classList.contains("sorting_1")) {
    let targetId = e.target.closest("tr").getAttribute("data-user-id");

    modalClient.classList.remove("hidden");

    $.ajax({
      type: "post", //hide url
      url: `${path}php/statistics/stat-client.php`, //your form validation url
      data: { target_id: targetId },
      dataType: "json",
      success: function (response) {
        console.log(response);

        let statData = response.statData;
        let userData = response.userData;
        let appointData = response.listAppointment;
        let appointStatusData = response.listAppointmentStatus;

        const birthdate = new Date(userData.birthdate);
        const ageValue = age(birthdate);

        modalClient.querySelector(".modal-body").innerHTML = `
        <p>Full name: ${userData.first_name} ${userData.last_name}</p>
        <p>Age: ${ageValue}</p>
        <p>Sex: ${userData.gender == 1 ? "Male" : "Female"}</p>
        <div class="divider">
          <div class="chart chart-one flex-center">
            <canvas id="stat"></canvas>
          </div>
          <div class="chart chart-one flex-center">
            <canvas id="status"></canvas>
          </div>
        </div>
        <p>Total appointment: ${appointData.length}</p>
        <table id="client_table" style="width: 100%">
          <thead>
            <tr>
              <td>Appointment #</td>
              <td>Nutritioanl concern</td>
              <td>Status</td>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
    `;
        modalClient.querySelector(".modal-body tbody").innerHTML =
          generateMarkUpRow(appointData);

        let appointStatusChart = document.querySelector("#status");
        let appointStatChart = document.querySelector("#stat");

        let statConfig = {
          type: "bar",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Month set appointment",
                data: statData,
                backgroundColor: [
                  "rgba(255, 99, 132, 0.2)",
                  "rgba(255, 159, 64, 0.2)",
                  "rgba(255, 205, 86, 0.2)",
                  "rgba(75, 192, 192, 0.2)",
                  "rgba(54, 162, 235, 0.2)",
                  "rgba(153, 102, 255, 0.2)",
                  "rgba(201, 203, 207, 0.2)",
                ],
                borderColor: [
                  "rgb(255, 99, 132)",
                  "rgb(255, 159, 64)",
                  "rgb(255, 205, 86)",
                  "rgb(75, 192, 192)",
                  "rgb(54, 162, 235)",
                  "rgb(153, 102, 255)",
                  "rgb(201, 203, 207)",
                ],
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
        };

        let statusConfig = {
          type: "pie",
          data: {
            labels: ["Approved", "Pending", "Declined"],
            datasets: [
              {
                label: "My First Dataset",
                data: appointStatusData,
                backgroundColor: [
                  "rgb(54, 162, 235)",
                  "rgb(255, 205, 86)",
                  "rgb(255, 99, 132)",
                ],
                hoverOffset: 4,
              },
            ],
          },
        };

        $("#client_table").DataTable();

        new Chart(appointStatChart, statConfig);
        new Chart(appointStatusChart, statusConfig);
      },
      error: function () {
        console.log("Cannot set ID");
      },
    });
  }
});
