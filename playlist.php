<?php include ("includes/includedFile.php"); ?>
<?php
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }else{
    header("Location:index.php");
  }

  $playlist = new Playlist($connect,$id);
  $owner = new User($connect,$playlist->getOwner());

?>

<div id="entityInfo">
  <div class="leftSection">
    <div class="playlistImage">
      <img src="assets/images/icons/playlist.png" alt="playlist icon">
    </div>
  </div>
  <div class="rightSection">
    <h2><?php echo $playlist->getName(); ?></h2>
    <p>By <?php echo $playlist->getOwner(); ?></p>
    <p><?php echo $playlist->getNumberofSongs(); ?>&nbsp;Songs</p>
    <button onclick="deletePlaylist('<?php echo $id ?>')" class="button bgGreen">DELETE PLAYLIST</button>
  </div>
</div>
<div class="trackListContainer">
  <ul class="trackList">
    <?php
      $songIdArray = $playlist->getSongId();
      $i=1;
      foreach ($songIdArray as $songId) {
        $playlistSong = new Song($connect,$songId);
        $songArtist = $playlistSong->getArtist();
        //coming from Artist Class
        echo "
          <li class='trackListRows'>
            <div class='trackCount'>
              <img onclick='setTrack(\"".$playlistSong->getID()."\", tempPlaylist , true)' class='play' src='assets/images/icons/play-white.png'>
              <span class='trackNumber'>$i</span>
            </div>
            <div class='trackInfo'>
            <span class='trackName'>".$playlistSong->getTitle()."</span>
            <span class='artistName'>".$songArtist->getName()."</span>
            </div>
            <div class='trackOption'>
              <input type='hidden' class='songId' value='".$playlistSong->getID()."'>
              <img class='optionButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
            </div>
            <div class='trackDuration'>
              <span class='duration'>".$playlistSong->getDuration()."</span>
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
  <nav class="optionsMenu">
    <input type="hidden" name="" class="songId">
    <?php echo Playlist::getPlaylistDropdown($connect,$userLoggedIn->getUsername()); ?>

    <div class="item" onclick="removeFromPlaylist(this,'<?php echo $id ?>')">
      Remove From Playlist
    </div>
  </nav>

