"use strict";

export function passwordChecker(parentElement, password1, password2) {
  let isPasswordMatch;

  if ($(`${password1}`).val() == $(`${password2}`).val()) {
    $(`${parentElement} .form-error-message`).html("");
    isPasswordMatch = true;
  } else {
    $(`${parentElement} .form-error-message`)
      .html("Password do not match")
      .css("color", "red");
    isPasswordMatch = false;
  }

  return isPasswordMatch;
}
