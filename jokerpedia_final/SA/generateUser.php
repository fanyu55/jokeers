<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 'System Admin'){
    header("location: ../logout.php");
    exit;
}

// Include config file
require_once __DIR__.'\..\core\config.php';

?>

<?php

// SQL Query to Check for 100x User data
$sql="SELECT * FROM user";
$result = $mysqli->query($sql);
$arrayResult1 = mysqli_fetch_array($result);

if(mysqli_num_rows($result) < 100){
	for($x = mysqli_num_rows($result);$x < 100;$x++){
		$user = "user".$x;
		$password = password_hash("qwe123", PASSWORD_DEFAULT);
		$email = $user."@test.com";
		
		// rand() to decide user type
		$type = rand(1,3);
		switch($type){
			// Author
			case 1:
				$userType = "Author";
				break;
			// Reviewer
			case 2:
				$userType = "Reviewer";
				break;
			// Conference Chair
			case 3:
				$userType = "Conference Chair";
				break;
		}
		
		// Prepare SQL Query to insert new user
		$sql1= "INSERT INTO user (username,password,email,usertype,active) 
				VALUES ('$user','$password','$email','$userType','1')";
		$mysqli->query($sql1);
	}
	
	// Return back
	echo ("<script LANGUAGE='JavaScript'>
	window.alert('Users Generated!!')
	window.location.href='../welcome.php' 
	</script>");
}
else{
	// Return back
	echo ("<script LANGUAGE='JavaScript'>
	window.alert('100 Users EXISTED!!')
	window.location.href='../welcome.php' 
	</script>");
	exit;
}
?>