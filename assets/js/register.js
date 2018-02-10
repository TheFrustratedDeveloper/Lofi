$(document).ready(function(){ //start execute as soon as document is ready
  $("#hideLogin").click(function(){
    $("#loginForm").hide();  //hide the login form
    $("#regForm").show(); //shows register form
  });

  $("#hideRegister").click(function(){
    $("#regForm").hide(); //hide register form
    $("#loginForm").show();  //shows login form

  });
});
