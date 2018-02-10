<?php 
	require_once("../../config.php");
	if(isset($_POST['name']) && isset($_POST['user'])){
		$name = $_POST['name'];
		$username = $_POST['user'];
		$date = date("Y-m-d");

		$query = mysqli_query($connect,"INSERT INTO playlists VALUES('','$name','$username','$date')");

	}else{
		echo "Name of Username not given";
	}
?>