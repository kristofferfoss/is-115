<?php 
	include_once 'header.php';
	include_once 'includes/dbh.inc.php';

	if ($_SESSION['user_level'] !== 1)
{
    header("Location: nicetry.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body> 
	<section class="mailToUsers">
		<style>

			.mailToUsers button {
				float: left;
				background-color: white;
				color: black;
				border: 3px solid red;
				border-radius: 12px;
				cursor: pointer;
				margin-top: 0px;
				transition-duration: 0.4s;
			}
			.mailToUsers button:hover {
				background-color: red;
				color: white;
			}
			.contigentReminder h3 {
				margin-top: 20px;
				text-align: left;
			}
		</style> 	
		<form action="" method="POST">
			<h3 style='text-align: left;'>Contigent reminder:</h3><br>
			<button type="submit" name="sendMail">Send mail</button>
		</form>
<?php
	if (isset($_POST['sendMail'])) {
	echo "<br><h4 style='text-align: left; margin-top: 25px;'>Mail regarding contigent has been sent to users.</h4>";
	$mysqli = mysqli_connect('localhost', 'root', '', 'phpproject01');
	$sql = "SELECT * FROM users WHERE userKontigent = 0";
	include'includes/dbh.inc.php';
	error_reporting(0);
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$result = mysqli_query($conn, $sql);
	$usersEmail = array();
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$usersEmail[] = $row;
		}
	}

	foreach ($usersEmail as $emailUsers) {
		echo $emailUsers['usersEmail'].", ";

		$to = implode(",", $emailUsers);;
		$subject = 'Contigent status: unpaid';
		$message = 'Dear user,
					Your contigent-status is unpaid. Click here to pay';
		$headers = 'From: Admin@neoungdom.com' . phpversion();
		mail($to, $subject, $message, $headers);
	}
}
?>

</section>

<section class="signup-form">
	<h3 style="text-align: left;">Add activity</h3><br>
        <form method="post">
            Activity:<input type="text" name="activityDesc" placeholder="Chess tournament">
            Date:<input type="date" name="activityDate" placeholder="Date">
            Responsible:<input type="text" name="activityPerson" placeholder="James Smith">
            Start time: <input type="time" name="activityStart" placeholder="Start time">
            End time: <input type="time" name="activityEnd" placeholder="End time">
            Place:<input type="text" name="activityPlace" placeholder="123 Main Street, NY">
            <button type="submit" name="submit"> Add activity </button>
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
        echo "Activity successfully added.";
        }
        else
        {
            echo "Notice: ddmmyyyy for date & hh:mm for time";
        }
        ?>
    </section>



</body>
</html>

<?php 
	include_once 'footer.php';
?>