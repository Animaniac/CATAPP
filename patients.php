<?php
include"connect.inc.php";
if ($stmt = $dbcon->prepare("SELECT username FROM users WHERE accountL = 0 ORDER BY username ASC"))
{
	$stmt->execute();
	$stmt->bind_result($patients);
	while ($stmt->fetch()) 
	{
		$output[] = $patients;
	}
	$result = json_encode($output);
	echo($result);
}
else
{
	echo "No Result";
}
?>