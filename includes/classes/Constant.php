<?php
 class Constant{
              //no constructor just some static public variables to store strings
          //First and Last Name
   public static $emptyName = "Name cannot be empty";
   public static $nameLength = "Name must be between 3 and 25 characters";

          //EMAILS
   public static $emptyEmail = "Email cannot be Empty";
   public static $invalidEmail = "Your Email is Invalid";
   public static $confirmEmail = "Both Emails does not match";
   public static $duplicateEmail = "Duplicate Email Found. Please Login with your email";
   //TODO: set a link for login with email with this error

          //USERNAME
   public static $emptyUsername = "Username cannot be empty";
   public static $usernameLength = "Username Must be between 3 and 25 characters";
   public static $duplicateUsername = "Username is already taken. Please choose different Username";

          //PASSWORDS
   public static $emptyPasswords = "Passwords cannot be empty";
   public static $passwordLength = "Passwords must be more than 6 characters";
   public static $confirmPassword = "Both Passwords does not match";


          //loginFailed
   public static $loginFailed = "Your Username or Password is incorrect";
 }
?>
