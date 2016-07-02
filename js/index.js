
function follow(obj){
  var completeTagID = obj.id;
  var tagID = completeTagID.replace("currentTagID","");
  var s="http://www.ansquick.com/index.php/Tag/follow/".concat(tagID);
  //alert(s);
  //alert(tagID);
  $.post(s,function(res){
    alert(res);
    if(res=="nowFollowing"){
      alert(completeTagID);
        $("#".concat(completeTagID)).attr("onclick","unFollow(this)");
        $("#".concat(completeTagID)).html("Unfollow");
        $("#".concat(completeTagID)).attr("class","btn btn-danger");
        $('#asdtagEvent').attr("class","glyphicon glyphicon-remove");

    }
    else if(res=="noUser"){
        alert("please login");
      //  $("#logIn").modal('show');
      //  alert("asda");
    }
  });

}
function unFollow(obj){
  var completeTagID = obj.id;
  var tagID = completeTagID.replace("currentTagID","");
  var s="http://www.ansquick.com/index.php/Tag/Unfollow/".concat(tagID);
  //alert(s);
  //alert(tagID);
  $.post(s,function(res){
    alert(res);
    if(res=="nowNotFollowing"){
        alert(completeTagID);
        $("#".concat(completeTagID)).attr("onclick","follow(this)");
        $("#".concat(completeTagID)).html("Follow");
        $("#".concat(completeTagID)).attr("class","btn btn-success");
        $('#asdtagEvent').attr("class","glyphicon glyphicon-ok");

    }
    else if(res=="noUser"){
        alert("please login");
      //  $("#logIn").modal('show');
      //  alert("asda");
    }
  });

}
$("#signUpSubmit").click(function(){
    $("#firstNameError").hide();
    $("#lastNameError").hide();
    $("#userNameError").hide();
    $("#emailIDError").hide();
    $("#passwordError").hide();
    $("#cpasswordError").hide();
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
    if (password == null || password == "") {
      $("#passwordError").html("Password cannot be empty");
      $("#passwordError").show(500);
      return false;
    }
    if(password!=cpassword){
      $("#cpasswordError").html("Passwords do not match");
      $("#cpasswordError").show(500);
      return false;
    }
    data = {'firstName' : firstName, 'lastName' : lastName , 'userName' : userName, 'emailID' : emailID, 'password' : password  };
    $.post("http://www.ansquick.com/index.php/Signup/index",data,function(res){
      if(res=="userNameExists"){
        $("#userNameError").html("This user Name already Exists");
        $("#userNameError").show(500);
      }
      else if(res=="emailIDExists"){
        $("#emailIDError").html("This Email-ID already Exists");
        $("#emailIDError").show(500);
      }
      else if(res=="true"){
        $("#signUpForm").submit();
      }
      else{
        $("#cpasswordError").html("Could not Register");
        $("#cpasswordError").show(500);
      }
    });
    return false;
});
$("#loginSubmit").click(function(){
  $("#userNameLoginError").hide();
  $("#passwordLoginError").hide();
  var userNameLogin    = document.forms["loginForm"]["userNameLogin"].value.trim();
  var passwordLogin    = document.forms["loginForm"]["passwordLogin"].value.trim();
  if(userNameLogin == null || userNameLogin == ""){
      $("#userNameLoginError").html("User Name cannot be empty");
      $("#userNameLoginError").show(500);
      return false;
  }
  if(passwordLogin == null || passwordLogin == ""){
      $("#passwordLoginError").html("Password cannot be empty");
      $("#passwordLoginError").show(500);
      return false;
  }
  data = {'userNameLogin' : userNameLogin, 'passwordLogin' : passwordLogin };
  $.post("http://www.ansquick.com/index.php/Login/checkUser",data,function(res){
    if(res=="false"){
      $("#passwordLoginError").html("Invalid Username or Password");
      $("#passwordLoginError").show(500);
    }
    else{
      $("#loginForm").submit();
    }
  });
  return false;
});

$("#forgotPasswordSubmit").click(function(){
  $("#userNameForgotPasswordError").hide();
  var userNameForgotPassword    = document.forms["forgotPasswordForm"]["userNameForgotPassword"].value.trim();
  if(userNameForgotPassword == null || userNameForgotPassword == ""){
      $("#userNameForgotPasswordError").html("This Field cannot be empty");
      $("#userNameForgotPasswordError").show(500);
      return false;
  }
  data = {'userNameForgotPassword' : userNameForgotPassword };

  $.post("http://www.ansquick.com/index.php/ForgotPassword/checkUser",data,function(res){

    if(res=="false"){
        $("#userNameForgotPasswordError").html("Invalid Username or Password");
        $("#userNameForgotPasswordError").show(500);
    }
    else{
        $("#userNameForgotPasswordError").hide();
        $.post("http://www.ansquick.com/index.php/ForgotPassword/sendmail",data,function(res){
          if(res=="true"){
            $("#forgotPasswordForm").submit();
          }
          else {
              $("#userNameForgotPasswordError").html("Error Sending Email!!");
              $("#userNameForgotPasswordError").show(500);
          }
        });
    }
  });
  return false;
});
$("#changePasswordSubmit").click(function(){
  $("#newPasswordError").hide();
  $("#cnewPasswordError").hide();
  var newPassword     = document.forms["changePasswordForm"]["newPassword"].value.trim();
  var cnewPassword    = document.forms["changePasswordForm"]["cnewPassword"].value.trim();
  if(newPassword == null || newPassword == ""){
      $("#newPasswordError").html("This Field cannot be empty");
      $("#newPasswordError").show(500);
      return false;
  }
  if(cnewPassword == null || cnewPassword == ""){
      $("#cnewPasswordError").html("This Field cannot be empty");
      $("#cnewPasswordError").show(500);
      return false;
  }
  if(cnewPassword != newPassword ){
      $("#cnewPasswordError").html("Passwords do not match");
      $("#cnewPasswordError").show(500);
      return false;
  }
  return true;
});
$("#postQuestionSubmit").click(function(){
    $("#categoryError").hide();
    $("#questionError").hide();
    $("#tagsError").hide();
    var tagsRX = /^([a-z]+)(,\s*[a-z]+)*$/i;
    var category     = document.forms["postQuestionForm"]["category"].value.trim();
    var question     = document.forms["postQuestionForm"]["question"].value.trim();
    var tags         = document.forms["postQuestionForm"]["tags"].value.trim();
    if(category  == null || category == "" ){
        $("#categoryError").html("Select a Category");
        $("#categoryError").show(500);
        return false;
    }
    if(question  == null || question == "" ){
        $("#questionError").html("This Field cannot be empty");
        $("#questionError").show(500);
        return false;
    }
    if(tags  == null || tags == "" ){
        $("#tagsError").html("Enter a Tag");
        $("#tagsError").show(500);
        return false;
    }
    else if (!tagsRX.test(tags)) {
        $("#tagsError").html("Invalid Format");
        $("#tagsError").show(500);
        return false;
    }
    return true;
});
function addAnswer(obj) {
  var idNum = obj.id.replace('addAnswerSubmit','');
  $("#addAnswerError"+idNum).hide();
  var addAnswerText     = $('#addAnswerText'+idNum).val().trim();
  if(addAnswerText  == null || addAnswerText == "" ){
      $("#addAnswerError"+idNum).html("This Field cannot be empty");
      $("#addAnswerError"+idNum).show(500);
      return false;
  }
  data = {'addAnswerText' : addAnswerText, 'questionID' : idNum };

  $.post("http://www.ansquick.com/index.php/AddAnswer/",data,function(res){
    if(res=="true"){
      location.reload();

    }
    else if(res=="noUser") {
        $("#addAnswerError"+idNum).html("You Need to Login First.");
        $("#addAnswerError"+idNum).show(500);
    }
    else{
        $("#addAnswerError"+idNum).html("Error Posting Answer!!");
        $("#addAnswerError"+idNum).show(500);
    }
  });
  return false;
}

/*$('#searchBox').focus( function(){
  alert("expanded");
});*/
