<html>
<head>
	<title>Welcome, to SGSITS SMS portal</title>
	<link rel="stylesheet" type="text/css" href="../css/style_1.css">
	<link rel="stylesheet" type="text/css" href="../css/style_2.css">
	<link href="../css/style_3.css" rel="stylesheet" type="text/css" media="all" />
	<script src="../js/jquery-1.11.1.min.js"></script>
</head>
<body>
	<?php
	include '../connect.inc.php';
	ob_start();
	session_start();
	if(!empty($_SESSION['user_id'])&&$_SESSION['user_type']=='Teacher')
	{
	?>
		<div class="banner img-responsive">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<ul class="navbar-header">
					<a id="welcome" class="hidden-xs navbar-brand" href="../index.php"><b>SGSITS</b></a>
					<span id="welcome" class="text-left navbar-brand">
						Welcome, <b><?echo $_SESSION['name']?></b>
					</span>
				</ul>
				<ul class="nav navbar-nav">
					<li id="active"><a id="logout" href="../index.php">Login Home</a></li>
					<li id="active"><a id="logout" href="../com.sms.connection/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
				<div class="visible-sm col-sm-2"></div>
					<div class="col-lg-4 jumbotron col-md-4 col-sm-8 graybox">
					<br>
						<?php
							include '../connect.inc.php';
							$query="select phone_no, father_name, dob, email, image from teacher where user_id='".$_SESSION['user_id']."'";
							$run_query = mysql_query($query);
							if($run_query)
							{
								if(mysql_num_rows($run_query) == 1)
								{
									while($row = mysql_fetch_assoc($run_query))
									{
										echo '<img src="data:image;base64,'.$row['image'].'" class="img-thumbnail" width="240"';
						?>
					<br>
					<hr>
					<div class="text-left">
						<h4><span class="glyphicon glyphicon-user"></span> - <? echo $_SESSION['name']?></h4><hr>
						<h4>S/O - <? echo $row['father_name']?></h4>
						<p></p>
						<h4><span class="glyphicon glyphicon-phone"></span>  - <? echo $row['phone_no']?></h4>
						<p></p>
						<h4><span class="glyphicon glyphicon-envelope"></span>  - <? echo $row['email']?></h4>
					</div>
						<?php			}
								}
							}
						?>
			</div>
			<div class="col-lg-1 col-md-1"></div>
			<div id="feedback" class="col-lg-6 jumbotron col-md-6 col-sm-12 graybox">
				<h2 class="change_pass_heading">Fill Attendance</h2><br>
				<?php
							if(isset($_POST['att_obtain'])&&isset($_POST['subject_code'])&&isset($_POST['en_no'])&&isset($_POST['outoff_attendance']))
							{
								$att_obtain=$_POST['att_obtain'];
								$outoff_attendance = $_POST['outoff_attendance'];
								$subject_code=$_POST['subject_code'];
								$en_no=$_POST['en_no'];

								if(!empty($att_obtain)&&!empty($en_no)&&!empty($subject_code)&&!empty($outoff_attendance)&&(strlen($en_no)==12))
								{
									$query = "select * from attendance where en_no='$en_no' and subject_code='$subject_code'";
									$run_query = mysql_query($query);
									$row_no = mysql_num_rows($run_query);
									if($row_no==0)
									{
										$session_year =  date('Y');
										if(date('m')<6)
											$session_sem = 'MAY';
										else
											$session_sem = 'DEC';
										$query = "insert into attendance (subject_code,en_no,att_obtain,outoff_attendance,session_year,session_sem)
										 values('$subject_code','$en_no','$att_obtain','$outoff_attendance','$session_year', '$session_sem')";
										$run_query = mysql_query($query);
										if($run_query)
										{
											echo '<div class="text-success">Attendance Filled</div>';
										}
										else
										{
											echo '<div class="text-danger">Attendance Can\'t be filled</div>';
										}
									}
									else if($row_no==1)
									{
										$session_year =  date('Y');
										if(date('m')<6)
											$session_sem = 'MAY';
										else
											$session_sem = 'DEC';
										$query = "UPDATE `attendance` SET `outoff_attendance`='$outoff_attendance', `session_year`='$session_year', `session_sem`='$session_sem' WHERE `subject_code`='$subject_code';";
										$run_query = mysql_query($query);
										if($run_query)
										{
											$query = "UPDATE `attendance` SET `att_obtain`=$att_obtain WHERE `en_no` = '$en_no' AND `subject_code`='$subject_code';";
											$run_query = mysql_query($query);
											if($run_query)
											{
												echo '<div class="text-success">Attendance UPDATED</div>';
											}
											else
											{
												echo '<div class="text-danger">Not UPDATED</div>';
											}
										}	
									}
									else
									{
										echo "some problem with server not uploaded";
									}
								}
								else
								{
									echo '<div class="text-danger">Attendance NOT Uploaded</div>';
								}								
							}			
				?>
					<div class="in-form">
						<form action="uploadAttendance.php" method="POST">
							<!-- Select Option to select Subject Cod -->
							<label><small>Select Subject : </small></label>
							<select id="subject_code" name="subject_code" class="form-control choicebox" >
							<?php
								$session_year =  date('Y');
								if(date('m')<6)
									$session_sem = 'MAY';
								else
									$session_sem = 'DEC';
								$query = "select subject_code from teacher_class where teacher_id='".$_SESSION['user_id']."' and session_sem='$session_sem' and session_year=$session_year";
								$run_query = mysql_query($query);
								if($run_query)
								{
							?>
							<?php
									while ($row = mysql_fetch_assoc($run_query))
									{
							?>
								<option value="<?echo $row['subject_code'];?>"><?echo $row['subject_code'];?></option>
							<?php
									}
								}
							?>
							</select>
							<p></p>
							<!-- Select Option to select Subject Cod -->
							<label><small>Select Student : </small></label>
							<select id="student_list" name="en_no" class="form-control choicebox" >
							<?php
								$query = "select * from teacher_class where teacher_id='".$_SESSION['user_id']."' and session_sem='$session_sem' and session_year=$session_year";
								$run_query = mysql_query($query);
								if($run_query)
								{	
									while ($row = mysql_fetch_assoc($run_query))
									{
										$department = $row['branch'];
										$sem = $row['semester'];
										$subject_code = $row['subject_code'];
										$sub_query = "select en_no, name from student where branch='$department' and sem='$sem'";
										$run_sub_query = mysql_query($sub_query);
										echo '<option>Student In:-----------'.$row['subject_code'].'------------</option>';
										if($run_sub_query)
										{
											while($row_sub = mysql_fetch_assoc($run_sub_query))
											{
												?>
													<option value="<?echo $row_sub['en_no'];?>"><?echo '('.$row_sub['en_no'].') '.$row_sub['name'];?></option>
												<?
											}
										}
									}
								}
							?>
							</select>
							<p></p>
							<input id="att_obtain" type="text" name="att_obtain" placeholder="Attended Class" maxlength="2" required=" ">
							<p></p>
							<input id="outoff_attendance" type="text" name="outoff_attendance" placeholder="Total Classes held" maxlength="2" required=" ">
							<div class="check_pass"></div>
							<div class="ckeck-bg">
								<div class="checkbox-form">
									<div class="check-left">	
								</div>
								<div class="check-right">														
									<input id="change_pass" type="submit" value="Upload">
								</div>
								</div>
							</div>
						</form>
					</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12"></div>	
		</div>
	</div>
	<?php
	}
	else
	{
		header("Location: ../index.php");
	}
	?>
</body>
</html>