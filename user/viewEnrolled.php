<?php
	if(isset($_POST['subject_code'])&&!empty($_POST['subject_code']))
	{
		include '../connect.inc.php';
		$session_year =  date('Y');
		if(date('m')<6)
			$session_sem = 'MAY';
		else
			$session_sem = 'DEC';
		$query = "select semester from student_class where subject_code = '".$_POST['subject_code']."' and session_year='$session_year' and session_sem='$session_sem'";
		if($run_query=mysql_query($query))
		{
			echo '<option>Select Student</option>';
			$row_no = mysql_num_rows($run_query);
			if ($row_no>0) 
			{
				$row = mysql_fetch_assoc($run_query);
				$semester = $row['semester'];
				$query = "select en_no from student where sem='$semester'";
				$run_query = mysql_query($query);
				while ($row = mysql_fetch_assoc($run_query))
				{
			?>
			   '<option value="<?echo $row['en_no'];?>"><?echo $row['en_no'];?></option>';
<?php
				}
			}
		}
	}
?>