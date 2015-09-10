<?php 
require_once('config.php');
require_once("../includes/validation.php");

//new member needs more info
if (isset($_REQUEST['first']) 
	&& isset($_REQUEST['last']) 
	&& isset($_REQUEST['major'])
	&& isset($_REQUEST['grad'])) {

	//connect to database
	$link = new mysqli(host, user, pass, daba);

	//get Event number
	$eventName = $_REQUEST['eventName'];
	$result = $link->query("SELECT id FROM `events` WHERE `name` = '$eventName'");
	$event = mysqli_fetch_assoc($result);
	$eventNumber = $event['id'];

 	//ToDo: Validate inputs
 	if (checkEmail($_REQUEST['e-mail'])) {
	 	$email = noTagScrub($_REQUEST['e-mail']);
	 	$first = alphaNumericScrub($_REQUEST['first']);
	 	$last = alphaNumericScrub($_REQUEST['last']);
	 	$major = alphaNumericScrub($_REQUEST['major']);
	 	$grad = alphaNumericScrub($_REQUEST['grad']);
	 }

	$link->query("INSERT INTO `members` (`events`, `e-mail`, `first`, `last`, `major`, `grad`, `timestamp`) 
					VALUES ('$eventNumber', '$email', '$first', '$last', '$major', '$grad', CURRENT_TIMESTAMP)");
}

	if (mysqli_error($link)) {
		echo mysqli_error($link);
		mysqli_close($link);
		return 0;
	} else {
		mysqli_close($link);
		return 1;
	}
?>