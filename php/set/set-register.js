"use strict";

import { passwordChecker } from "../../tools/functions.js";

let parentElement = ".account-info-form";
let password1 = "#reg-pass";
let password2 = "#reg-pass-confirm";

let isPasswordMatch = false;
$("#reg-pass, #reg-pass-confirm").on("keyup", function () {
  isPasswordMatch = passwordChecker(parentElement, password1, password2);
});
