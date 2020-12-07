<?php
// Check for empty input signup
function emptyInputSignup($firstname, $lastname, $email, $phonenumber, $address, $postno, $postplace, $username, $birthdate, $pwd, $pwdRepeat) {
	$result;
	if (empty($firstname) || empty($lastname) || empty($email) || empty($phonenumber) || empty($address) || empty($postno) || empty($postplace) || empty($username) || empty($birthdate) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid username
function invalidUid($username) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid postnumber
function invalidPostno($postno) {
	$result;
	if (strlen($postno) != 4) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat) {
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $firstname, $lastname, $email, $phonenumber, $address, $postno, $postplace, $regdato, $username, $birthdate, $gender, $pwd) {
  $sql = "INSERT INTO users (usersFirstname, usersLastname, usersEmail, usersUid, usersDob, usersKjonn, usersPwd, usersPhone, usersPostno, usersPostplace, usersAddress, usersRegdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "sssssssiisss", $firstname, $lastname, $email, $username, $birthdate, $gender, $hashedPwd, $phonenumber, $postno, $postplace, $address, $regdato);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../signup.php?error=none");
	exit();
}

// Check for empty input login
function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersId"];
		$_SESSION["useruid"] = $uidExists["usersUid"];
		$_SESSION["user_level"] = $uidExists["user_level"];
		header("location: ../index.php?error=none");
		exit();
	}
}

function isAdmin($conn) 
{
	$ID = $_SESSION['userid'];

	$sql = "SELECT user_level FROM users WHERE usersId = ?";

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$stmt = mysqli_stmt_init($conn);
	
	mysqli_stmt_prepare($stmt, $sql);
	
	mysqli_stmt_bind_param($stmt, "i", $ID);
	
	mysqli_stmt_execute($stmt);
	
	$results = mysqli_stmt_get_result($stmt);
	
	while($row = mysqli_fetch_assoc($results))
	{
		$_SESSION['user_level'] = $row['user_level'];
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
}
