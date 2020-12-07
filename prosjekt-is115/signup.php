<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Registrering</h2>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      Fornavn:<input type="text" name="firstname" placeholder="Fornavn">
      Etternavn:<input type="text" name="lastname" placeholder="Etternavn">
      Epost:<input type="text" name="email" placeholder="E-post">
      Mobilnummer: <input type="number" name="phonenumber" placeholder="Mobilnummer">
      Adresse:<input type="text" name="address" placeholder="Adresse">
      Postnummer: <input type="number" name="postno" placeholder="Postnummer">
      Poststed:<input type="text" name="postplace" placeholder="Poststed">
      Brukernavn:<input type="text" name="uid" placeholder="Brukernavn">
      Fødselsdato:<input type="date" name="dob" required>
      Kjønn:<br><select name="gender" id="gender" required>
        <option value="Mann">Mann</option>
        <option value="Dame">Dame</option>
        <option value="Annet">Annet</option>
      </select><br>
      Passord:<input type="password" name="pwd" placeholder="Passord">
      Gjenta passord:<input type="password" name="pwdrepeat" placeholder="Gjenta passord">
      <button type="submit" name="submit">Registrer deg</button>
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
      else if ($_GET["error"] == "invalidpostno") {
        echo "<p>Velg et ordentlig postnummer! (4 sifre)</p>";
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
