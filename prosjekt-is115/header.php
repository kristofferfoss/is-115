<?php
  session_start();
  include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Neo Ungdomsklubb</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <!--A quick navigation-->
    <nav>
      <div class="wrapper">
        <a href="index.php"><img src="img/neo.png" alt="Neo"></a>

        <ul>
          <li><a href="index.php">Hjem</a></li>
          <?php
            if (isset($_SESSION["useruid"])) {
              echo "<li><a href='admin.php'>Admin</a></li>";
              echo "<li><a href='medlemmer.php'>Medlemmer</a></li>";
              echo "<li><a href='profil.php'>Din Profil</a></li>";
              echo "<li><a href='aktivitet.php'>Aktiviteter</a></li>";
              echo "<li><a href='logout.php'>Logg Ut</a></li>";
            }
            else {
              echo "<li><a href='signup.php'>Registrer</a></li>";
              echo "<li><a href='login.php'>Logg inn</a></li>";
            }
          ?>
        </ul>
      </div>
    </nav>

<!--A quick wrapper to align the content (ends in footer.php)-->
<div class="wrapper">
