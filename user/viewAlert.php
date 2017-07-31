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
				<div class="due_alert">
	<p></p>
<?php
	$sum = 0;
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{
	
			$query = "select due_remain,alert, remark, due from alert where en_no='".$_SESSION['user_id']."'";
			$run_query = mysql_query($query);
			if($run_query)
			{
				while ($row = mysql_fetch_assoc($run_query))
				{
					if($row['due']=='W'||$row['due']=='w')
						echo '<div class="alert alert-warning" role="alert">'.$row['alert'].':->'.$row['remark'].'<br> pay Remained-: '.$row['due_remain'].' ₹</div>';
					else if($row['due']=='i'||$row['due']=='I')
						echo '<div class="alert alert-danger" role="alert">'.$row['alert'].':->'.$row['remark'].'<br> pay Remained-: '.$row['due_remain'].' ₹</div>';
					else if($row['due']=='n'||$row['due']=='N')
						echo '<div class="alert alert-info" role="alert">'.$row['alert'].':->'.$row['remark'].'<br> pay Remained -: '.$row['due_remain'].' ₹</div>';
					$sum = $sum+$row['due_remain'];
				}
			}
		}
?>
<div class="well">
<div>Total Due Remain : <span class="label label-danger"><?echo $sum;?>.00 ₹</span></div>
</div>
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