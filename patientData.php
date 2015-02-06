<?php
$user = trim((filter_input(INPUT_POST,patient,FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT lastActive, email FROM users WHERE username = ?"))
{
	$stmt->bind_param('s', $user);
	$stmt->execute();
	$stmt->bind_result($lastActive,$email);
	while ($stmt->fetch()) 
	{
		$email = array('email'=>$email);
		$LA = array('lastActive'=>$lastActive);
	}
		$output = array_merge($email, $LA);
	$result = json_encode($output);
	echo($result);
}
else
{
	echo "No Result";
}
?>