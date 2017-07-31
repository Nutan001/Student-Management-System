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
	if(!empty($_SESSION['user_id']))
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
				<?php
				if(isset($_SESSION['user_id']))
				{
					$user_id=$_SESSION['user_id'];
					if(isset($_POST['en_no'])&&!empty($_POST['en_no']))
					{
						$user_id = $_POST['en_no'];
					}
					if(!empty($user_id))
					{
						$query = "select * from student where en_no = '$user_id'";
						$run_query = mysql_query($query);
						if($run_query)
						{
						?>
						<p></p>
						<p></p>
						<h3 class="head_profile">Profile</h3>
						<p></p>
						<div class="container-fluid block_profile">
						<?php
							$row_no = mysql_num_rows($run_query);
							if($row_no==1)
							{
								$row = mysql_fetch_array($run_query);
								echo '<div class="text-center"><img src="data:image;base64,'.$row['image'].'" class="img-thumbnail" width="240"</div>';
								echo '<hr>';
								echo '<h3 class="view_profile">Name  <p class="visible-xs"></p>&nbsp <span>'.$row['name'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">DOB   <p class="visible-xs"></p>&nbsp <span>'.$row['dob'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Father Name  <p class="visible-xs"></p>&nbsp <span>'.$row['father_name'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Mother Name  <p class="visible-xs"></p>&nbsp <span>'.$row['mother_name'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Address  <p class="visible-xs"></p>&nbsp <span>'.$row['address'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">City  <p class="visible-xs"></p>&nbsp <span>'.$row['hometown'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Mobile  <p class="visible-xs"></p>&nbsp <span>'.$row['phone_no'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Category  <p class="visible-xs"></p>&nbsp <span>'.$row['category'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Admission Date  <p class="visible-xs"></p>&nbsp <span>'.$row['admission_date'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Domicile of  <p class="visible-xs"></p>&nbsp <span>'.$row['state'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Branch  <p class="visible-xs"></p>&nbsp <span>'.$row['branch'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Course  <p class="visible-xs"></p>&nbsp <span>'.$row['course'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Semester  <p class="visible-xs"></p>&nbsp <span>'.$row['sem'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Year  <p class="visible-xs"></p>&nbsp <span>'.$row['year'].' Year</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">JEE-Main Rank  <p class="visible-xs"></p>&nbsp <span>'.$row['jee_rank'].'</span></h3>';
								echo '<hr>';
								echo '<h3 class="view_profile">Schooling <p class="visible-xs"></p>&nbsp<span>'.$row['hss_school'].'</span></h3>';
							}
							else
							{
								echo '<h2 class="text-danger">Enrollment Not Found</h2>';
							}
						?>
					</div>
						<?php	
						}
					}
				}
			?>
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