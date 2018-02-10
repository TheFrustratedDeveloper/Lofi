<?php include ("includes/includedFile.php"); ?>

<?php 
	if(isset($_GET['tag'])){
		$tags = urldecode($_GET['tag']);
	}else{
		$tags = "";
	}
?>
<div class="searchContainer">
	<h4>Search for an artist, album, or song</h4>
	<input class="searchInput" value="<?php echo $tags ?>" type="text" onfocus="var val=this.value; this.value=''; this.value= val;" placeholder="Start typing ...">
</div>
<script>
	$('.searchInput').focus();
	$(function(){
		$('.searchInput').keyup(function(){
			clearTimeout(timer);
			timer = setTimeout(function(){
				var val = $('.searchInput').val();
				openPagePushState('search.php?tag='+val);
			},1000);
		});
	});
</script>
<?php 
	if($tags == ""){
		exit();
	}
?>
<!-- searching songs -->
<div class="trackListContainer borderBottom">
  <h2>Songs</h2>
  <ul class="trackList">
    <?php
    $songsQuery = mysqli_query($connect,"SELECT id FROM songs WHERE title LIKE '%$tags%' LIMIT 10");
    if(mysqli_num_rows($songsQuery) == 0){
    	echo "<span class='noResults'>No songs found matching <b> $tags </b> </span> ";
    }
      $songIdArray = array();
      $i=1;
      while ($row = mysqli_fetch_array($songsQuery)) {
      	if($i > 15){
      		break;
      	}

      	array_push($songIdArray,$row['id']);
        $albumSong = new Song($connect,$row['id']);
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
<!-- searching artist -->
<div class="artistsContainer borderBottom">
	<h2>Artists</h2>
<?php 
		$artistQuery = mysqli_query($connect,"SELECT id FROM artist WHERE name LIKE '$tags%' LIMIT 10");
	if(mysqli_num_rows($artistQuery) == 0){
    	echo "<span class='noResults'>No artist found matching <b> $tags </b> </span> ";
    }
    while($row = mysqli_fetch_array($artistQuery)){
    	$artist = new Artist($connect,$row['id']);
    	echo "
		<div class='searchResultRow'>
			<div class='artistName'>
				<span onclick='openPagePushState(\"artist.php?id=".$artist->getId()." \")' role='link' tabindex='0'>
				".
					$artist->getName()
				."
				</span>

			</div>
		</div>
    	";
    }
?>
</div>
<!-- searching albums -->
<div class="gridViewContainer">
	<h2>Albums</h2>
    <?php
      $albumQuery = mysqli_query($connect,"SELECT * FROM album WHERE title LIKE '%$tags%' LIMIT 10");
      if(!$albumQuery){
      	die('Error'.mysqli_error($connect));
      }
      if(mysqli_num_rows($albumQuery) == 0){
      	echo "<span class='noResults'>No album found matching <b> $tags </b> </span>";
      }
      while($row = mysqli_fetch_array($albumQuery)){
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