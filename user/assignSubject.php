<html>
<head>
	<title>Welcome, to SGSITS SMS Portal</title>
	<link rel="stylesheet" type="text/css" href="../css/style_1.css">
	<link rel="stylesheet" type="text/css" href="../css/style_2.css">
	<link href="../css/style_3.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="../css/jquery-ui.min.css">
</head>
<body>
	<?php
	ob_start();
	session_start();
	if(!empty($_SESSION['user_id'])&&$_SESSION['user_type']=='Admin')
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
			<div class="col-lg-1 col-sm-2"></div>
			<div id="feedback" class="col-lg-10 jumbotron col-md-6 col-sm-12 graybox">
				<h3 class="text-info">Teacher Registration Form</h3>
				<?php
					include '../connect.inc.php';
					if(
						isset($_POST['year'])&&isset($_POST['semester'])&&
						isset($_POST['department'])&&isset($_POST['subject_code'])&&
						isset($_POST['teacher_id'])
						)
					{
						$year = $_POST['year'];
						$semester = $_POST['semester'];
						$department = $_POST['department'];
						$subject_code = $_POST['subject_code'];
						$teacher_id = $_POST['teacher_id'];
						if(
							!empty($year)&&!empty($semester)&&
							!empty($department)&&!empty($subject_code)&&
							!empty($teacher_id)
							)
						{
							$session_year =  date('Y');
							if(date('m')<6)
								$session_sem = 'MAY';
							else
								$session_sem = 'DEC';
							$query = "insert into teacher_class (id, subject_code, teacher_id, branch, year, semester, session_year, session_sem)
							values ( null, '$subject_code', '$teacher_id', '$department', '$year', '$semester', '$session_year', '$session_sem')";
							$run_query = mysql_query($query);
							if($run_query)
							{
								echo '<h3 class="text-success">Subject Assigned to Faculty.</h3>';
							}
							else
							{
								echo '<h3 class="text-danger">Well this is Embarrasing...some error occured</h3>';
							}
						}
						else
						{
							echo '<h3 class="text-warning"> Fill select appropriate fields.</h3>';
						}
					}
				?>
				<p></p>
				<div class="registration in-form">
					<form action="assignSubject.php" method="POST" enctype="multipart/form-data">
							<!-- Select Option to select Subject Cod -->
							<select name="year" class="form-control choicebox" >
								<option value=""> Select Year </option>
								<!--<option value="1">First Year</option>-->
								<option value="2">Second Year</option> 
								<option value="3">Third Year</option>
								<option value="4">Fourth Year</option>
							</select>
							<p></p>
							<select name="semester" class="form-control choicebox" >
								<option value=""> Select Semester </option>
								<!--<option value="1">First sem</option>
								<option value="2">Second sem</option> -->
								<option value="3">Third sem</option>
								<option value="4">Fourth sem</option>
								<option value="5">Fifth sem</option>
								<option value="6">Sixth sem</option>
								<option value="7">Seventh sem</option>
								<option value="8">Eighth sem</option>
							</select>
							<p></p>
							<select name="department" class="form-control choicebox" >
								<option value=""> Select Department </option>
								<option value="BM">Bio Medical Engineering</option>
								<option value="CE">Civil Engineering</option>
								<option value="CSE">Computer Science &amp Engineering</option>
								<option value="EC">Electronics &amp Tele Communication</option>
								<option value="EE">Electrical Engineering</option>
								<option value="EI">Electronics &amp Instrumentation</option>
								<option value="IP">Industrial Production</option>
								<option value="IT">Information Technology</option>
								<option value="ME">Mechanical Engineering</option>
							</select>
							<p></p>
							<select name="subject_code" class="form-control choicebox" >
								<?php
									
									$query = "select subject_code, department, subject_name from subjects";
									$run_query = mysql_query($query);
									if($run_query)
									{
										while($row = mysql_fetch_assoc($run_query))
											echo '<option value="'.$row['subject_code'].'">('.$row['subject_code'].') '.$row['subject_name'].'</option>';
									}
								?>
							</select>
							<p></p>
							<select name="teacher_id" class="form-control choicebox" >
								<?php
									$query = "select user_id, name from users where user_type='Teacher'";
									$run_query = mysql_query($query);
									if($run_query)
									{
										while($row = mysql_fetch_assoc($run_query))
											echo '<option value="'.$row['user_id'].'">('.$row['user_id'].') '.$row['name'].'</option>';
									}
								?>
							</select>
							<!--// Form Fiels -->	
							<div class="check_pass"></div>
							<div class="ckeck-bg">
								<div class="checkbox-form">
									<div class="check-left">	
								</div>
								<div class="check-right">														
									<input type="submit" value="Upload">
								</div>
							</div>
							</div>
						</form>
				</div>
			</div>
			<div class="col-lg-1 col-sm-2"></div>
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