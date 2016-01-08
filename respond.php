<?php 
/***************************************
* iOS Messaging Web Mockup - Open Source
* Version: 1.0
* FILE: responde.php
* AUTHOR: Steven Basher
* DETAILS: A VERY basic respond script to showcase the scenario.
* LICENSE: MIT
***************************************/

//Remove punctuation and convert to uppercase to make matching easier.
function removePunc($str) {
	$str = preg_replace('/[[:punct:]]/uis', ' ', $str);
	$str = preg_replace('/\s\s+/', ' ', $str);
    $str = (IS_MB_ENABLED) ? mb_strtoupper($str) : strtoupper($str);
    $str = trim($str);
	return $str;
}

//Basic respond function, you must name your function respond() for it to work in the program.
function respond($str) {
	$str = removePunc($str);

	switch ($str) {
		//WHAT TO SAY STRAIGHT AWAY WHEN LOADED
		case 'INITIATE':
			$say = "Why hello there. #l";
			$say .= "My name is Bob, feel free to use and customise this scenario as you wish!";
			break;

		//POSSIBLE (VERY BASIC) WAY TO DEAL WITH RESPONSES
		case 'HELLO':
			$say = "Hello, it's lovely to meet you.";
			break;

		case 'HOW ARE YOU':
			$say = "I'm great thanks, the life of a few lines of code isn't exactly the toughest!";
			break;

		case 'WHO MADE YOU':
			$say = "Well that's a tad personal... #l";
			$say .= "But if you must know, his name is Steve Basher, check out his <a href='https://github.com/stevebasher/iOS-Messaging-Web-Mockup'>GitHub</a>!";
			break;
		
		//RETURN A RANDOM 'I DONT UNDERSTAND' RESPONSE:
		default:
			$catchAllArray = array(
				"I'm not sure I fully understand what you are saying...",
				"Eh?",
				"What on earth are you talking about?",
				"You're going to have to repeat that...");
			$say = $catchAllArray[array_rand($catchAllArray)]; 
			break;
	}

	return $say;
}

?>