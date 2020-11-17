<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Logg Inn</h2>
  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
      <input type="text" name="uid" placeholder="Brukernavn/E-post">
      <input type="password" name="pwd" placeholder="Passord">
      <button type="submit" name="submit">Logg Inn</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fyll inn alle felt!</p>";
      }
      else if ($_GET["error"] == "wronglogin") {
        echo "<p>Feil brukernavn/passord!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
