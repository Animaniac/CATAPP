<?php
session_start();
$errorCount = 0;
//checking emails match
$email = filter_input(INPUT_POST,email, FILTER_SANITIZE_STRING);
$emailR = filter_input(INPUT_POST,emailR, FILTER_SANITIZE_STRING);
if ($email != $emailR)
{
	$_SESSION['emailMatch']=false;
	$errorCount = $errorCount + 1;
}
else 
{
	$_SESSION['emailMatch']=true;
}
if ((!filter_var($email, FILTER_VALIDATE_EMAIL))or(!filter_var($emailR, FILTER_VALIDATE_EMAIL)))
{
	$_SESSION['emailValid']=false;
	$errorCount = $errorCount + 1;
}
else
{
	$_SESSION['emailValid']=true;
}
//checking passwords match

$regPass = trim((filter_input(INPUT_POST,regPass, FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
$confRegPass = trim((filter_input(INPUT_POST,confRegPass, FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
if (strlen($regPass) < 8)
{
	$_SESSION['toShort']=true;
	$errorCount = $errorCount + 1;
}
else
{
	$_SESSION['toShort']=false;
}
if ($regPass != $confRegPass)
{
	$_SESSION['passMatch']=false;
	$errorCount = $errorCount + 1;
}
else 
{
	$_SESSION['passMatch']=true;
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
//setting a default account level
$accountl = 0;
//checking they inputted a username
$regUser = trim(filter_input(INPUT_POST,regUser, FILTER_SANITIZE_STRING)," \t\n\r\0\x0B");
if ($regUser == "")
{
	$_SESSION['reguserEmp']=false;
	$errorCount = $errorCount + 1;
}
else 
{
	$_SESSION['reguserEmp']=true;
}

include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT username,email FROM users Where username= ? or email= ?")) {
		$stmt->bind_param('ss', $regUser, $email);
		$stmt->execute();
		$stmt->bind_result($userTaken, $emailTaken);
		$stmt->fetch();
if ($userTaken == $regUser)
{
	//echo("nopeU");
	$_SESSION['regTaken']=true;
	$errorCount = $errorCount + 1;
}
else
{
	$_SESSION['regTaken']=false;
}
if ($emailTaken == $email)
{
	//echo("nopeG");
	$_SESSION['emailTaken']=true;
	$errorCount = $errorCount + 1;
}
else
{
	$_SESSION['emailTaken']=false;
}
//echo $errorCount."</br>";
if($errorCount > 0)
{
	//echo ($email."</br>".$emailR."</br>".$regPass."</br>".$confRegPass."</br>".$dob."</br>".$accountl."</br>".$regUser."</br>");
	//echo ($_SESSION['emailMatch']? 'true' : 'false');
	//echo ($_SESSION['passMatch']? 'true' : 'false');
	//echo ($_SESSION['regTaken']? 'true' : 'false');
	//echo ($_SESSION['emailTaken']? 'true' : 'false');
	mysqli_close($dbcon);
	header ("Location: log_reg.php");
}
else
{
	//echo("yup");
	$_SESSION['emailTaken']=false;
	$_SESSION['regTaken']=false;
	$null = "{null}";
	$empty ="";
	$confirmation = rand();
if ($stmt = $dbcon->prepare("INSERT INTO Users(ID,email,username,password,accountL,confirmation,confcode) 
										VALUES (?,?,?,?,?,?,?)")) {
		$stmt->bind_param('ssssiis',$null ,$email, $regUser, $regPass, $accountl, $null, $confirmation);
		$stmt->execute();
	//echo "user added";
		$_SESSION['regUser'] = $regUser;
	$subject = 'Do not reply - Gravity Lan account confirmation';
	$message = 'Welcome to Gravity Lan, to confirm your account please input:'."\r\n".$confirmation."\r\n".'on this page: http://homepages.shu.ac.uk/~b3006705/CATApp/confirm.php';
	$headers = 'From: GravityLan@gmail.com';
	mail($email, $subject, $message, $headers);
	$_SESSION['login']=false;
	header ("Location: confirm.php");
}	
else 
{
	//echo("user not added");
	header ("Location: log_reg.php");
}}
$stmt->close();
$dbcon->close();}
?>