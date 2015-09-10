<?php
require_once('config.php');

function logIn($pswd) {
	$link = new mysqli(host, user, pass, daba);
	$password = hash(ALGO, $pswd);
	$result = $link->query("SELECT * FROM `users` WHERE password = '$password'");

	$user = mysqli_fetch_array($result);

	mysqli_close($link);
	if ($user == null) {
		return false;
	} else {
		return $user;
	}
}

function newEvent($eventName) {
	$link = new mysqli(host, user, pass, daba);

	$result = $link->query("SELECT COUNT(`name`) FROM  `events` WHERE `name` = '$eventName'");
	$result = mysqli_fetch_assoc($result);
	$result = $result["COUNT(`name`)"];

	if ($result == "0") {
		$result = $link->query("INSERT INTO `events` ( `name` ) VALUES ( '$eventName')");

		if (mysqli_error($link)) {
			mysqli_close($link);
			return 0;
		} else {
			return 1;
		}
	}

	//get here only if name already exists
	mysqli_close($link);
	return 0;
	
}

?>