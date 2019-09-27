<?php
	session_start();
	require_once('config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title> Faculty Member Sign up |BRACU Teacher Student Portal</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	/*<link rel="stylesheet" href="assets/css/main.css" />*/
	
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
	
	
</head>
<body>
<!-- Header -->
	<header id="header">
		<div class="logo"><a href="/"><span>BRACU Teacher Student Portal</span></a></div>
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
				<form action="#" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
						Sign Up as Faculty Member!
					</span>
					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Full name is reauired">
						<span class="label-input100">Full Name</span>
						<input class="input100" type="text" name="name" placeholder="Type your full name" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Faculty initial is reauired">
						<span class="label-input100">Faculty Initial</span>
						<input class="input100" type="text" name="initial" placeholder="Type your faculty initial" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Department is reauired">
						<span class="label-input100">Department</span>
						<input class="input100" type="text" name="dep" placeholder="Enter dept. e.g. CSE/CS/EEE/BBA" required>
						<span class="focus-input100" data-symbol="&#xf366;"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email is reauired">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Enter email" required>
						<span class="focus-input100" data-symbol="&#xf200;"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Phone number is reauired">
						<span class="label-input100">Room Number</span>
						<input class="input100" type="text" name="room_no" placeholder="Enter Room number" required>
						<span class="focus-input100" data-symbol="&#xf2bb;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" id="myInput" type="password" name="password" placeholder="Enter password" pattern=".{8,}" title="At least 8 or more characters" required>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<div>
						<span class="label-input100">
						<input type="checkbox" onclick="myFunction()">  Show Password
						</span>
						<div class="text-right p-t-8 p-b-31">
						</div>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Confirm Password</span>
						<input class="input100" id="myInputCon" type="password" name="cpassword" placeholder="Enter password" pattern=".{8,}" title="At least 8 or more characters" required>
						<span class="focus-input100" data-symbol="&#xf191;"></span>
					</div>
					<div>
						<span class="label-input100">
						<input type="checkbox" onclick="myFunctionCon()">  Show Password
						</span>
						<div class="text-right p-t-8 p-b-31">
						</div>
					</div>
					
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="signup" value='signup' class="login100-form-btn">
								Sign Up
							</button>
						</div>
					</div>

					<div class="txt1 text-center p-t-54 p-b-20">
						<span>
							Already Registered?
						</span>
					</div>

					<div class="flex-c-m">
						<a href="login.php" class="txt2">
							<strong>Login</strong>
						</a>
					</div>
			<?php
			if(isset($_POST['signup']))
			{
				@$name=$_POST['name'];
				@$pass=$_POST['password'];
				@$cpass=$_POST['cpassword'];
				@$initial=$_POST['initial'];
				@$dep=$_POST['dep'];
				@$email=$_POST['email'];
				@$phone=$_POST['room_no'];
				if($pass==$cpass)
				{
					$query = 'select * from faculty where initial=\''.$initial.'\';';
					print $query;
					$query_run = mysqli_query($con,$query);
					if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This Faculty Already exists.. Please try again!")</script>';
						}
						else
						{
							$query = "insert into faculty values('$initial','$name','$room_no','$email','$dep','$pass')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Faculty Registered.. Welcome")</script>';
								$_SESSION['name'] = $name;
								$_SESSION['initial'] = $initial;
								$_SESSION['logged_in'] = true;
								header( "Location: facultyDashboard.php");
								//echo "<script type='text/javascript'> document.location = 'homepage.php'; </script>";
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
				}
				
			}
			else
			{
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
	<script>
		function myFunctionCon() {
		  var x = document.getElementById("myInputCon");
		  if (x.type === "password") {
			x.type = "text";
		  } else {
			x.type = "password";
		  }
		}
	</script>
	<!-- confirm password matching -->
	<script>
		var password = document.getElementById("myInput")
		, confirm_password = document.getElementById("myInputCon");

		function validatePassword(){
		  if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords Don't Match!");
		  } else {
			confirm_password.setCustomValidity('');
		  }
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
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