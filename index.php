
<?php 
/***************************************
* iOS Messaging Web Mockup - Open Source
* Version: 1.0
* FILE: index.php
* AUTHOR: Steven Basher
* DETAILS: Creates an interactive iOS-style messaging scenario on the web. 
* LICENSE: MIT
***************************************/

//INCLUDES
//YOU MUST CREATE AND INCLUDE A RESPOND FILE TO DEAL WITH THE USER RESPONSES, I HAVE INCLUDED A VERY BASIC ONE TO SHOW HOW IT CAN EASILY BE DONE.
//NOTE: Adding #l in the respond string splits the reply onto multiple bubbles, as would happen in a normal text conversation. 
include 'respond.php'


//VARIABLES - Change as you wish.
$chatTitle = "Speak To Bob"; //Title to show at the top of the page.
$userColour = "#80dfff"; //Colour for your input bubble
$bobColour = "#d9d9d9"; //Colour for Bob's response bubble

//Basically everything else can be changed with just a bit of CSS knowledge.


function parseHistory($history) {
	$history = str_replace('#b', '<div id="message_bob">', $history);
	$history = str_replace('#u', '<div id="message_user">', $history);
	$history = str_replace('#d', '</div>', $history);
	return $history;
}

if ($_POST) { 
	$input = $_POST["input"];

	$history = $_POST["history"];
	$history .= '#u';
	$history .= $input;
	$history .= '#d';

	$output = respond($input);

	if ($input == "INITIATE") {
		$output = "Erm, excuse me, I don't like what you are trying to do there.";
	}

	$outputArr = explode("#l", $output);

	foreach ($outputArr as $message) {
		$history .= '#b';
		$history .= $message;
		$history .= '#d';
	}

} else {
	$history = "";

	$output = respond("INITIATE");

	$outputArr = explode("#l", $output);

	foreach ($outputArr as $message) {
		$history .= '#b';
		$history .= $message;
		$history .= '#d';
	}
}
?>


<!-- HTML TO DISPLAY SCENARIO ################################### -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<title>iOS Messaging Scenario Mockup</title>
<style type="text/css">
	body {
		font-family: Sans-Serif;
	}
	#phone_bg {
		background-color: #ffffff;
		background-image: url("images/iphone6s.png");
		background-size: 100% 100%;
		background-repeat: no-repeat;
		width: 316px;
		height: 644px;
	}

	#phone_screen {
		position: absolute;
		top: 0px;
		left: 0px;
		margin-left: 27px;
		margin-top: 85px;
		padding: 10px;
		background-color: #ffffff;
		width: 258px;
		height: 470px;
	}

	#screen_content {
		width: 100%;
		height: 100%;
		background-color: #ffffff;
	}

	#title_area {
		width: 100%;
		height: 5%;
		text-align:center;
	}

	#message_area {
		width: 100%;
		height: 66%;
		background-color: #ffffff;
		overflow-y: auto;
		overflow-x: none;
	}

	#keyboard_area {
		width: 100%;
		height: 30%;
		background-color: #ffffff;
	}

	#message_bob {
		margin-left: 5px;
		width: 190px;
		margin-top: 5px;
		margin-bottom: 5px;
		border-radius: 5px;
		padding: 10px;
		font-size: 12px;
		background-color: <?php echo $bobColour; ?>; /* COLOUR FOR BOB'S RESPONSE BUBBLE */
		float: left;
	}

	#message_user {
		margin-left: 28px;
		border-radius: 5px;
		width: 190px;
		margin-top: 5px;
		margin-bottom: 5px;
		padding: 10px;
		font-size: 12px;
		background-color: <?php echo $userColour; ?>;
		float: left;
	}

	textarea {
	    width: 236px;
	    height: 85px;
	    border-radius: 0.5em;
	    padding: 10px;
	    border: 1px solid #d9d9d9; 
	    outline: none;
	    resize: none; 
	    font-size: 15px;
	}

	.formbutton {
	    padding:5px 15px; 
	    margin-top: 7px;
	    width: 118px;
	    background:#80dfff; 
	    border:0 none;
	    cursor:pointer;
	    font-size: 12px;
	    -webkit-border-radius: 5px;
	    border-radius: 5px; 
	}

	.title {
		font-size: 23
		px;
		font-weight: bold;
		color: #666666; /* TITLE COLOUR */
	}

</style>

<!-- SCRIPT TO AUTOMATICALLY SCROLL THE USER TO THE CURRENT MESSAGE AFTER SUBMITTING -->
<script type="text/javascript">
function scroll() {
	var objDiv = document.getElementById("message_area");
	objDiv.scrollTop = objDiv.scrollHeight;
}
</script>

</head>

<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div id="phone_bg">
<!-- Background Image of Iphone -->
	<div id="phone_screen">
	<!-- Screen-->
		<div id="screen_content">
		<!-- Message / Keyboard Area -->
			<div id="title_area">
				<span class="title"><?php echo $chatTitle; ?></span>
			</div>
			<div id="message_area">
				<?php 
					echo parseHistory($history); 
					echo '<script type="text/javascript">';
					echo 'scroll();';
					echo '</script>';
				?>

			</div>
			<div id="keyboard_area">
				<textarea class="input_area" name="input"></textarea>
				<input type="reset" name="clear" class="formbutton" value="Clear" style="margin-left:5px;margin-right:5px;" />
				<input type="submit" name="submit" class="formbutton" value="Send" style="margin-right:5px;"/>
			</div>
		</div>

	</div>
</div>
<input type="hidden" name="history" value="<?php echo $history;?>">
</form> 



</body>
</html>
