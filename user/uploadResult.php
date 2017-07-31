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
					<li id="active"><a id="logout" href="../com.sms.connection/logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
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
				<h2 class="change_pass_heading">Upload Sessional</h2><br>
				<?php
							if(isset($_POST['marks'])&&isset($_POST['subject_code'])&&isset($_POST['en_no'])&&isset($_POST['remark'])&&isset($_POST['outoff']))
							{
								$sessional=$_POST['marks'];
								$subject_code=$_POST['subject_code'];
								$en_no=$_POST['en_no'];
								$remark = $_POST['remark'];
								$outoff = $_POST['outoff'];
								$session_year =  date('Y');
									if(date('m')<6)
										$session_sem = 'MAY';
									else
										$session_sem = 'DEC';

								if(!empty($sessional)&&!empty($en_no)&&!empty($subject_code)&&(strlen($en_no)==12))
								{
									$query = "select * from sessional where en_no='$en_no' and subject_code='$subject_code' and remark='$remark'";
									$run_query = mysql_query($query);
									$row_no = mysql_num_rows($run_query);
									if($row_no==0)
									{
										$query = "insert into sessional (subject_code,marks,en_no,remark,outoff,exam_year,exam_month) values('$subject_code','$sessional','$en_no','$remark','$outoff','$session_year','$session_sem')";
										$run_query = mysql_query($query);
										if($run_query)
										{
											echo '<div class="text-success">Sessional Uploaded</div>';
										}
										else
										{
											echo '<div class="text-danger">Sessional NOT Uploaded</div>';
										}
									}
									else if($row_no==1)
									{
										$query = "UPDATE `sessional` SET `marks`=$sessional WHERE `en_no` = '$en_no' AND `remark` = '$remark' AND `subject_code`='$subject_code';";
										$run_query = mysql_query($query);
										if($run_query)
										{
											echo '<div class="text-success">Sessional UPDATED</div>';
										}
										else
										{
											echo '<div class="text-danger">Not UPDATED</div>';
										}	
									}
									else
									{
										echo "some problem with server not uploaded";
									}
								}
								else
								{
									echo '<div class="text-danger">Sessional NOT Uploaded</div>';
								}								
							}			
				?>
				
					<div class="in-form">
						<form action="uploadResult.php" method="POST">
							<label><small>Select Subject : </small></label>
							<select id="subject_code" name="subject_code" class="form-control choicebox" >
								<option value="">Select Subject : </option>
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
							<input id="sessional" type="text" name="marks" placeholder="Sessional marks" maxlength="2" required=" ">
							<p></p>
							<input type="text" name="outoff" placeholder="Out Off Marks" maxlength="3" required=" ">
							<p></p>
							<input type="text" name="remark" placeholder="Marks of(Test, Midterm etc)" maxlength="100" required=" ">
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