$(document).ready(function() {
    console.log("Connected to login.js");


    $("#loginForm").on("submit", function(e) {
        e.preventDefault();

        var inputUsername = $("#username").val();
        var inputPwd = $("#password").val();

        // console.log("Username: " + inputUsername);
        // console.log("Email: " + inputPwd);


    });
});