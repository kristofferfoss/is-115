<?php
// Check for empty input signup
function emptyInputSignup($firstname, $lastname, $email, $mobilnummer, $adresse, $postno, $poststed, $username, $fødselsdato, $pwd, $pwdRepeat) {
	$result;
	if (empty($firstname) || empty($lastname) || empty($email) || empty($mobilnummer) || empty($adresse) || empty($postno) || empty($poststed) || empty($username) || empty($fødselsdato) || empty($pwd) || empty($pwdRepeat)) {
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
function createUser($conn, $firstname, $lastname, $email, $mobilnummer, $adresse, $postno, $poststed, $regdato, $username, $fødselsdato, $kjønn, $pwd) {
  $sql = "INSERT INTO users (usersFirstname, usersLastname, usersEmail, usersUid, usersDob, usersKjonn, usersPwd, usersPhone, usersPostno, usersPostplace, usersAddress, usersRegdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "sssssssiisss", $firstname, $lastname, $email, $username, $fødselsdato, $kjønn, $hashedPwd, $mobilnummer, $postno, $poststed, $adresse, $regdato);
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
		header("location: ../index.php?error=none");
		exit();
	}
	define ('USER_LEVEL_ADMIN', '1');
	if (!isAdmin() ) {
		header("location: ../index.php?error=none");
	}
	elseif (isAdmin() ) {
		header("location: ..//admin.php");
	}
}

function isAdmin() {
	if (isset($_SESSION['usersId']) && $_SESSION['usersId'] && USER_LEVEL_ADMIN == $_SESSION['usersId']['users_level']) {
		return true;
	} else {
		return false;
	}
}
