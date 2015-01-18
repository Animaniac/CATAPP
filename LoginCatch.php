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
	$loginDetails = array('Username'=>"Wrong user name");
	$errorCount = $errorCount + 1;
}
else 
{
	$loginDetails = array('Username'=>"Correct user name");
}
if (crypt($form_pass, $pass)!= $pass)
{
	$loginDetails = array('Password'=>"Wrong user password");
	$errorCount = $errorCount + 1;
}
else 
{
	$loginDetails = array('Password'=>"Correct user password");
}
if ($conf == 0)
{
	$_SESSION['noConf']=true;
	$loginDetails = array('NoConf'=>"Account not confirmed");
}
else
{
	$loginDetails = array('NoConf'=>"Account confirmed");
}
if (($_SESSION['wrongp']==true) or ($_SESSION['wrongu']==true))
{
	$loginDetails = array('NoConf'=>"Account confirmed");
}
if($errorCount > 0)
{	
	$stmt->close();
	$dbcon->close();
	$myReturnJson = json_encode($loginDetails);
	echo $myReturnJson;
	$myArray = array('success'=>$form_user."v1");
	$myReturnJson = json_encode($myArray);
	echo $myReturnJson;	
	//echo ($pass."</br>");
	//echo (crypt($form_pass, $pass));
	//header ("Location: log_reg.php");
}
else
{
if (($form_user == $user) and (crypt($form_pass, $pass)== $pass))
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
			//header ("Location: home.php");
			$myArray = array('success'=>0);
			$myReturnJson = json_encode($myArray);
			echo $myReturnJson;		
		}
		else if ($accountl == 1)
		{
			$_SESSION['mod']=true;
			$_SESSION['admin']=false;
			//header ("Location: home.php");
			$myArray = array('success'=>1);
			$myReturnJson = json_encode($myArray);
			echo $myReturnJson;		
		}
		else if ($accountl == 2)
		{
			$_SESSION['mod']=true;
			$_SESSION['admin']=true;
			// header ("Location: home.php");
			//json_encode("home.php");
			$myArray = array('success'=>2);
			$myReturnJson = json_encode($myArray);
			echo $myReturnJson;		
		}
		else
		{
			$_SESSION['login']=false;
			$_SESSION['admin']=false;
			$_SESSION['mod']=false;
			$myArray = array('success'=>$form_user);
			$myReturnJson = json_encode($myArray);
			echo $myReturnJson;		
		}
	}
else
	{
		//if the username or passswords dont equal the ones on the table kick them out and set a varibale to tell them later.
		$_SESSION['login']=false;
		$myArray = array('success'=>3);
		$myReturnJson = json_encode($myArray);
		echo $myReturnJson;	
		//header ("Location: log_reg.php");
		mysqli_close($dbcon);
	}
	$stmt->close();
	$dbcon->close();}}
?>