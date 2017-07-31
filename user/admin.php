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
					<a id="welcome" class="hidden-xs navbar-brand" href="#"><b>SGSITS</b></a>
					<span id="welcome" class="text-left navbar-brand">
						Welcome, <b><?echo $_SESSION['name']?></b>
					</span>
				</ul>
				<ul class="nav navbar-nav">
					<li id="active"><a id="logout" href="../com.sms.connection/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="visible-sm col-sm-2"></div>
			<div class="col-lg-4 jumbotron col-md-4 col-sm-8 graybox"><br>
				<h2>Welcome, Admin</h2>
				<p></p>
				<p class="sign-in-head"></p>
				<?php
					include '../connect.inc.php';
					$query = 'select * from correction_table';
					$run_query = mysql_query($query);
					$row_no = 0;
					if($run_query)
					{
						$row_no = mysql_num_rows($run_query);
					}
				?>
				<p class="link-tag" id="view_profile"><a href="Correction.php"><span class="glyphicon glyphicon-registration-mark"></span> Request <span class="badge badge-warning"><?php echo $row_no; ?></span></a></p>
				<!--<p class="link-tag" id="view_profile"><a href="updateSession.php"><span class="glyphicon glyphicon-edit"></span> Update Session </a></p>-->
				<p class="link-tag" id="view_profile"><a href="clearDue.php"><span class="glyphicon glyphicon-saved"></span> Clear Dues </a></p>
			</div>
			<div class="col-lg-1 col-md-1"></div>
			<div id="attendance_feedback" class="col-lg-6 jumbotron col-md-6 col-sm-12">
				<p></p>
				<p class="sign-in-head"></p>
				<p class="link-tag" id="view_profile"><a href="viewStudentProfile.php"><span class="glyphicon glyphicon-user"></span> View Profile</a></p>
				<p class="link-tag" id="alert"><a href="studentRegistration.php"><span class="glyphicon glyphicon-edit"></span> Student Registration</a></p>
				<p class="link-tag" id="attendance"><a href="teacherRegistration.php"><span class="glyphicon glyphicon glyphicon-pencil"></span> Teacher Registration</a></p>
				<p class="link-tag"><a href="assignSubject.php"><span class="glyphicon glyphicon-list-alt"></span> Assign Subject</a></p>
				<p class="link-tag"><a href="assignClass.php" class="abc"><span class="glyphicon glyphicon-paste"></span> Assign Class</a></p>
				<p class="link-tag"><a href="addSubject.php" class="abc"><span class="glyphicon glyphicon-plus"></span> Add Subject</a></p>
			</div>
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