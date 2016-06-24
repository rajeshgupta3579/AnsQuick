function validateEmail(email) {
  var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(email);
}
function isFilled(data){
  if (data == null || data == "") {
      return false;
  }
  else {
      return true;
  }
}
function validateForm() {
    var firstName = document.forms["signUpForm"]["firstName"].value;
    firstName = firstName.trim();
    if (firstName == null || firstName == "") {
        alert("Name must be filled out");
        return false;
    }
    if (!(/^[A-Za-z\s]+$/.test(firstName))) {
        alert("Name is in incorrect format");
        return /^[A-Za-z\s]+$/.test(firstName);
    }
    var lastName = document.forms["signUpForm"]["lastName"].value;
    lastName = lastName.trim();
    if (lastName == null || lastName == "") {
        alert("Name must be filled out");
        return false;
    }
    if (!(/^[A-Za-z\s]+$/.test(lastName))) {
        alert("Name is in incorrect format");
        return /^[A-Za-z\s]+$/.test(lastName);
    }
    var emailID = document.forms["signUpForm"]["emailID"].value;
    if(!validateEmail(emailID)){
		 alert("Please enter correct email ID");
		 return false;
    }
    var password = document.forms["signUpForm"]["password"].value;
    if (password == null || password == "") {
        alert("Password must be filled out");
        return false;
    }

    var cpassword= document.forms["myForm"]["cpassword"].value;
    if(password!=cpassword){
      document.getElementById("cpassword").innerHTML = "Passwords do not match!";
    }
    else{
    	document.getElementById("cpassword").innerHTML = "";
    }
    var x = document.forms["myForm"]["ph"].value;
    if (x == null || x == "") {
        alert("Contact must be filled out");
        return false;
    }
    if(x.length<10){
      document.getElementById("phonev").innerHTML = "Invalid:Please enter correct phone number";
      return false;

    }
    else{
    	document.getElementById("phonev").innerHTML = "";
    }

	  if(isNaN(x)||x.indexOf(" ")!=-1)
           {
            document.getElementById("phonev").innerHTML = "Invalid:Please enter correct phone number";
              return false;
           }
           else{
    	document.getElementById("phonev").innerHTML = "";
    }
    return true;
}
