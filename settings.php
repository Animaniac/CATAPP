<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<?php
			require_once"headder.inc.php";
		?>
		<link rel="stylesheet" href="settings.css"/>
	</head>
	<body>
		<div id="banner"></div>
			<img id="cat" src="images/logo.png">
			<img id="nhs" src="images/nhs.png">
		<article class="main">
			<u><h2>Settings</h2></u>
			<div class="formContainer">
			<form>
			<label for="currentU">Current Username:</label>
			<input type="text" name="currentU" id="currentU" requiered autofocus>
			<label for="newU">New Username:</label>
			<input type="text" name="newU" id="newU" requiered>
			<label for="confNewU">Confirm New Username:</label>
			<input type="text" name="confNewU" id="confNewU" requiered>
			<input type="submit" name="submit" id="submit" value="Submit" class="buttonStyle">
			</form>
			<form>
			<label for="currentP">Current Password:</label>
			<input type="password" name="currentP" id="currentP" requiered>
			<label for="newP">New Password:</label>
			<input type="password" name="newP" id="newP" requiered>
			<label for="confNewP">Confirm New Password:</label>
			<input type="password" name="confNewP" id="confNewP" requiered>
			<input type="submit" name="submit" id="submit" value="Submit" class="buttonStyle">
			</form>
			<form>
			<label for="currentE">Current e-mail:</label>
			<input type="e-mail" name="currentE" id="currentE" requiered>
			<label for="newE">New e-mail:</label>
			<input type="e-mail" name="newE" id="newE" requiered>
			<label for="confNewE">Confirm New e-mail:</label>
			<input type="e-mail" name="confNewE" id="confNewE" requiered>
			<input type="submit" name="submit" id="submit" value="Submit" class="buttonStyle">
			</form>

		</article>
		<?php
			require_once"nav.inc.php";
		?>
	</body>
</html>