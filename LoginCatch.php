<?php
session_start();
// //take all the inputted data from the log in page and place into variables and session variables for later  use
	$form_user = trim(filter_input(INPUT_POST,user, FILTER_SANITIZE_STRING)," \t\n\r\0\x0B");
	$form_pass = trim(filter_input(INPUT_POST,pass, FILTER_SANITIZE_STRING)," \t\n\r\0\x0B");
	$errorCount = 0;
	//if the inputted data is equal to nothing then set the vaibale for telling them that and send them back to the login page
if (trim($_POST["pass"])=="")
{
	$_SESSION['nop']=true;
	$errorCount = $errorCount + 1;
}
else 
{
	$_SESSION['nop']=false;
}
if ($form_user=="")
{
	$_SESSION['nou']=true;
	$errorCount = $errorCount + 1;
}
else 
{
	$_SESSION['nou']=false;
}
if($errorCount > 0)
{	
	$_SESSION['wrongp']=false;
	$_SESSION['wrongu']=false;
	$_SESSION['login']=false;
	$myArray = array('success'=>3);
	$myReturnJson = json_encode($myArray);
	echo $myReturnJson;	
	//header ("Location: log_reg.php");
}
else{
include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT username,password,accountL,confirmation FROM users WHERE username=?")) {
		$stmt->bind_param('s', $form_user);
		$stmt->execute();
		$stmt->bind_result($user, $pass, $accountl,$conf);
		$stmt->fetch();
if ($form_user != $user)
{
	$_SESSION['wrongu']=true;
	$errorCount = $errorCount + 1;
}
else 
{
	$_SESSION['wrongu']=false;
}
if (crypt($form_pass, $pass)!= $pass)
{
	$_SESSION['wrongp']=true;
	$errorCount = $errorCount + 1;
}
else 
{
	$_SESSION['wrongp']=false;
}
if ($conf == 0)
{
	$_SESSION['noConf']=true;
	$errorCount = $errorCount + 1;
}
else
{
	$_SESSION['noConf']=false;
}
if (($_SESSION['wrongp']==true) or ($_SESSION['wrongu']==true))
{
	$_SESSION['noConf']=false;
}
if($errorCount > 0)
{	
	$_SESSION['login']=false;
	$stmt->close();
	$dbcon->close();
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
	$dbcon->close();}}}
?>