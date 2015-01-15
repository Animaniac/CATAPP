<!DOCTYPE html>
<html>
	<title>&nbsp;</title>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="log_reg.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		
		
	</head>
	<body>
		<div id="banner"></div>
		<div id="logo">
			<img src="images/logo.png">
		</div>
		<?php
				session_start();
		if (isset($_SESSION['login']))
			{if ($_SESSION['login'] == true)
				{header("Location: index.php");
		}}
		?>
		<div id="buffer"></div>
		<article class="main" id="log">
				<script>
				function logVal(){
				    var user = document.forms["logincheck"]["user"].value;
				    var pass = document.forms["logincheck"]["pass"].value;
				    var logCount = 0;
				    var logErrormMsg = "";
				    if(user == null || user == "")
				    {
				        logCount++;
				        LEM = "You didn't input your username</br>";
				        logErrormMsg = logErrormMsg.concat(LEM);
				    }
				    if(pass == null || pass == "")
				    {
				        logCount++;
				        LEM = "You didn't input your password</br>";
				        logErrormMsg = logErrormMsg.concat(LEM);
				    }
					if (logCount > 0){
				        document.getElementById("LogValText").innerHTML = logErrormMsg;
				        return false;
				    }};
				</script>
				<form id="fromLogin" name="logincheck" method="post" action="LoginCatch.php" onsubmit="return logVal()" class="loginPage">
					<h3><u>Login</u></h3>
					<label for="user">Username:</label>
					<input type="text" name="user" id="user" autofocus required>
				</br>
					<label for="pass">Password:</label>
					<input type="password" name="pass" id="pass" required>
				</br>
					<a href='Forgoten.html'>Forgot password?</a>
					<input type="submit" name="submit" id="submit" value="Login" class="buttonStyle">
				</form>
				<p id="LogValText">
				<?php
					if (isset($_SESSION['noConf'])){
						if ($_SESSION['noConf'] == true)
						{
							echo("please <a href='confirm.php'>confirm</a> your account</br>");
						}
						else
						{
							echo("");
						}}
					if (isset($_SESSION['wrongu'])){
						if ($_SESSION['wrongu'] == true)
						{
							echo("Wrong username</br>");
							echo '<style type="text/css">
									#user
									{
										border:2px solid red;
									}
									</style>';
						}
						else
						{
							echo("");
						}}
					if (isset($_SESSION['wrongp'])){
						if ($_SESSION['wrongp'] == true)
						{
							echo("Wrong password</br>");
							echo '<style type="text/css">
									#pass
									{
										border:2px solid red;
									}
									</style>';
						}
						else
						{
							echo("");
						}}
					if (isset($_SESSION['nou'])){
						if ($_SESSION['nou'] == true)
						{
							echo("You didnt input a username</br>");
							echo '<style type="text/css">
									#user
									{
										border:2px solid red;
									}
									</style>';
						}
						else
						{
							echo("");
						}
					}
					if (isset($_SESSION['nop'])){
						if ($_SESSION['nop'] == true)
						{
							echo("You didnt input a password</br>");
							echo '<style type="text/css">
									#pass
									{
										border:2px solid red;
									}
									</style>';
						}
						else
						{
							echo("");
						}
					}
				?></p></article>
				<div id="changeForm">
					<button id="toggleBtn" class="buttonStyle">Register</button>
				</div>
				<article class="main" id="reg">
				<script type="text/javascript">

				var counter = 0;
				$(document).ready(function(){
				$('.buttonStyle').click(function (){
					if (counter == 0) {
						$('#fromLogin').fadeOut();
						$('#reg').delay(385).fadeIn();
						$('#toggleBtn').text('Login');
						counter++;}

    				else if (counter == 1){
			    	$('#reg').fadeOut();
					$('#fromLogin').delay(385).fadeIn();
					$('#toggleBtn').text('Register');
					counter--;}
    				});  
	
				});  


						
				</script>
				<script>
				function regVal(){
				    var email = document.forms["registercatch"]["email"].value;
				    var emailR = document.forms["registercatch"]["emailR"].value;
				    var regUser = document.forms["registercatch"]["regUser"].value;
				    var regPass = document.forms["registercatch"]["regPass"].value;
				    var confRegPass = document.forms["registercatch"]["confRegPass"].value;
				    var count = 0;
				    var errormMsg = "";
				    if(email == null || email == "")
				    {
				        count++;
				        EM = "you didn't input your email</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    if(emailR == null || emailR == "")
				    {
				        count++;
				        EM = "you didn't input your confirmation email</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    if (email!=emailR) 
				    {
				        count++;
				        EM = "your emails didn't match</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    if (regUser == null || regUser == "")
				    {
				        count++;
				        EM = "you didn't input a username</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    if (regPass == null || regPass == "")
				    {
				        count++;
				        EM = "you didn't input a password</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    var passL = regPass.length;
				    if (passL < 8)
				    {
				        count++;
				        EM = "Your password should be at least 8 characters long</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    if (confRegPass == null || confRegPass == "")
				    {
				        count++;
				        EM = "you didn't input your confirmation password</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    if (regPass!=confRegPass) 
				    {
				        count++;
				        EM = "your passwords didn't match</br>";
				        errormMsg = errormMsg.concat(EM);
				    }
				    if (count > 0){
				        document.getElementById("RegValText").innerHTML = errormMsg;
				        return false;
				    }};
				</script>
				<form name="registercatch" method="post" action="RegisterCatch.php" onsubmit="return regVal()" class="loginPage" id="myForm">
					<h3><u>Register</u></h3>
					<label for="email">E-mail:<p>*</p></lable>
					<input type="email" name="email" id="email" required placeholder="example@gmail.com">
				</br>
					<label for="emailR">Confirm E-mail:<p>*</p></lable>
					<input type="email" name="emailR" id="emailR" required placeholder="example@gmail.com">
				</br>
					<label for="regUser">Username:<p>*</p></label>
					<input type="text" name="regUser" id="regUser" id="regUser" required placeholder="example">
				</br>
					<label for="regPass">Password:<p>*</p></label>
					<input type="password" name="regPass" id="regPass" id="regPass" required placeholder="8 character minimum">
				</br>
					<label for="confRegPass">Confirm Password:<p>*</p></label>
					<input type="password" name="confRegPass" id="confRegPass" id="confRegPass" required placeholder="8 character minimum">
				</br>
					<input type="submit" name="submit" id="submit" value="Register" class="buttonStyle">
				</form>
				<p id="RegValText">
				<?php
				if (isset($_SESSION['toShort'])){
					if ($_SESSION['toShort'] == true)
						{
							echo("Your password should be at least 8 characters long</br>");
							echo '<style type="text/css">
									#regPass
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['toShort'] == false)
						{
							echo("");
						}}
				if (isset($_SESSION['emailMatch'])){
					if ($_SESSION['emailMatch'] == false)
						{
							echo("Your emails didn't match</br>");
							echo '<style type="text/css">
									#email, #emailR
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['emailMatch'] == true)
						{
							echo("");
						}}
				if (isset($_SESSION['emailValid'])){
					if ($_SESSION['emailValid'] == false)
						{
							echo("Your email isn't Valid</br>");
							echo '<style type="text/css">
									#email, #emailR
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['emailValid'] == true)
						{
							echo("");
						}}
				if (isset($_SESSION['passMatch'])){
					if ($_SESSION['passMatch'] == false)
						{
							echo("Your passwords didn't match</br>");
							echo '<style type="text/css">
									#regPass, #confRegPass 
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['passMatch'] == true)
						{
							echo("");
						}}
				if (isset($_SESSION['dob'])){
					if ($_SESSION['dob'] == false)
						{
							echo("You didn't enter your Date of Birth</br>");
							echo '<style type="text/css">
									#dob
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['dob'] == true)
						{
							echo("");
						}}
				if (isset($_SESSION['reguserEmp'])){
					if ($_SESSION['reguserEmp'] == false)
						{
							echo("You misses your username</br>");
							echo '<style type="text/css">
									#regUser
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['reguserEmp'] == true)
						{
							echo("");
						}}
				if (isset($_SESSION['regTaken'])){
					if ($_SESSION['regTaken'] == true)
						{
							echo("That username already exists</br>");
							echo '<style type="text/css">
									#regUser
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['regTaken'] == false)
						{
							echo("");
						}}
				if (isset($_SESSION['emailTaken'])){
					if ($_SESSION['emailTaken'] == true)
						{
							echo("That email already exists</br>");
							echo '<style type="text/css">
									#email
									{
										border:2px solid red;
									}
									</style>';
						}
					elseif ($_SESSION['emailTaken'] == false)
						{
							echo("");
						}}
						
				?></p>
		</article>
	</body>
</html>