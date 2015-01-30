<?php
session_start();
// //take all the inputted data from the log in page and place into variables and session variables for later  use
	$form_user = trim(filter_input(INPUT_POST,user, FILTER_SANITIZE_STRING)," \t\n\r\0\x0B");
	$form_pass = trim(filter_input(INPUT_POST,pass, FILTER_SANITIZE_STRING)," \t\n\r\0\x0B");
	$errorCount = 0;
	//if the inputted data is equal to nothing then set the vaibale for telling them that and send them back to the login page
include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT username,password,accountL,confirmation FROM users WHERE username=?")) {
		$stmt->bind_param('s', $form_user);
		$stmt->execute();
		$stmt->bind_result($user, $pass, $accountl,$conf);
		$stmt->fetch();
if ($form_user != $user)
{
	$user = array('user'=>"Wrong username");
	$errorCount = $errorCount + 1;
}
else 
{
	$user = array('user'=>"Correct username");
}
if (crypt($form_pass, $pass)!= $pass)
{
	$pass = array('pass'=>"Wrong password");
	$errorCount = $errorCount + 1;
}
else 
{
	$pass = array('pass'=>"Correct password");
}
if ($errorCount >= 0)
{
if ($conf == 0)
{
	$conf = array('conf'=>"Account not confirmed");
}
else
{
	$conf = array('conf'=>"Account confirmed");
}}
if($errorCount > 0)
{	
	$stmt->close();
	$dbcon->close();
	$state = array('success'=>"3");
	$result = array_merge($user, $pass, $conf, $state);
	$result = json_encode($result);
	echo($result);
}
else
{
	$_SESSION['login']=true;
	$_SESSION['currentUser']=$form_user;
	$_SESSION['timeStamp']=time();
	$_SESSION['currentUser'] = $user;
	//this is just for expantion so that i can set levels for the users, ie admin/mod/user
	if ($accountl == 0)
	{
		$_SESSION['mod']=false;
		$_SESSION['admin']=false;
		$state = array('success'=>0);
		$result = array_merge($user, $pass, $conf, $state);
		$result = json_encode($result);
		echo($result);	
	}
	else if ($accountl == 1)
	{
		$_SESSION['mod']=true;
		$_SESSION['admin']=false;
		$state = array('success'=>1);
		$result = array_merge($user, $pass, $conf, $state);
		$result = json_encode($result);
		echo($result);
	}
	else if ($accountl == 2)
	{
		$_SESSION['mod']=true;
		$_SESSION['admin']=true;
		$state = array('success'=>2);
		$result = array_merge($user, $pass, $conf, $state);
		$result = json_encode($result);
		echo($result);
	}
	else
	{
		$_SESSION['login']=false;
		$_SESSION['admin']=false;
		$_SESSION['mod']=false;
		$state = array('success'=>3);
		$result = array_merge($user, $pass, $conf, $state);
		$result = json_encode($result);
		echo($result);		
	}
$stmt->close();
$dbcon->close();}}
?>