<?php
session_start();
$currentU = $_SESSION['currentUser'];
include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT ldate,title,letter,doctor FROM letter WHERE username=? ORDER BY ID ASC")) 
{
	$stmt->bind_param('s', $currentU);
	$stmt->execute();
	$stmt->bind_result($date,$title,$letter,$doctor);
	while ($stmt->fetch()) 
	{
		$date[] = $date;
		$title[] = $title;
		$letter[] = $letter;
		$doctor[] = $doctor;
	}
	$output = array_merge($date, $title, $letter, $doctor);
	$result = json_encode($output);
	echo($result);
}
else
{
	$result = array('state'=>"server down");
	$result = json_encode($result);
	echo($result);
}
?>