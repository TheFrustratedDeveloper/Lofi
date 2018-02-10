var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

$(document).click(function(click){
  var target = $(click.target);
  if(!target.hasClass("optionButton") && !target.hasClass("item")){
    hideOptionsMenu();
  }
});

$(window).scroll(function(){
  hideOptionsMenu();
});

$(document).on("change","select.playlist",function(){
  var select = $(this);
  var playlistId = select.val();
  var songId = select.prev(".songId").val();
  $.post("includes/handlers/ajax/addToPlaylist.php", { playlistId : playlistId , songId : songId}).
  done(function(error){
      if(error!=""){
        alert(error);
        return;
      }
    hideOptionsMenu();
    select.val("");
  });
});

// ______________________________________________

window.addEventListener("popstate", function() {
  var url = location.href;
  openPage(url);
})

function openPage(url){
  if(timer != null){
    clearTimeout(timer);
  }
  if(url.indexOf('?') == -1){
    url = url + "?";
  }
  var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
  $('#mainContent').load(encodedUrl);
  $('body').scrollTop(0);
}

function openPagePushState(url) {
  openPage(url);
  history.pushState(null, null, url);
}

// ______________________________________________

function createPlaylist(){
  var popUp = prompt("Please enter the name for your playlist");
  if(popUp != null){
    $.post("includes/handlers/ajax/createPlaylist.php",{ name : popUp , user : userLoggedIn}).done(function(error){
      if(error!=""){
        alert(error);
        return;
      }
      openPagePushState("music.php");
    });
  }
}

function deletePlaylist(playlistId){
  var confirmDelete = confirm("Are you sure you want to delete this playlist");
  if(confirmDelete){
    $.post("includes/handlers/ajax/deletePlaylist.php",{playlistId : playlistId}).done(function(error){
      if(error!=""){
        alert(error);
        return;
      }
      openPagePushState("music.php");
    });
  }
}

function removeFromPlaylist(button,playlistId){
  var songId = $(button).prevAll(".songId").val();

  $.post("includes/handlers/ajax/removeFromPlaylist.php",{playlistId : playlistId , songId : songId}).done(function(error){
    if(error!=""){
      alert(error);
      return;
    }
    openPagePushState("playlist.php?id="+playlistId);
  });
}

function formatTime(seconds){
  var time = Math.round(seconds);
  var min = Math.floor(time / 60);
  var seconds = time - (min * 60);
  var extraZero = (seconds < 10) ? "0" : "";
  return min + ":" +extraZero + seconds;
}

function playFirstSong(){
  setTrack(tempPlaylist[0],tempPlaylist , true);
}

function updateTimeProgressBar(audio){
  $('.progressTime.current').text(formatTime(audio.currentTime));
  $('.progressTime.remaining').text(formatTime(audio.duration-audio.currentTime));

  var progress = audio.currentTime / audio.duration * 100 ;
  $('.playbackBar .progress').css("width",progress + "%");
}

function updateVolumeProgressBar(audio){

  var volume = audio.volume * 100 ;
  $('.volumeBar .progress').css("width",volume + "%");
}

function hideOptionsMenu(){
  var menu = $('.optionsMenu');
  if(menu.css("display") != "none"){
    menu.css("display","none");
  }
}

function showOptionsMenu(button){
  var songId = $(button).prevAll(".songId").val();

  var menu = $('.optionsMenu');
  var menuWidth = menu.width();
  menu.find(".songId").val(songId);
  var scrollTop = $(window).scrollTop(); //distance from top of window to top of document
  var elementOffset = $(button).offset().top; //distance from top of doc.
  var top = elementOffset - scrollTop;
  var left = $(button).position().left;

  menu.css({
    "top"  : top  + "px",
    "left" : left -menuWidth + "px",
    "display" : "inline"
  });
}

function updateEmail(emailClass){
  var emailValue =$('.'+emailClass).val();
  $.post("includes/handlers/ajax/updateEmail.php",{email : emailValue , username : userLoggedIn}).done(function(response){
    $('.'+emailClass).nextAll(".message").text(response);
  });
}

function updatePassword(oldPasswordClass,newPasswordClass,confirmPasswordClass){
  var oldPassword =$("."+oldPasswordClass).val();
  var newPassword =$("."+newPasswordClass).val();
  var confirmPassword =$("."+confirmPasswordClass).val();
  $.post("includes/handlers/ajax/updatePassword.php",{ oldPassword : oldPassword , newPassword : newPassword , confirmPassword : confirmPassword , username : userLoggedIn }).done(function(response){
    $("."+confirmPasswordClass).nextAll(".message").text(response);
  });
}

function logout(){
  $.post("includes/handlers/ajax/logout.php",function(){
    location.reload();
  });
}

//AUDIO CLASS 

function Audio(){
  //creating Audio class in javascript
  this.currentlyPlaying;
  this.audio = document.createElement('audio');
  //audio is prebuilt property
  //making function
  this.audio.addEventListener("canplay",function(){
    //this refers to object that the event was called on
    var duration = formatTime(this.duration);
    $('.progressTime.remaining').text(duration);
  });
  this.audio.addEventListener("ended",function(){
    nextSong();
  })
  this.audio.addEventListener("timeupdate",function(){
    if(this.duration){
      updateTimeProgressBar(this);
    }
  });
  this.audio.addEventListener("volumechange",function(){
    updateVolumeProgressBar(this);
  })
  this.setTracks = function(track){
    this.currentlyPlaying = track;
    //setting current playing as track object
    this.audio.src = track.path;
    // setting audio src = src
  }
  this.play = function(){
    this.audio.play();
  }
  this.pause = function(){
    this.audio.pause();
  }
  this.setTime = function(seconds){
    this.audio.currentTime = seconds;
  }
}

