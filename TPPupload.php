<?php
session_start();
$currentU = $_SESSION['currentUser'];
$user = trim((filter_input(INPUT_POST,patient,FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
$title = trim((filter_input(INPUT_POST,title,FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
$breakdown = trim((filter_input(INPUT_POST,breakdown,FILTER_SANITIZE_STRING))," \t\n\r\0\x0B");
date_default_timezone_set('GMT');
$timeStamp = (date('Y-m-d'));
include"connect.inc.php";
$null = "{null}";
if ($stmt = $dbcon->prepare("INSERT INTO TPP(ID,username,TPPdate,title,breakdown,doctor) VALUES (?,?,?,?,?,?)")) 
	{
	$stmt->bind_param('ssssss',$null ,$user, $timeStamp, $title, $breakdown, $currentU);
	$stmt->execute();
	$result = array('state'=>"Success!");
	$result = json_encode($result);
	echo($result);
}
else
{
	$result = array('state'=>"server down");
	$result = json_encode($result);
	echo($result);
}
?>