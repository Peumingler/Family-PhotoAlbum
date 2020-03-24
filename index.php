<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['user_id'])) {
	Header('Location: ./board.php');
}
?>


<html>
<head>
	<meta charset="utf-8"/>
	<title>우리집 사진첩 - 로그인</title>
</head>
<body>
<form action="./login_ok.php" method="POST">
	<p><input type="text" name="loginid" placeholder="아이디"></p>
	<p><input type="password" name="loginpw" placeholder="비밀번호"></p>
	<input type="submit" value="로그인">
	<input type="button" value="회원가입" onclick="location.href='./register.php'">
</form>
</body>
</html>
