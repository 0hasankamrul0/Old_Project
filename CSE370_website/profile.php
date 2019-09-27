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
			/*
			#moreCourse {
				display: none;
			} */
			
			
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
			
		</style>
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="/"><span>BRACU Teacher Student Portal</span></a></div>
				<a href="index.php">Home</a>
				<a href="dashboard.php">Dashboard</a>
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
						$student_detail_query = 'select * from student where id=\''.$_SESSION['id'].'\';';
						$student_detail_query_result = mysqli_query($con,$student_detail_query);
						$student_detail=mysqli_fetch_assoc($student_detail_query_result);
						$_SESSION['st_name'] = $student_detail['name'];
						$_SESSION['id'] = $student_detail['id'];
						$_SESSION['dep'] = $student_detail['dep'];
						$_SESSION['email'] = $student_detail['email'];
						$_SESSION['date_of_birth'] = $student_detail['date_of_birth'];
						if($student_detail['sex'] == 'M') {
							$_SESSION['sex'] = 'Male';
						} elseif ($student_detail['sex'] == 'F')  {
							$_SESSION['sex'] = 'Female';
						} else {
							$_SESSION['sex'] = 'Other';
						}
						print '<p><strong> Personal information: </strong></p>';
						print '<p><strong>Full name: </strong>'.$_SESSION['st_name'].'</strong></p>';
						print '<p><strong>Student ID: </strong>'.$_SESSION['id'].'</strong></p>';
						print '<p><strong>Department: </strong>'.$_SESSION['dep'].'</strong></p>';
						print '<p><strong>Email: </strong>'.$_SESSION['email'].'</strong></p>';
						print '<p><strong>Birth date: </strong>'.$_SESSION['date_of_birth'].'</strong></p>';
						print '<p><strong>Sex: </strong>'.$_SESSION['sex'].'</strong></p>';

						$course_detail_query = 'select course_id from `student_course` where st_id=\''.$_SESSION['id'].'\';';
						$course_detail_query_result = mysqli_query($con,$course_detail_query);

						print '<strong> Courses taken: </strong>';
						print '<ul>';
						while($course_detail=mysqli_fetch_assoc($course_detail_query_result)) {
							print '<li>'.$course_detail['course_id'].'</li>';
						}
						print '</ul>';
   
						?>
							<?php
								$ses = 'Summer 2019';
								$day[0] = 'Saturday';
								$day[1] = 'Sunday';
								$day[2] = 'Monday';
								$day[3] = 'Tuesday';
								$day[4] = 'Wednesday';
								$day[5] = 'Thursday';
								$total_day = count($day);
                                print '';

								
									print '<header class="align-center">
												<h2>Class Routine</h2>
											</header>';
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
											$slot_query = 'select * from section join student_course on section.course_id=student_course.course_id and section.section=student_course.section where student_course.st_id=\''.$_SESSION['id'].'\' and section.day_of_week='.($i+1).' and section.slot='.($j+1).' and student_course.semester=\''.$ses.'\';';
											//print $slot_query;	
											$results = mysqli_query($con, $slot_query);
											$row = mysqli_fetch_array($results);
                    						print '<td>'.$row['course_id'].'<br>'.$row['room'].'</td>';
										}
									}	
									print '</table> <br>';
								
							?>
							
													<!-- add course to generate routine -->
							
							<p>
							 <header class="align-center">
								<h3>Add course to generate routine:</h3>
							</header>
							<!--<button onclick="courseFunction()" id="courseBtn">Add course</button>-->
							</p>
							<div>
								<!--<span id="dots"></span>
								<span id="moreCourse" style="display: none">-->
									<form action="/profile.php" method="POST">
											<table class="tableBackground" width="100%">
												<tr align="center">
													<th>Course</th>
													<td>
														<select name="c">
															<option value="">- Select Course -</option>
															<?php
															$course_detail_query = 'SELECT DISTINCT(course_id) FROM section ORDER BY course_id;';
															$course_detail_query_result = mysqli_query($con,$course_detail_query);
															while($course_detail=mysqli_fetch_assoc($course_detail_query_result)) {
																print '<option value="'.$course_detail['course_id'].'">'.$course_detail['course_id'].'</option>';
															}
															?>
														</select>
													</td>
														</select>
													</td>
													<td>
														<select name="Sec">
															<option value="">- Select Section -</option>
															<?php
															$course_detail_query = 'SELECT DISTINCT(section) FROM section ORDER BY section;';
															$course_detail_query_result = mysqli_query($con,$course_detail_query);
															while($course_detail=mysqli_fetch_assoc($course_detail_query_result)) {
																print '<option value="'.$course_detail['section'].'">Section-'.$course_detail['section'].'</option>';
															}
															?>
														</select>
													</td>
												</tr>
											</table> <br>
											<input type="submit" name="courseAdd" value="Update" class="btn">
										</form><br>
								<!--</span>-->
							</div>
						<?php
						if(isset($_POST['courseAdd']) && !empty($_POST['c']) && !empty($_POST['Sec'])) {
									$query='insert into student_course values(\''.$_SESSION['id'].'\', \''.$_POST['c'].'\', \''.$_POST['Sec'].'\' , \''.$ses.'\');';
									$query_run = mysqli_query($con,$query);
									if($query_run)	{
										echo '<script type="text/javascript">alert("COURSE ADDED \n XOXO ")</script>';
										header("Refresh:0");
									}
								}
						?>	
						<!-- Remove course -->
							 <header class="align-center">
								<h3>Remove taken courses: </h3>
							</header>
							<!--<button onclick="courseFunction()" id="courseBtn">Add course</button>-->
							</p>
							<div>
								<!--<span id="dots"></span>
								<span id="moreCourse" style="display: none">-->
									<form action="/profile.php" method="POST">
											<table class="tableBackground" width="100%">
												<tr align="center">
													<th>Course</th>
													<td>
														<select name="cour">
															<option value="">- Select Course -</option>
															<?php
															$course_detail_query = 'select course_id from `student_course` where st_id=\''.$_SESSION['id'].'\' ORDER BY course_id;';
															$course_detail_query_result = mysqli_query($con,$course_detail_query);
															while($course_detail=mysqli_fetch_assoc($course_detail_query_result)) {
																print '<option value="'.$course_detail['course_id'].'">'.$course_detail['course_id'].'</option>';
															}
															?>
														</select>
													</td>
												</tr>
											</table> <br>
											<input type="submit" name="courseRemove" value="Update" class="btn">
										</form><br>
								<!--</span>-->
							</div>
								<?php
								if(isset($_POST['courseRemove']) && !empty($_POST['cour'])) {	
									$del_query='delete from student_course where st_id='.$_SESSION['id'].' and course_id=\''.$_POST['cour'].'\';';	
									print $del_query;
									$del_query_run = mysqli_query($con,$del_query);
									if($del_query_run)	{
										echo '<script type="text/javascript">alert("COURSE REMOVED \n XOXO ")</script>';
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
										<form action="/profile.php" method="POST">
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
													<th>Birth date </th>
													<td>
														<input type="date" name="bday" class="input">
													</td>
												</tr>
												<tr align="center">
													<th>Sex </th>
													<td>
														<input type="text" name="sex" placeholder="Enter Sex M/F/O" class="input">
													</td>
												</tr>
											</table> <br>
											<input type="submit" name="personal_detail"value="Update" class="btn">
										</form>
										<?php
											if(isset($_POST['personal_detail'])) {
												@$detail[0]=$_POST['name'];
												@$detail[1]=$_POST['dept'];
												@$detail[2]=$_POST['email'];
												@$detail[3]=$_POST['bday'];
												@$detail[4]=$_POST['sex'];

												$s[0]='name';
												$s[1]='dep';
												$s[2]='email';
												$s[3]='date_of_birth';
												$s[4]='sex';
												$detail_length = count($detail);
												
												for($i=0; $i<$detail_length; $i++) {
													if(!empty($detail[$i])) {
														$del_Chan= 'update student set '.$s[$i].'=\''.$detail[$i].'\' where id=\''.$_SESSION['id'].'\';';
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
										<form action="/profile.php" method="POST">
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
														$passChan= 'update student set password=\''.$new.'\' where id='.$_SESSION['id'].';';
														$student_detail_query_result = mysqli_query($con,$passChan);
														if($student_detail_query_result)	{
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
								</div><br><br><br><br><br>
						
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