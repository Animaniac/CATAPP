<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<?php
			require_once"headder.inc.php";
		?>
		<link rel="stylesheet" href="letterRead.css"/>
	</head>
	<body>
		<div id="banner"></div>
			<img id="cat" src="images/logo.png">
			<img id="nhs" src="images/nhs.png">
		<article class="main">
			<u><h2>Session</h2></u>
			<textarea rows="12" name="post" id="post" disabled>last week I killed an old lady who pissed me off with her stupid wrinkes</textarea>
			<footer>
				<form action="sessionM.php">
					<input type="submit" name="back" id="back" value="back" class="buttonStyle">
				</form>
			</footer>
		</article>
		<?php
			require_once"nav.inc.php";
		?>
	</body>
</html>