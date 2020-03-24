<?php
header('HTTP/1.1 403 Forbidden');

function loginCheck($id, $password) {
	$link = mysqli_connect('localhost', 'albumUser', 'ConnectTo20@', 'album');

	//connect error check
	if (mysqli_connect_errno()) {
        die('Connect Error: '.mysqli_connect_error());
	}

	//mysqli_query($link, "INSERT INTO users (loginid, loginpw, created) VALUES ('".$id['loginid']."', '".password_hash($id['loginpw'], PASSWORD_DEFAULT)."', now())");

	//Login Process
	$queryResult = mysqli_query($link, "SELECT user_id, loginid, loginpw FROM users WHERE loginid='".mysqli_real_escape_string($link, $id)."'");
	$userData = mysqli_fetch_assoc($queryResult);

	if (password_verify($password, $userData['loginpw'])) {
        /*
        echo "Successfuly logined.";
        */
        return $userData['user_id'];
	}
	else {
		/*
        echo "<script>alert(\"아이디 또는 비밀번호가 잘못 입력되었습니다.\")</script>";
        header("Refresh: 0; URL=./index.html");
        */
        return false;
	}


	mysqli_free_result($queryResult); //Query결과 해제
	mysqli_close($link);
}

/*
 * -returns
 * 	success = 0
 * 	same id exist = 1
 * 	$id or $password is blank = 2
 * 	!Not worked yet: Hangul included = 3
 */
function register($id, $password) {
	//Check $id or $password
	if ($id === '' || $password === '') {
		return 2;
	}
	
/*	if (preg_match("/[xE0-xFF][x80-xFF][x80-xFF]/", $id)) {
		return 3;
	}
 */

	/* main */
	$link = mysqli_connect('localhost', 'albumUser', 'ConnectTo20@', 'album');

	//connect error check
	if (mysqli_connect_errno()) {
       	die('Connect Error: '.mysqli_connect_error());
	}

	//Duplication check
	$queryResult = mysqli_query($link, "SELECT loginid FROM users WHERE loginid='".mysqli_real_escape_string($link, $id)."'");
	$userData =mysqli_fetch_assoc($queryResult);

	if($id === $userData['loginid']) { //If id is already exist.
		$result = 1;
	}
	else {
		mysqli_query($link, "INSERT INTO users (loginid, loginpw, created) VALUES ('".mysqli_real_escape_string($link, $id)."', '".password_hash($password, PASSWORD_DEFAULT)."', now())");
		$result = 0;
	}

	mysqli_free_result($queryResult);
	mysqli_close($link);
	return $result;

}
?>
