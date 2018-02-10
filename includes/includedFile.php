<?php 
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		//if send with ajax
		require_once('includes/config.php');
		require_once('includes/classes/User.php');
		require_once('includes/classes/Artist.php');
		require_once('includes/classes/Album.php');
		require_once('includes/classes/Song.php');
		require_once('includes/classes/Playlist.php');

		if(isset($_GET['userLoggedIn'])){
			$userLoggedIn = new User($connect,$_GET['userLoggedIn']);
		}else{
			echo "Username not defined";
			exit();
		}
	}else{
		//if send with url
		include ("includes/files/header.php");
		include ("includes/files/footer.php");
		$url = $_SERVER['REQUEST_URI'];
		echo "
			<script>
				openPagePushState('$url');
			</script>
		";
		exit();
	}
?>