$("#signUpSubmit").click(function(){
    var nameRX      = /^[A-Za-z\s]+$/ ;
    var emailIDRX   = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var userNameRX  = /^[0-9a-zA-Z]+$/;
    var firstName   = document.forms["signUpForm"]["firstName"].value.trim();
    var lastName    = document.forms["signUpForm"]["lastName"].value.trim();
    var userName    = document.forms["signUpForm"]["userName"].value.trim();
    var emailID     = document.forms["signUpForm"]["emailID"].value.trim();
    var password    = document.forms["signUpForm"]["password"].value.trim();
    var cpassword   = document.forms["signUpForm"]["cpassword"].value.trim();

    if(firstName == null || firstName == ""){
      $("#firstNameError").html("First Name cannot be empty");
      $("#firstNameError").show(500);
      return false;
    }
    else if (!nameRX.test(firstName)) {
        $("#firstNameError").html("First Name is invalid");
        $("#firstNameError").show(500);
        return false;
    }
    else{
        $("#firstNameError").hide();
    }

    if(lastName == null || lastName == ""){
      $("#lastNameError").html("Last Name cannot be empty");
      $("#lastNameError").show(500);
      return false;
    }
    else if (!nameRX.test(lastName)) {
        $("#lastNameError").html("Last Name is invalid");
        $("#lastNameError").show(500);
        return false;
    }
    else{
        $("#lastNameError").hide();
    }

    if(userName == null || userName == ""){
      $("#userNameError").html("Username cannot be empty");
      $("#userNameError").show(500);
      return false;
    }
    else if (!userNameRX.test(userName)) {
        $("#userNameError").html("Username is invalid");
        $("#userNameError").show(500);
        return false;
    }
    else{
        $("#userNameError").hide();
    }

    if(emailID == null || emailID == ""){
      $("#emailIDError").html("Email-ID cannot be empty");
      $("#emailIDError").show(500);
      return false;
    }
    else if (!emailIDRX.test(emailID)) {
        $("#emailIDError").html("Email-ID is invalid");
        $("#emailIDError").show(500);
        return false;
    }
    else{
        $("#emailIDError").hide();
    }

    if (password == null || password == "") {
      $("#passwordError").html("Password cannot be empty");
      $("#passwordError").show(500);
      return false;
    }
    else{
        $("#passwordError").hide();
    }

    if(password!=cpassword){
      $("#cpasswordError").html("Passwords do not match");
      $("#cpasswordError").show(500);
      return false;
    }
    else{
    	$("#cpasswordError").hide();
    }
    return true;
});
