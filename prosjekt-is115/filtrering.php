<?php
include 'header.php';
$mysqli = mysqli_connect('localhost', 'root', '', 'phpproject01');

// For en ekstra trygghet mot SQL-injections, følgende er kolonner en kan sortere etter:
$columns = array('usersUid','usersRegdate','usersLastname','userInterests');

// Henter kun kolonnen hvis den er i kolonne arrayet ovenfor, hvis den ikke eksisterer vil database tabellen sorteres etter første verdi i kolonne arrayet. 
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Hente sorteringsmetode, ascending eller descending, asc er default.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $mysqli->query('SELECT * FROM users ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Variabler som vi trenger for tabellen.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
if (!isset($_SESSION['useruid']))
{
    header("Location: login.php");
    die();
}
	?>
	<section class="filtrering">
	<!DOCTYPE html>
	<html>
		<head>
			<title>Sortering av medlemmer</title>
			<meta charset="utf-8">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
			<h3>Vennligst velg hvilken kolonne du ønsker å sortere etter.</h3><br>
			<style>
			h3 {
				text-align: center;
			}
			html {
				font-family: Tahoma, Geneva, sans-serif;
				padding: 10px;
			}
			table {
				border-collapse: collapse;
				width: 100%;
			}
			th {
				background-color: #54585d;
				border: 1px solid #54585d;
				text-align: center;
			}
			th:hover {
				background-color: #64686e;
			}
			th a {
				display: block;
				text-decoration:none;
				padding: 10px;
				color: #ffffff;
				font-weight: bold;
				font-size: 13px;
			}
			th a i {
				margin-left: 5px;
				color: rgba(255,255,255,0.4);
			}
			td {
				padding: 10px;
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr {
				background-color: #ffffff;
			}
			tr .highlight {
				background-color: #f9fafb;
			}
			</style>
		</head>
		<body>
			<table>
				<tr>
					<th><a href="filtrering.php?column=usersUid&order=<?php echo $asc_or_desc; ?>">Brukernavn<i class="fas fa-sort<?php echo $column == 'usersUid' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="filtrering.php?column=usersLastname&order=<?php echo $asc_or_desc; ?>">Etternavn<i class="fas fa-sort<?php echo $column == 'usersLastname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="filtrering.php?column=usersRegdate&order=<?php echo $asc_or_desc; ?>">Medlem siden<i class="fas fa-sort<?php echo $column == 'usersRegdate' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="filtrering.php?column=userInterests&order=<?php echo $asc_or_desc; ?>">Interesser<i class="fas fa-sort<?php echo $column == 'userInterests' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'usersUid' ? $add_class : ''; ?>><?php echo $row['usersUid']; ?></td>
					<td<?php echo $column == 'usersLastname' ? $add_class : ''; ?>><?php echo $row['usersLastname']; ?></td>
					<td<?php echo $column == 'usersRegdate' ? $add_class : ''; ?>><?php echo $row['usersRegdate']; ?></td>
					<td<?php echo $column == 'userInterests' ? $add_class : ''; ?>><?php echo $row['userInterests']; ?></td>
				</tr>
				<?php endwhile; ?>
			</table>
			<br><button style="background-color: #E1E1E1;" onclick="location.href='medlemmer.php'">Tilbake</button>
		</body>
	</html>
</section>
	<?php
	$result->free();
}
include 'footer.php';
?>