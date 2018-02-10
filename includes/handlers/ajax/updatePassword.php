<?php 
	require_once("../../config.php");
	if(!isset($_POST['username'])){
		echo "ERROR: User not logged in";
		exit();
	}

	if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword']) || !isset($_POST['confirmPassword'])){
		echo "All password fields are not set";
		exit();
	}
	if(empty($_POST['oldPassword']) || empty($_POST['newPassword']) || empty($_POST['confirmPassword'])){
		echo "Please fill all the password fields";
		exit();
	}

	$username = $_POST['username'];
	$oldPassword = md5($_POST['oldPassword']);
	$newPassword = md5($_POST['newPassword']);	
	$confirmPassword = md5($_POST['confirmPassword']);

	$oldPasswordCheckQuery = mysqli_query($connect,"SELECT password , username FROM users WHERE username = '$username' AND password = '$oldPassword'");
	if(mysqli_num_rows($oldPasswordCheckQuery) != 1){
		echo "Old Password is incorrect";
		exit();
	}
	if($newPassword != $confirmPassword){
		echo "Please confirm your new password";
		exit();
	}

	$updatePasswordQuery = mysqli_query($connect,"UPDATE users SET password = '$newPassword' WHERE username = '$username'");
	if($updatePasswordQuery){
		echo "Password updated successfully";
	}


?>