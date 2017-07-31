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
				<p></p>
				<div class="registration in-form">
					<?php
						if(
							isset($_POST['name'])&&isset($_POST['father_name'])&&
							isset($_POST['education_details'])&&isset($_POST['dob'])&&
							isset($_POST['department'])&&isset($_POST['address'])&&
							isset($_POST['hometown'])&&isset($_POST['state'])&&
							isset($_POST['t_address'])&&isset($_POST['ug_from'])&&
							isset($_POST['phone_no'])&&isset($_POST['pg_from'])&&
							isset($_POST['email'])&&isset($_POST['gender'])&&
							isset($_POST['experience'])&&isset($_POST['post'])&&	
							isset($_POST['joining_date'])&&isset($_POST['user_id']))
						{
							$name = $_POST['name'];
							$user_id = $_POST['user_id'];
							$father_name =$_POST['father_name'];
							$dob = $_POST['dob'];
							$department = $_POST['department'];
							$address = $_POST['address'];
							$hometown = $_POST['hometown'];
							$state = $_POST['state'];
							$t_address = $_POST['t_address'];
							$phone_no = $_POST['phone_no'];
							$email = $_POST['email'];
							$gender = $_POST['gender'];
							$experience = $_POST['experience'];
							$education_details = $_POST['education_details'];
							$ug_from = $_POST['ug_from'];
							$pg_from = $_POST['pg_from'];
							$post = $_POST['post'];
							$joining_date = $_POST['joining_date'];
							$i_name= addslashes($_FILES['image']['name']);
							$image = addslashes($_FILES['image']['tmp_name']);
							if(
								!empty($name)&&!empty($user_id)&&!empty($father_name)&&
								!empty($dob)&&!empty($department)&&!empty($address)&&
								!empty($state)&&!empty($hometown)&&!empty($email)&&
								!empty($experience)&&!empty($education_details)&&!empty($phone_no)&&
								!empty($department)&&!empty($ug_from)&&!empty($post)&&
								!empty($joining_date)&&!empty($i_name)&&!empty($gender))
							{
								include '../connect.inc.php';
								$joining_year  = intval(substr($joining_date, 0, 4));
								$image = file_get_contents($image);
								$image = base64_encode($image);
								$query = "insert into teacher (id, user_id, name, father_name, dob, address, t_address, phone_no, state, ug_from, pg_from, experience, post, gender, email, department, joining_date, hometown, image_name, image, education_details) values (null,  '$user_id',
								 '$name', '$father_name', '$dob' ,'$address', '$t_address', '$phone_no', '$state',
								'$ug_from', '$pg_from', '$experience', '$post','$gender', '$email', '$department',
								'$joining_date', '$hometown','$i_name', '$image', '$education_details')";
								$run_query = mysql_query($query);
								if($run_query)
								{
									$password = md5("abc123");
									$session_year =  date('Y');
									if(date('m')<6)
										$session_sem = 'MAY';
									else
										$session_sem = 'DEC';
									$query = "insert into users (id,name,user_id,password,user_type,session_year, session_sem)
									values (null, '$name', '$user_id', '$password', 'Teacher','$session_year', '$session_sem')";
									$run_query= mysql_query($query);
									if($run_query)
									{
										echo '<h3 class="text-success">\'Congratulations Registration Done\'</h3>';
									}
									else
									{
										echo '<h3 class="text-info">\'Registration Not Completely Done.\'</h3>';
									}
								}
								else
								{
									echo '<h3 class="text-info">\'There may be some fault in system(command)\'</h3>';
								}
							}
							else
							{
								echo '<h3 class="text-danger">\'Please Fill all fields\'</h3>';
							}
						}
					?>
					<form action="teacherRegistration.php" method="POST" enctype="multipart/form-data">
							<!-- Select Option to select Subject Cod -->
							<input type="text" name="name" placeholder="Student Name" maxlength="45" required="">
							<p></p>
							<input type="text" name="father_name" placeholder="Father's Name" maxlength="45" required="">
							<p></p>
							<input type="text" name="user_id" placeholder="Enroll Number" maxlength="12" required="">
							<p></p>
							<input type="text" name="dob" placeholder="Date Of Birth (YYYY-MM-DD)" maxlength="10" required="">
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
							<input type="text" name="post" placeholder="Designation" maxlength="100" required="">
							<p></p>
							<input type="text" name="address" placeholder="Address" maxlength="100" required="">
							<p></p>
							<input type="text" name="hometown" placeholder="City" maxlength="100" required="">
							<p></p>
							<select name="state" class="form-control choicebox" >
								<option value=""> Select State </option>
								<option value="ASSAM">Assam</option>
								<option value="BIHAR">Bihar</option>
								<option value="MAHARASTRA">Maharastra</option>
								<option value="M.P.">Madhya Pradesh</option>
								<option value="U.P.">Uttar Pradesh</option>
							</select>
							<p></p>
							<select name="gender" class="form-control choicebox" >
									<option value=""> Select Gender </option>
									<option value="F">Female</option>
									<option value="M">Male</option>
							</select>
							<p></p>
							<input type="text" name="t_address" placeholder="Temporary Address" maxlength="100" required="">
							<p></p>
						<input type="text" name="education_details" placeholder="Education details" maxlength="100" require="">
							<p></p>
							<input type="text" name="phone_no" placeholder="Mob. No" maxlength="10" required="">
							<p></p>
							<input type="text" name="email" placeholder="Email id" maxlength="100" required="">
							<p></p>
							<input type="text" name="experience" placeholder="Experience" maxlength="2">
							<p></p>
							<input type="text" name="ug_from" placeholder="UG Institute" maxlength="100">
							<p></p>
							<input type="text" name="pg_from" placeholder="PG Institute" maxlength="100">
							<p></p>
							<input type="text" name="joining_date" placeholder="Joining Date" maxlength="10" required="">
							<p></p>
							<h3>Select Photo	 :
							<input class="btn btn-info btn-lg btn-block" type="file" name="image">
							</h3>
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