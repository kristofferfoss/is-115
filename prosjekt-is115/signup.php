<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Registrer</h2>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="name" placeholder="Fullt navn">
      <input type="text" name="email" placeholder="E-post">
      <input type="text" name="uid" placeholder="Brukernavn">
      <input type="password" name="pwd" placeholder="Passord">
      <input type="password" name="pwdrepeat" placeholder="Gjenta passord">
      <button type="submit" name="submit">Registrer</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fyll inn alle felt!</p>";
      }
      else if ($_GET["error"] == "invaliduid") {
        echo "<p>Velg et ordentlig brukernavn!</p>";
      }
      else if ($_GET["error"] == "invalidemail") {
        echo "<p>Velg en ordentlig E-post!</p>";
      }
      else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Passordene er ikke like!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Noe gikk galt!</p>";
      }
      else if ($_GET["error"] == "usernametaken") {
        echo "<p>Brukernavn tatt!</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>Du har registrert deg!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
