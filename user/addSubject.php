<html>
<head>
	<title>Welcome, to SGSITS SMS Portal</title>
	<link rel="stylesheet" type="text/css" href="../css/style_1.css">
	<link rel="stylesheet" type="text/css" href="../css/style_2.css">
	<link href="../css/style_3.css" rel="stylesheet" type="text/css" media="all" />
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
					<li id="active"><a id="logout" href="../com.sms.connection/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="col-lg-1 col-sm-2"></div>
			<div id="feedback" class="col-lg-10 jumbotron col-md-6 col-sm-12 graybox">
				<h3 class="text-info">Fill Subject Details</h3>
				<?php
					include '../connect.inc.php';
					if(isset($_POST['department'])&&isset($_POST['subject_code'])&&isset($_POST['subject_name']))
					{
						$date = date('d-M-Y');
						$department = $_POST['department'];
						$subject_code = $_POST['subject_code'];
						$subject_name = $_POST['subject_name'];
						if(!empty($department)&&!empty($subject_code)&&!empty($subject_name))
						{
							$query = "insert into subjects (id, subject_code, department, subject_name, added_date)
							values ( null, '$subject_code', '$department', '$subject_name', '$date')";
							$run_query = mysql_query($query);
							if($run_query)
							{
								echo '<h3 class="text-success">Subject Added to Database.</h3>';
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
					<form action="addSubject.php" method="POST" enctype="multipart/form-data">
							<!-- Select Option to select Subject Cod -->
							<input type="text" name="subject_name" placeholder="Subject Name">
							<p></p>
							<input type="text" name="subject_code" placeholder="Subject Code" maxlength="6">
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