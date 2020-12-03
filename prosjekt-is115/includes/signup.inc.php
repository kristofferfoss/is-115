<?php

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $firstname = ucfirst($_POST["firstname"]);
  $lastname = ucfirst($_POST["lastname"]);
  $email = $_POST["email"];
  $mobilnummer = $_POST["mobilnummer"];
  $adresse = $_POST["address"];
  $postno = $_POST["postno"];
  $poststed = $_POST["poststed"];
  $regdato = date('Y-m-d');
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];
  $fødselsdato = $_POST["dob"];
  $kjønn = ucfirst($_POST["kjønn"]);

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputSignup($firstname, $lastname, $email, $mobilnummer, $adresse, $postno, $poststed, $username, $fødselsdato, $pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  // Proper username chosen
  if (invalidUid($uid) !== false) {
    header("location: ../signup.php?error=invaliduid");
    exit();
  }
  // Wrong Postnumber
  if (invalidPostno($postno) !== false) {
    header("location: ../signup.php?error=invalidpostno");
    exit();
  }
  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: ../signup.php?error=invalidemail");
    exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }
  // Is the username taken already
  if (uidExists($conn, $username) !== false) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $firstname, $lastname, $email, $mobilnummer, $adresse, $postno, $poststed, $regdato, $username, $fødselsdato, $kjønn, $pwd);

} else {
  header("location: ../signup.php");
    exit();
}
