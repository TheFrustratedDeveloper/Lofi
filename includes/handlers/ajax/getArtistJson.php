<?php
require_once("../../config.php");
if(isset($_POST['artistId'])){
  $artistId = $_POST['artistId'];

  $query = mysqli_query($connect,"SELECT * FROM artist WHERE id = $artistId");
  $resultArray = mysqli_fetch_array($query);

  echo json_encode($resultArray);
}
?>
