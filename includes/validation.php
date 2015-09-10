<?php

function alphaNumericScrub($input) {
	$output = preg_replace("/[^a-zA-Z0-9]+/", "", $input);
	return $output;
}

function noTagScrub($input) {
	$output = strip_tags($input);
	return $output;
}

function checkEmail($input) {
	//Requires @ and msu.edu
	if (substr_count($input, "@") == 1){
		if (substr_count($input, "msu.edu") == 1) {
			if ($input == noTagScrub($input)) {
				return true;
			}
		}
	}
	
	//always return false unless all conditions are met.	
	return false;
	
} 

?>