<?php
if (isset($_SESSION['admin']))
	{if ($_SESSION['admin'] != true)
		{header("Location: index.php");
}}else{header("Location: index.php");
}
?>