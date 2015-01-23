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
	$User = array('Username'=>"Wrong username");
	$errorCount = $errorCount + 1;
}
else 
{
	$User = array('Username'=>"Correct username");
}
if (crypt($form_pass, $pass)!= $pass)
{
	$Pass = array('Password'=>"Wrong password");
	$errorCount = $errorCount + 1;
}
else 
{
	$Pass = array('Password'=>"Correct password");
}
if ($conf == 0)
{
	$conf = array('Conf'=>"Account not confirmed");
}
else
{
	$conf = array('Conf'=>"Account confirmed");
}
if (($_SESSION['wrongp']==true) or ($_SESSION['wrongu']==true))
{
	$conf = array('Conf'=>"Account confirmed");
}
if($errorCount > 0)
{	
	$stmt->close();
	$dbcon->close();
	$User = json_encode($User);
	echo $User;
	$Pass = json_encode($Pass);
	echo $Pass;
	$conf = json_encode($conf);
	echo $conf;
	$state = array('success'=>"3");
	$state = json_encode($state);
	echo $state;	

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
			$state = array('success'=>0);
			$state = json_encode($state);
			echo $state;		
		}
		else if ($accountl == 1)
		{
			$_SESSION['mod']=true;
			$_SESSION['admin']=false;
			$state = array('success'=>1);
			$state = json_encode($state);
			echo $state;		
		}
		else if ($accountl == 2)
		{
			$_SESSION['mod']=true;
			$_SESSION['admin']=true;
			$state = array('success'=>2);
			$state = json_encode($state);
			echo $state;		
		}
		else
		{
			$_SESSION['login']=false;
			$_SESSION['admin']=false;
			$_SESSION['mod']=false;
			$state = array('success'=>$form_user);
			$state = json_encode($state);
			echo $state;		
		}
	}
else
	{
		//if the username or passswords dont equal the ones on the table kick them out and set a varibale to tell them later.
		$_SESSION['login']=false;
		$state = array('success'=>3);
		$state = json_encode($state);
		echo $state;	
		mysqli_close($dbcon);
	}
	$stmt->close();
	$dbcon->close();}}
?>