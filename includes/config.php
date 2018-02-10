<?php
  //started output buffering
  ob_start();
  session_start();
  //setting default timezone
  $timeZone = date_default_timezone_set("Asia/Kolkata");
  //connect for connecting to databse
  $connect = mysqli_connect("localhost","root","","lofi");
  if(mysqli_connect_errno()){
    echo "Connection Failed";
  }
?>
