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
						$session_year =  date('Y');
							if(date('m')<6)
								$session_sem = 'MAY';
							else
								$session_sem = 'DEC';
						$query = "select * from sessional where en_no = '$user_id' and exam_year='$session_year' and exam_month='$session_sem'";
						$run_query = mysql_query($query);
						if($run_query)
						{
						?>
						<p></p>
						<p></p>
						<h3 class="head_profile">Marks</h3>
						<p></p>
						<div class="container-fluid block_profile">
						<?php
							$row_no = mysql_num_rows($run_query);
							if($row_no>0)
							{?>
							<div id="attendance">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th style="color: #803F5F;">#</th>
										<th style="color: #803F5F;">Subject</th>
										<th style="color: #803F5F;">Marks Obtained</th>
										<th style="color: #803F5F;">Outoff</th>
										<th style="color: #803F5F;">Remark</th>
									</tr>
								</thead>
								<tbody>
						<?php
							$count=1;
							while ($row= mysql_fetch_assoc($run_query))
							{
								echo "<tr>";
								echo "<th scope=\"row\">$count</th>";
								echo "<td>".$row['subject_code']."</td>";
								echo "<td>".$row['marks']."</td>";
								echo "<td>".$row['outoff']."</td>";
								echo "<td>".$row['remark']."</td>";
								echo "</tr>";
								$count++;
							}
						?>
								</tbody>
							</table>
						</div>
							<?}
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