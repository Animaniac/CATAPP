<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<?php
			require_once"headder.inc.php";
		?>
		<link rel="stylesheet" href="TPPe.css"/>
	</head>
	<body>
		<div id="banner"></div>
			<img id="cat" src="images/logo.png">
			<img id="nhs" src="images/nhs.png">
		<article class="main">
			<u><h2>TPP</h2></u>
			<textarea rows="12" name="post" id="post"></textarea>
			<footer>
				<form action="TTPr.php">
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