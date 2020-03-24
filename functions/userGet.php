<?php
header('HTTP/1.1 403 Forbidden');

//return user's albumID array
function get_User_albumIdArray($userId) {
	$link = mysqli_connect('localhost', 'albumUser', 'ConnectTo20@', 'album');
	$queryResult = mysqli_query($link, "SELECT album_id FROM users WHERE user_id = {$userId}");

	$queryData = mysqli_fetch_assoc($queryResult);

	$splitedArray = null;
	if($queryData['album_id'] !== NULL) {	
		$splitedArray = explode(",",$queryData['album_id']);
	}
	mysqli_free_result($queryResult);
	mysqli_close($link);
	return $splitedArray;
}

/* 로그인한 유저의 앨범 아이디 가져오기 */
function get_User_albumNameArray($userId) {
	$albumArr = get_User_albumIdArray($userId);
	
	$returnVal = null;
	if($albumArr !== null) { //로그인한 유저가 앨범을 하나라도 가지고 있을 경우
		$link = mysqli_connect('localhost', 'albumUser', 'ConnectTo20@', 'album');

		//query문 생성
		$query = "SELECT album_name FROM albums WHERE album_id = 0 "; // album_id = 0일 경우는 있을 수 없으므로 사용함.
		$albumArrLength = count($albumArr);	
		for($i = 0 ; $i < $albumArrLength ; $i = $i + 1) {
			$query = $query."OR album_id = ".$albumArr[$i]." ";
		}
		$query = $query.";";

		//앨범 이름 질의
		$queryResult = mysqli_query($link, $query);
		
		//앨범 이름 Array 저장
		$returnVal  = array();
		while($queryData = mysqli_fetch_assoc($queryResult)) {
			array_push($returnVal, $queryData['album_name']);
		}
		mysqli_free_result($queryResult);
		mysqli_close($link);
	}
	return $returnVal;
}

/* 유저가 가진 앨범의 album_id, album_name을 연관배열 형식으로 가져오기 */
/* return: [index arr]['album_id'], [index arr]['album_name']*/
function get_User_albumAssoc($userId) {
	$link = mysqli_connect('localhost', 'albumUser', 'ConnectTo20@', 'album');

	//album_id Array로 만들기
	$queryResult = mysqli_query($link, "SELECT album_id FROM users WHERE user_id = {$userId}");

	$queryData = mysqli_fetch_assoc($queryResult);

	if(is_null($queryData['album_id']) === false) {	
		$albumIdArr = explode(",",$queryData['album_id']);
	}
	else {
		return null;
	}

	//album_name Array로 만들기
	$query = "SELECT album_id, album_name FROM albums WHERE album_id = 0";
	$albumIdArrLength = count($albumIdArr);
	for($i = 0 ; $i < $albumIdArrLength ; $i = $i + 1) { //Query문 WHERE조건 생성
		$query = $query." OR album_id = ".$albumIdArr[$i];
	}
	$query = $query.";"; //Query문 생성완료

	$queryResult = mysqli_query($link, $query);

	$returnVal = array();
	while($queryData = mysqli_fetch_assoc($queryResult)) {
		array_push($returnVal, $queryData);
	}
	return $returnVal;
}
?>