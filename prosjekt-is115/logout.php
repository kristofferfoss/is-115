<?php
//ends session and gets rid of session variables
session_start();
session_unset();
session_destroy();

//takes you back to index.php after logout
header("location: index.php");
exit();
