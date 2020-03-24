<?php
header('HTTP/1.1 403 Forbidden');

function get_Album_userIdArray($albumId) {
	$link = mysqli_connect('localhost', 'albumUser', 'ConnectTo20@', 'album');
	$queryResult = mysqli_query($link, "SELECT user_id FROM albums WHERE album_id = {$albumId}");

	$queryData = mysqli_fetch_assoc($queryResult);

	$splitedArray = null;
	if($queryData['user_id'] !== NULL) {	
		$splitedArray = explode(",",$queryData['user_id']);
	}
	mysqli_free_result($queryResult);
	mysqli_close($link);
	return $splitedArray;
}

function get_Album_imageUrlArray($albumId) {

}

?>
