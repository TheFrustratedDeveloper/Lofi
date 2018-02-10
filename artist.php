<?php 
include ("includes/includedFile.php");

  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }else{
    header("Location:index.php");
  }

  $artist = new Artist($connect,$id);
?>
<div class="entityInfo borderBottom">
	<div class="centerSection">
		<div class="artistInfo">
			<h1 class="artistName"><?php echo  $artist->getName(); ?></h1>
			<div class="headerButtons">
				<button onclick="playFirstSong()" class="button bgGreen">PLAY</button>
			</div>
		</div>
	</div>
</div>
<!-- Popular Songs by artist -->
<div class="trackListContainer borderBottom">
  <h2>Popular Songs</h2>
  <ul class="trackList">
    <?php
      $songIdArray = $artist->getSongId();
      $i=1;
      foreach ($songIdArray as $songId) {
      	if($i > 5){
      		break;
      	}
        $albumSong = new Song($connect,$songId);
        $albumArtist = $albumSong->getArtist();
        //coming from Artist Class
        echo "
          <li class='trackListRows'>
            <div class='trackCount'>
              <img onclick='setTrack(\"".$albumSong->getID()."\", tempPlaylist , true)' class='play' src='assets/images/icons/play-white.png'>
              <span class='trackNumber'>$i</span>
            </div>
            <div class='trackInfo'>
            <span class='trackName'>".$albumSong->getTitle()."</span>
            <span class='artistName'>".$albumArtist->getName()."</span>
            </div>
            <div class='trackOption'>
              <input type='hidden' class='songId' value='".$albumSong->getID()."'>
              <img class='optionButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
            </div>
            <div class='trackDuration'>
              <span class='duration'>".$albumSong->getDuration()."</span>
            </div>
          </li>
        ";
        $i++;
      }
    ?>
<script>
  var tempSongIDs = '<?php echo json_encode($songIdArray)?>';
  tempPlaylist = JSON.parse(tempSongIDs);
</script>

  </ul>
</div>
<!-- Popular albums by artist -->
<div class="gridViewContainer">
	<h2>Albums</h2>
    <?php
      $albumQuery = mysqli_query($connect,"SELECT * FROM album WHERE artist = $id");
      while($row = mysqli_fetch_assoc($albumQuery)){
        echo "
          <div class='gridViewItem'>
              <span onclick='openPagePushState(\"album.php?id=".$row['id']."\")' role='link' tabindex='0'>
              <img src='".$row['artworkPath']."'>
              <div class='gridViewInfo'>".
                $row['title']
              ."</div>
              </span>
          </div>
          ";
      }
    ?>
  </div>
  <nav class="optionsMenu">
    <input type="hidden" name="" class="songId">
    <?php echo Playlist::getPlaylistDropdown($connect,$userLoggedIn->getUsername()); ?>
  </nav>