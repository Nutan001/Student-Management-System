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
					<li id="active"><a id="logout" href="../com.sms.connection/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="col-lg-1 col-sm-2"></div>
			<div id="feedback" class="col-lg-10 jumbotron col-md-6 col-sm-12 graybox">
				<?php
					include '../connect.inc.php';
					if(isset($_POST['en_no']))
					{
						$en_no = $_POST['en_no'];
						if(isset($_POST['due_remain'])&&isset($_POST['due'])&&isset($_POST['alert'])&&isset($_POST['remark']))
						{
							$due_remain = $_POST['due_remain'];
							$due = $_POST['due'];
							$alert = $_POST['alert'];
							$remark = $_POST['remark'];
							if(!empty($en_no)&&!empty($due_remain)&&!empty($alert)&&!empty($remark))
							{
								$query = "insert into alert (id, en_no, due, due_remain, alert, remark) values (null, '$en_no', '$due', '$due_remain', '$alert', '$remark')";
								$run_query = mysql_query($query);
								if($run_query)
								{
									echo '<h4 class="text-success">Due Added Successfully</h4>';
								}
								else
								{
									echo '<h4 class="text-success">Request Unsuccessfull</h4>';
								}
							}
						}
						else if(isset($_POST['alert']))
						{
							$alert = $_POST['alert'];
							if(!empty($en_no)&&!empty($alert))
							{
								$query = "delete from alert where en_no='$en_no' and alert='$alert'";
								$run_query = mysql_query($query);
								if($run_query)
								{
									echo '<h4 class="text-success">Due Cleared Successfully</h4>';
								}
								else
								{
									echo '<h4 class="text-success">Request Unsuccessfull</h4>';
								}
							}
						}
					}
				?>
				<h3 class="text-info">Add Dues</h3>
				<p></p>
				<div class="registration in-form">
					<form action="clearDue.php" method="POST" enctype="multipart/form-data">
							<select name="en_no" class="form-control choicebox" >
								<option>Select Student</option>
								<?php
									$query = "select * from users where user_type='Student'";
									$run_query = mysql_query($query);
									if($run_query)
									{
										while($row = mysql_fetch_assoc($run_query))
										{
											echo '<option value="'.$row['user_id'].'">'.$row['user_id'].' '.$row['name'].'</option>';
										}
									}
								?>
							</select>
							<p></p>
							<select name="alert" class="form-control choicebox" >
								<option value="I">Select Due Of</option>
								<option value="Lib">Library</option>
								<option value="Aca">Academics</option>
								<option value="TPO">TPO</option>
							</select>
							<p></p>
							<input type="text" name="remark" maxlength="100" placeholder="Message(Remark)">
							<p></p>
							<select name="due" class="form-control choicebox" >
								<option value="I">Select Due</option>
								<option value="I">Important</option>
								<option value="W">Warning</option>
								<option value="N">Alert</option>
							</select>
							<p></p>
							<input type="text" name="due_remain" placeholder="Enter Due pay Remain">
							<div class="check_pass"></div>
							<div class="ckeck-bg">
								<div class="checkbox-form">
									<div class="check-left">	
								</div>
								<div class="check-right">														
									<input type="submit" value="Add Due">
								</div>
							</div>
							</div>
					</form>
				</div>
				<h3 class="text-info">Clear Dues</h3>
				<p></p>
				<div class="registration in-form">
					<form action="clearDue.php" method="POST" enctype="multipart/form-data">
							<select name="en_no" class="form-control choicebox" >
								<?php
									$query = "select * from alert";
									$run_query = mysql_query($query);
									if($run_query)
									{
										while($row = mysql_fetch_assoc($run_query))
										{
											$sub_query = "select name from users where user_id='".$row['en_no']."'";
											$run_sub_query = mysql_query($sub_query);
											$name_of_en_no = mysql_fetch_assoc($run_sub_query);
											echo '<option value="'.$row['en_no'].'">('.$row['en_no'].') '.$name_of_en_no['name'].'</option>';
										}
									}
								?>
							</select>
							<p></p>
							<select name="alert" class="form-control choicebox" >
								<option value="I">Select Due Of</option>
								<option value="Lib">Library</option>
								<option value="Aca">Academics</option>
								<option value="TPO">TPO</option>
							</select>
							<div class="check_pass"></div>
							<div class="ckeck-bg">
								<div class="checkbox-form">
									<div class="check-left">	
								</div>
								<div class="check-right">														
									<input type="submit" value="Clear Dues">
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