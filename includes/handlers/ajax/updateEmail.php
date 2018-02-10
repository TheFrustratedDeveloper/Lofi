<?php 
	require_once("../../config.php");
	if(isset($_POST['email']) && isset($_POST['username'])){
		$newEmail = $_POST['email'];
		$username = $_POST['username'];
		if(!empty($newEmail)){
			if(!filter_var($newEmail,FILTER_VALIDATE_EMAIL)){
				echo "Please provide valid email";
				exit();
			}
			$emailCheck = mysqli_query($connect,"SELECT email FROM users WHERE email = '$newEmail' AND username != '$username'");
			if(mysqli_num_rows($emailCheck) > 0){
				echo "Email is already in use";
				exit();
			}
			$emailCheck = mysqli_query($connect,"SELECT email FROM users WHERE email = '$newEmail' AND username = '$username'");
			if(mysqli_num_rows($emailCheck) > 0){
				echo "Email Saved";
				exit();
			}
			$query = mysqli_query($connect,"UPDATE users SET email = '$newEmail' WHERE username = '$username'");
			if($query){
				echo "Email Updated Successfully";
			}
			
		}else{
			echo "You must enter an email";
			exit();
		}
	}else{
		echo "Email or Username not found";
		exit();
	}
?>

