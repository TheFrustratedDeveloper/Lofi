<?php
// if register button is pressed
    if(isset($_POST['register'])){
        // getting values from register form
        $fName = sanitizeName($_POST['regFirstName']);
        $lName = sanitizeName($_POST['regLastName']);
        $email = sanitizeUserName($_POST['regEmail']);
        $confirmEmail = sanitizeUserName($_POST['regConfirmEmail']);
        $username = sanitizeUserName($_POST['regUsername']);
        $pass = sanitizePass($_POST['regPass']);
        $confirmPass = sanitizePass($_POST['regConfirmPass']);

        $isRegister = $user->registerUser($fName,$lName,$email,$confirmEmail,$username,$pass,$confirmPass);
        if($isRegister){ //return true or false
          //if its true we are gonna to set some sessions
          $_SESSION['userLoggedIn'] = $username;
          //redirecting user to index.php if register sucessfully
          header("Location:index.php");
        }
    }




?>
