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
			<a href="TPPM.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/TPP.png"></div>
			<div class="content" id="m"><h3>Target Problem Procedure</h3></div>
			</div></a>
			<a href=""><div class="content" id="l">
			<div class="content" id="s"><img src="images/map.png"></div>
			<div class="content" id="m"><h3>Mood Map</h3></div>
			</div></a>
			<a href="MoodM.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/moodManager.png"></div>
			<div class="content" id="m"><h3>Mood Manager</h3></div>
			</div></a>
			<a href="LettersR.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/letters.png"></div>
			<div class="content" id="m"><h3>Doctors Letters</h3></div>
			</div></a>
			<a href="sessionM.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/note.png"></div>
			<div class="content" id="m"><h3>Sessions</h3></div>
			</div></a>
			<a href="Alarm.php"><div class="content" id="l">
			<div class="content" id="s"><img src="images/clock.png"></div>
			<div class="content" id="m"><h3>Alarms</h3></div>
			</div></a>
			<a href=""><div class="content" id="l">
			<div class="content" id="s"><img src="images/recognition.png"></div>
			<div class="content" id="m"><h3>Recognition</h3></div>
			</div></a>
			<a href=""><div class="content" id="l">
			<div class="content" id="s"><img src="images/revision.png"></div>
			<div class="content" id="m"><h3>Revision</h3></div>
			</div></a>
		</article>
		<nav>
			<a href="home.php"><div id="home"><img src="images/homeNav.png"></div></a>
			<a href="sessionM.php"><div id="home"><img src="images/noteNav.png"></div></a>
			<a href="alarm.php"><div id="home"><img src="images/clockNav.png"></div></a>
			<a href="settings.php"><div id="home"><img src="images/settingsNav.png"></div></a>
			<a href="exit.js"><div id="home"><img src="images/exitNav.png"></div></a>
		</nav>
	</body>
</html>