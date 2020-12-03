<?php
  include_once 'header.php';
  require_once 'includes/profil.inc.php';
  require_once 'includes/dbh.inc.php';
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<section class="profil-intro">
  <h1>~ Neo Ungdomsklubb ~</h1>
  <p>Din profil</p>
</section>
<div class="tab-panel">
  <section id="Informasjon" class="tab-panel">
    <?php
      require_once "includes/profil.inc.php";
      require_once "includes/dbh.inc.php";
      displayInfo($conn);
    ?>
  </section>
</div>
<?php
  include_once 'footer.php';
?>
