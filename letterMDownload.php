<?php
session_start();
$currentU = $_SESSION['currentUser'];
include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT ldate,title,letter,doctor FROM letter WHERE username=? ORDER BY ID ASC")) 
{
	$stmt->bind_param('s', $currentU);
	$stmt->execute();
	$stmt->bind_result($date,$title,$letter,$doctor);
	$array = array();
	while ($stmt->fetch()) 
	{
		//$data[] = $data;
		array_push($array, array($date, $title,$doctor,$letter));
		//$date = array('date'=>$date);
		//$title = array('ltitle'=>$title);
	}
	//$output = array_merge($date, $title);
	$result = json_encode($array);
	echo($result);
}
else
{
	$result = array('state'=>"server down");
	$result = json_encode($result);
	echo($result);
}
?>