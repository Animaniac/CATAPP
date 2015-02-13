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
	$stmt->bind_result($userTaken, $storedEmail);
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
	if ($storedEmail == $email)
	{
		$emailTaken = array('emailTaken'=>"Email Taken");
		$errorCount = $errorCount + 1;
	}
	else
	{
		$emailTaken = array('emailTaken'=>"Email Availible");
	}
	if($errorCount <= 0)
	{
		$stmt->close();
		$dbcon->close();
		$accountl = 0;
		$null = "{null}";
		$empty ="";
		include"connect.inc.php";
	if ($stmt = $dbcon->prepare("INSERT INTO users(ID,email,username,password,accountL) VALUES (?,?,?,?,?)")) 
		{
			$stmt->bind_param('ssssi',$null ,$email, $regUser, $regPass, $accountl);
			$stmt->execute();
			$_SESSION['regUser'] = $regUser;
			$state = array('success'=>2);
			$result = array_merge($state, $emailValid, $regTaken, $emailTaken);
			$result = json_encode($result);
			echo($result);
			$check1 = 1;
		}
		else 
		{
			$state = array('success'=>3);
			$result = array_merge($state, $emailValid, $regTaken, $emailTaken);
			$result = json_encode($result);
			echo($result);
			$check1 = 1;
		}
	}
	if ($check1 != 1)
	{
		$state = array('success'=>3);
		$result = array_merge($state, $emailValid, $regTaken, $emailTaken);
		$result = json_encode($result);
		echo($result);
	}
}
else
{
	echo "server down";
}
?>