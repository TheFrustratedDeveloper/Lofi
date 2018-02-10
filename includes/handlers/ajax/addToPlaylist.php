<?php 
	require_once("../../config.php");
	if(isset($_POST['playlistId']) && isset($_POST['songId'])){
		$playListId = $_POST['playlistId'];
		$songId = $_POST['songId'];
		
		$orderIdQuery = mysqli_query($connect,"SELECT MAX(playlistOrder) + 1 AS playlistOrder FROM playlistsongs WHERE playlistId = '$playListId'");

		$row = mysqli_fetch_array($orderIdQuery);
		$order = $row['playlistOrder'];

		$query = mysqli_query($connect,"INSERT INTO playlistsongs VALUES('','$songId','$playListId','$order')");

	}else{
		echo "Name of Username not given";
	}
?>