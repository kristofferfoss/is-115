<?php
  include_once 'header.php';
  require_once 'includes/profil.inc.php';
  require_once 'includes/dbh.inc.php';
?>

<section class="profil-intro">
  <h1>~ Neo Ungdomsklubb ~</h1>
  <p>Din profil</p>
</section>

<section class="profilboks">
<td> Name: 
<?php

  displayInfo($conn);
  echo $_SESSION["name"];
  
?>
<br> </td>
<td> Email: 
<?php

  displayInfo($conn);
  echo $_SESSION["email"];
?>
<br></td>
<td> User ID: <br></td>


</section>

<?php
  include_once 'footer.php';
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
?>
