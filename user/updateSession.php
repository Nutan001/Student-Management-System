<?php
ob_start();
session_start();
if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_type']=='Admin')
	{
	if(isset($_POST['sure'])&&isset($_POST['moresure'])&&isset($_POST['mostsure']))
	{
		include '../connect.inc.php';
		$query = "delete from alert";
		$run_query = mysql_query($query);
		if($run_query)
		{
			$query = "delete from student_class";
			$run_query = mysql_query($query);
			if($run_query)
			{
				$query = "delete from teacher_class";
				$run_query = mysql_query($query);
				if($run_query)
				{
					echo 'Session Updated Completely';
				}		
			}
			else
			{
				echo 'doasdne';
			}
		}
		else
		{
			echo 'Not done';
		}
	}
	else
	{
		echo " not sure";
	}
?>
<form method="post" action="updateSession.php">
	Sure :- <input type="checkbox" name="sure">
	<input type="checkbox" name="moresure">
	<input type="checkbox" name="mostsure">
	<input type="submit" name="submit" value="Send Request">
</form>
<?php
}
}
?>