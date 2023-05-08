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

let appointStatusChart = document.querySelector("#status");
let appointStatChart = document.querySelector("#stat");

$.ajax({
  type: "post", //hide url
  url: `${path}php/statistics/stat-client.php`, //your form validation url
  data: { target_id: document.querySelector(".user-id").value },
  dataType: "json",
  success: function (response) {
    console.log(response);

    let statData = response.statData;
    let userData = response.userData;
    let appointData = response.listAppointment;
    let appointStatusData = response.listAppointmentStatus;

    const birthdate = new Date(userData.birthdate);
    const ageValue = age(birthdate);

    userData.profile_img =
      userData.profile_img != null ? userData.profile_img : "dummy_user.jpg";

    document.querySelector(
      ".client-pic"
    ).src = `${path}uploads/${userData.profile_img}`;

    let clientInfoMarkUp = `<p class="text-uppercase">Client basic information</p>
    <div class="divider">
      <div class="left">
        <p>Full name:</p>
      </div>
      <div class="right">
        <p>${userData.first_name} ${userData.last_name}</p>
      </div>
    </div>

    <div class="divider">
      <div class="left">
        <p>Age:</p>
      </div>
      <div class="right">
        <p>${ageValue}</p>
      </div>
    </div>

    <div class="divider">
      <div class="left">
        <p>Sex:</p>
      </div>
      <div class="right">
        <p>${userData.gender == 1 ? "Male" : "Female"}</p>
      </div>
    </div>

    <div class="divider">
      <div class="left">
        <p>Email:</p>
      </div>
      <div class="right">
        <p>${userData.email}</p>
      </div>
    </div>`;

    document.querySelector(".client-info-parent").innerHTML = clientInfoMarkUp;

    document.querySelector(".approved-appointment").textContent =
      appointStatusData[0];
    document.querySelector(".declined-appointment").textContent =
      appointStatusData[2];
    document.querySelector(".pending-appointment").textContent =
      appointStatusData[1];
    document.querySelector(".total-appointment").textContent =
      appointData.length;

    document.querySelector("table tbody").innerHTML =
      generateMarkUpRow(appointData);

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

    new Chart(appointStatChart, statConfig);
    new Chart(appointStatusChart, statusConfig);

    setTimeout(function () {
      window.print();
    }, 2000);
  },
  error: function () {
    console.log("Cannot set ID");
  },
});
