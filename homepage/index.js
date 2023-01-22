"use strict";

// NAVIGATOR
const headerNavContainer = document.querySelector("header .navigator-parent");
const modalLoginRegParent = document.querySelector(".modal-login-reg");

// LOGIN AND REGISTER
const loginContainer = document.querySelector(".login-form-parent");
const registerContainer = document.querySelector(".register-form-parent");

headerNavContainer.addEventListener("click", function (e) {
  if (e.target.tagName == "A") {
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
