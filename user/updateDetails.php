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
			<div class="col-lg-2 col-md-2 col-sm-12"></div>
			<div id="" class="col-lg-8 col-md-8 col-sm-12 graybox">
				<?php
					if(isset($_POST['correction_field'])&&isset($_POST['user_type'])&&isset($_POST['correction_no'])&&isset($_POST['correct_detail']))
					{
						$correction_no = $_POST['correction_no'];
						$correct_detail = $_POST['correct_detail'];
						$correction_field = $_POST['correction_field'];
						$user_type_c = $_POST['user_type'];
						if($user_type_c=='Student')
						{
							if($correction_field=='name')
							{
								$query ="update users set $correction_field='$correct_detail' where user_id='$correction_no' and user_type='$user_type_c'";
								$run_query = mysql_query($query);
							}
							$query ="update student set $correction_field='$correct_detail' where en_no='$correction_no'";
							$run_query = mysql_query($query);
							if($run_query)
							{
								echo '<span class="text-success">Your Details Updated succesfully</span>';
								echo '<br><a href="updateDetails.php?user_id='.$correction_no.'&token=true">Go Home And Delete Request</a>';
							}
							else
							{
								echo '<span class="text-danger">Your Details not updated succesfully</span>';
							}
						}
						else if($user_type_c=="Teacher")
						{
							if($correction_field=='name')
							{
								$query ="update users set $correction_field='$correct_detail' where user_id='$correction_no' and user_type='$user_type_c'";
								$run_query = mysql_query($query);
							}
							$query ="update teacher set $correction_field='$correct_detail' where user_id='$correction_no'";
							$run_query = mysql_query($query);
							if($run_query)
							{
								echo '<span class="text-success">Your Details Updated succesfully</span>';
								echo '<br><a href="updateDetails.php?user_id='.$correction_no.'&token=true">Go Home And Delete Request</a>';
							}
							else
							{
								echo '<span class="text-danger">Your Details not updated succesfully</span>';
							}
						}
						else
						{
							echo '<span class="text-danger">Not Valid User</span>';
						}
					}
					if(isset($_GET['user_id'])&&!empty($_GET['user_id']))
					{
						$correction_no = $_GET['user_id'];
						if(isset($_GET['token'])&&$_GET['token']==true)
						{
							$query ="delete from correction_table where user_id='$correction_no'";
							$run_query = mysql_query($query);
							if($run_query)
							{
								echo '<h3>Deletion Done</h3>';
								header('Location: Correction.php');
							}
							else
							{
								echo 'Can\'t delete';
							}
						}
						else
						{
							if(isset($_GET['correct_detail'])&&isset($_GET['incorrect_detail'])&&isset($_GET['correction_field']))
							{
								echo 'User ID :'.$correction_no.'<br>';
								echo 'Correction In :'.$correction_field = $_GET['correction_field'].'<br>';
								echo 'Correct Detail :'.$correct_detail = $_GET['correct_detail']."<br>";
								echo 'Incorrect Detail :'.$incorrect_detail = $_GET['incorrect_detail'].'<br>';
								?>
								<div class="in-form">
									<form action="updateDetails.php" method="POST">
										<select name="correction_field" class="form-control choicebox" >
											<option value=""> Select Correction Field</option>
											<option value="name"> Name</option>
											<option value="father_name"> Father's Name</option>
											<option value="mother_name"> Mother's Name</option>
											<option value="dob"> Date Of Birth</option>
											<option value="address"> Permanent Address</option>
											<option value="t_address"> Temporary Address</option>
											<option value="phone_no"> Phone No</option>
											<option value="email"> Email ID</option>
											<option value="gender"> Gender</option>
											<option value="state"> state</option>
											<option value="sem"> Semester</option>
										</select>										
										<p></p><br>
										<input type="hidden" value="<?php echo $correction_no;?>" name="correction_no"/>
										<input type="text" name="correct_detail" placeholder="Correct Detail" required=" ">
											<div class="ckeck-bg">
											<div class="checkbox-form">
												<div class="check-left">
												<div class="check">
													<label class="checkbox"><input type="radio" name="user_type" value="Student"><i></i> Student</label>
													<label class="checkbox"><input type="radio" name="user_type" value="Teacher"><i></i> Teacher</label>
												</div>	
												</div>
											<div class="check-right">														
												<input id="change_pass" type="submit" value="Submit">
											</div>
										</div>
										</div>
									</form>
								</div>
								<?php
							}
						}
					}
					else
					{
						if(isset($_POST['sem'])&&isset($_POST['u_en_no']))
						{
							$sem = $_POST['sem'];
							$u_en_no = $_POST['u_en_no'];
							if(!empty($sem)&&!empty($u_en_no))
							{
								$year = $sem/2;
								$query="update student set sem='$sem', year='$year' where en_no='$u_en_no'";
								$run_query = mysql_query($query);
								if ($run_query) 
								{
									echo 'Updated Your Data';
								}
							}
						}
						?>
				<form action="updateDetails.php" method="POST">
					<select name="sem" class="form-control choicebox" >
						<option value=""> Select Semester</option>
						<option value="1">First sem</option>
						<option value="2">Second sem</option>
						<option value="3">Third sem</option>
						<option value="4">Fourth sem</option>
						<option value="5">Fifth sem</option>
						<option value="6">Sixth sem</option>
						<option value="7">Seventh sem</option>
						<option value="8">Eighth sem</option>
					</select>										
					<p></p><br>
					<input type="text" name="u_en_no" placeholder="Enrollnment Number" required=" ">
						<div class="ckeck-bg"><div class="checkbox-form"><div class="check-left"></div><div class="check-right">														
									<input id="change_pass" type="submit" value="Update Semester">
								</div>
							</div>
						</div>
				</form>
						<?
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