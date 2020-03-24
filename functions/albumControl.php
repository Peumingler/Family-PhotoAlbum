<?php
header('HTTP/1.1 403 Forbidden');
include "functions/userGet.php";
include "functions/albumGet.php";

function create_Album($userId, $albumName) {
	$link = mysqli_connect('localhost', 'albumUser', 'ConnectTo20@', 'album');

	//Create album.
	mysqli_query($link, "INSERT INTO albums (album_name, created) VALUES ('".mysqli_escape_string($link, $albumName)."', now())");

	//Get new album's album_id
	$queryResult = mysqli_query($link, "SELECT album_id FROM albums WHERE album_name = '{$albumName}'");
	$queryData = mysqli_fetch_assoc($queryResult);
	$albumId = $queryData['album_id'];

	//Get user's accessable albums raw data.
	$user_AlbumArray = get_User_albumIdArray($userId);

	//Update user's album_id raw data.
	$user_AlbumIdRaw = '';
	if($user_AlbumArray !== null) { //기존 앨범 데이터가 있는 경우 실행
		foreach ($user_AlbumArray as $i) {
			$user_AlbumIdRaw = $user_AlbumIdRaw.$i.",";
		}	
	}
	$user_AlbumIdRaw = $user_AlbumIdRaw.$albumId;
	mysqli_query($link, "UPDATE users SET album_id = '{$user_AlbumIdRaw}' WHERE user_id = {$userId}");

	//Update album's user_id raw data.
	$album_UserIdArray = get_Album_userIdArray($albumId);

	$album_UserIdRaw = '';
	if($album_UserIdArray !== null) {
		foreach ($album_UserIdArray as $i) {
			$album_UserIdRaw = $album_UserIdRaw.$i.",";
		}
	}
	$album_UserIdRaw = $album_UserIdRaw.$userId;
	mysqli_query($link, "UPDATE albums SET user_id = '{$userId}' WHERE album_id = {$albumId}");


	mysqli_close($link);
	return true;
}

?>