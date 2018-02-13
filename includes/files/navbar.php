<div id="navbarContainer">
  <nav class="navBar">
    <span onclick="openPagePushState('index.php')" role="link" tabindex="0" class="logo">
      <img src="assets/images/Layer.png" alt="lofi-logo">
    </span>
  </nav>
  <div class="group">
    <div class="navItem">
      <span onclick="openPagePushState('search.php')" role="link" tabindex="0" class="navItemLink">Search
       <img src="assets/images/icons/search.png" class="icon" alt="search">
      </span>
      <!-- <input class="searchHere" type="text" name="" id=""> -->
    </div>
  </div>
  <div class="group">
    <div class="navItem">
      <span onclick="openPagePushState('browse.php')" role="link" tabindex="0" class="navItemLink">Browse</span>
    </div>
    <div class="navItem">
      <span onclick="openPagePushState('music.php')" role="link" tabindex="0" class="navItemLink">Music</span>
    </div>
    <div class="navItem">
      <span onclick="openPagePushState('settings.php')" role="link" tabindex="0" class="navItemLink">
        <?php echo $username->getFirstAndLastName(); ?>

      </span>
    </div>
  </div>
</div>
