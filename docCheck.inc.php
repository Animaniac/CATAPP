<?php
if (isset($_SESSION['doc']))
	{if ($_SESSION['doc'] != true)
		{header("Location: index.php");
}}else{header("Location: index.php");
}
?>