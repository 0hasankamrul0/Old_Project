<?php
	session_start();
	require_once('config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title> Login |BRACU Teacher Student Portal</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fontss/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fontss/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/csss/util.css">
	<link rel="stylesheet" type="text/css" href="assets/csss/main.css">
<!--===============================================================================================-->
	
	
	<style>
		
		/* Create two equal columns that floats next to each other */
		.column {
		  float: left;
		  width: 50%;
		  padding: 10px;
		  
		}

		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
		
		.switch {
		  position: relative;
		  display: inline-block;
		  width: 200px;
		  height: 34px;
		}

		.switch input {display:none;}

		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #2196F3;
		  -webkit-transition: .4s;
		  transition: .4s;
		   border-radius: 34px;
		}

		.slider:before {
		  position: absolute;
		  content: "";
		  height: 26px;
		  width: 25px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		  border-radius: 50%;
		}

		input:checked + .slider {
		  background-color: #d752e3;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #d752e3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(166px);
		  -ms-transform: translateX(166px);
		  transform: translateX(166px);
		}

		/*------ ADDED CSS ---------*/
		.slider:after
		{
		 content:'As Student';
		 color: white;
		 display: block;
		 position: absolute;
		 transform: translate(-50%,-50%);
		 top: 50%;
		 left: 50%;
		 font-size: 105%;
		 font-weight: bold;
		 font-family: Arial, Helvetica, sans-serif;
		}

		input:checked + .slider:after
		{  
		  content:'As Faculty';
		}

		
	</style>
	
</head>
<body>
<!-- Header -->
			<header id="header">
				<div class="logo"><a href="/"><span>BRACU Teacher Student Portal</span></a></div>
				<a href="/">Home</a>
				<a href="signUp.php">Sign up</a>
				<a href="#menu"></a>
			</header>

	
<!-- Nav -->
	<nav id="menu">
		<ul class="links">
			<li><a href="/">Home</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="signUp.php">Sign up</a></li>
		</ul>
	</nav>
			
		
	<div class="limiter"><br>
		<div class="container-login100" style="background-image: url('assets/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form name="myForm" action="#" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
						Login
					</span>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email is reauired">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Enter email" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" id="myInput" type="password" name="password" placeholder="Enter password" required>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="row">
					  <div class="column">
						<span class="label-input100">
						<input type="checkbox" onclick="myFunction()">  Show Password
						</span>
					  </div>
					  <div class="column" align="right">
						<div class="text-right p-t-8 p-b-31">
							<a href="#">
								Forgot password?
							</a>
						</div>
					  </div>
					</div>
					
					<div align="center">
						<label class="switch">
							<input name="tog" type="checkbox" id="togBtn">
							<div class="slider round"></div>
						</label>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="login" value='Login' class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="txt1 text-center p-t-54 p-b-20">
						<span>
							Not Registered?
						</span>
					</div>

					<div class="flex-c-m">
						<a href="signUp.php" class="txt2">
							<strong>Sign Up</strong>
						</a>
					</div>

					<div class="flex-c-m">
						<a href="facultyRegister.php" class="txt2">
							<strong>Sign Up as a Faculty</strong>
						</a>
					</div>

				<?php 
				if(isset($_POST['login']))
				{
				@$email=$_POST['email'];
				@$pre_pass=$_POST['password'];
				//echo "<script type='text/javascript'> $email    $pre_pass; </script>"; 
				if(!isset($_POST['tog'])) {
				    $query = "select * from student where email='$email' and password='$pre_pass' ";
				} else {
				    $query = "select * from faculty where email='$email' and password='$pre_pass' ";
				}
				$query_run = mysqli_query($con,$query); 
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0) {
					$row=mysqli_fetch_assoc($query_run);
					$_SESSION['name'] = $row['name'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['logged_in'] = true;
					if(!isset($_POST['tog'])) {
				    	$_SESSION['id'] = $row['id'];
				    	header("Location:dashboard.php"); 
						print 'HEADER.......';
					} else {
				    	$_SESSION['initial'] = $row['initial'];
				    	header("Location:facultyDashboard.php"); 
						print 'HEADER.......';
					}
                    exit();
					} else {
						echo '<script type="text/javascript">alert("No such User exists\n             or\nInvalid Credentials")</script>';
					}
				} else {
					echo '<script type="text/javascript">alert("Database Error")</script>';
			    }
			}
			?>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	
	
	
	
<!-- Footer -->
	<footer id="footer">
		<div class="container">
			<ul class="icons">
				<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
				<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
			</ul>
		</div>
		<div class="copyright">
			&copy; BRACU Teacher Student Portal. All rights reserved.
		</div>
	</footer>

<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	
	<script>
		function myFunction() {
		  var x = document.getElementById("myInput");
		  if (x.type === "password") {
			x.type = "text";
		  } else {
			x.type = "password";
		  }
		}
	</script>
	
	
<!--===============================================================================================-->
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/jss/main.js"></script>
	
</body>
</html>


