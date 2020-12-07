<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "phpproject01";

//creates database connection that can be used throughout the files
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
?>