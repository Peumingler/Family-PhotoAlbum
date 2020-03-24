<?php
/* Model */
require 'functions/login.php';
//Check form is submitted.
$action = false;
if(isset($_POST['action'])) {
	$action = true;
}

//Execute if form is submitted.
$registered = '';
if($action === true) {
	$registered = register($_POST['registerid'], $_POST['registerpw']);
}
?>

<!-- View -->
<html>
<head>
	<meta charset="utf-8"/>
	<title>우리집 사진첩 - 회원가입</title>
</head>
<body>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
		<p><input type="text" name="registerid" placeholder="아이디"></p>
		<p><input type="password" name="registerpw" placeholder="비밀번호"></p>
		<input type="hidden" name="action"  value="form_submit"/>
		<input type="submit" value="회원가입"/>
		<input type="button" value="뒤로가기" onclick="location.href='./index.php'"/>
	</form>
<?php
	if(isset($action)) { //$action is setted if form is submitted.
		if($registered === 0) {
			echo "<script>alert(\"회원가입이 완료되었습니다.\")</script>";
			header("Refresh: 0; URL=./index.php");
		}
		else if($registered === 1) {
			echo "<script>alert(\"이미 동일한 아이디가 존재합니다.\")</script>";
		}
		else if($registered === 2) {
			echo "<script>alert(\"아이디, 비밀번호를 입력하십시오.\")</script>";
		}
/*		else if($registered === 3) {
			echo "<script>alert(\"아이디에 한글은 사용불가합니다.\")</script>";
		}
 */
	}

?>


</body>
</html>
