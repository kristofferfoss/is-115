<?php

if (isset($_POST["submit"])) 
{
  // First we get the form data from the login.php
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  // Then we run an error handler to catch user mistakes
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty, triggers feedback to users 
  if (emptyInputLogin($username, $pwd) === true) 
  {
    header("location: ../login.php?error=emptyinput");
    exit();
  }
  // If we get to here, it means there are no user errors
  // Now we insert the user into the database
  loginUser($conn, $username, $pwd);

} 
else 
{
  header("location: ../login.php");
  exit();
}
?>