<?php 
	require_once("../../config.php");
	if(isset($_POST['playlistId']) && isset($_POST['songId'])){
		$playlistId = $_POST['playlistId'];
		$songId = $_POST['songId'];

		$query = mysqli_query($connect,"DELETE FROM playlistsongs WHERE playlistId = $playlistId AND songId = $songId");

	}else{
		echo "Playlist or song not given";
	}
?>