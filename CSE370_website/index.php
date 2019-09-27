<?php
	session_start();
	require_once('config.php');
	//phpinfo();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>BRACU Teacher Student Portal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="/"><span>BRACU Teacher Student Portal</span></a></div>
				<?php 
					if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] ) {
						print '<a href="/">Home</a>';
						if(empty($_SESSION['initial'])) {
					        print '<a href="dashboard.php">Dashboard</a>';
					        print '<a href="profile.php">Profile</a>';
						} elseif(empty($_SESSION['id'])) {
						    print '<a href="facultyDashboard.php">Dashboard</a>';
					        print '<a href="facultyProfile.php">Profile</a>';
						}
						print '<a href="logOut.php">Log out</a>';
					} else {
						print '<a href="login.php">Login</a>';
						print '<a href="signUp.php">Sign up</a>';
					} 
					?>
				<a href="#menu"></a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="/">Home</a></li>
					<?php 
					if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] ) {
					    if(empty($_SESSION['initial'])) {
    					    print '<li><a href="dashboard.php">Dashboard</a></li>';
    					    print '<li><a href="profile.php">Profile</a></li>';
					    } elseif(empty($_SESSION['id'])) {
					        print '<li><a href="facultyDashboard.php">Dashboard</a></li>';
    					    print '<li><a href="facultyProfile.php">Profile</a></li>';
					    }
					    print '<li><a href="logOut.php">Log out</a></li>';
					} else {
						print '<li><a href="login.php">Login</a></li>';
						print '<li><a href="signUp.php">Sign up</a></li>';
					} 
					?>
				</ul>
			</nav>

		<!-- Banner -->
			<section class="banner full">
				<article>
					<img src="https://i.ytimg.com/vi/2l63Oq10bUU/maxresdefault.jpg" alt="" />
					<div class="inner">
						<header>
							<p style="font-size:200%">Welcome to  <a href="https://templated.co"></a></p>
							<h2 style="font-size:500%">BRACU<br>Teacher Student Portal</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="https://i.ytimg.com/vi/yyAhMG1yonc/maxresdefault.jpg" alt="" />
					<div class="inner">
						<header>
							<p style="font-size:200%">Welcome to  <a href="https://templated.co"></a></p>
							<h2 style="font-size:500%">BRACU<br>Teacher Student Portal</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="https://www.bracu.ac.bd/sites/default/files/bulletin/2012/February/7th_convocation.jpg"  alt="" />
					<div class="inner">
						<header>
							<p style="font-size:200%">Welcome to  <a href="https://templated.co"></a></p>
							<h2 style="font-size:500%">BRACU<br>Teacher Student Portal</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="https://www.bracuniversitybd.info/sites/default/files/styles/home_page_banner/public/slider-images/lake-view_0bd67.jpg?itok=QfEP4P8Z"  alt="" />
					<div class="inner">
						<header>
							<p style="font-size:200%">Welcome to  <a href="https://templated.co"></a></p>
							<h2 style="font-size:500%">BRACU<br>Teacher Student Portal</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="https://media.dhakatribune.com/uploads/2017/08/BracU-Protest-08012017_Mahadi-Al-Hasnat-2_feature-edited.jpg"  alt="" />
					<div class="inner">
						<header>
							<p style="font-size:200%">Welcome to  <a href="https://templated.co"></a></p>
							<h2 style="font-size:500%">BRACU<br>Teacher Student Portal</h2>
						</header>
					</div>
				</article>
			</section>


		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<header class="align-center">
								<h2>BRACU Teacher Student Portal</h2>
							</header>
							<p> “BRACU Teacher Student Portal” is going to create a bridge between the teachers and the students of BRAC University. Often students need the contact information and consultation hours of their respective faculties which becomes quite tough for them when they find that there is no other way to access their information other than going to a university lab and then getting access to TSR. Moreover, sometimes students come to the university only to meet a faculty and find that he (the faculty) has no class in that day. In fact, it has become a common scenario due to the tough process of getting access to necessary information.</p>

							<p>Furthermore, we often see that tough teachers are sending SMS in their students’ phone number in case of some emergency declaration, students are not getting it and this miscommunication sometimes leads to some unexpected occurrences. Though Facebook and other social media can play a role here, but that can never be a formal solution. In fact, to mitigate this prevailing problem to some extent, we are building the “BRACU Teacher Student Portal”.</p>
						
							<p> Learn more about BRAC University - <a href="https://www.bracu.ac.bd/" class="button alt">BRAC University</a> </p>
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