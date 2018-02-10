<?php 
	require_once("../../config.php");
	if(isset($_POST['playlistId'])){
		$id = $_POST['playlistId'];
		$playListQuery = mysqli_query($connect,"DELETE FROM playlists WHERE id = $id ");
		$Songsquery = mysqli_query($connect,"DELETE FROM playlistsongs WHERE playlistId = $id ");

	}else{
		echo "NPlaylist is  not given";
	}
?>