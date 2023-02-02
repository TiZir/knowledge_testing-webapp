<?php
	include 'config.php';

	session_start();
	$_SESSION["Name"] = $_POST['NameAuthorization'];
	$_SESSION["Password"] = $_POST['PasswordAuthorization'];
	$result=mysqli_query($connect,"SELECT * FROM `students` WHERE 
	`UsernameStudent`='".$_SESSION["Name"]."' AND `PasswordStudent`='".$_SESSION["Password"]."';") ;

	$user=$result->fetch_assoc();
	if (empty($user)) {
		$connect->close();
		session_destroy();
		header('location:index.php' );
		exit();
	} 

	$result=mysqli_query($connect,"SELECT `StudentID`,`LastNameStudent`,`FirstNameStudent` FROM 
	`students` WHERE `UsernameStudent`='".$_SESSION["Name"]."' AND `PasswordStudent`='".$_SESSION["Password"]."';") ;
	while($row = $result->fetch_array()){	 
		$_SESSION["LastName"] = $row["LastNameStudent"];
		$_SESSION["FirstName"] = $row["FirstNameStudent"];
		$_SESSION["StudentID"] = $row["StudentID"];
	}
	session_write_close();
	$connect->close();
	header('location:studentmain.php' );
	exit();
?>