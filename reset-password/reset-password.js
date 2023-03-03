"use strict";

let path = "../";

import {
  checkPasswordMatch,
  checkPasswordValidity,
} from "../tools/functions.js";

let parentForm = "form-reset-password";
let passOneInput = `.${parentForm} #reg-pass`;
let passTwoInput = `.${parentForm} #reg-pass-confirm`;

let isPasswordMatch = false;
$(`${passOneInput}, ${passTwoInput}`).on("keyup", function () {
  isPasswordMatch = checkPasswordMatch();

  let result = checkPasswordMatch(
    $(`${passOneInput}`).val(),
    $(`${passTwoInput}`).val()
  );

  if (result) {
    $(`.${parentForm} .confirm-password .form-error-message`).html("");
    isPasswordMatch = true;
  } else {
    $(`.${parentForm} .confirm-password .form-error-message`)
      .html("Password do not match")
      .css("color", "red");
    isPasswordMatch = false;
  }
});

let isPasswordOk = false;
$(`${passOneInput}`).on("keyup", function () {
  let result = checkPasswordValidity($(`${passOneInput}`).val());

  if (!result) {
    $(`.${parentForm} .account-info-form .password .form-error-message`)
      .html("")
      .css("color", "green");
    isPasswordOk = true;
  } else {
    $(`.${parentForm} .account-info-form .password .form-error-message`)
      .html(result)
      .css("color", "red");
    isPasswordOk = false;
  }
});

$(".form-reset-password").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  let parentForm = "form-reset-password";
  // let path = this.querySelector(".path").value;

  if (!isPasswordMatch || !isPasswordOk) {
    console.log("bad");
    return;
  }
  console.log("good");

  $.ajax({
    type: "post", //hide url
    url: `${path}php/update/upd-reset-password.php`, //your form validation url
    data: $(".form-reset-password").serialize(),
    success: function (response) {
      console.log(response);

      if (response == "success") {
        $(`.section-header-parent h2`).text("Password changed");
        $(`.continue-register-container`).addClass("hidden");
      }
    },
    error: function () {
      console.log("ERROR at reset password");
    },
  });
});
