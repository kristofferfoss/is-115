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
  <p>Din profil</p>
</section>
  <div class="tab-panel">
    <section id="Informasjon" class="tab-panel">
      <?php
      if (!isset($_SESSION['useruid']))
      {
          header("Location: login.php");
      die();
      }
        require_once "includes/profil.inc.php";
        require_once "includes/dbh.inc.php";
        displayInfo($conn);
      ?>
    </section>
  </div>
<section> 
 <button onclick="location.href='endreProfil.php'">Rediger profilinfo</button>
</section>
</body>
<?php
  include_once 'footer.php';
?>
