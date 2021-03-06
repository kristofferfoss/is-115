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
<button style="background-color: #E1E1E1;" onclick="location.href='filtrering.php'">Sorter etter..</button>
<table>
	<tr>
		<th>Brukernavn</th>
		<th>Medlem siden</th>
		<th>Epost</th>
		<th>Kjønn</th>
	</tr>
<?php 
//prevents people from entering without loging in 
if (!isset($_SESSION['useruid']))
{
    header("Location: login.php");
    die();
}

$conn = mysqli_connect("localhost", "root", "", "phpproject01");

//error if you cannot connect to database
if ($conn-> connect_error) 
{
    die("Connection failed. ". $conn-> connect_error);
}
//retrieves all information about users
$sql = "SELECT * FROM users";

$resultat = $conn-> query($sql);

if ($resultat-> num_rows > 0) 
{
    while ($row = $resultat-> fetch_assoc()) 
    {
        //prints specified rows into table
        echo "<tr><td>". $row['usersUid'] . "</td><td>". $row['usersRegdate'] . "</td><td>". $row['usersEmail'] . "</td><td>". $row['usersGender']. "</td></tr>";
    }
    echo "</table>";
}
else 
{
    echo "Det er ingen medlemmer ennå.";
}

$conn-> close(); 
?>
</body>
</html>
</section>
<?php
  include_once 'footer.php';
?>