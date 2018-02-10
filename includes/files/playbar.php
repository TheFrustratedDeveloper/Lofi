<?php
  $songQuery = mysqli_query($connect,"SELECT id FROM songs ORDER BY RAND()");
  $resultArray = array();
  while($row = mysqli_fetch_array($songQuery)){
    array_push($resultArray,$row['id']);
  }
  //converting php array to jsonArray
  $jsonArray = json_encode($resultArray);
?>
<script>
  $(document).ready(function(){
      var newPlaylist =  <?php echo $jsonArray ?> ;
      audioElement = new Audio();
      setTrack(newPlaylist[0],newPlaylist, false);
      updateVolumeProgressBar(audioElement.audio);

      $('#nowPlayingBarContainer').on("mousedown touchstart mousemove touchmove",function(e){
        e.preventDefault();
      })
//progressBar
      $('.playbackBar .progressBar').mousedown(function(){
        mouseDown = true;
      });
      $('.playbackBar .progressBar').mousemove(function(e){
        //passing mouse click evenet
        if(mouseDown){
          //set time of song, depending on position of mouse
          timeFromOffset(e,this);
        }
      });
      $('.playbackBar .progressBar').mouseup(function(e){
        //passing mouse click evenet
        timeFromOffset(e,this);
      });
//volumeBar

      $('.volumeBar .progressBar').mousedown(function(){
        mouseDown = true;
      });
      $('.volumeBar .progressBar').mousemove(function(e){
        //passing mouse click evenet
        if(mouseDown){
          var percentage = e.offsetX / $(this).width();
          if(percentage >= 0 && percentage <= 1){
            audioElement.audio.volume = percentage;
          }
        }
      });
      $('.volumeBar .progressBar').mouseup(function(e){
        //passing mouse click evenet
        var percentage = e.offsetX / $(this).width();
        if(percentage >= 0 && percentage <= 1){
          audioElement.audio.volume = percentage;
        }
      });


      $(document).mouseup(function(){
        mouseDown = false;
      });
  });

  function timeFromOffset(mouse, progressBar){
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage/100);
    audioElement.setTime(seconds);
  }


  function setTrack(trackId,newPlaylist,play){
    if(newPlaylist != currentPlaylist){
      currentPlaylist = newPlaylist;
      shufflePlaylist = currentPlaylist.slice();
      shuffleArray(shufflePlaylist);
    }
    if(shuffle){
      currentIndex = shufflePlaylist.indexOf(trackId);
    }else{
      currentIndex = currentPlaylist.indexOf(trackId);
    }
    pauseSong();
    //getting song details
    $.post("includes/handlers/ajax/getSongJson.php" , { songId : trackId }, function(data){
      var track = JSON.parse(data);
      $('.trackName span').text(track.title);
      //getting artist name

      $.post("includes/handlers/ajax/getArtistJson.php" , { artistId : track.artist }, function(data){
        var artist = JSON.parse(data);
        $('.trackInfo .artistName span').text(artist.name);
        $('.trackInfo .artistName span').attr("onclick","openPagePushState('artist.php?id="+ artist.id + "')");
      });

      //getting album artwork
      $.post("includes/handlers/ajax/getAlbumJson.php" , { albumId : track.album }, function(data){
        var album = JSON.parse(data);
        // console.log(album.artworkPath);
        $('.albumArtwork').attr("src", album.artworkPath);
        $('.albumArtwork').attr("onclick","openPagePushState('album.php?id="+ album.id + "')");
        $('.trackName span').attr("onclick","openPagePushState('album.php?id="+ album.id + "')");
      });
      audioElement.setTracks(track);
      //if play = true (play song)
      if(play == true){
        playSong();
      }
    });
  }

  function playSong(){
    if(audioElement.audio.currentTime == 0){
      // console.log(audioElement.currentlyPlaying.id);
      $.post("includes/handlers/ajax/updateSongPlays.php" , { songId : audioElement.currentlyPlaying.id });
    }
    //updating song plays

    $('.controlButton.play').hide();
    $('.controlButton.pause').show();
    audioElement.play();
  }
  function pauseSong(){
    $('.controlButton.play').show();
    $('.controlButton.pause').hide();
    audioElement.pause();
  }
  function prevSong(){
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0){
      audioElement.setTime(0);
    }else{
      currentIndex -- ;
      setTrack(currentPlaylist[currentIndex], currentPlaylist , true);
    }
  }
  function nextSong(){
    if(repeat){
      audioElement.setTime(0);
      playSong();
      return;
    }
    if(currentIndex == currentPlaylist.length - 1){
      currentIndex = 0;
    }else{
      currentIndex++ ;
    }
    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
  }

  function setRepeat(){
    repeat = !repeat;
    var imageName = repeat ? "repeat-active.png" : "repeat.png" ;
    $('.controlButton.repeat img').attr("src","assets/images/icons/"+imageName);
  }
  function setMute(){
    audioElement.audio.muted = !audioElement.audio.muted
    var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png" ;
    $('.controlButton.volume img').attr("src","assets/images/icons/"+imageName);
  }
  function setShuffle(){
    shuffle = !shuffle;
    var imageName = shuffle ? "shuffle-active.png" : "shuffle.png" ;
    $('.controlButton.shuffle img').attr("src","assets/images/icons/"+imageName);
    if(shuffle){
      //randomizePlayList
      shuffleArray(shufflePlaylist);
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    }else{
      //shuffle off
      //go back to regular playlist
      currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
  }
  function shuffleArray(a){
    var j, x, i;
    for(i = a.length; i; i--){
      j = Math.floor(Math.random() * i);
      x = a[i - 1];
      a[i - 1] = a[j];
      a[j] = x;
    }
  }
</script>

<div id="nowPlayingLeft">
  <div class="content">
    <span class="albumArt">
      <img  role="link" tabindex="0" class="albumArtwork" src="" alt="album artwork">
    </span>
    <div class="trackInfo">
      <span class="trackName">
        <span role="link" tabindex="0"><!-- TRACK-NAME --></span>
      </span>
      <span role="link" tabindex="0" class="artistName">
        <span><!-- ARTIST-NAME --></span>
      </span>
    </div>
  </div>
</div>


<div id="nowPlayingMiddle">
  <div class="content playerControls">
    <div class="buttons">
      <button onclick="setShuffle();" class="controlButton shuffle" title="shuffle" type="button" name="button">
        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
      </button>
      <button onclick="prevSong();" class="controlButton previous" title="previous song" type="button" name="button">
        <img src="assets/images/icons/previous.png" alt="Shuffle">
      </button>
      <button onclick="playSong()" class="controlButton play" title="play" type="button" name="button">
        <img src="assets/images/icons/play.png" alt="play">
      </button>
      <button onclick="pauseSong();" style="display:none;" class="controlButton pause" title="pause" type="button" name="button">
        <img src="assets/images/icons/pause.png" alt="pause">
      </button>
      <button onclick="nextSong();" class="controlButton next" title="next song" type="button" name="button">
        <img src="assets/images/icons/next.png" alt="next">
      </button>
      <button onclick="setRepeat();" class="controlButton repeat" title="repeat song" type="button" name="button">
        <img src="assets/images/icons/repeat.png" alt="repeat">
      </button>
    </div>
    <div class="playbackBar">
      <span class="progressTime current">0.00</span>
      <div class="progressBar">
        <div class="progressBarBG">
          <div class="progress"></div>
        </div>
      </div>
      <span class="progressTime remaining"></span>
    </div>
  </div>
</div>


<div id="nowPlayingRight">
  <div class="volumeBar">
    <button onclick="setMute();" class="controlButton volume" title="volume" type="button" name="button">
      <img src="assets/images/icons/volume.png" alt="volume">
    </button>
    <div class="progressBar">
      <div class="progressBarBG">
        <div class="progress"></div>
      </div>
    </div>
  </div>
</div>
