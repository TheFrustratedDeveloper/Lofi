<?php
  class Accounts{
    private $connect;
    private $errorArray;

    public function __construct($connect){
      //constructor for accounts class (called as soon as object init)
      $this->connect = $connect;
      $this->errorArray = array();
    }
    public function registerUser($fName,$lName,$email,$confirmEmail,$username,$pass,$confirmPass){
        //taking every single user value as parameter
        $this->validateName($fName); //validate first name
        $this->validateName($lName); //validate last name
        $this->validateEmail($email,$confirmEmail); //validate emails
        $this->validateUsername($username); //validate username
        $this->validatePass($pass,$confirmPass); //validate passwords

        if(empty($this->errorArray)){   //if errorArry if empty that means every validations is passed
          //inserting into database -table (users)
          return $this->insertDetails($fName,$lName,$username,$email,$pass);
        }else{
          return false;
        }
    }
    public function loginUser($username,$password){
      $password = md5($password);
      $query = mysqli_query($this->connect,"SELECT * FROM users WHERE username = '$username' AND password = '$password'");
      if(mysqli_num_rows($query) == 1){
        return true;
      }else{
        array_push($this->errorArray,Constant::$loginFailed);
        return false;
      }
    }
    //displaying error messages
    public function error($error){
      if(!in_array($error,$this->errorArray)){
        $error = "";
      }
      return "<span class='errorMessage'>$error</span>";
    }
    //insert User Details
    private function insertDetails($firstName,$lastName,$username,$email,$password){
      // TODO: make password more secure via encrypting with bcrypt
      $password = md5($password);
      $profile = "assets/images/profile/boy.png"; //settings as a default image for every registered user
      $date = date("Y-m-d"); //set the date format
      $query = "INSERT INTO users VALUES('','$username','$firstName','$lastName','$email','$password','$date','$profile')";
      return mysqli_query($this->connect,$query);
    }

    //register validations
    private function validateName($name){
      //used for both first and last name
      if(empty($name)){
        array_push($this->errorArray,Constant::$emptyName);
        return;
      }
      if(strlen($name) > 25 || strlen($name) < 3){
        array_push($this->errorArray,Constant::$nameLength);
        return;
      }
    }
    private function validateEmail($email,$confirmEmail){
      //used to chk validation as well as duplicate emails from db
      if(empty($email) || empty($confirmEmail)){
        array_push($this->errorArray,Constant::$emptyEmail);
        return;
      }
      if($email != $confirmEmail){
        array_push($this->errorArray,Constant::$confirmEmail);
        return;
      }
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($this->errorArray,Constant::$invalidEmail);
        return;
      }
      $query = mysqli_query($this->connect,"SELECT email FROM users WHERE email = '$email'");
      if(mysqli_num_rows($query) != 0 ){
        array_push($this->errorArray,Constant::$duplicateEmail);
        return;
      }

    }

    private function validateUsername($username){
      //used to validate duplicate username
      if(empty($username)){
        array_push($this->errorArray,Constant::$emptyUsername);
        return;
      }
      if(strlen($username) >= 25 || strlen($username) <= 3){
        array_push($this->errorArray,Constant::$usernameLength); //add this string into errorArray
        return; //return from function if any error occours
      }
      $query = mysqli_query($this->connect,"SELECT username FROM users WHERE username = '$username'");
      if(mysqli_num_rows($query) != 0 ){
        array_push($this->errorArray,Constant::$duplicateUsername);
        return;
      }
    }

    private function validatePass($pass,$confirmPass){
      //used to encrypt and validate both passwords
      if(empty($pass) || empty($confirmPass)){
        array_push($this->errorArray,Constant::$emptyPasswords);
        return;
      }
      if($pass != $confirmPass){
        array_push($this->errorArray,Constant::$confirmPassword);
        return;
      }
      if(strlen($pass) < 6){
        array_push($this->errorArray,Constant::$passwordLength);
        return;
      }
    }
//Account class end
  }
?>
