<!DOCTYPE html>
<html>
<head>
<title>Welcome to Student Management Portal of SGSITS</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Student management Portal of SGSITS" />
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style_3.css" rel="stylesheet" type="text/css" media="all" />
<link href='https://fonts.googleapis.com/css?family=UnifrakturMaguntia' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:600,600italic,700,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- banner -->
	<div class="banner">
		<div class="container">
			<div class="header-nav">
				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<div class="logo">
							<a class="navbar-brand" href="index.php">SGSITS,<span style="color: white;font-size: 15pt;">Student Management Portal</span></a>
						</div>
					</div>
					 <ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<!--<li><a href="services.html">How To Register</a></li>
						<li><a href="contact.html">Contact Us</a></li> -->
					  </ul>
				</nav>
			</div>
			<!---->
			<div class="col-md-6 col-sm-0">
			</div>
				<div class="col-md-6 col-sm-12 banner-info-right">
					<div class="sap_tabs">
						<br>	
						<h2 class="text-center"><span class="sign-in-head">User Sign In</span></h2>
						<br>
						<div class="container-fluid">
							<div class="sign-in-form">
								<div class="in-form">
									<form action="<?php echo $current_file;?>" method="POST">
										<input type="text" name="user_id" value="" placeholder="Username" required=" ">
										<input type="password" name="password" placeholder="Password" required=" ">
										<div class="ckeck-bg">
											<div class="checkbox-form">
												<div class="check-left">
													<div class="check">
														
													</div>
												</div>
												<div class="check-right">														
													<form action="<?php echo $current_file;?>" method="POST">
														<input type="submit" value="Login">
													</form>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!---->
		</div>
	</div>

<!--<div class="more m1">
		<a href="single.html">Learn More</a>
	</div>-->
	<div class="welcome">
		<div class="container">
			<h3>Welcome !</h3>
			<div class="line">
			</div>
			<p style="font-size: 14pt;" class="proident">This is the Home page of SGSITS Student Management Portal, You can access portal using Valid ID if you are Registered User.</p>
			<br>
			<br>
			<hr>
			<div class="welcome-grids">
				<div class="col-md-4 welcome-grid">
					<div class="welcome-grid1">
						<h4>Address</h4>
						<p>
							<address>
							  <strong style="color: #803F5f;">Shri GS Intitute Of Tech. & Science</strong><br>
							  23 Sir M. Visvesvaraya Marg,<br>
							  Indore 452003 (MP) India<br>
							  <!-- #803F5F-->
							  <abbr title="Phone">Phone:</abbr> 91-(0731) 2548334–8
							</address>
						</p>
					</div>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4 welcome-grid">
					<div class="welcome-grid1">
						<h4>Contact Numbers</h4>
						<p>
							<abbr title="phone">EPABX: </abbr> 91-(0731) 2548334–8 <br>
							<abbr title="phone">FAX: </abbr> 91-(0731) 2432540 <br>
							URL : http//www.sgsits.ac.in 
						</p>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //welcome -->

	
<!--footer-->
	<div class="footer">
		<div class="container">
			<div class="footer-row">
				<div class="col-md-3 footer-grids">
					<h4><a href="index.html">SGSITS</a></h4>
					<p>Director's Office</p>
					<p><a href="mailto:director@sgsits.ac.in">director@sgsits.ac.in</a></p>
					<p>91-(0731) 2582112, 2544415</p>
				</div>
				
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<!--//footer end -->
		<div class="container">		
			<p>Copyright © 2016 SGSITS. All rights reserved | Design by Aditya Vashishtha &amp Abhishek Verma</p>					
		</div>
	</div>
</body>
</html>
	<?php
		if(isset($_POST['user_id'],$_POST['password']))
		{
			if(isset($_POST['checkbox']))
			{
				if($_POST['checkbox']=='on')
				{
					//setcookie('','yes',time()+6000000);
				}
				else
				{
					//setcookie('remember_me','no',time()+600000);
				}
			}
			$user_id = $_POST['user_id'];
			$password = $_POST['password'];
			$pass_hash= md5($password);
			if(!empty($user_id)&&!empty($password))
			{
				$query ="SELECT `user_id`, `id`, `password`, `name`, `user_type` FROM `users` WHERE `user_id`='$user_id' AND `password`='$pass_hash'";
				if($query_run=(mysql_query($query)))
				{
					$result_num = mysql_num_rows($query_run);
					if($result_num==1)
					{
							$user = mysql_fetch_assoc($query_run);
							$_SESSION['user_id']=$user_id;
							$_SESSION['password']=$pass_hash;
							//print_r($user);
							$_SESSION['name']=$user['name'];
						 	$_SESSION['user_type']=$user['user_type'];
							'<br>Login success';
							header("Location: index.php");
					}
					else
					{
						echo '<h1 class="label label-warning" style="position: fixed; top: 50px; font-size:1em; left: 35%;">Wrong user ID or Password</h1>';
					}	
				}
				else
				{
					echo 'false user';
				}
				//".mysql_real_escap_string()."
			}
			else
			{
				echo 'Please Fill All feilds';
			}
		}	
?>
