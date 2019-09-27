<?php
	session_start();
	if(!$_SESSION['logged_in']) {
        header("Location:login.php");
        exit(); 
    } else {
	    require_once('config.php');
    }
	//phpinfo();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Faculty members |BRACU Teacher faculty Portal</title>
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
			/* styles of messages from faculties */
			.messageContainer {
				border: 2px solid #dedede;
				background-color: #f1f1f1;
				border-radius: 5px;
				padding: 10px;
				margin: 10px 0;
			}
			.messageContainer img {
			    float: left;
			    max-width: 51px;
			    width: 100%;
			    margin-right: 20px;
			    border-radius: 50%;
			}
			
		</style>
	</head>
	<body class="subpage">

	<!-- Header -->
			<header id="header">
				<div class="logo"><a href="/"><span>BRACU Teacher Student Portal</span></a></div>
				<a href="/">Home</a>
				<?php
					if(empty($_SESSION['initial'])) {
						print '<a href="dashboard.php">Dashboard</a>';
						print '<a href="profile.php">Profile</a>';
					} elseif(empty($_SESSION['id'])) {
						print '<a href="facultyDashboard.php">Dashboard</a>';
						print '<a href="facultyProfile.php">Profile</a>';
					}
				?>
				<a href="logOut.php">Log out</a>
				<a href="#menu"></a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="/">Home</a></li>
					<?php
					if(empty($_SESSION['initial'])) {
						print '<li><a href="dashboard.php">Dashboard</a></li>
							   <li><a href="profile.php">Profile</a></li>';
					} elseif(empty($_SESSION['id'])) {
						print '<li><a href="facultyDashboard.php">Dashboard</a></li>
							   <li><a href="facultyProfile.php">Profile</a></li>';
					}
				?>	
					<li><a href="logOut.php">Log out</a></li>
				</ul>
			</nav>
		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><strong>Profile of</strong></p>
						<h2><?php echo $_SESSION['fc_name']; ?></h2>
					</header>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
						<p> Search faculty members with their initials to get their consultation hour, email address, room number and other information.</p>
							<strong> Select faculty by initials: </strong> 
							<form action="faculty.php" method="POST">
								<select name="initial_list" required>
									<option value="">- Select faculty initial -</option>
									<?php
										$faculty_detail_query = 'SELECT initial FROM faculty;';
										$faculty_detail_query_result = mysqli_query($con,$faculty_detail_query);
										while($faculty_detail=mysqli_fetch_assoc($faculty_detail_query_result)) {
										print '<option value="'.$faculty_detail['initial'].'">'.$faculty_detail['initial'].'</option>';
										}
									?>
								</select>
								<input type="submit" name="init" value="Search">
							</form> <br>
						<br><br><br><br>
						<?php 
						if(isset($_POST['init'])) {
							$_SESSION['fc_initial'] = $_POST['initial_list'];		
			    			$faculty_detail_query = 'select * from faculty where initial=\''.$_SESSION['fc_initial'].'\';';
							$faculty_detail_query_result = mysqli_query($con,$faculty_detail_query);
							$faculty_detail=mysqli_fetch_assoc($faculty_detail_query_result);
							$_SESSION['fc_name'] = $faculty_detail['name'];
							$_SESSION['room'] = $faculty_detail['room'];
							$_SESSION['fc_dep'] = $faculty_detail['dep'];
							$_SESSION['fc_email'] = $faculty_detail['email'];
							header('Location:faculty.php');        
                    		exit();
                    	} 
						$faculty_detail_query = 'select * from faculty where initial=\''.$_SESSION['fc_initial'].'\';';
						print '<p><strong> Personal information: </strong></p>';
						print '<p><strong>Full name: </strong>'.$_SESSION['fc_name'].'</strong></p>';
						print '<p><strong>Faculty initial: </strong>'.$_SESSION['fc_initial'].'</strong></p>';
						print '<p><strong>Department: </strong>'.$_SESSION['fc_dep'].'</strong></p>';
						print '<p><strong>Email: </strong>'.$_SESSION['fc_email'].'</strong></p>';
						print '<p><strong>Room number: </strong>'.$_SESSION['room'].'</strong></p>';

						$course_detail_query = 'select distinct(course_id) from `section` where faculty_initial=\''.$_SESSION['fc_initial'].'\';';
						$course_detail_query_result = mysqli_query($con, $course_detail_query);

						print '<strong> Courses taught: </strong>';
						print '<ul>';
						while($course_detail=mysqli_fetch_assoc($course_detail_query_result)) {
							print '<li>'.$course_detail['course_id'].'</li>';
						}
						print '</ul>';
						?>
							<header class="align-center">
								<h2>Consultation Hour Planner</h2>
							</header>
							<div height="600" width="1200" style="border:none">
								<?php
										@$initial = $_SESSION['fc_initial'];
										@$ses = 'Summer 2019';

										@$day[0] = 'Saturday';
										@$day[1] = 'Sunday';
										@$day[2] = 'Monday';
										@$day[3] = 'Tuesday';
										@$day[4] = 'Wednesday';
										@$day[5] = 'Thursday';
										@$total_day = count($day);

										print '<table class="tableBackground" width="100%" style="text-align:center">
											<tr  align="center">
												<th>Days </th>
												<th>8:00-9:20 </th>
												<th>9:30-10:50 </th> 
												<th>11:00-12:20 </th>
												<th>12:30-1:50 </th>
												<th>2:00-3:20 </th>
												<th>3:30-4:50 </th>
												<th>5:00-6:20 </th>
											</tr>';
										for ($i=0; $i<$total_day; $i++) {
										print '<tr align="center">';
										print '<th>'.$day[$i].'</th>';
										@$total_slot = 7;
										for($j=0; $j<$total_slot; $j++) {
											$slot_query = 'select * from section where faculty_initial=\''.$initial.'\' and day_of_week='.($i+1).' and slot='.($j+1).' and semester=\''.$ses.'\';';
											$results = mysqli_query($con, $slot_query);
											$row = mysqli_fetch_array($results);

											$consult_query = 'select * from faculty_consultation where faculty_initial=\''.$initial.'\' and day_of_week='.($i+1).' and slot='.($j+1).' and semester=\''.$ses.'\';';
											$consult_results = mysqli_query($con, $consult_query);
											print '<td>';
											print $row['course_id'];
											if(mysqli_num_rows($consult_results)>0 and !empty($row['course_id'])) {
												print '<br>Consult';
											} else if (mysqli_num_rows($consult_results)>0 and empty($row['course_id'])) {
												print 'Consult';
											}
											print '</td>';
										}
									}	
									print '</table> <br>';
								?>
							</div>
							<br><br><br><br><br>
							<?php
								print '<header class="align-center">
								<h2>Messages From '.$_SESSION['fc_name'].'</h2>
								</header>';
							    $faculty_list_query = 'select faculty.name, faculty_message.post_time ,faculty_message.message from faculty, faculty_message where faculty_message.faculty_initial=faculty.initial and faculty.initial=\''.$_SESSION['fc_initial'].'\' ORDER BY faculty_message.post_time DESC;';
							  
							    $list_results = mysqli_query($con, $faculty_list_query);  
								while($list_row = mysqli_fetch_array($list_results)) {
								    print '<div class="messageContainer">';
							        print '<div>';
							        print '<img src="images/human.png" alt="Human Icon" style="width:100%;">';
							        $a = $list_row['post_time'];  
                                    $datetime = new DateTime($a);
                                    $bd_time = new DateTimeZone('Asia/Dhaka');
                                    $datetime->setTimezone($bd_time);
							        print '<h4>'.$list_row['name'].'<br> <small><small>'
							        	.$datetime->format("d F, Y  h:i A").'</small></small> </h4>';
							        print '</div> <p>';	
							        print $list_row['message']; //message print 
							        print '</p> </div>';
								}
							?>
							<br><br><br><br><br>
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
					&copy; BRACU Teacher faculty Portal. All rights reserved.
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