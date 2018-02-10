<!DOCTYPE html>
<?php
  include ("includes/init.php");
      $user = new Accounts($connect); //init user as object of Account class
if(isset($_SESSION['userLoggedIn'])){
  header("Location:index.php");
  exit();
}
  include ("includes/handlers/loginHandler.php");
  include ("includes/handlers/registerHandler.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to LoFi</title>
    <!-- custom register.css file -->
    <link rel="stylesheet" href="assets/css/register.css">
    <!-- jQuery file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- fontawesome css file -->
    <!-- custom register.js file -->
    <script src="assets/js/register.js"></script>
</head>
<body>
<?php
  if(isset($_POST['register'])){
    echo '<script>
          $(document).ready(function(){ //start execute as soon as document is ready
            $("#loginForm").hide();  //hide the login form
            $("#regForm").show(); //shows register form
          });
        </script>';
  }else{
    echo '<script>
      $(document).ready(function(){ //start execute as soon as document is ready
          $("#loginForm").show();  //hide the login form
          $("#regForm").hide(); //shows register form
      });
    </script>';
  }
?>


  <div id="background">
    <div id="container">
<!-- loginform -->
    <div id="inputContainer">
        <form action="register.php" id="loginForm" method="post" autocomplete="on">
            <h2>Login to your account</h2>
            <!-- LoginUsername -->
<?php echo $user->error(Constant::$loginFailed); ?>
            <p><label for="loginUsername">Username</label>
            <input required type="text" name="loginUsername" id="loginUsername" placeholder="e.g dhruvSaxena" value="<?php getInputValue('loginUsername'); ?>"></p>
            <!-- login Password -->
            <p><label for="loginPass">Password</label>
            <input required type="password" name="loginPass" id="loginPass"></p>
            <input type="submit" name="login" value="Login">

            <div class="hasAccountText">
              <span id="hideLogin">Don't have an account yet ? Signup here</span>
            </div>
        </form>
<!-- registerform -->
        <form action="register.php" id="regForm" method="post" autocomplete="on">
            <h2>Create your free account</h2>
            <!-- first name -->
<?php echo $user->error(Constant::$emptyName); ?>
<?php echo $user->error(Constant::$nameLength); ?>
            <p><label for="regFirstName">First Name</label>
            <input required type="text" name="regFirstName" id="regFirstName" placeholder="Your First Name" value="<?php getInputValue('regFirstName'); ?>"></p>
            <!-- last name -->
            <p><label for="regLastName">Last Name</label>
            <input required type="text" name="regLastName" id="regLastName" placeholder="Your Last Name" value="<?php getInputValue('regLastName'); ?>"></p>
            <!-- Username -->
<?php echo $user->error(Constant::$emptyUsername); ?>
<?php echo $user->error(Constant::$usernameLength); ?>
<?php echo $user->error(Constant::$duplicateUsername); ?>
            <p><label for="regUsername">Username</label>
            <input required type="text" name="regUsername" id="regUsername" placeholder="e.g dhruvSaxena" value="<?php getInputValue('regUsername');?>"></p>
            <!-- Email -->
<?php echo $user->error(Constant::$emptyEmail); ?>
<?php echo $user->error(Constant::$confirmEmail); ?>
<?php echo $user->error(Constant::$invalidEmail); ?>
<?php echo $user->error(Constant::$duplicateEmail); ?>
            <p><label for="regEmail">Email</label>
            <input required type="email" name="regEmail" id="regEmail" placeholder="someone@example.com" value="<?php getInputValue('regEmail'); ?>"></p>
            <!-- confirmEmail -->
            <p><label for="regConfirmEmail">Confirm Email</label>
            <input required type="email" name="regConfirmEmail" id="regConfirmEmail" placeholder="someone@example.com"></p>
            <!-- password -->
<?php echo $user->error(Constant::$emptyPasswords); ?>
<?php echo $user->error(Constant::$confirmPassword); ?>
<?php echo $user->error(Constant::$passwordLength); ?>
            <p><label for="regPass">Password</label>
            <input required type="password" name="regPass" id="regPass"></p>
            <!-- confirmPassword -->
            <p><label for="regConfirmPass">Confirm Password</label>
            <input required type="password" name="regConfirmPass" id="regConfirmPass"></p>

            <input type="submit" name="register" value="Register">
            <div class="hasAccountText">
              <span id="hideRegister">Already have an account ? Login here</span>
            </div>
        </form>
    </div>
    <div class="inputText">
      <h1>Get great music, <br>right now</h1>
      <h2>Loads of songs available in gallery for free</h2>
      <ul>
        <li><img src="assets/images/icons/checkmark.png" alt="checkmark">Discover music you'll fall in love with</li>
        <li><img src="assets/images/icons/checkmark.png" alt="checkmark">Create and Share your own playlists</li>
        <li><img src="assets/images/icons/checkmark.png" alt="checkmark">Follow Artists and Members and be up to date</li>
      </ul>
    </div>
  </div>
  </div>
</body>
</html>
