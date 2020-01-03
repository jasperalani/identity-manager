<?php

function getUID($username){
	global $conn;

	$sql = "SELECT userid FROM users WHERE username LIKE '" . $username . "'";
	$getUIDquer = $conn->query($sql);

	if($getUIDquer->num_rows > 0){
		$uid = $getUIDquer->fetch_assoc();
		$uid = $uid['userid'];
		return $uid;
	}else{
		return 'no uid found.';
	}
}