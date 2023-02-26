"use strict";

let path = "../";

let profileContainer = document.querySelector(".profile-page-container");
let modalUploadId = document.querySelector(".modal-upload-id");

profileContainer.addEventListener("click", function (e) {
  console.log(e.target);

  if (e.target.classList.contains("upload-id-btn")) {
    e.preventDefault();
    modalUploadId.classList.toggle("hidden");
  }

  if (e.target.classList.contains("disabled")) {
    e.preventDefault();
  }
});

modalUploadId.addEventListener("click", function (e) {
  // console.log(e.target);

  if (
    e.target.classList.contains("fa-xmark") ||
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-cancel")
  ) {
    this.classList.add("hidden");
  }

  if (e.target.parentElement.classList.contains("form-success")) {
    modalUploadId.classList.toggle("hidden");
  }
});

// FORM -- IDENTIFICATION
$(".form-identification").on("submit", function (e) {
  e.preventDefault();

  $.ajax({
    type: "post", //hide url
    url: `${path}php/set/set-user-identification.php`, //your form validation url
    data: new FormData(this),
    // dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
      console.log(response);

      if (response.response == 0) {
        console.log(response.message);
        $(`.modal-upload-id .form-error-message`).text(response.message);
        return;
      } else {
        modalUploadId.querySelector("form").classList.add("hidden");
        modalUploadId
          .querySelector("form")
          .insertAdjacentHTML("beforebegin", `<p>Uploaded successfully</p>`);
        modalUploadId.querySelector(".form-success").classList.remove("hidden");

        profileContainer.querySelector(".upload-id-btn").textContent =
          "UPLOADED";
        profileContainer
          .querySelector(".upload-id-btn")
          .classList.add("disabled");
        profileContainer
          .querySelector(".upload-id-btn")
          .classList.toggle("upload-id-btn");

        modalUploadId
          .querySelector(".modal-container")
          .classList.add("modal-good");
      }
    },
    error: function () {
      console.log("Cannot set ID");
    },
  });
});
