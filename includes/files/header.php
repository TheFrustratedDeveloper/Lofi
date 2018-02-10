<!DOCTYPE html>
<?php
require_once('includes/config.php');
require_once('includes/classes/User.php');
require_once('includes/classes/Artist.php');
require_once('includes/classes/Album.php');
require_once('includes/classes/Song.php');
require_once('includes/classes/Playlist.php');

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome to LO-FI</title>
  <!-- custom css file -->
  <link rel="stylesheet" href="assets/css/index.css">
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="assets/js/script.js"></script>
  <?php
  if(isset($_SESSION['userLoggedIn'])){
    $username = new User($connect,$_SESSION['userLoggedIn']);
    $userFirstAndLastName = $username->getUsername();
    $usernameEmail = $username->getEmail();
    echo "<script>userLoggedIn = '$userFirstAndLastName'</script>";
  }else{
    header("Location:register.php");
  }
  ?>
</head>
<body>
  <div id="mainContainer">
    <div id="topContainer">
      <!-- contains navbar and main container -->
      <!-- navigation bar -->
      <?php include("includes/files/navbar.php"); ?>
      <!-- main container -->
      <div id="mainViewContainer">
        <div id="mainContent">
