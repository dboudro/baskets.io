<?php 
require 'connections.php';
//require 'redirects.php';

function handlelogin() {
	$dbc = connectToDB();
	if ($dbc) {
		$pass = "";
		$email = "";
	
		$pass = sha1(fix_input($_POST['inpass']));
		$email = fix_input($_POST['inmail']);
		
		$findemail = "SELECT * from `users` WHERE `email` = \"".$email."\"";
		
		$result = mysqli_query($dbc, $findemail);
		print_r($result);
		while($row = mysqli_fetch_array($result)) {
			
			foreach($row  as $col) {
				print($col);
			}
			if ($pass == $row['password']) {
				echo "need to go to next page";
				//toMain();
			}
			else {
				//report the error
				echo "Incorrect Password";
				unset($_COOKIE['Login']);
			}
			return true;
		}
			echo "Could not log in";
		
		
	}

}
	
function handlesignup() {

	$pass = sha1(fix_input($_POST['uppass']));
	$passconf = sha1(fix_input($_POST['passconf']));
	$email = fix_input($_POST['upmail']);
	
	if ($pass != $passconf) { 
		echo "Passwords do not match";
		die;
	}
	if ($dbc = connectToDB()) {
		$findemail = "SELECT * from `users` WHERE `email` = \"".$email."\"";
		$mailres = mysqli_query($dbc, $findemail);
		
		if (mysqli_num_rows($mailres) > 0) {
			echo "Email already in Database - try the sign in page";
			die;
		}
	
		$signup = "INSERT INTO `users`(`userID`, `email`, `password`) VALUES ( NULL, '";
		$signup .= $email."' , SHA1('".$pass."') )";
	
		$result = mysqli_query($dbc, $signup);
		echo "need to go to next page";
		//toMain();
	}
	else {
		echo "Could not connect to the database at this time";
	}
	// check that email isn't in Database already - JAVASCRIPT?
	//  check that both passwords match
	//  add user to Database
	//  set a persistent "member" cookie so that you always go to sign in page?
	//  set a "logged in" cookie
}
?>