<?php
// if login button is pressed
    if(isset($_POST['login'])){
        //getting value from login form
        $username = sanitizeUserName($_POST['loginUsername']);
        $password = sanitizePass($_POST['loginPass']);

        $login = $user->loginUser($username,$password);
        if($login){
          $_SESSION['userLoggedIn'] = $username;
          header("Location:index.php");
        }
    }

?>
