<?php
$errorCount = 0;
$email = filter_input(INPUT_POST,email, FILTER_SANITIZE_STRING);
$emailR = filter_input(INPUT_POST,emailR, FILTER_SANITIZE_STRING);
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
$regUser = trim(filter_input(INPUT_POST,regUser, FILTER_SANITIZE_STRING)," \t\n\r\0\x0B");
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
if ($emailTaken == $email)
{
	$emailTaken = array('emailTaken'=>"Email Taken");
	$errorCount = $errorCount + 1;
}}else{
$regTaken = array('regTaken'=>"Username Availible");
$emailTaken = array('emailTaken'=>"Email Availible");
}}
if($errorCount <= 0)
{
	$stmt->close();
	$dbcon->close();
	$accountl = 0;
	$null = "{null}";
	$empty ="";
	$confirmation = rand();
	include"connect.inc.php";
if ($stmt = $dbcon->prepare("INSERT INTO users(ID,email,username,password,accountL,confirmation,confcode) 
										VALUES (?,?,?,?,?,?,?)")) {
		$stmt->bind_param('ssssiss',$null ,$email, $regUser, $regPass, $accountl, $null, $confirmation);
		$stmt->execute();
		$_SESSION['regUser'] = $regUser;
	$subject = 'Do not reply - Account Confirmation';
	$message = 'Welcome to the Cognitive Analytic Therapy App, to confirm your account please input:'."\r\n".$confirmation."\r\n".'on this page: http://homepages.shu.ac.uk/~b3006705/CATApp/confirm.html';
	$headers = 'From: catapp@gmail.com';
	mail($email, $subject, $message, $headers);
	$state = array('success'=>2);
	$result = array_merge($state, $emailValid, $regTaken, $emailTaken);
	$result = json_encode($result);
	echo($result);
}
else 
{
	$state = array('success'=>3);
	$result = array_merge($state, $emailValid, $regTaken, $emailTaken);
	$result = json_encode($result);
	echo($result);
}}
?>