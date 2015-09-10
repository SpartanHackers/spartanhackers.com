<?php
require_once('config.php');
require_once("../includes/validation.php");
include('existingMember.php');


if (isset($_REQUEST['e-mail']) && isset($_REQUEST['eventName'])) {

	if (checkEmail($_REQUEST['e-mail'])) {
		$email = $_REQUEST['e-mail'];
	} else {
		echo "Not a valid email";
	}

	$eventName = noTagScrub($_REQUEST['eventName']);

	//connect to database
	$link = new mysqli(host, user, pass, daba);

	//get event number
	$result = $link->query("SELECT id FROM `events` WHERE `name` = '$eventName'");
	$event = mysqli_fetch_assoc($result);
	$eventNumber = $event['id'];

	//check email agaisnt members database
	$result = $link->query("SELECT * FROM `members` WHERE `e-mail` = '$email'");
	$member = mysqli_fetch_row($result);

	if(is_array($member)) {
		//call existingMember.php
		$result = existingMemberSignIn($member, $eventNumber);
		if ($result == 1) {
			echo "Welcome back member!";
		} else {
			echo "error updating existing member";
		}
	} else {
		echo "new"; //new member form will redirect straight to existing member
	}

	if (mysqli_error($link)) {
		echo mysqli_error($link);
	}

	mysqli_close($link);
} else {
	echo "email or eventName is missing";
}

?>