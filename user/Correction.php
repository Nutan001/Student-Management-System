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
					<li id="active"><a id="logout" href="../com.sms.connection/logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="col-lg-2 col-md-2 col-sm-12"></div>
			<div id="" class="col-lg-8 col-md-8 col-sm-12 graybox">
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
						$query = "select * from correction_table";
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
										<th style="color: #803F5F;">User ID</th>
										<th style="color: #803F5F;">Correction In</th>
										<th style="color: #803F5F;">Old detail</th>
										<th style="color: #803F5F;">New detail</th>
										<th style="color: #803F5F;">Edit</th>
										<th style="color: #803F5F;">Delete</th>
									</tr>
								</thead>
								<tbody>
						<?php
							$count=1;
							while ($row= mysql_fetch_assoc($run_query))
							{
								echo "<tr>";
								echo "<th scope=\"row\">$count</th>";
								echo "<td>".$row['user_id']."</td>";
								echo "<td>".$row['correction_field']."</td>";
								echo "<td>".$row['incorrect_detail']."</td>";
								echo "<td>".$row['correct_detail']."</td>";
								echo '<td><a href="updateDetails.php?user_id='.$row['user_id'].'&correction_field='.$row['correction_field'].'&correct_detail='.$row['correct_detail'].'&incorrect_detail='.$row['incorrect_detail'].'">Edit</a>';
								echo '<td><a href="updateDetails.php?user_id='.$row['user_id'].'&token=true"> Delete</a>';
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
								echo '<h2 class="text-danger">Nothing in Here Enrollment</h2>';
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