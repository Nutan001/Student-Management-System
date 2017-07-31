<?php
	ob_start();
	session_start();
	$current_file = $_SERVER['SCRIPT_NAME'];
	function loggedin()
	{
		if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type']))
		{
			if(!empty($_SESSION['user_id'])&&!empty($_SESSION['user_type']))
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
?>
