<?php
  include_once 'header.php';
?>
<section class="medlem-tabell">
<!DOCTYPE html>
<html>
<head>
	<title>Medlemmer</title>
	<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Medlemsliste</h2>
<table>
	<tr>
		<th>Brukernavn</th>
		<th>Medlem siden</th>
		<th>Epost</th>
		<th>Kjønn</th>
	</tr>
<?php 
if (!isset($_SESSION['useruid']))
{
    header("Location: login.php");
    die();
}
$conn = mysqli_connect("localhost", "root", "", "phpproject01");
if ($conn-> connect_error) {
    die("Connection failed. ". $conn-> connect_error);
}
$sql = "SELECT * FROM users";
$resultat = $conn-> query($sql);

if ($resultat-> num_rows > 0) {
    while ($row = $resultat-> fetch_assoc()) {
        echo "<tr><td>". $row['usersUid'] . "</td><td>". $row['usersRegdate'] . "</td><td>". $row['usersEmail'] . "</td><td>". $row['usersKjonn']. "</td></tr>";
    }
    echo "</table>";
}
else {
    echo "Det er ingen medlemmer ennå.";
}
$conn-> close(); 
?>
</table>
</body>
</html>
</section>
<?php
  include_once 'footer.php';
?>