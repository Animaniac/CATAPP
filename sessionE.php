<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<?php
			require_once"headder.inc.php";
		?>
		<link rel="stylesheet" href="sessionE.css"/>
	</head>
	<body>
		<div id="banner"></div>
			<img id="cat" src="images/logo.png">
			<img id="nhs" src="images/nhs.png">
		<article class="main">
			<u><h2>Session</h2></u>
			<textarea rows="12" name="post" id="post">last week I killed an old lady who pissed me off with her stupid wrinkes</textarea>
			<u><h2>Homework:</h2></u>
			<textarea rows="12" name="post" id="post">dont kill people</textarea>
			<footer>
				<form action="sessionR.php">
					<input type="submit" name="back" id="back" value="back" class="buttonStyle">
				</form>
				<form>
						<input type="checkbox" name="done" id="done" class="buttonStyle"><label for="done">homework done?</label>
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