<?php include ("includes/includedFile.php"); ?>


<!-- Main Container -->
  <h1 class="pageHeadingBig">Your might also like</h1>
  <div class="gridViewContainer">
    <?php
      $albumQuery = mysqli_query($connect,"SELECT * FROM album ORDER BY RAND() LIMIT 10");
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
<!-- Main Container End -->