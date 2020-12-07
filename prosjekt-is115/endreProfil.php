<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h3>Redigering</h3>
  <br>
  <h4> Endre én verdi om gangen. </h4>
  <br>
  <div>
    <form action="includes/profil.inc.php" method="post">
      Fornavn:<input type="text" name="firstname" placeholder="Nytt Fornavn">
      <button type="submit" name="editFirstname" value="editFirstname">Endre Fornavn</button>
    </form>
    <form action="includes/profil.inc.php" method="post">
      Etternavn:<input type="text" name="lastname" placeholder="Nytt Etternavn">
      <button type="submit" name="editLastname" value="editLastname">Endre Etternavn</button>
    </form>
    <form action="includes/profil.inc.php" method="post">
      Epost:<input type="text" name="email" placeholder="Ny Epost Adresse">
      <button type="submit" name="editEmail" value="editEmail">Endre Epost Adresse</button>
    </form>
    <form action="includes/profil.inc.php" method="post">
      Mobilnummer:<input type="text" name="phone" placeholder="Nytt Mobilnummer">
      <button type="submit" name="editPhone" value="editPhone">Endre Mobilnummer</button>
    </form>
    <form action="includes/profil.inc.php" method="post">
      Adresse:<input type="text" name="address" placeholder="Ny Adresse">
      <button type="submit" name="editAddress" value="editAddress">Endre Adresse</button>
    </form>
    <form action="includes/profil.inc.php" method="post">
      Postnummer:<input type="text" name="postno" placeholder="Nytt Postnummer">
      <button type="submit" name="editPostno" value="editPostno">Endre Postnummer</button>
    </form>
    <form action="includes/profil.inc.php" method="post">
      Poststed:<input type="text" name="postplace" placeholder="Nytt Poststed">
      <button type="submit" name="editPostplace" value="editPostplace">Endre Poststed</button>
    </form>
    <form action="includes/profil.inc.php" method="post">
      Kjønn:<input type="text" name="kjonn" placeholder="Nytt Kjønn">
      <button type="submit" name="editKjonn" value="editKjonn">Endre Kjønn</button>
    </form>
  </div>
</section>

<?php
  include_once 'footer.php';
?>