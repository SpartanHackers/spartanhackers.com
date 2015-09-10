<?php

function existingMemberSignIn($memberInfo, $eventNumber) {

	//connect to database
	$link = new mysqli(host, user, pass, daba);

	//Get old events the member attended.
	$result = $link->query("SELECT `events` FROM `members` WHERE `id` = $memberInfo[0]");
	$events = mysqli_fetch_assoc($result); //returns array, only one thing in array, string of events
	$events = $events['events']; //get actual value

	$events = $events.",".$eventNumber; //append our new value, COMMA SEPERATED

	//update events
	$link->query("UPDATE `members` SET `events`='$events', `timestamp`=CURRENT_TIMESTAMP WHERE `id` = $memberInfo[0]");

	if (mysqli_error($link)) {
		echo mysqli_error($link);
		mysqli_close($link);
		return 0;
	} else {
		mysqli_close($link);
		return 1;
	}
}
?>