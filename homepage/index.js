"use strict";

import { passwordChecker } from "../tools/functions.js";

// NAVIGATOR
const headerNavContainer = document.querySelector("header .navigator-parent");
const modalLoginRegParent = document.querySelector(".modal-login-reg");

// LOGIN AND REGISTER
const loginContainer = document.querySelector(".login-form-parent");
const registerContainer = document.querySelector(".register-form-parent");

headerNavContainer.addEventListener("click", function (e) {
  if (e.target.closest(".nav-button")) {
    e.preventDefault();
  }

  // Open nav amd Close
  if (
    e.target.classList.contains("fa-bars") ||
    e.target.classList.contains("fa-xmark")
  ) {
    this.querySelector(".fa-xmark").classList.toggle("hidden");
    this.querySelector(".nav-container").classList.toggle("open-nav");
  }

  // Open login
  if (e.target.textContent == "login") {
    modalLoginRegParent.classList.toggle("hidden");
    loginContainer.classList.remove("hidden");
    registerContainer.classList.add("hidden");
  }

  // Open Register
  if (e.target.textContent == "register") {
    modalLoginRegParent.classList.toggle("hidden");
    loginContainer.classList.add("hidden");
    registerContainer.classList.remove("hidden");
  }
});

// LOGIN AND REGISTER
modalLoginRegParent.addEventListener("click", function (e) {
  // console.log(e.target);

  if (e.target.tagName == "A") {
    // e.preventDefault();
  }

  // Close nav
  if (
    e.target.classList.contains("fa-xmark") ||
    e.target.classList.contains("overlay-black")
  ) {
    this.classList.add("hidden");
  }

  // Open Register
  if (e.target.textContent == "Sign up") {
    loginContainer.classList.add("hidden");
    registerContainer.classList.remove("hidden");
  }
});

// LOGIN - Submit
$(".form-login").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  let path = this.querySelector(".path").value;
  console.log(path);

  $.ajax({
    type: "post", //hide url
    url: `${path}php/request/req-login.php`, //your form validation url
    data: $(".form-login").serialize(),

    success: function (response) {
      if (response) {
        let initialHref = location.href;
        location.href = initialHref;
      } else {
        console.log("ERROR LOGIN VIA TEXT");
      }
    },
    error: function () {
      alert("Cannot establish connection login");
    },
  });
});

let parentElement = ".account-info-form";
let password1 = "#reg-pass";
let password2 = "#reg-pass-confirm";

let isPasswordMatch = false;
$("#reg-pass, #reg-pass-confirm").on("keyup", function () {
  isPasswordMatch = passwordChecker(parentElement, password1, password2);
});

// REGISTER - Submit
$(".form-register").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  let path = this.querySelector(".path").value;
  console.log(path);

  if (!isPasswordMatch) {
    console.log(isPasswordMatch);
    return;
  }
  console.log(isPasswordMatch);

  $.ajax({
    type: "post", //hide url
    url: `${path}php/set/set-register-manual.php`, //your form validation url
    data: $(".form-register").serialize(),
    success: function (response) {
      if (response == "success") {
        $(".register-form-parent h2").html("Registration complete");
        $(".register-form-parent form").html(
          "<p class='text-center'>In order to start using this service, you need to confirm your email address first.</p><br><em class='text-center'>A verification link has sent to your <br> email provided.</em>"
        );
      } else {
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

let outsideProfileCon = document.querySelector(
  ".outside-profile > .profile-container"
);
let floatingProfileCard = document.querySelector(".nav-profile-card");

outsideProfileCon.addEventListener("mouseover", function (e) {
  floatingProfileCard.classList.toggle("hidden");
});

// BMI CALCULATOR
// const inputFeetTool = document.querySelector("#feet");
// const inputInchesTool = document.querySelector("#inches");
// const inputPoundsTool = document.querySelector("#pounds");
// const btnBmiTool = document.querySelector(".submit-bmi-tool");
// const bmiToolParent = document.querySelector(".bmi-tool");

// bmiToolParent.addEventListener("click", function (e) {
//   // BUTTON
//   if (e.target.tagName == "BUTTON") {
//     e.preventDefault();

//     let getBmi =
//       (703 * parseInt(inputPoundsTool.value)) /
//       Math.pow(
//         parseInt(inputFeetTool.value) * 12 + parseInt(inputInchesTool.value),
//         2
//       );
//     getBmi = getBmi.toFixed(2);

//     bmiToolParent.querySelector(".tool-result p").outerHTML = `
//   <p>Your Body Mass Index is <em>${getBmi}</em></p>
//   `;

//     if (getBmi < 18.5) {
//       bmiToolParent.querySelector(".tool-result h3").outerHTML = `
//     <h3 style="color: #87b1d9;" class="red text-uppercase">underweight</h3>
//     `;
//     } else if (getBmi > 18.5 && getBmi < 24.9) {
//       bmiToolParent.querySelector(".tool-result h3").outerHTML = `
//     <h3 style="color: #3cd465;" class="red text-uppercase">normal</h3>
//     `;
//     } else if (getBmi > 24.9 && getBmi < 29.9) {
//       bmiToolParent.querySelector(".tool-result h3").outerHTML = `
//     <h3 style="color: #eee133;" class="red text-uppercase">overweight</h3>
//     `;
//     } else if (getBmi > 30 && getBmi < 34.9) {
//       bmiToolParent.querySelector(".tool-result h3").outerHTML = `
//     <h3 style="color: #fd802e;" class="red text-uppercase">obese</h3>
//     `;
//     } else if (getBmi > 35) {
//       bmiToolParent.querySelector(".tool-result h3").outerHTML = `
//     <h3 style="color: #f95353;" class="red text-uppercase">extremely obese</h3>
//     `;
//     }

//     bmiToolParent.querySelector(".tool-result").classList.remove("hidden");
//   }
// });

// FORM VALIDATION
// $("#password, #confirm_password").on("keyup", function () {
//   if ($("#password").val() != $("#confirm_password").val()) {
//     $(".confirm-password .form-error-message")
//       .html("Not Matching")
//       .css("color", "red");
//   } else $(".confirm-password .form-error-message").html("").css("color", "red");
// });

// console.log("test");
