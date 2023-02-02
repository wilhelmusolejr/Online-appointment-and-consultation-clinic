"use strict";

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
  if (e.target.tagName == "A") {
    e.preventDefault();
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

// BMI CALCULATOR
const inputFeetTool = document.querySelector("#feet");
const inputInchesTool = document.querySelector("#inches");
const inputPoundsTool = document.querySelector("#pounds");
const btnBmiTool = document.querySelector(".submit-bmi-tool");
const bmiToolParent = document.querySelector(".bmi-tool");

btnBmiTool.addEventListener("click", function (e) {
  let getBmi =
    (703 * parseInt(inputPoundsTool.value)) /
    Math.pow(
      parseInt(inputFeetTool.value) * 12 + parseInt(inputInchesTool.value),
      2
    );
  getBmi = getBmi.toFixed(2);

  bmiToolParent.querySelector(".tool-result p").outerHTML = `
  <p>Your Body Mass Index is <em>${getBmi}</em></p>
  `;

  if (getBmi < 18.5) {
    bmiToolParent.querySelector(".tool-result h3").outerHTML = `
    <h3 style="color: #87b1d9;" class="text-uppercase">underweight</h3>
    `;
  } else if (getBmi > 18.5 && getBmi < 24.9) {
    bmiToolParent.querySelector(".tool-result h3").outerHTML = `
    <h3 style="color: #3cd465;" class="text-uppercase">normal</h3>
    `;
  } else if (getBmi > 24.9 && getBmi < 29.9) {
    bmiToolParent.querySelector(".tool-result h3").outerHTML = `
    <h3 style="color: #eee133;" class="text-uppercase">overweight</h3>
    `;
  } else if (getBmi > 30 && getBmi < 34.9) {
    bmiToolParent.querySelector(".tool-result h3").outerHTML = `
    <h3 style="color: #fd802e;" class="text-uppercase">obese</h3>
    `;
  } else if (getBmi > 35) {
    bmiToolParent.querySelector(".tool-result h3").outerHTML = `
    <h3 style="color: #f95353;" class="red text-uppercase">extremely obese</h3>
    `;
  }

  bmiToolParent.querySelector(".tool-result").classList.remove("hidden");
});

$("form").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  $.ajax({
    type: "POST", //hide url
    url: "formvalidation.php", //your form validation url
    data: $("form").serialize(),
    success: function () {
      alert("The form was submitted successfully"); //display an alert whether the form is submitted okay
    },
  });
});
