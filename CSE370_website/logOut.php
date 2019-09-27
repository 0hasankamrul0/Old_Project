<?php
	session_start();
	require_once('config.php');
	//phpinfo();
?>	
<!DOCTYPE HTML>
<html>
	<head>
		<title>Log out |BRACU Teacher Student Portal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style>
			#more {
				display: none;
			}
			
			
			.btn {
				background-color: #4CAF50;
				color: white;
				font-weight: bold;
				font-size: 105%;
				padding: 16px 20px;
				border: none;
				cursor: pointer;
				width: 20%;
				opacity: 0.5;
			}

			.btn:hover {
				opacity: 1;
			}
			
		</style>
	</head>
	<body class="subpage">

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

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><strong>Logged out from </strong></p>
						<h2>BRACU Teacher Student Portal</h2>
					</header>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<?php 
							session_unset(); 
							session_destroy(); 
							header('Refresh: 1; URL=/');
							?>
							<header class="align-center">
								<h2>You have successfully logged out! </h2>
							</header>
							<br><br>
							<!--p align="center"> Login again!<br>
							<a href="login.php" target="_blank"><button>Login</button></a> </p>
							<p align="center"> Back to Home Page! <br>
							<a href="/" target="_blank"><button>Home</button></a> </p><br><br><br-->
						</div>
					</div>
				</div>
			</section>

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

	</body>
</html>