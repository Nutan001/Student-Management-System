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
	if(!empty($_SESSION['user_id'])&&$_SESSION['user_type']=='Teacher')
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
			<div class="col-lg-4 jumbotron col-md-4 col-sm-10 graybox">
				<br>
				<?php
					include '../connect.inc.php';
					$query="select phone_no, address, father_name, dob, email, image from teacher where user_id='".$_SESSION['user_id']."'";
					$run_query = mysql_query($query);
					if($run_query)
					{
						if(mysql_num_rows($run_query) == 1)
						{
							while($row = mysql_fetch_assoc($run_query))
							{
								echo '<img src="data:image;base64,'.$row['image'].'" class="img-thumbnail" width="150" height="175"';
				?>
				<br>
				<hr>
			<div class="text-left">
				<h4><span class="glyphicon glyphicon-user"></span> - <? echo $_SESSION['name']?></h4><hr>
				<h4><span class="glyphicon glyphicon-comment"></span> - <? echo $row['email']?></h4><hr>
				<h4><span class="glyphicon glyphicon-envelope"></span> - <? echo $row['address']?></h4><hr>
				<h4><span class="glyphicon glyphicon-phone"></span> - <? echo $row['phone_no']?></h4><hr>
			</div>
				<?php			}
						}
					}
				?>
			</div>
			<div class="col-lg-1 col-md-1"></div>
			<div id="attendance_feedback" class="col-lg-6 jumbotron col-md-6 col-sm-12">
				<p></p>
				<p class="sign-in-head"></p>
				<p class="link-tag" id="view_profile"><a href="viewStudentProfile.php"><span class="glyphicon glyphicon-user"></span> View Profile</a></p>
				<p class="link-tag" id="alert"><a href="uploadResult.php"><span class="glyphicon glyphicon-edit"></span> Upload Marks</a></p>
				<p class="link-tag" id="attendance"><a href="uploadAttendance.php"><span class="glyphicon glyphicon-plus"></span> Upload Attandance</a></p>
				<p class="link-tag"><a href="changePassword.php"><span><span class="glyphicon glyphicon-wrench"></span> Change Password</span></a></p>
				<p class="link-tag"><a href="applyCorrection.php"><span class="glyphicon glyphicon-apple"></span> Apply For Correction</a></p>
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