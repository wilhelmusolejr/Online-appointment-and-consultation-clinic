"use strict";

let path = document.querySelector(".path_locator").textContent;

import {
  checkPasswordMatch,
  checkPasswordValidity,
} from "../tools/functions.js";

// console.log("updated 3/28 10:30pm");

// NAVIGATOR
const headerNavContainer = document.querySelector("header .navigator-parent");
const modalLoginRegParent = document.querySelector(".modal-login-reg");

// LOGIN AND REGISTER
const loginContainer = document.querySelector(".login-form-parent");
const registerContainer = document.querySelector(".register-form-parent");

const body = document.querySelector("body");

headerNavContainer.addEventListener("click", function (e) {
  console.log(e.target);

  if (e.target.closest(".nav-button")) {
    e.preventDefault();
  }

  // notif bell
  if (e.target.classList.contains("fa-bell")) {
    console.log("bell is clicked");

    $.ajax({
      type: "post", //hide url
      url: `${path}php/update/upd-notification-resets.php`, //your form validation url
      // data: $(".form-login").serialize(),
      // dataType: "json",
      success: function (response) {
        console.log("reset");
      },
      error: function () {
        console.log("Cannot reset");
      },
    });
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
    body.classList.add("lock-page");

    modalLoginRegParent.classList.toggle("hidden");
    loginContainer.classList.remove("hidden");
    registerContainer.classList.add("hidden");
  }

  // Open Register
  if (e.target.textContent == "register") {
    body.classList.add("lock-page");

    modalLoginRegParent.classList.toggle("hidden");
    loginContainer.classList.add("hidden");
    registerContainer.classList.remove("hidden");
  }
});

// LOGIN AND REGISTER
modalLoginRegParent.addEventListener("click", function (e) {
  if (e.target.tagName == "A") {
    // e.preventDefault();
  }

  if (e.target.classList.contains("forgot-password")) {
    $(".login-form-parent h2").text("Reset password");
    $(".form-login").addClass("hidden");
    $(".form-reset-password").removeClass("hidden");
  }

  if (e.target.classList.contains("button-cancel")) {
    console.log("wiw");

    $(".login-form-parent h2").text("login");
    $(".form-login").removeClass("hidden");
    $(".form-reset-password").addClass("hidden");
  }

  // Close nav
  if (
    e.target.classList.contains("fa-xmark") ||
    e.target.classList.contains("overlay-black") ||
    e.target.classList.contains("button-back")
  ) {
    body.classList.remove("lock-page");
    this.classList.add("hidden");
  }

  // Open Register
  if (e.target.textContent == "Sign up") {
    loginContainer.classList.add("hidden");
    registerContainer.classList.remove("hidden");
  }
});

function spinnerActivate(parent, show) {
  if (show) {
    // remove hidden stopper
    $(`.${parent} .stopper`).removeClass("hidden");
    // remove hidden loading
    $(`.${parent} .spinner`).removeClass("hidden");
  } else {
    // remove hidden stopper
    $(`.${parent} .stopper`).addClass("hidden");
    // remove hidden loading
    $(`.${parent} .spinner`).addClass("hidden");
  }
}

// LOGIN - Submit
$(".form-login").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page
  let path = this.querySelector(".path").value;

  // disabled button
  let parentForm = "login-form-container";
  spinnerActivate(parentForm, true);

  $.ajax({
    type: "post", //hide url
    url: `${path}php/request/req-login-google.php`, //your form validation url
    data: $(".form-login").serialize(),
    dataType: "json",
    success: function (response) {
      console.log(response.response);

      if (response.response == 1) {
        let initialHref = location.href;
        location.href = initialHref;
      } else {
        // show error
        $(`.form-login .form-error-message`).html(response.response.message);

        if (response.response.target == "verification") {
          $.ajax({
            type: "post", //hide url
            url: `${path}php/set/set-send-verification-mail.php`, //your form validation url
            data: { user_id: response.user_id },
            // dataType: "json",
            success: function (response) {
              console.log(response);
            },
            error: function () {
              console.log("error at send verification");
            },
          });
        }

        spinnerActivate("login-form-parent", false);
      }
    },
    error: function () {
      alert("Cannot establish connection login");
    },
  });
});

let parentForm = "form-register-manual";
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

// REGISTER - Submit
$(".form-register-manual").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  let parentForm = "form-register-manual";

  let path = this.querySelector(".path").value;

  if (!isPasswordMatch || !isPasswordOk) {
    console.log("bad");
    return;
  }
  console.log("good");

  spinnerActivate("register-form-container", true);

  $.ajax({
    type: "post", //hide url
    url: `${path}php/set/set-register-manual.php`, //your form validation url
    data: $(".form-register-manual").serialize(),
    dataType: "json",
    success: function (response) {
      console.log(response);

      if (response.response == "success") {
        $(".register-form-parent h2").html("Registration complete");
        $(".register-form-parent form").html(
          `<p class='text-center'>In order to start using this service, you need to confirm your email address first.</p><br><em class='text-center'>A verification link has sent to your <br> provided email.</em>
          <div class='text-center'>
            <a class='button button-back button-primary'>Done</a>
          </div>`
        );

        // joshuayasil@gmail.com
        spinnerActivate("register-form-container", false);

        // SET DATABASE FOR VERIFICATION
        $.ajax({
          type: "post", //hide url
          url: `${path}php/set/set-account-verification.php`, //your form validation url
          data: { userData: response.userData },
          success: function (response) {
            console.log(response);
          },
          error: function () {
            console.log("connect did not establish");
          },
        });
      } else {
        $(".contact-info-form .form-error-message")
          .html("Email is already registered")
          .css("color", "red");

        spinnerActivate("register-form-container", false);
      }
    },
    error: function () {
      console.log("ERROR at set register manual");
    },
    complete: function (response) {
      if (response.response != "success") {
        $(`.${parentForm} button`).prop("disabled", false);
      }
    },
  });
});

// FORGOT PASSWORD
$(".form-reset-password").on("submit", function (e) {
  e.preventDefault(); //prevent to reload the page

  let parentForm = "form-reset-password";
  let path = this.querySelector(".path").value;

  spinnerActivate("form-reset-password", true);

  $.ajax({
    type: "post", //hide url
    url: `${path}php/update/update-reset-password.php`, //your form validation url
    data: $(".form-reset-password").serialize(),
    success: function (response) {
      console.log(response);

      if (response == "Account is not yet registered") {
        $(`.${parentForm} .form-error-message`).text(response);
        spinnerActivate("form-reset-password", false);
      }
      if (response == "success") {
        $(`.${parentForm} .form-error-message`).text(
          "Reset password link has been sent to the email."
        );
        $(`.${parentForm} .form-error-message`).removeClass(
          "form-error-message"
        );

        $(`.${parentForm} .username-form`).addClass("hidden");
        $(`.${parentForm} .submit`).addClass("hidden");

        spinnerActivate("form-reset-password", false);
      }
    },
    error: function () {
      console.log("ERROR at reset password");
    },
  });
});

//
let outsideProfileCon = document.querySelector(
  ".outside-profile > .profile-container"
);
let floatingProfileCard = document.querySelector(".nav-profile-card");

outsideProfileCon.addEventListener("click", function (e) {
  floatingProfileCard.classList.toggle("hidden");
});

let outsideNotifCon = document.querySelector(".fa-bell");
let floatingNotifCard = document.querySelector(".notification-bar-card");

console.log(outsideNotifCon);

outsideNotifCon.addEventListener("click", function (e) {
  floatingNotifCard.classList.toggle("hidden");
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

const header = document.querySelector("header");
const navHeight = headerNavContainer.getBoundingClientRect().height;

const stickyNav = function (entries) {
  const [entry] = entries;

  if (!entry.isIntersecting) {
    headerNavContainer.style.position = "fixed";
    headerNavContainer.style.backgroundColor = "white";
    headerNavContainer.classList.add("nav-shadow");
  } else {
    headerNavContainer.style.position = "sticky";
    headerNavContainer.style.backgroundColor = "#f5f5f5";
    headerNavContainer.classList.remove("nav-shadow");
  }
};

const headerObserver = new IntersectionObserver(stickyNav, {
  root: null,
  threshold: 0,
  rootMargin: `-${navHeight}px`,
});

headerObserver.observe(header);

function generateTemplateNotif(data) {
  let markUp = "";

  data.forEach((list) => {
    markUp += `
        <li class="notif-item hiddens">
          <a class="divider" href="${
            path +
            "php/update/upd-notif-clicked.php?notif_id=" +
            list.tbl_notif_id
          }">
            <div>
              <p class="divider-grow">${list.message}</p>
              <p class="notif-time">${list.created_at}</p>
            </div>
            <span class="${list.is_read == 0 ? "isRead" : ""}"></span>
          </a>
        </li>
    `;
  });

  return markUp;
}

function getMessage() {
  $.ajax({
    type: "post", //hide url
    url: `${path}php/request/req-notification.php`, //your form validation url
    // data: $(".form-login").serialize(),
    dataType: "json",
    success: function (data) {
      // console.log(data);

      document.querySelector(".notif-list").innerHTML =
        generateTemplateNotif(data);

      let notifNum = data.filter((x) => x.is_read == 0).length;

      if (notifNum == 0) {
        document.querySelector(".notif-num-container").classList.add("hidden");
      } else {
        document
          .querySelector(".notif-num-container")
          .classList.remove("hidden");
        document.querySelector(".notif-num-container").innerHTML = `
        <p class="notif-num">${notifNum}</p>
        `;
      }
    },
    error: function () {
      console.log("ERROR at getting notification");
    },
    complete: function () {
      setTimeout(getMessage, 3000);
    },
  });
}

getMessage();
