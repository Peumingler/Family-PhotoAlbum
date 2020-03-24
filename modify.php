<?php
session_start();
include "functions/albumControl.php";

if(!isset($_SESSION['user_id']) || !isset($_GET['mod'])) { //로그인을 안한 상태거나 get을 못받았을 경우 index.php로 튕겨냄
	Header("Location: ./index.php");
}

//Init
$url = $_SERVER['PHP_SELF']."?mod=".$_GET['mod'];

if($_GET['mod'] === 'albumCreate') {
	$label = "새 앨범 이름";
}
else if($_GET['mod'] === 'albumModify') {
	$label = "바꿀 앨범 이름";
}

//Execute if submitted.
if(isset($_POST['action'])) {
	if($_GET['mod'] === 'albumCreate') {
		$result = create_Album($_SESSION['user_id'], $_POST['albumName']);

		if($result === true) {
			echo "<script>alert(\"앨범을 생성하였습니다.\")</script>";
			header("Refresh: 0; URL=./{$url}");
		}
	}
	else if($_GET['mod'] === 'albumModify') {

	}

}
?>

<!-- View -->
<html>
<head>
	<meta charset="utf8"/>
	<title>우리집 사진첩 - 앨범 만들기</title>
</head>
<body>
	<form action="<?=$url?>" method="POST">
		<input type="text" name="albumName" placeholder="<?=$label?>"/>
		<input type="submit" value="제출"/>
		<input type="button" value="뒤로가기" onclick="location.href='./index.php'"/>
		<input type="hidden" name="action" value="form_submit"/>
	</form>
</body>


</html>
