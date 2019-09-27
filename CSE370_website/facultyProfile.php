<?php
	session_start();
	if(!$_SESSION['logged_in'] || empty($_SESSION['initial'])) {
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
		<title>Profile |BRACU Teacher Student Portal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style>
			#more {
				display: none;
			}
			#morePass {
				display: none;
			}
			#moreCourse {
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
			.input {
				background-color: #f1f1f1;
				color: black;
				padding: 16px 20px;
				border: none;
				cursor: pointer;
				width: 50%;
				opacity: 0.8;
			}

			.input:hover {
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
			.postContainer {
				border: 2px solid #dedede;
				background-color: #ddd;
				width: 100%;
				border-radius: 5px;
				padding: 10px;
				margin: 10px 0;
			}
			
		</style>
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="/"><span>BRACU Teacher Student Portal</span></a></div>
				<a href="/">Home</a>
				<a href="facultyDashboard.php">Dashboard</a>
				<a href="logOut.php">Log out</a>
				<a href="#menu"></a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="/">Home</a></li>
					<li><a href="facultyDashboard.php">Dashboard</a></li>
					<li><a href="facultyProfile.php">Profile</a></li>
					<li><a href="logOut.php">Log out</a></li>
				</ul>
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><strong>Profile of</strong></p>
						<h2><?php echo $_SESSION['name']; ?></h2>
					</header>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
						<?php 
			    		$faculty_detail_query = 'select * from faculty where initial=\''.$_SESSION['initial'].'\';';
						$faculty_detail_query_result = mysqli_query($con,$faculty_detail_query);
						$faculty_detail=mysqli_fetch_assoc($faculty_detail_query_result);
						print '<p><strong> Personal information: </strong></p>';
						print '<p><strong>Full name: </strong>'.$faculty_detail['name'].'</strong></p>';
						print '<p><strong>Faculty initial: </strong>'.$_SESSION['initial'].'</strong></p>';
						print '<p><strong>Department: </strong>'.$faculty_detail['dep'].'</strong></p>';
						print '<p><strong>Email: </strong>'.$faculty_detail['email'].'</strong></p>';
						print '<p><strong>Room number: </strong>'.$faculty_detail['room'].'</strong></p>';

						$course_detail_query = 'select distinct(course_id) from `section` where faculty_initial=\''.$_SESSION['initial'].'\';';
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
										@$initial = $_SESSION['initial'];
										@$ses = 'Summer 2019';

										@$day[0] = 'Saturday';
										@$day[1] = 'Sunday';
										@$day[2] = 'Monday';
										@$day[3] = 'Tuesday';
										@$day[4] = 'Wednesday';
										@$day[5] = 'Thursday';
										@$total_day = count($day);

										print '<table class="tableBackground" width="100%">
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
							<br><br><br>
						<
													<!-- add TIME to generate routine -->
							
							<p>
							 <header class="align-center">
								<h3>Add Consultation Time to generate routine:</h3>
							</header>
							<!--<button onclick="courseFunction()" id="courseBtn">Add TIME</button>-->
							</p>
							<div>
								<!--<span id="dots"></span>
								<span id="moreCourse" style="display: none">-->
									<form action="/facultyProfile.php" method="POST">
											<table class="tableBackground" width="100%">
												<tr align="center">
													<th>Time</th>
													<td>
														<select name="dow">
															<option value="">- Select Day -</option>
															<option value="1">Saturday</option>
															<option value="2">Sunday</option>
															<option value="3">Monday</option>
															<option value="4">Tuesday</option>
															<option value="5">Wednesday</option>
															<option value="6">Thursday</option>
														</select>
													</td>
														</select>
													</td>
													<td>
														<select name="slo">
															<option value="">- Select Time -</option>
															<option value="1">8:00-9:20</option>
															<option value="2">9:30-10:50</option>
															<option value="3">11:00-12:20</option>
															<option value="4">12:30-1:50</option>
															<option value="5">2:00-3:20</option>
															<option value="6">3:30-4:50</option>
															<option value="7">5:00-6:20</option>
															?>
														</select>
													</td>
												</tr>
											</table> <br>
											<input type="submit" name="TimeAdd" value="Update" class="btn">
										</form><br>
								<!--</span>-->
							</div>
						<?php
						if(isset($_POST['TimeAdd']) && !empty($_POST['dow']) && !empty($_POST['slo'])) {	
									$query='insert into faculty_consultation values(\''.$_SESSION['initial'].'\', \''.$_POST['dow'].'\', \''.$_POST['slo'].'\' , \''.$ses.'\');';
									$query_run = mysqli_query($con,$query);
									if($query_run)	{
										echo '<script type="text/javascript">alert(TIME ADDED \n XOXO ")</script>';
										header("Refresh:0");
									}
								}
						?>	<br><br>
						<!-- Remove TIME -->
							 <header class="align-center">
								<h3>Remove Given Consultation Time: </h3>
							</header>
							<!--<button onclick="courseFunction()" id="courseBtn">Add TIME</button>-->
							</p>
							<div>
								<!--<span id="dots"></span>
								<span id="moreCourse" style="display: none">-->
									<form action="/facultyProfile.php" method="POST">
											<table class="tableBackground" width="100%">
												<tr align="center">
													<th>Time</th>
													<td>
														<select name="dow">
															<option value="">- Select Day -</option>
															<option value="1">Saturday</option>
															<option value="2">Sunday</option>
															<option value="3">Monday</option>
															<option value="4">Tuesday</option>
															<option value="5">Wednesday</option>
															<option value="6">Thursday</option>
														</select>
													</td>
														</select>
													</td>
													<td>
														<select name="slo">
															<option value="">- Select Time -</option>
															<option value="1">8:00-9:20</option>
															<option value="2">9:30-10:50</option>
															<option value="3">11:00-12:20</option>
															<option value="4">12:30-1:50</option>
															<option value="5">2:00-3:20</option>
															<option value="6">3:30-4:50</option>
															<option value="7">5:00-6:20</option>
															?>
														</select>
													</td>
												</tr>
											</table> <br>
											<input type="submit" name="TimeRemove" value="Update" class="btn">
										</form><br>
								<!--</span>-->
							</div>
								<?php
								if(isset($_POST['TimeRemove']) && !empty($_POST['dow']) && !empty($_POST['slo'])) {	
									$del_query='delete from faculty_consultation where faculty_initial=\''.$_SESSION['initial'].'\' and day_of_week=\''.$_POST['dow'].'\' and slot=\''.$_POST['slo'].'\' and semester=\'Summer 2019\';';	
									print $del_query;
									$del_query_run = mysqli_query($con,$del_query);
									if($del_query_run)	{
										echo '<script type="text/javascript">alert("TIME REMOVED \n XOXO ")</script>';
										header("Refresh:0");
									} else {
										print 'Somethings else is wrong';
									}
								}
						?>
						
						<!-- edit personal info -->
							<br><br><br><br><br><br>
							<p>
							<strong> Edit personal information: </strong> <br><br>
							<button onclick="myFunction()" id="myBtn" class="btn">Edit personal info</button>
							</p>
								<div>
									<span id="dots"></span>
									<span id="more" style="display: none">
										<form action="/facultyProfile.php" method="POST">
											<table class="tableBackground" width="100%">
												<tr align="center">
													<th>Full name</th>
													<td>
														<input type="text" name="name" placeholder="Type your full name" class="input">
													</td>
												</tr>
												<tr align="center">
													<th>Department </th>
													<td>
														<input type="text" name="dept" placeholder="Enter dept. e.g. CSE/CS/EEE/BBA" class="input">
													</td>
												</tr>
												<tr align="center">
													<th>Email</th>
													<td>
														<input type="email" name="email" placeholder="Enter email" class="input">
													</td>
												</tr>
												<tr align="center">
													<th>Room Number </th>
													<td>
														<input type="text" name="room" class="input">
													</td>
												</tr>
											</table> <br>
											<input type="submit" name="personal_detail"value="Update" class="btn">
										</form>
										<?php
											if(isset($_POST['personal_detail'])) {
												@$detail[0]=$_POST['name'];
												@$detail[1]=$_POST['room'];
												@$detail[2]=$_POST['email'];
												@$detail[3]=$_POST['dept'];

												$s[0]='name';
												$s[1]='room';
												$s[2]='email';
												$s[3]='dep';
												$detail_length = count($detail);
												
												for($i=0; $i<$detail_length; $i++) {
													if(!empty($detail[$i])) {
														$del_Chan= 'update faculty set '.$s[$i].'=\''.$detail[$i].'\' where initial=\''.$_SESSION['initial'].'\';';
														$del_Chan_query_result = mysqli_query($con,$del_Chan);
														if($del_Chan_query_result)	{
														echo '<script type="text/javascript">alert("Details Changed")</script>';
														header("Refresh:0");
														}
													}
												}

											}
										?>
									</span>
								</div> <br>
								
								<!-- change password -->
								<p><br><br><br>
								<strong> Change password: </strong> <br><br>
								<button onclick="passFunction()" id="passBtn" class="btn">Change password</button>
								</p>
								<div>
									<span id="dots"></span>
									<span id="morePass" style="display: none">
										<form action="/facultyProfile.php" method="POST">
											<table class="tableBackground" width="100%">
												<tr align="center">
													<th>Enter old password: </th>
													<td>
														<input type="password" name="oPassword" placeholder="Enter old password" class="input" required>
													</td>
												</tr>
												<tr align="center">
													<th>Enter new password: </th>
													<td>
														<input type="password" name="Password" placeholder="Enter new password" class="input" required>
													</td>
												</tr>
												<tr align="center">
													<th>Confirm new password:</th>
													<td>
														<input type="password" name="cPassword" placeholder="Enter new password" class="input" required>
													</td>
												</tr>
											</table> <br>
											<input type="submit" name="passwordsubmit" value="Update password" class="btn">
										</form>
										<?php 
											if(isset($_POST['passwordsubmit'])) {
												$old = $_POST['oPassword'];
												$new = $_POST['Password'];
												$newCon = $_POST['cPassword'];
												$give = $_SESSION['password'];
												print $give;
												if($new == $newCon) {
													if($give == $old) {
														$passChan= 'update faculty set password=\''.$new.'\' where initial=\''.$_SESSION['initial'].'\';';
														$faculty_detail_query_result = mysqli_query($con,$passChan);
														if($faculty_detail_query_result)	{
															echo '<script type="text/javascript">alert("Password Changed")</script>';
														} else {
														    echo '<script type="text/javascript">alert("Query did not run")</script>';
														}
													} else {
													    echo '<script type="text/javascript">alert("Old given Password is Wrong")</script>';
													}
												} else {
												    echo '<script type="text/javascript">alert("New Password do not match")</script>';
												}
											}
										?>
									</span>
								<br><br><br><br><br>
							<?php
								print '<header class="align-center">
								<h2>My Messages:</h2>
								</header>';
							    $faculty_list_query = 'select faculty.name, faculty_message.post_time ,faculty_message.message, faculty_message.id from faculty, faculty_message where faculty_message.faculty_initial=faculty.initial and faculty_message.faculty_initial=\''.$_SESSION['initial'].'\' ORDER BY faculty_message.post_time DESC;';
							  	//print $faculty_list_query;
							    $list_results = mysqli_query($con, $faculty_list_query);  
								while($list_row = mysqli_fetch_array($list_results)) {
									print '<form action="/facultyDashboard.php" method="POST">';
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
							        print'<button type="submit" name="msg" value="'.$list_row['id'].'">Delete</button>';
							        print '</form>';
							        print '<br><br>';
								}
							?>
							<br><br><br><br><br>
						
							<header class="align-center">
								<h2></h2>
							</header>
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
			<script>
			function myFunction(){
				var dots = document.getElementById("dots");
				var moreText = document.getElementById("more");
				var btnText = document.getElementById("myBtn");
				
				if (moreText.style.display === "none") {
					dots.style.display = "inline";
					btnText.innerHTML = "Hide"; 
					moreText.style.display = "inline";
				} else {
					dots.style.display = "none";
					btnText.innerHTML = "Edit personal info"; 
					moreText.style.display = "none";
				}
			}
			
			</script>
			
			<script>
			function passFunction(){
				var dots = document.getElementById("dots");
				var moreText = document.getElementById("morePass");
				var btnText = document.getElementById("passBtn");
				
				if (moreText.style.display === "none") {
					dots.style.display = "inline";
					btnText.innerHTML = "Hide"; 
					moreText.style.display = "inline";
				} else {
					dots.style.display = "none";
					btnText.innerHTML = "Change password"; 
					moreText.style.display = "none";
				}
			}
			
			</script>
			
			<script>
			function courseFunction(){
				var dots = document.getElementById("dots");
				var moreText = document.getElementById("moreCourse");
				var btnText = document.getElementById("courseBtn");
				
				if (moreText.style.display === "none") {
					dots.style.display = "inline";
					btnText.innerHTML = "Hide"; 
					moreText.style.display = "inline";
				} else {
					dots.style.display = "none";
					btnText.innerHTML = "Remove course"; 
					moreText.style.display = "none";
				}
			}
			
			</script>
			
			<!--
			<script>
			function courseFunction(){
				var dots = document.getElementById("dots");
				var moreText = document.getElementById("moreCourse");
				var btnText = document.getElementById("courseBtn");
				
				if (moreText.style.display === "none") {
					dots.style.display = "inline";
					btnText.innerHTML = "Hide"; 
					moreText.style.display = "inline";
				} else {
					dots.style.display = "none";
					btnText.innerHTML = "Add course"; 
					moreText.style.display = "none";
				}
			}
			-->
			
			</script>
			
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>