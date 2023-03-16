"use strict";

let sideBarElem = document.querySelector(".side-bar");

sideBarElem.addEventListener("click", function (e) {
  if (e.target.classList.contains("fa-solid")) {
    e.preventDefault();

    e.target.closest(".active").querySelector("ul").classList.toggle("hidden");
  }
});
