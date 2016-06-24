function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
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
        return /^[A-Za-z\s]+$/.test(x);
    }

    var emailID = document.forms["myForm"]["email"].value;
    if(!validateEmail(emailID))
    {
		 alert("Please enter correct email ID");
		 return false;
    }

    var x = document.forms["myForm"]["pwd"].value;
    if (x == null || x == "") {
        alert("Password must be filled out");
        return false;
    }

    var y= document.forms["myForm"]["cpwd"].value;
    if(x!=y){
    document.getElementById("cpwv").innerHTML = "Passwords do not match!";
    }
    else{
    	document.getElementById("cpwv").innerHTML = "";
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
