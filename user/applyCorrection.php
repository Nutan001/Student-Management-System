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
				<h2 class="change_pass_heading">Apply for Correction</h2><br>				
				<?php
					if(isset($_POST['correction_field'])&&isset($_POST['incorrect_detail'])&&isset($_POST['correct_detail']))
					{
						$correct_detail = $_POST['correct_detail'];
						$correction_field = $_POST['correction_field'];
						$incorrect_detail = $_POST['incorrect_detail'];
						if(!empty($correction_field)&&!empty($correct_detail)&&!empty($incorrect_detail))
						{
							$query = "insert into correction_table (id, correction_field, incorrect_detail, correct_detail, user_id, acknowledge)
							values (null ,'$correction_field', '$incorrect_detail', '$correct_detail', '".$_SESSION['user_id']."', '0')";
							$run_query = mysql_query($query);
							if($run_query)
							{
								echo 'Request Sent';
							}
							else
							{
								echo 'Sorry could not proceed Request this time try again later';
							}
						}
						else
						{
							echo 'Please Fill all the fields.';
						}
					}
				?>
					<div class="in-form">
						<form action="applyCorrection.php" method="POST">
							<input type="text" name="correction_field" placeholder="Enter Correction Field" required=" ">
							<p></p><br>
							<input type="text" name="incorrect_detail" placeholder="Incorrect Detail" required=" ">
							<p></p><br>
							<input type="text" name="correct_detail" placeholder="Correct Detail" required=" ">
								<div class="ckeck-bg">
								<div class="checkbox-form">
									<div class="check-left">	
								</div>
								<div class="check-right">														
									<input id="change_pass" type="submit" value="Submit">
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