<html>
<head>
	<title>Welcome, to SGSITS SMS portal</title>
	<link rel="stylesheet" type="text/css" href="../css/style_1.css">
	<link rel="stylesheet" type="text/css" href="../css/style_2.css">
	<link href="../css/style_3.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<?php
	include '../connect.inc.php';
	ob_start();
	session_start();
	if(!empty($_SESSION['user_id'])&&($_SESSION['user_type']=='Student' || $_SESSION['user_type']=='Teacher'))
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
			<div class="col-lg-3 col-md-3 col-sm-12"></div>
			<div id="" class="col-lg-6 col-md-6 col-sm-12 graybox">
				<h2 class="change_pass_heading">Change Password</h2><br>
				<?php
					if(isset($_SESSION['password']))
					{
						if(!empty($_SESSION['password']))
						{
							if(isset($_POST['opass'])&&isset($_POST['npass']))
							{
								$opass=$_POST['opass'];
								$opass=md5($opass);
								$npass=$_POST['npass'];
								$npass=md5($npass).'<br>';
								$uid = $_SESSION['user_id'];
								if($_SESSION['password']==$opass)
								{
									$query ="UPDATE `users` SET `password` ='$npass' WHERE `user_id`='$uid';";
									if($query_run=mysql_query($query))
									{
										?>
										<div class="text-success"><?php echo 'password Changed';?></div>
										<?php
									}
								}
								else
								{
									echo 'password did\'nt match' ;
								}
							}
						}
					}
				?>
				
					<div class="in-form">
						<form action="changePassword.php" method="POST">
							<input id="opass" type="password" name="opass" placeholder="Old Password" required=" ">
							<input id="npass" type="password" name="npass" placeholder="New Password" required=" ">
							<input id="cpass" type="password" name="cpass" placeholder="Confirm New Password" required=" ">
							<div class="check_pass"></div>
							<div class="ckeck-bg">
								<div class="checkbox-form">
									<div class="check-left">	
								</div>
								<div class="check-right">														
									<input disabled="disabled" id="change_pass" type="submit" value="Submit">
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