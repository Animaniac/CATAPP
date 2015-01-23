<?php
session_start();
$errorCount = 0;
$email = filter_input(INPUT_POST,email, FILTER_SANITIZE_STRING);
$emailR = filter_input(INPUT_POST,emailR, FILTER_SANITIZE_STRING);
if ($email != $emailR)
{
	$emailMatch = array('emailMatch'=>"Emails dont match");
	$errorCount = $errorCount + 1;
}
else 
{
	$emailMatch = array('emailMatch'=>"Emails match");
}
if ((!filter_var($email, FILTER_VALIDATE_EMAIL))or(!filter_var($emailR, FILTER_VALIDATE_EMAIL)))
{
	$emailValid = array('emailValid'=>"Invalid Email");
	$errorCount = $errorCount + 1;
}
else
{
	$emailValid = array('emailValid'=>"Valid Email");
}
$regPass = trim((filter_input(INPUT_POST,regPass, FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
$confRegPass = trim((filter_input(INPUT_POST,confRegPass, FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
if (strlen($regPass) < 8)
{
	$toShort = array('toShort'=>"Password to short");
	$errorCount = $errorCount + 1;
}
else
{
	$toShort = array('toShort'=>"Password long enough");
}
if ($regPass != $confRegPass)
{
	$passMatch = array('passMatch'=>"Passwords dont match");
	$errorCount = $errorCount + 1;
}
else 
{
	$passMatch = array('passMatch'=>"Passwords match");
	function cryptPass($input, $rounds = 9)
	{
		$salt = "";
		$saltChars = array_merge(range('A','Z'),range('a','z'),range(0,9));
		for ($i = 0;$i < 22;$i++)
		{
			$salt .= $saltChars[array_rand($saltChars)];
		}
		return crypt($input, sprintf('$2y$%02d$', $rounds).$salt);
	}
	$regPass = cryptPass($regPass);
}
$accountl = 0;
$regUser = trim(filter_input(INPUT_POST,regUser, FILTER_SANITIZE_STRING)," \t\n\r\0\x0B");
if ($regUser == "")
{
	$reguserEmp = array('reguserEmp'=>"Username not Empty");
	$errorCount = $errorCount + 1;
}
else 
{
	$reguserEmp = array('reguserEmp'=>"Username Empty");
}

include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT username,email FROM users Where username= ? or email= ?")) {
		$stmt->bind_param('ss', $regUser, $email);
		$stmt->execute();
		$stmt->bind_result($userTaken, $emailTaken);
		$stmt->fetch();
if ($userTaken == $regUser)
{
	$regTaken = array('regTaken'=>"Username Taken");
	$errorCount = $errorCount + 1;
}
else
{
	$regTaken = array('regTaken'=>"Username Availible");
}
if ($emailTaken == $email)
{
	$emailTaken = array('emailTaken'=>"Email Taken");
	$errorCount = $errorCount + 1;
}
else
{
	$emailTaken = array('emailTaken'=>"Email Availible");
}
if($errorCount < 0)
{
	$null = "{null}";
	$empty ="";
	$confirmation = rand();
if ($stmt = $dbcon->prepare("INSERT INTO Users(ID,email,username,password,accountL,confirmation,confcode) 
										VALUES (?,?,?,?,?,?,?)")) {
		$stmt->bind_param('ssssiis',$null ,$email, $regUser, $regPass, $accountl, $null, $confirmation);
		$stmt->execute();
		$_SESSION['regUser'] = $regUser;
	$subject = 'Do not reply - Gravity Lan account confirmation';
	$message = 'Welcome to Gravity Lan, to confirm your account please input:'."\r\n".$confirmation."\r\n".'on this page: http://homepages.shu.ac.uk/~b3006705/CATApp/confirm.html';
	$headers = 'From: GravityLan@gmail.com';
	mail($email, $subject, $message, $headers);
	$_SESSION['login']=false;
	header ("Location: confirm.html");
}	
else 
{
	header ("Location: log_reg.html");
}}
?>