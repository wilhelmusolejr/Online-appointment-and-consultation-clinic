"use strict";

let path = "../";

$.ajax({
  type: "POST", //hide url
  url: `${path}php/request/req-all-appoint.php`, //your form validation url
  dataType: "json",
  async: false,
  success: function (response) {
    console.log(response);
    // clearInterval(joinRoom);
  },
  error: function () {
    console.log("error");
  },
});
