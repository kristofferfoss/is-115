<?php 
	include_once 'header.php';
	include_once 'dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	$sql = "SELECT * FROM users";
	$resultat = mysqli_query($conn, $sql);
	$medlemmerEpost = array();
	if (mysqli_num_rows($resultat) > 0) {
		while($row = mysqli_fetch_assoc($resultat)) {
			$datas[] = $row;
		}
	}
	foreach ($medlemmerEpost as $epostMedlemmer) {
		echo $epostMedlemmer['usersEmail']." ";
	}
?>
</body>
</html>

		// First we get the form data from the URL
		$activityDesc = ucfirst($_POST["activityDesc"]);
		$activityDate = $_POST["activityDate"];
		$activityPerson = ucfirst($_POST["activityPerson"]);
		$activityStart = $_POST["activityStart"];
		$activityEnd = $_POST["activityEnd"];
		$activityPlace = ucfirst($_POST["activityPlace"]);
		
		require_once "includes/dbh.inc.php";
		require_once 'includes/aktivitet.inc.php';
		
		addActivity($conn, $activityDesc, $activityDate, $activityPerson, $activityStart, $activityEnd, $activityPlace);
		echo "Aktivitet lagt til.";
		}
		else
		{
			echo "Fikk ikke lagt til aktivitet. Husk å legge dato i yyyy-mm-dd format og tid i hh-mm-ss format.";
		}
		?>
	</section>
</body>
<?php 
	include_once 'footer.php';
?>