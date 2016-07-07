var nameRX      = /^[A-Za-z\s]+$/ ;
var emailIDRX   = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var userNameRX  = /^[0-9a-zA-Z]+$/;
var mobileNoRX  = /^\d{10}$/;
$("#searchBoxForm").submit(function(){
  return false;
});
function follow(obj){
  var completeTagID = obj.id;
  var tagID = completeTagID.replace("currentTagID","");
  var s="http://www.ansquick.com/index.php/Tag/follow/".concat(tagID);
  $.post(s,function(res){
    if(res=="nowFollowing"){
        $("#".concat(completeTagID)).attr("onclick","unFollow(this)");
        $("#".concat(completeTagID)).html('<i class="glyphicon glyphicon-remove"></i>Unfollow');
        $("#".concat(completeTagID)).attr("class","btn btn-danger");
    }
    else if(res=="noUser"){
        alert("please login");
    }
  });

}
function unFollow(obj){
  var completeTagID = obj.id;
  var tagID = completeTagID.replace("currentTagID","");
  var s="http://www.ansquick.com/index.php/Tag/Unfollow/".concat(tagID);
  $.post(s,function(res){
    if(res=="nowNotFollowing"){
        $("#".concat(completeTagID)).attr("onclick","follow(this)");
        $("#".concat(completeTagID)).html('<i class="glyphicon glyphicon-ok"></i>Follow');
        $("#".concat(completeTagID)).attr("class","btn btn-success");
    }
    else if(res=="noUser"){
        alert("please login");
    }
  });

}
$("#signUpSubmit").click(function(){
    $(".alert").hide();
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
  $(".alert").hide();
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
    if(res=="true"){
      $("#loginForm").submit();
    }
    else{
      $("#passwordLoginError").html("Invalid Username or Password");
      $("#passwordLoginError").show(500);
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
        $(".alert").hide();
        $("#userNameForgotPasswordError").html("Your Request has been accepted");
        $("#userNameForgotPasswordError").show(500);
        $.post("http://www.ansquick.com/index.php/ForgotPassword/sendmail",data,function(res){

          if(res=="true"){
            $(".alert").hide();
            $("#userNameForgotPasswordSuccess").html("A link to reset password has been sent to yout Email.");
            $("#userNameForgotPasswordSuccess").show(500);
          }
          else {
              alert(res);
              $("#userNameForgotPasswordError").html("Error Sending Email!!");
              $("#userNameForgotPasswordError").show(500);
          }
        });
    }
  });
  return false;
});
$("#changePasswordSubmit").click(function(){
  $(".alert").hide();
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
    $(".alert").hide();
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
function writeAnswerFocus(obj){
  $(".alert").hide();
  var questionID = obj.id.replace('writeAnswer','');
  $('#addAnswerText'+questionID).focus();
  return true;
}
function addAnswer(obj) {
  $(".alert").hide();
  var questionID = obj.id.replace('addAnswerSubmit','');
  var addAnswerText     = $('#addAnswerText'+questionID).val().trim();
  if(addAnswerText  == null || addAnswerText == "" ){
      $("#addAnswerError"+questionID).html("This Field cannot be empty");
      $("#addAnswerError"+questionID).show(500);
      return false;
  }
  data = {'addAnswerText' : addAnswerText, 'questionID' : questionID };

  $.post("http://www.ansquick.com/index.php/AddAnswer/",data,function(res){
    if(res=="true"){
      location.reload();

    }
    else if(res=="noUser") {
        $("#addAnswerError"+questionID).html("You Need to Login First.");
        $("#addAnswerError"+questionID).show(500);
    }
    else{
        $("#addAnswerError"+questionID).html("Error Posting Answer!!");
        $("#addAnswerError"+questionID).show(500);
    }
  });
  return false;
}
function addLike(obj) {
  $(".alert").hide();
  var answerID = obj.id.replace('likeAnswerButton','');
  $likeCount = $("#likeCount"+answerID).html();
  data = {'answerID' : answerID };
  $.post("http://www.ansquick.com/index.php/Like/addLike",data,function(res){
    if(res=="true"){
      location.reload();
    }
    else if(res=="noUser") {
        $("#likeAnswerError"+answerID).html("You Need to Login First.");
        $("#likeAnswerError"+answerID).show(500);
    }
    else{
        $("#likeAnswerError"+answerID).html("Error Liking Answer!!");
        $("#likeAnswerError"+answerID).show(500);
    }
  });
  return false;
}
function removeLike(obj) {
  $(".alert").hide();
  var answerID = obj.id.replace('likeAnswerButton','');
  $likeCount = $("#likeCount"+answerID).html();
  data = {'answerID' : answerID };
  $.post("http://www.ansquick.com/index.php/Like/removeLike",data,function(res){
    if(res=="true"){
      location.reload();
    }
    else if(res=="noUser") {
        $("#likeAnswerError"+answerID).html("You Need to Login First.");
        $("#likeAnswerError"+answerID).show(500);
    }
    else{
        $("#likeAnswerError"+answerID).html("Error Unliking Answer!!");
        $("#likeAnswerError"+answerID).show(500);
    }
  });
  return false;
}

$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    //make First Name editable
    $('#profileFirstName').editable({
        type: 'text',
        validate: function(value) {
          value = $.trim(value);
          if(value == '') {
              return 'This field is required';
          }
          else if (!nameRX.test(value)) {
              return "First Name is invalid";
          }
        },
        send: 'always',
        autotext: $.trim($(this).text),
        url: 'http://www.ansquick.com/index.php/AnsQuick/editProfile/',
        success: function(response, newValue) {
          if(response!="success"){
            return response;
          }
        }
    });

    //make Last Name editable
    $('#profileLastName').editable({
        type: 'text',
        validate: function(value) {
          value = $.trim(value);
          if(value == '') {
              return 'This field is required';
          }
          else if (!nameRX.test(value)) {
              return "Last Name is invalid";
          }
        },
        send: 'always',
        autotext: $.trim($(this).text),
        url: 'http://www.ansquick.com/index.php/AnsQuick/editProfile/',
        success: function(response, newValue) {
          if(response!="success"){
            return response;
          }
        }
    });

    //make Title editable
    $('#profileTitle').editable({
        type: 'text',
        validate: function(value) {
          value = $.trim(value);
          if(value == '') {
              return 'This field is required';
          }
        },
        send: 'always',
        autotext: $.trim($(this).text),
        url: 'http://www.ansquick.com/index.php/AnsQuick/editProfile/',
        success: function(response, newValue) {
          if(response!="success"){
            return response;
          }
        }
    });


    //make AboutMe editable
    $('#profileAboutMe').editable({
        type: 'text',
        validate: function(value) {
          value = $.trim(value);
          if(value == '') {
              return 'This field is required';
          }
        },
        send: 'always',
        autotext: $.trim($(this).text),
        url: 'http://www.ansquick.com/index.php/AnsQuick/editProfile/',
        success: function(response, newValue) {
          if(response!="success"){
            return response;
          }
        }
    });


    //make MobileNo editable
    $('#profileMobileNo').editable({
        type: 'text',
        validate: function(value) {
          value = $.trim(value);
          if(value == '') {
              return 'This field is required';
          }
          else if (!mobileNoRX.test(value)) {
              return "Mobile No is invalid";
          }
        },
        send: 'always',
        autotext: $.trim($(this).text),
        url: 'http://www.ansquick.com/index.php/AnsQuick/editProfile/',
        success: function(response, newValue) {
          if(response!="success"){
            return response;
          }
        }
    });

    //make Gender editable
    $('#profileGender').editable({
        type: 'select',
        title: 'Select Gender',
        source: [
            {value: 'male', text: 'Male'},
            {value: 'female', text: 'Female'}
        ],
        validate: function(value) {
          value = $.trim(value);
          if(value == '') {
              return 'This field is required';
          }
        },
        send: 'always',
        autotext: $.trim($(this).text),
        url: 'http://www.ansquick.com/index.php/AnsQuick/editProfile/',
        success: function(response, newValue) {
          if(response!="success"){
            return response;
          }
        }
    });


});

$("#profilePicFile").change(function() {
    $filename = $("#profilePicFile").val();
    $filename = $filename.replace('C:\\fakepath\\','');
    $filename = $filename.substr($filename.length-10,$filename.length);
    $("#imagePath").html("..."+$filename);
    $("#imagePath").show(500);
    return true;
});

$("#profilePicSubmit").click(function(){
  $filename = $("#profilePicFile").val();
  $filename = $.trim($filename);
  if($filename  == null || $filename == "" ){
    $("#profilePicError").html("Select a File to Upload");
    $("#profilePicError").show(500);
    return false;
  }
  return true;
});
