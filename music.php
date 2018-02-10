<?php 
include ("includes/includedFile.php");
?>
<div class="playlistContainer">
	<div class="gridViewContainer">
		<h2>PLAYLISTS</h2>
		<div class="buttonItems">
			<button onclick="createPlaylist()" class="button bgGreen">
				NEW PLAYLIST
			</button>
		</div>
		
		<?php
		$username = $userLoggedIn->getUsername();
	      $playListQuery = mysqli_query($connect,"SELECT * FROM playlists WHERE owner = '$username' ");
	      if(mysqli_num_rows($playListQuery) == 0){
	      	echo "<span class='noResults'>You don't have a playlist yet. Create One </span>";
	      }
	      while($row = mysqli_fetch_array($playListQuery)){
	      	$playlist = new Playlist($connect,$row);
	        echo "
	          <div class='gridViewItem' role='link' tabindex='0' 
	          	onclick='openPagePushState(\"playlist.php?id=".$playlist->getId()."\")'>
		        <div class='playlistImage'>
					<img src='assets/images/icons/playlist.png'>
		        </div>
	            <div class='gridViewInfo playlistName'>".
	     	        $playlist->getName()
	            ."</div>
	          </div>
	          ";
	      }
    ?>

	</div>
</div>