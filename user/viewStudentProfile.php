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
	if(!empty($_SESSION['user_id'])&&(($_SESSION['user_type']=='Admin')||($_SESSION['user_type']=='Teacher')))
	{
	?>
		<div class="banner img-responsive">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" id="togglebtn"class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="glyphicon glyphicon-tasks"></span>
					</button>
					<a id="welcome" class="hidden-xs navbar-brand" href="../index.php"><b>SGSITS</b></a>
					<span id="welcome" class="text-left navbar-brand">
						Welcome, <b><?echo $_SESSION['name']?></b>
						<!--<?echo 'Welcome, <b>'.$_SESSION['user_type'].'</b> , '.$_SESSION['user_id'].'</h5>';?>-->
					</span>
				</div>
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">	
						<li class="active"><a href="../index.php" id="active">Login Home</a></li>
						<li>
						    <a id="dropdown1" class="dropdown-toggle container-fluid" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    	<span class="col-xs-1 glyphicon glyphicon-cog"></span>
								<span class="col-xs-10 visible-xs">Settings</span>
						    </a>
						    <ul class="dropdown-menu">
						    	<li class="dropdown_list"><a id="droppy" href="#"><span class="glyphicon glyphicon-user"></span>View Profile</a></li>
							    <li class="dropdown_list"><a id="droppy" href="../com.sms.connection/logout.php" class="abc"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
							</ul>
					    </li>	
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="col-lg-1 col-md-1"></div>
			<div id="feedback" class="col-lg-4 jumbotron col-md-4 col-sm-12 graybox">
				<h3 class="text-info">View Student Profile</h3>
				<p></p>
				<div class="registration in-form">
					<form method="POST" action="viewProfile.php">
						<input type="text" name="en_no" maxlength="12" placeholder="Student Enrollment Number(Press Enter)"/>
						<p></p>
						<div class="ckeck-bg">
							<div class="checkbox-form">
								<div class="check-left">	
								</div>
								<div class="check-right">														
									<input id="change_pass" type="submit" value="Search">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="registration in-form">
					<form method="POST" action="viewMarks.php">
						<input type="text" name="en_no" maxlength="12" placeholder="Student Enrollment For Marks"/>
						<p></p>
						<div class="ckeck-bg">
							<div class="checkbox-form">
								<div class="check-left">	
								</div>
								<div class="check-right">														
									<input id="change_pass" type="submit" value="Search">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-1 col-md-1"></div>
			<div id="attendance_feedback" class="col-lg-6 jumbotron col-md-6 col-sm-12">
				Student Profile Shown here....
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