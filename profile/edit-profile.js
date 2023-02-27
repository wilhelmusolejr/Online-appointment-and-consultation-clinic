"use strict";

let path = "../";

import {
  checkPasswordMatch,
  checkPasswordValidity,
} from "../tools/functions.js";

let parentForm = "form-edit-profile";
let passOneInput = `.${parentForm} #reg-pass`;
let passTwoInput = `.${parentForm} #reg-pass-confirm`;

let passOneParent = `.${parentForm} .account-info-form .password`;
let passTwoParent = `.${parentForm} .account-info-form .confirm-password`;

let isPasswordOk = false;
$(`${passTwoInput}`).on("keyup", function () {
  let result = checkPasswordValidity($(`${passTwoInput}`).val());

  if (!result) {
    $(`${passTwoParent} .form-error-message`).html("").css("color", "green");
    isPasswordOk = true;
  } else {
    $(`${passTwoParent} .form-error-message`).html(result).css("color", "red");
    isPasswordOk = false;
  }

  // reset
  if ($(`${passTwoInput}`).val() == "") {
    $(`${passTwoParent} .form-error-message`).html("").css("color", "red");
  }
});

// TO CHECK IF CURRENT PASS IS MATCHING WITH USER INPUT
let isPasswordMatch = false;
$(`${passOneInput}`).on("keyup", function () {
  isPasswordMatch = checkPasswordMatch();

  let result = checkPasswordMatch(
    $(`${passOneInput}`).val(),
    $(`.${parentForm} input[name='current_pass']`).val()
  );

  if (result) {
    $(`${passOneParent} .form-error-message`).html("");
    isPasswordMatch = true;
  } else {
    $(` ${passOneParent} .form-error-message`)
      .html("Password do not match")
      .css("color", "red");
    isPasswordMatch = false;
  }

  // reset
  if ($(`${passOneInput}`).val() == "") {
    $(`${passOneParent} .form-error-message`).html("").css("color", "red");
  }
});

// New password
let isGoingTochangePass = "";
$(`${passTwoInput}`).on("keyup", function () {
  isGoingTochangePass = this.value != "";
});

$(".form-edit-profile").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  if (!isPasswordMatch) {
    return;
  }

  if (isGoingTochangePass) {
    if (!isPasswordOk) {
      return;
    }
  }

  $.ajax({
    type: "post", //hide url
    url: `${path}php/update/update-profile.php`, //your form validation url
    data: new FormData(this),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    async: false,
    success: function (response) {
      // FILE CHECKING
      if (response.response == 0) {
        $(`.profile-image .form-error-message`).html(response.message);
        return;
      }

      // CHANGE URL
      location.href = `${path}/profile/profile.php`;
    },
    error: function () {
      console.log("connect did not establish");
    },
  });
});
