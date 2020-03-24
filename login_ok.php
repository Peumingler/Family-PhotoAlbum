<?php
session_start();

/* Session loginned Check */
if(isset($_SESSION['user_id'])) {
	Header("Location: ./board.php");
}

/* Login Check */
include "functions/login.php";

//Check id, password
$result = loginCheck($_POST['loginid'], $_POST['loginpw']);
if($result === false) {
	echo "<script>alert(\"가입하지 않은 아이디거나, 잘못된 비밀번호입니다.\")</script>";
	Header("Refresh: 0 URL=index.php");
}
else {
	$_SESSION['user_id'] = $result;


	Header("Location: ./board.php");
}
?>

