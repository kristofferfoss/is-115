<?php 
	include_once 'header.php';
	include_once 'includes/dbh.inc.php';

	//session check to verify admin level privilege
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
		<form action="" method="POST">
			<h3 style='text-align: left;'>Contigent reminder:</h3><br>
			<button type="submit" name="sendMail">Send mail</button>
		</form>
<?php
	//function to send mail to all members that have not paid yet
	if (isset($_POST['sendMail'])) 
	{
	//if the button is pressed a mail will be sent to members 
	echo "<br><h4 style='text-align: left; margin-top: 25px;'>Mail regarding contigent has been sent to users:</h4>";

	$mysqli = mysqli_connect('localhost', 'root', '', 'phpproject01');
	//Selects all users with this value in "userKontigent"
	$sql = "SELECT * FROM users WHERE userKontigent = 0";
	
	include 'includes/dbh.inc.php';
	
	error_reporting(0);
	
	error_reporting(E_ALL);
	
	ini_set('display_errors', '1');

	$result = mysqli_query($conn, $sql);
	//create array to store results in
	$usersEmail = array();
	
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			//store all rows in array
			$usersEmail[] = $row;
		}
	}
	//mail funtion 
	foreach ($usersEmail as $emailUsers) {
		echo $emailUsers['usersEmail'].", <br> ";

		//convert array to strings to send mail to everyone
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
	<!-- Form to add activities -->
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
		//checks if button has been pressed then runs function
		if (isset($_POST["submit"])) 
		{
        // First we get the form data from the URL
        $activityDesc = ucfirst($_POST["activityDesc"]);
        $activityDate = $_POST["activityDate"];
        $activityPerson = ucfirst($_POST["activityPerson"]);
        $activityStart = $_POST["activityStart"];
        $activityEnd = $_POST["activityEnd"];
        $activityPlace = ucfirst($_POST["activityPlace"]);

        require_once "includes/dbh.inc.php";
        require_once 'includes/aktivitet.inc.php';
		
		//function from aktivitet.inc.php 
        addActivity($conn, $activityDesc, $activityDate, $activityPerson, $activityStart, $activityEnd, $activityPlace);
		
		echo "Activity successfully added.";
        }
        else
        {
			//in case someone uses Safari where date and time types(html) do not work
            echo "Notice: ddmmyyyy for date & hh:mm:ss for time";
        }
        ?>
    </section>
</body>
</html>

<?php 
	include_once 'footer.php';
?>