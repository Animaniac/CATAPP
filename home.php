<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<?php
			require_once"headder.inc.php";
		?>
		<link rel="stylesheet" href="home.css"/>
	</head>
	<body>
		<div id="banner"></div>
			<img id="cat" src="images/logo.png">
			<img id="nhs" src="images/nhs.png">
		<article class="main">
			<u><h2>Main Menu</h2></u>
			<a href=""><div class="content" id="l">
			<div class="content" id="s"><img src="images/icon.gif"></div>
			<div class="content" id="m"><h3>Target Problem Procedure</h3></div>
			</div></a>
			<a href="MoodM.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/icon.gif"></div>
			<div class="content" id="m"><h3>Mood Manager</h3></div>
			</div></a>
			<a href="LettersR.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/icon.gif"></div>
			<div class="content" id="m"><h3>Doctors Letters</h3></div>
			</div></a>
			<a href="sessionM.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/icon.gif"></div>
			<div class="content" id="m"><h3>Sessions</h3></div>
			</div></a>
			<a href="ProgressM.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/icon.gif"></div>
			<div class="content" id="m"><h3>Progress</h3></div>
			</div></a>
			<a href="Alarm.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/icon.gif"></div>
			<div class="content" id="m"><h3>Alarms</h3></div>
			</div></a>
		</article>
		<?php
			require_once"nav.inc.php";
		?>
	</body>
</html>