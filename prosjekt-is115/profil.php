<?php
  include_once 'header.php';
  require_once 'includes/profil.inc.php';
  require_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
<body>
<section class="profil-intro">
  <h1>~ Neo Ungdomsklubb ~</h1>
  <h3>Din profil</h3>
</section>
<div class="tab-panel">
  <section id="Informasjon" class="tab-panel">
    <?php
    //checks for an active session
    if (!isset($_SESSION['useruid']))
    {
        //sends user to login if no active session exists
        header("Location: login.php");
        die();
    }
    //displays information from database through profil.inc.php
    echo "<h3><center> Medlemsinformasjon </center><h3> <br>";
    require_once "includes/profil.inc.php";
    require_once "includes/dbh.inc.php";
    displayInfo($conn);
    ?>
  </section>
</div>
<div class="tab-panel">
  <section id="Informasjon" class="tab-panel">
    <center> <button onclick="location.href='endreProfil.php'">Rediger profilinfo</button></center>
    <?php
    if (!isset($_SESSION['useruid']))
    {
        header("Location: login.php");
    die();
    }

      //uses more funtions from profil.inc.php to print all information
      echo "--------------------------------------------------------------------------------------------------------------------------------------------------------------";
      echo "<h3><center> Ytterligere Informasjon </center><h3> <br>";
      require_once "includes/profil.inc.php";
      require_once "includes/dbh.inc.php";
      //displays kontigent and interests
      displayMoreInfo($conn);
      echo "<br>";
      echo "--------------------------------------------------------------------------------------------------------------------------------------------------------------";
      echo "<h3><center> Aktivitetshistorikk </center><h3> <br>";
      require_once "includes/profil.inc.php";
      require_once "includes/dbh.inc.php";
      //displays activities
      displayActivityHistory($conn);
    ?>
  </section>
</div>
</body>
<?php
  include_once 'footer.php';
?>
