<?php
	session_start();
	if(!$_SESSION['logged_in'] || empty($_SESSION['id'])) {
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
		<title>Dashboard |BRACU Teacher Student Portal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style>
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
				<a href="profile.php">Profile</a>
				<a href="logOut.php">Log out</a>
				<a href="#menu"></a>
			</header>


		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="/">Home</a></li>
					<li><a href="dashboard.php">Dashboard</a></li>
					<li><a href="profile.php">Profile</a></li>
					<li><a href="logOut.php">Log out</a></li>
				</ul>
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><strong>Welcome</strong></p>
						<h2><?php echo $_SESSION['name']; ?></h2>
					</header>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">	
							<br>
							<p> Search faculty members with their initials to get their consultation hour, email address, room number and other information.</p>
							<strong> Select faculty by initials: </strong> 
							<form action="/faculty.php" method="POST">
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

							<header class="align-center">
								<h2>Class Routine</h2>
							</header>
							<div height="600" width="1200" style="border:none">
								<?php
									if(isset($_POST['init'])) {
										$_SESSION['initial'] = $_POST['initial_list'];		
										$faculty_detail_query = 'select * from faculty where initial=\''.$_SESSION['initial'].'\';';
										$faculty_detail_query_result = mysqli_query($con,$faculty_detail_query);
										$faculty_detail=mysqli_fetch_assoc($faculty_detail_query_result);
										$_SESSION['fc_name'] = $faculty_detail['name'];
										$_SESSION['room'] = $faculty_detail['room'];
										$_SESSION['fc_dep'] = $faculty_detail['dep'];
										$_SESSION['fc_email'] = $faculty_detail['email'];
										header('Location:faculty.php');        
                    					exit();
                    				} else {
										@$id = $_SESSION['id'];
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
											//print 'ID is '.$id;
											$slot_query = 'select * from section join student_course on section.course_id=student_course.course_id and section.section=student_course.section where student_course.st_id=\''.$id.'\' and section.day_of_week='.($i+1).' and section.slot='.($j+1).' and student_course.semester=\''.$ses.'\';';
											//print $slot_query;	
											$results = mysqli_query($con, $slot_query);
											$row = mysqli_fetch_array($results);
                    						print '<td>'.$row['course_id'].'<br>'.$row['room'].'</td>';
										}
									}	
									print '</table> <br>';
								}
								?>
														</div>
							<br><br><br><br><br><br>
							<?php
								print '<header class="align-center"><h2>Messages From Course Faculties:</h2></header>';
							    $faculty_list_query = 'select faculty.name, faculty_message.post_time ,faculty_message.message from faculty, faculty_message where faculty_message.faculty_initial=faculty.initial and faculty.initial=ANY(select section.faculty_initial from section, student_course where student_course.course_id=section.course_id and student_course.section=section.section and student_course.semester=\'Summer 2019\' and student_course.st_id='.$_SESSION['id'].') ORDER BY faculty_message.post_time DESC;';
							  
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