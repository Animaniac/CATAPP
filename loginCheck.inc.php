<?php
if (isset($_SESSION['login']))
	{if ($_SESSION['login'] != true)
		{header("Location: log_reg.php");
}}else{header("Location: log_reg.php");
}
?>