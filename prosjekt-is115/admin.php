<?php 
	include_once 'header.php';
?>
<body> 
	<section class="signup-form">
		<form method="post">
			Aktivitetsnavn:<input type="text" name="activityDesc" placeholder="Aktivitetsnavn">
			Dato:<input type="date" name="activityDate" placeholder="Dato">
			Anvarlig:<input type="text" name="activityPerson" placeholder="Ansvarlig">
			Start tid: <input type="time" name="activityStart" placeholder="Start tid">
			Slutt tid: <input type="time" name="activityEnd" placeholder="Slutt tid">
			Sted:<input type="text" name="activityPlace" placeholder="Sted">
			<button type="submit" name="submit"> Legg til aktivitet </button>
		</form>
		<?php
		if (isset($_POST["submit"])) {

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