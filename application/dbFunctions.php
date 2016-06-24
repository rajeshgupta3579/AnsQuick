<?php
/*
* Returns a connection to the Database.
*/

function dbConnection(){
	

		$host 		=     'localhost';
		$userName	= 	  'root';
		$pass 		= 	  'Jindal9@';
		$dbname 	= 	  'ansQuick';
		$con 		=	   mysqli_connect($host,$userName,$pass,$dbname);
		
		if(!$con){

		 	die("Connection failed: " . $con->connect_error);
		 
		 }
		 else {

		 	return $con;

		 }
	
	
	
}
/*
* Checks if the userName or emailID exsists in the database.
* Takes a connection to the database, userName and EmailID as an imput.
* Returns true if the userName or EmailID exists in the DB else return false.
*/
function userExist($con,$userName,$emailID ){

		$stmt	=	$con->prepare("SELECT * FROM UserInfo WHERE userName=? OR emailID=?");
		$stmt->bind_param("ss",$userName,$emailID);
		$stmt->execute();
		$stmt->bind_result($result);
		$stmt->fetch();
		$num_row	=	mysqli_num_rows($result);
		
		if($num_row>0){
			$row 	=	mysqli_fetch_row($result);
			return $row;
		}
		
		else return false;

}
/*
* Encrypts the user password. 
* Takes the user entered password as input and adds random salt to it and perform encryption.
* Returns the encrypted password and generated salt.
*/

function encryptPassword($password,$salt){

		$password 	=	utf8_encode($password);
		
		$saltEncoded= 	utf8_encode(uniqid(mt_rand(), true));
		$password 	= 	md5($password);
		$password 	= 	md5($password + $saltEncoded);
		
		for($i=0;$i<1000;$i++){
		
			$password = md5($password);
		
		}

		$password 	=	base64_encode($password);
		$pair		=	array(0=>$password,1=>$salt);
		return $pair;
		
}
/*
* Adds a user to the database if he doen't already exist.
* Takes info about user from POST array.
* returns TRUE if user is added else return FALSE.
*/

function insertUser(){
			 if(!isset($_POST['firstName']) OR 
					!isset($_POST['userName']) OR
					 !isset($_POST['password']) OR 
					 	!isset($_POST['emailID'])
				  )
				{
					return false;
				}
		$firstName 	=	$_POST['firstName'];
		$lastName 	=	$_POST['lastName'];
		$userName 	=	$_POST['userName'];
		$password	=	$_password['password'];
		$emailID 	=	$_POST['emailID'];
		$con 		= 	dbConnection();
		$salt 		= 	uniqid(mt_rand(), true);

		if(!userExist($con,$userName,$emailID)){

			$password 	=	encryptPassword($password,$salt);
			$stmt		=	$con->prepare("INSERT INTO UserInfo (firstName,lastName,userName,password,emailID,salt)VALUES=(?,?,?,?,?,?)");
			$stmt->bind_param("sssss",$firstName,$lastName,$userName,$password,$emailID,$salt);
			$stmt->execute();
			return true;

		}
		else return false;
		
}
/*
* Creates Session for a user on successfull login and returns 1.
* Takes username and password from POST array.
* Returns 0 for non-existant user , returns 2 for existing user and wrong password, returns 3 for empty fields.
*/
function logIn(){
		if(!isset($_POST['userName']) OR
			!isset($_POST['password'])
			){
			return 3;
		}
		$userName 	=	$_POST['userName'];
		$password 	=	$_POST['password'];
		$con 		= 	dbConnection();
		$emailID 	= 	$userName;

		if($row=userExist($con,$userName,$emailID)){
			
			$storedPassword = $row['password'];
			$salt 			= $row['salt'];
			$password 		= encryptPassword($password,$salt);
			$userID 		= $row['userID'];	
			
			if($password==$storedPassword){

				$_SESSION["$serID"]	=	$password;

				
			}
			else
			{
				return 0;
			}
		}
		else{
				return 2;
		}

}

function logOut(){

		if(!isset($_POST['userName']) OR
			!isset($_POST['password'])
			){
			return 3;
		}

}

?>

