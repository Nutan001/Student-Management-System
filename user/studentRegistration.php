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
					<a id="welcome" class="hidden-xs navbar-brand" href="#"><b>SGSITS</b></a>
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
				<h3 class="text-info">Student Registration Form</h3>
				<p></p>
				<div class="registration in-form">
					<?php
						if(
							isset($_POST['name'])&&isset($_POST['father_name'])&&
							isset($_POST['mother_name'])&&isset($_POST['dob'])&&
							isset($_POST['branch'])&&isset($_POST['p_address'])&&
							isset($_POST['hometown'])&&isset($_POST['state'])&&
							isset($_POST['t_address'])&&isset($_POST['hss_school'])&&
							isset($_POST['phone_no'])&&isset($_POST['f_phone_no'])&&
							isset($_POST['s_email'])&&isset($_POST['guardian_email'])&&
							isset($_POST['gender'])&&isset($_POST['religion'])&&
							isset($_POST['category'])&&isset($_POST['sub_category'])&&	
							isset($_POST['jee_rank'])&&isset($_POST['jeemain_marks'])&&
							isset($_POST['hss_board'])&&isset($_POST['hss_marks'])&&	
							isset($_POST['hs_board'])&&isset($_POST['hs_marks'])&&	
							isset($_POST['admission_date'])&&isset($_POST['en_no'])&&
							isset($_POST['c_sem'])&&isset($_POST['c_year']))
						{
							$name = $_POST['name'];
							$en_no = $_POST['en_no'];
							$father_name =$_POST['father_name'];
							$mother_name =$_POST['mother_name'];
							$dob = $_POST['dob'];
							$branch = $_POST['branch'];
							$p_address = $_POST['p_address'];
							$hometown = $_POST['hometown'];
							$state = $_POST['state'];
							$c_year = $_POST['c_year'];
							$c_sem = $_POST['c_sem'];
							$t_address = $_POST['t_address'];
							$phone_no = $_POST['phone_no'];
							$f_phone_no = $_POST['f_phone_no'];
							$s_email = $_POST['s_email'];
							$guardian_email = $_POST['guardian_email'];
							$gender = $_POST['gender'];
							$religion = $_POST['religion'];
							$category = $_POST['category'];
							$sub_category = $_POST['sub_category'];
							$jee_rank = $_POST['jee_rank'];
							$jeemain_marks = $_POST['jeemain_marks'];
							$hss_marks = $_POST['hss_marks'];
							$hss_board = $_POST['hss_board'];
							$hss_school = $_POST['hss_school'];
							$hs_board = $_POST['hs_board'];
							$hs_marks = $_POST['hs_marks'];
							$admission_date = $_POST['admission_date'];
							$i_name= addslashes($_FILES['image']['name']);
							$image = addslashes($_FILES['image']['tmp_name']);
							if(
								!empty($name)&&!empty($en_no)&&!empty($father_name)&&!empty($mother_name)&&
								!empty($dob)&&!empty($branch)&&!empty($p_address)&&
								!empty($state)&&!empty($hometown)&&
								!empty($s_email)&&!empty($religion)&&!empty($category)&&
								!empty($branch)&&!empty($p_address)&&!empty($sub_category)&&
								!empty($hss_board)&&!empty($hss_marks)&&!empty($hs_marks)&&
								!empty($hs_board)&&!empty($jeemain_marks)&&!empty($jee_rank)&&
								!empty($admission_date)&&!empty($i_name)&&!empty($hss_school))
							{
								include '../connect.inc.php';
								$admission_year  = intval(substr($admission_date, 0, 4));
								$image = file_get_contents($image);
								$image = base64_encode($image);
								//$query = "INSERT INTO `student` (`id`, `en_no`, `name`, `dob`, `father_name`, `mother_name`, `p_address`, `t_address`, `phone_no`, `f_phone_no`, `category`, `state`, `nationality`, `jeemain_marks`, `hss_board`, `hs_board`, `hss_marks`, `hs_marks`, `sub_category`, `gender`, `s_email`, `guardian_email`, `hss_school`, `branch`, `course`, `religion`, `admission_year`, `jee_rank`, `sem`, `year`, `image_name`, `image`, `hometown`, `admission_date`) VALUES (NULL, '$en_no', '$name', '$dob', '$father_name', '$mother_name', '$p_address', '$t_address', '$phone_no', '$f_phone_no', '$category', '$state', 'Indian', '$jeemain_marks', '$hss_board', '$hs_board', '$hss_marks', '$hs_marks', '$sub_category', '$gender', '$s_email', '$guardian_email', '$hss_school', '$branch', 'Bachelor of Engineering', '$religion', '$admission_year', '$jee_rank', '1', '1', '$i_name', $image, '$hometown', '$admission_date');";
								$query = "insert into student (id, en_no, name, father_name, mother_name, dob, address, t_address, phone_no,
								f_phone_no, category, state, nationality, jeemain_marks, hss_board, hs_board, hss_marks, hs_marks, sub_category,
								gender, email, guardian_email, hss_school, branch, course, religion, admission_year, jee_rank, sem, year, hometown, admission_date, image_name, image) 
								values (null,  '$en_no', '$name', '$father_name', '$mother_name','$dob' ,'$p_address',
								'$t_address', '$phone_no', '$f_phone_no', '$category', '$state', 'Indian', '$jeemain_marks', '$hss_board', '$hs_board',
								'$hss_marks', '$hs_marks', '$sub_category', '$gender', '$s_email', '$guardian_email', '$hss_school', '$branch', 
								'Bachelor of Engineering', '$religion', '$admission_year', '$jee_rank', '$c_sem', '$c_year','$hometown', '$admission_date', '$i_name', '$image')";
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
									values (null, '$name', '$en_no', '$password', 'Student','$session_year', '$session_sem')";
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
					<form action="studentRegistration.php" method="POST" enctype="multipart/form-data">
							<!-- Select Option to select Subject Cod -->
							<input type="text" name="name" placeholder="Student Name" maxlength="45" required="">
							<p></p>
							<input type="text" name="father_name" placeholder="Father's Name" maxlength="45" required="">
							<p></p>
							<input type="text" name="mother_name" placeholder="Mother's Name" maxlength="45" required="">
							<p></p>
							<input type="text" name="en_no" placeholder="Enroll Number" maxlength="12" required="">
							<p></p>
							<input type="text" name="dob" placeholder="Date Of Birth (YYYY-MM-DD)" maxlength="10" required="">
							<p></p>
							<select name="branch" class="form-control choicebox" >
								<option value=""> Select Branch </option>
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
							<select name="c_year" class="form-control choicebox" >
								<option value="1">First Year</option>
								<option value="2">Second year</option>
								<option value="3">Third Year</option>
								<option value="4">Fourth Year</option>
								</select>
							<p></p>
							<select name="c_sem" class="form-control choicebox" >
								<option value="1">First Semester</option>
								<option value="2">Second Semster</option>
								<option value="3">Third Semester</option>
								<option value="4">Fourth Semester</option>
								<option value="5">Fifth Semester</option>
								<option value="6">Sixth Semester</option>
								<option value="7">Seventh Semester</option>
								<option value="8">Eigth Semester</option>
							</select>
							<p></p>
							<input type="text" name="p_address" placeholder="Permanent Address here" maxlength="100" required="">
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
							<input type="text" name="t_address" placeholder="Temporary Address" maxlength="100" required="">
							<p></p>
							<input type="text" name="phone_no" placeholder="Mob. No" maxlength="10" required="">
							<p></p>
							<input type="text" name="f_phone_no" placeholder="Gardian Mob. No*" maxlength="10">
							<p></p>
							<input type="text" name="s_email" placeholder="Student Email" maxlength="100" required="">
							<p></p>
							<input type="text" name="guardian_email" placeholder="Guardian Email*" maxlength="100">
							<p></p>
							<select name="gender" class="form-control choicebox" >
									<option value=""> Select Gender </option>
									<option value="F">Female</option>
									<option value="M">Male</option>
							</select>
							<p></p>
							<select name="religion" class="form-control choicebox" >
									<option value=""> Select Religion </option>
									<option value="Christian">Christian</option>
									<option value="Hindu">Hindu</option>
									<option value="Jain">Jain</option>
									<option value="Muslim">Muslim</option>
									<option value="Sikh">Sikh</option>
									<option value="Judaism">Judaism</option>
							</select>
							<p></p>
							<select name="category" class="form-control choicebox" >
									<option value=""> Select Category </option>
									<option value="GEN">General</option>
									<option value="OBC">OBC</option>
									<option value="SC">SC</option>
									<option value="ST">ST</option>
							</select>
							<p></p>
							<select name="sub_category" class="form-control choicebox" >
									<option value=""> Sub Category </option>
									<option value="NA">Not Aplicable</option>
									<option value="NCC">NCC</option>
									<option value="TS">Technical Stream</option>
									<option value="SN">Sainik</option>
									<option value="FF">Freedom Fighter</option>
							</select>
							<p></p>
							<input type="text" name="jee_rank" placeholder="JEE-Mains Rank" maxlength="8" required="">
							<p></p>
							<input type="text" name="jeemain_marks" placeholder="JEE-Mains Marks" maxlength="8" required="">
							<p></p>
							<input type="text" name="hss_school" placeholder="12th School" maxlength="100" required="">
							<p></p>
							<input type="text" name="hss_board" placeholder="12th Board" maxlength="100" required="">
							<p></p>
							<input type="text" name="hss_marks" placeholder="12th Percentage" maxlength="8" required="">
							<p></p>
							<input type="text" name="hs_board" placeholder="10th Board" maxlength="100" required="">
							<p></p>
							<input type="text" name="hs_marks" placeholder="10th Percentage" maxlength="8" required="">
							<p></p>
							<input type="text" name="admission_date" placeholder="Date Of Admission" maxlength="10" required="">
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