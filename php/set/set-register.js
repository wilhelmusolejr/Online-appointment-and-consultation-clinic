"use strict";

let path = "../../";

import {
  checkPasswordMatch,
  checkPasswordValidity,
} from "../../tools/functions.js";

let isPasswordMatch = false;
$("#reg-pass, #reg-pass-confirm").on("keyup", function () {
  isPasswordMatch = checkPasswordMatch();

  let result = checkPasswordMatch(
    $(`#reg-pass`).val(),
    $(`#reg-pass-confirm`).val()
  );

  if (result) {
    $(`.confirm-password .form-error-message`).html("");
    isPasswordMatch = true;
  } else {
    $(`.confirm-password .form-error-message`)
      .html("Password do not match")
      .css("color", "red");
    isPasswordMatch = false;
  }
});

let isPasswordOk = false;
$("#reg-pass").on("keyup", function () {
  console.log("#reg-pass");

  let result = checkPasswordValidity($(`#reg-pass`).val());

  if (!result) {
    $(`.account-info-form .password .form-error-message`)
      .html("")
      .css("color", "green");
    isPasswordOk = true;
  } else {
    $(`.account-info-form .password .form-error-message`)
      .html(result)
      .css("color", "red");
    isPasswordOk = false;
  }
});

$(".form-register-google").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  if (!isPasswordMatch || !isPasswordOk) {
    console.log("bad");
    return;
  }
  console.log("good");

  $.ajax({
    type: "post", //hide url
    url: `${path}php/set/set-register-manual.php`, //your form validation url
    data: $(".form-register-google").serialize(),
    // dataType: "json",
    success: function (response) {
      console.log(response);

      if (response == "success") {
        $(".continue-register-parent h2").html("Registration completed!");
        $(".continue-register-container").html("");
      }
      // might not gonna work
      else {
        $(".contact-info-form .form-error-message")
          .html("Email is already registered")
          .css("color", "red");
      }
    },
    error: function () {
      console.log("connect did not establish");
    },
  });
});
