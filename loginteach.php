<?php
	include 'config.php';

	session_start();
	$_SESSION["Name"] = $_POST['NameAuthorization'];
	$_SESSION["Password"] = $_POST['PasswordAuthorization'];
	$result=mysqli_query($connect,"SELECT * FROM `teachers` WHERE `UsernameTeacher`='".$_SESSION["Name"]."' 
	AND `PasswordTeacher`='".$_SESSION["Password"]."';") ;

	$user=$result->fetch_assoc();
	if (empty($user)) {
		$connect->close();
		session_destroy();
		header('location:teacherenter.php' );
		exit();
	} 

	$result=mysqli_query($connect,"SELECT `TeacherID`,`LastNameTeacher`,`FirstNameTeacher` FROM `teachers` WHERE 
	`UsernameTeacher`='".$_SESSION["Name"]."' AND `PasswordTeacher`='".$_SESSION["Password"]."';") ;
	while($row = $result->fetch_array()){	 
		$_SESSION["LastName"] = $row["LastNameTeacher"];
		$_SESSION["FirstName"] = $row["FirstNameTeacher"];
		$_SESSION["TeacherID"] = $row["TeacherID"];
	}
	session_write_close();
	$connect->close();
	header('location:teachermain.php' );
	exit();
?>