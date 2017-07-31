<?php
	require 'connect.inc.php';
	require 'main.inc.php';
	if(loggedin())
	{
		echo 'logged in here';
		echo '<a href="com.sms.connection/logout.php">Log Out</a>';
		if($_SESSION['user_type']=='Admin')
		{
			//include 'admin.php';
			header('Location: user/admin.php');
		}
		else if($_SESSION['user_type']=='Student')
		{
			header("Location: user/student.php");
		}
		else if($_SESSION['user_type']=='Teacher')
		{
			header("Location: user/teacher.php");
		}
	}
	else
	{
		include 'logincheck.php';
	}
?>
