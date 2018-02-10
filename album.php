<?php include ("includes/includedFile.php"); ?>
<?php
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }else{
    header("Location:index.php");
  }
  //getting album
  $album = new Album($connect,$id);
  ///artist object done in Album class
  $artist = $album->getArtist();

?>

<div id="entityInfo">
  <div class="leftSection">
    <img src="<?php echo $album->getArtwork() ?>" alt="">
  </div>
  <div class="rightSection">
    <h2><?php echo $album->getTitle(); ?></h2>
    <p>By <?php echo $artist->getName(); ?></p>
    <p><?php echo $album->getNumberOfSongs(); ?>&nbsp;Songs</p>
  </div>
</div>
<div class="trackListContainer">
  <ul class="trackList">
    <?php
      $songIdArray = $album->getSongId();
      $i=1;
      foreach ($songIdArray as $songId) {
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
<nav class="optionsMenu">
  <input type="hidden" name="" class="songId">
    <?php echo Playlist::getPlaylistDropdown($connect,$userLoggedIn->getUsername()); ?>
</nav>