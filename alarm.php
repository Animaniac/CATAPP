<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<?php
			require_once"headder.inc.php";
		?>
		<link rel="stylesheet" href="alarm.css"/>
	</head>
	<body>
		<div id="banner"></div>
			<img id="cat" src="images/logo.png">
			<img id="nhs" src="images/nhs.png">
		<article class="main">
			<u><h2>Alarm</h2></u>
			<form id="alarmSettings">
			<div class="content" id="l">
			<div class="content" id="s"><lable for="alarm">Time:</lable></div>
			<div class="content" id="m"><input type="date" name="alarm" id="alarm" required>
			</div>
			</div>
		<div class="content" id="l">
			<div class="content" id="s"><lable>Time:</lable></div>
			<div class="content" id="m"><lable id="goOff">Go off</lable>
				<select>
					<option value="0">0</option>
					<option value="15">15</option>
					<option value="30">30</option>
					<option value="45">45</option>
					<option value="60">60</option>
				</select><lable> minutes before</lable>
			</div>
			</div>
			<div class="content" id="l">
			<div class="content" id="s"><lable for="vol">Volume:</lable></div>
			<div class="content" id="m"><input type="range" name="vol" id="vol" required>
			</div>
			</div>
			<div class="content" id="l">
			<div class="content" id="s"><lable for="vibe">Vibrate:</lable></div>
			<div class="content" id="m"><input type="checkbox" name="vibe" id="vibe" required>
			</div>
			</div>
			<div class="content" id="l">
			<div class="content" id="s"><lable for="vibe">Sound:</lable></div>
			<div class="content" id="m"><select id="sound">
					<option value="Deafult">Deafult</option>
					<option value="rumba">rumba</option>
					<option value="Sweat Child of Mine">Sweat Child of Mine</option>
					<option value="batman">batman</option>
					<option value="the who">the who</option>
				</select>
			</div>
			</div>
			<div class="content" id="l">
			<div class="content" id="s"><lable for="vibe">Vibrate:</lable></div>
			<div class="content" id="m"><select id="type">
					<option value="Alarm">Alarm</option>
					<option value="Mood Reminder">Mood Reminder</option>
					<option value="Meeting">Meeting</option>
					<option value="Medication">Pick up medication</option>
					<option value="Homework">Homework</option>
				</select>
			</div>
			</div>
			</div>
			<div class="content" id="l">
			<div class="content" id="s"><lable for="snooz">Snooz:</lable></div>
			<div class="content" id="m"><input type="checkbox" name="snooz" id="snooz" required>
			</div>
			</div>
			</form>
			<footer>
				<form action="home.php">
					<input type="submit" name="back" id="back" value="back" class="buttonStyle">
				</form>
				<form action="">
					<input type="submit" name="save" id="save" value="save" class="buttonStyle">
				</form>
			</footer>
		</article>
		<?php
			require_once"nav.inc.php";
		?>
	</body>
</html>