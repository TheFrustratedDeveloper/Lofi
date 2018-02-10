<?php
//sanitize functions
function sanitizeUserName($username){
    $username = strip_tags($username); //stripTags to remove any HTML tags from input
    $username = str_replace(" ","",$username); //str_replace to remove any void spaced from username
    return $username;
}
function sanitizeName($name){
    $name = sanitizeUserName($name); //as both lines are actually the same
    $name = strtolower($name);       //string to lower characters
    $name = ucfirst($name);          //making first character upper
    return $name;
}
function sanitizePass($pass){
  return strip_tags($pass);          //return sanitized password
}

function getInputValue($fieldName){
    if(isset($_POST[$fieldName])){
      echo $_POST[$fieldName];
    }
}


?>
