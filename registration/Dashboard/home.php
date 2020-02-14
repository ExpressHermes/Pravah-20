<?php
/*
Filename: home.php
Purpose: Establish connection to MySQL database and login the participant, show dashboard afterwards.
Author: Harshal Dev & Nikhil Khushwaha
Last edited: 27/02/18
*/
$logincookie = "login";

$salt = "somesaltysalt";
$server = "localhost";
$user = "ietlunxt_encore";
$dbpassword = "df#!BFLBdP3H";
$database = "ietlunxt_encore";

$gens = array( "Male", "Female", "Other" );
$yous = array( "Participant", "Accompanying Faculty", "Others" );
$zones = array( "Agra", "Allahabad", "Bareilly", "Gautam Budh Nagar", "Ghaziabad", "Gorakhpur", "Lucknow", "Meerut" );
$UPI = array ( "ujwlshukla@paytm (Ujjwal Shukla)", "9598162131@upi (Markanday Upadhyay)", "9170000857@ybl (Anshu Chaturvedi)", "9918753148@paytm (Shubham Jaiswal)", "priyanshujaiswal42@okaxis (Priyanshu Jaiswal)", "7985235897@paytm (Prashant Singh)", "9457178883@ybl (Ashwani Sharma)", "9457178883@ybl (Ashwani Sharma)" );
$tshirts = array ( "Small", "Medium", "Large", "XL", "XXL" );

$_zone;

$firstname;
$lastname;
$dob;
$gender;
$email_;
$phone;
$fathername;
$mothername;
$aadhaar;
$zone;
$college;
$tshirt;
$rollno;
$events;
$youare;
$team;
$transactionID;
$transactionStatus;

$activeT = 0;
$active = 0;
if ( isset($_COOKIE["team"]) )
{
	setcookie("team", "", time() - 3600, "/");
	$active = 1;
}	

if ( isset($_COOKIE["transaction"]) )
{
	setcookie("transaction", "", time() - 3600, "/");
	$activeT = 1;
}
	
$active_ = 0;

// Are we already logged in?
if ( isset($_COOKIE[$logincookie]) )
{	
	$email = $_COOKIE["email_"];	
	$email_ = $email;
	
	// Establish connection to our database.
	$mysqli = new mysqli($server, $user, $dbpassword, $database);
	if ($mysqli->connect_errno) {
		die("Failed to connect to MySQL: " . $mysqli->connect_error);
	}
		
	// Password change request.
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newpassword"]) )
	{
		$oldpassword_ = strtoupper(md5(validateForm($_POST["oldpassword"])."".$salt));
		$newpassword_ = strtoupper(md5(validateForm($_POST["newpassword"])."".$salt));
		
		$query = $mysqli->query("SELECT id FROM accounts WHERE email='$email' AND accpassword='".$mysqli->real_escape_string($oldpassword_)."'");
		if ( $query && ( $query->num_rows > 0 ) )
		{
			$update = $mysqli->query("UPDATE accounts SET accpassword='".$mysqli->real_escape_string($newpassword_)."' WHERE email='$email'");
		}
		else
		{
			// Script alert Invalid password entered.
			$active_ = 1;
		}
	}
	
	// Retrieve account details.
	$email = $mysqli->real_escape_string($email);
	$result = $mysqli->query("SELECT firstname, lastname, dob, gender, mobile, fathername, mothername, aadhaar, zone, college, tshirt, rollno, events, youare, team, transactionid, transaction_ FROM accounts WHERE email='$email'");
	
	if ( $result && ( $result->num_rows > 0 ) )
	{
		$row = $result->fetch_assoc();
		
		$firstname = $row["firstname"];
		$lastname = $row["lastname"];
		$dob = $row["dob"];
		$gender = $row["gender"];
		$phone = $row["mobile"];
		$fathername = $row["fathername"];
		$mothername = $row["mothername"];
		$aadhaar = $row["aadhaar"];
		$zone = $row["zone"];
		$college = $row["college"];
		$tshirt = $row["tshirt"];
		$rollno = $row["rollno"];
		$events = $row["events"];
		$youare = $row["youare"];
		$team = $row["team"];
		$transactionID = $row["transactionid"];
		$transactionStatus = $row["transaction_"];

		$_zone = $zone;
		$gender = $gens[($gender - 1)];
		$zone = $zones[($zone - 1)];
		$youare = $yous[($youare - 1)];
		
		$result->close();
	}
	else 
	{
		// Login again please, something went wrong.
		setcookie("login", "", time() - 3600, "/");
		setcookie("email_", "", time() - 3600, "/");

		header("Location: ../registration.php");
		exit;
	}
	
	$mysqli->close();
}
else
{
	// Logging in for first time.
	if ( $_SERVER["REQUEST_METHOD"] == "POST" )
	{
		// Validate and store the details sent to the php script.
		$email = validateForm($_POST["email"]);
		$email_ = $email;
		$password = strtoupper(md5(validateForm($_POST["password"])."".$salt));

		// Establish connection to our database.
		$mysqli = new mysqli($server, $user, $dbpassword, $database);
		if ($mysqli->connect_errno) {
			die("Failed to connect to MySQL: " . $mysqli->connect_error);
		}
		
		// Check whether or not the entered email is registered.
		$email = $mysqli->real_escape_string($email);
		$result = $mysqli->query("SELECT firstname, lastname, dob, gender, mobile, fathername, mothername, aadhaar, zone, college, tshirt, rollno, events, youare, team, transactionid, transaction_ FROM accounts WHERE email='$email' AND accpassword='".$mysqli->real_escape_string($password)."'");
		
		if ( $result && ( $result->num_rows > 0 ) )
		{
			$row = $result->fetch_assoc();
		
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$dob = $row["dob"];
			$gender = $row["gender"];
			$phone = $row["mobile"];
			$fathername = $row["fathername"];
			$mothername = $row["mothername"];
			$aadhaar = $row["aadhaar"];
			$zone = $row["zone"];
			$college = $row["college"];
			$tshirt = $row["tshirt"];
			$rollno = $row["rollno"];
			$events = $row["events"];
			$youare = $row["youare"];
			$team = $row["team"];
			$transactionID = $row["transactionid"];
			$transactionStatus = $row["transaction_"];
		
			$_zone = $zone;
			$gender = $gens[($gender - 1)];
			$zone = $zones[($zone - 1)];
			$youare = $yous[($youare - 1)];
		
			$result->close();
			
			setcookie($logincookie, "1", time() + (86400 * 30), "/");
			setcookie("email_", $email_, time() + (86400 * 30), "/");
			
		}
		else
		{
			// User is not registered.
			setcookie("wrong", "1", time() + (86400 * 30), "/");
			header("Location: ../registration.php");
			exit;
		}
		
		$mysqli->close();
	}
	else
	{
		header("Location: ../registration.php");
		exit;
	}
}

	
function validateForm($data)
{
	if ( strlen($data) > 0 )
	{
		$data = trim($data);
		$data = stripslashes($data);		
		$data = htmlspecialchars($data);
	}
		
	return $data;
}
function decodeEvents($str)
{
	$values = array();
	$index = 0;
	$last = 0;
	for ( $i = 0; $i < strlen($str); $i++ )
	{
		if ( substr($str, $i, 1) == ";" )
		{	
			if ( substr($str, $last, 1) == "-" )
			{
				$values[$index] = "-1";
			}
			else
			{
				$values[$index] = substr($str, $last, 2);
			}
			
			$last = ($i+1);
			$index++;
		}
	}
	
	return $values;
}

function decodeTeam ($str)
{
	$values = array();
	$index = 0;
	$last = 0;
	for ( $i = 0; $i < strlen($str); $i++ )
	{
		if ( substr($str, $i, 1) == ";" )
		{	
			if ( substr($str, $last, 1) == "-" )
			{
				break;
			}
			else
			{	
				$values[$index] = substr($str, $last, $i-$last);
			}
			
			$last = ($i+1);
			$index++;
		}
	}
	
	return $values;
}
?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" />
		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}

		</script>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="css/style.css?ver=2.3" rel='stylesheet' type='text/css' />
		<!-- font CSS -->
		<!-- font-awesome icons -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- //font-awesome icons -->
		<!-- js-->
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<!--webfonts-->
		<!--animate-->
		<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/wow.min.js"></script>
		<script>
			new WOW().init();

		</script>
		<!--//end-animate-->
		<!-- Metis Menu -->
		<script src="js/metisMenu.min.js"></script>
		<script src="js/custom.js?ver=1.1"></script>
		<link href="css/custom.css" rel="stylesheet">
		<!--//Metis Menu -->
	</head>

	<body class="cbp-spmenu-push">
		<div class="main-content">
			<!--left-fixed -navigation-->
			<div class=" sidebar" role="navigation">
				<div class="navbar-collapse">
					<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
						<ul class="nav" id="side-menu">
							<li>
								<a href="#home" onclick=enableHome() id=lihome><i class="fa fa-home nav_icon"></i>Home</a>
							</li>
							<li>
								<a href="#changepassword" onclick=enablePassword() id=lipassword><i class="fa fa-user nav_icon"></i>Change Password</a>
							</li>
							<li>
								<a href="#teams" onclick=enableTeams() id=liteams><i class="fa fa-users nav_icon"></i>Teams</a>
							</li>
							<li>
								<a href="#accomodation" onclick=enableAccomodation() id=liaccomodation><i class="fa fa-credit-card nav_icon"></i>Accomodation</a>
							</li>
							<li>
								<a href="logout.php"><i class="fa fa-power-off nav_icon"></i>Logout</a>
							</li>
						</ul>
						<div class="clearfix"> </div>
						<!-- //sidebar-collapse -->
					</nav>
				</div>
			</div>
			<!--left-fixed -navigation-->
			<!-- header-starts -->
			<div class="sticky-header header-section ">
				<div class="header-left">
					<!--toggle button start-->
					<button id="showLeftPush"><i class="fa fa-bars"></i></button>
					<!--toggle button end-->
					<!--logo -->
					<div class="logo">
						<a href="home.php">
							<h1><span style="font-family: Astronout; font-size:1.3em">Pravah'</span><span style="font-family: BadMofo; font-size:1em">18</span></h1>
							<span style="font-family: Bubblegum Sans">User Profile</span>
						</a>
					</div>
				</div>
				<div class="header-right">

					<!--notification menu end -->
					<div class="profile_details">
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">
										<div class="user-name">
											<p>
												<?php echo $firstname." ".$lastname;?>
											</p>
											<span><?php echo $email_;?></span>
										</div>
										<i class="fa fa-angle-down lnr"></i>
										<i class="fa fa-angle-up lnr"></i>
										<div class="clearfix"></div>
									</div>
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- //header-ends -->
			<!-- main content start-->
			<div id="page-wrapper">
				<div class="main-page" id=home style="">
					<h5 style="padding-bottom:20px"><b>Dear Participant,<br> Congratulation for qualifying for state Round of Dr. Abdul Kalam Arts and Cultural Fest. Here are few guidelines for the final to be held in the campus of IET Lucknow on 26th to 27th March 2018.</b></h5>
					<h3 class="title1">Personal Info:</h3>
					<ul style="list-style-type: none;padding:20px;line-height: 1;">
						<li>
							<?php echo "<b>Gender: </b>".$gender;?>
						</li>
						<hr>
						<li>
							<?php echo "<b>Date of birth: </b>".$dob;?>
						</li>
						<hr>
						<li>
							<?php echo "<b>Phone: </b>".$phone;?>
						</li>
						<hr>
						<li>
							<?php echo "<b>Zone: </b>".$zone;?>
						</li>
						<hr>
						<li>
							<?php echo "<b>Tshirt Size: </b>".$tshirts[$tshirt-1];?>
						</li>
						<hr>
						<li>
							<?php echo "<b>College: </b>".$college;?>
						</li>
						<hr>
						<li>
							<?php echo "<b>Aadhaar: </b>".$aadhaar;?>
						</li>
						<hr>
						<li>
							<?php if ( $youare == "Participant" ) {	echo "<b>Father's Name: </b>".$fathername; }?>
						</li>
						<hr>
						<li>
							<?php if ( $youare == "Participant" ) {	echo "<b>Mother' Name: </b>".$mothername; }?>
						</li>
						<hr>
						<li>
							<?php if ( $youare == "Participant" ) {	echo "<b>Roll Number: </b>".$rollno; }?>
						</li>
						<hr>
						<li>
							<?php echo "<b>Attending Pravah as: </b>".$youare;?>
						</li>
						<hr>
						<li>
							<?php echo "<b>Events: </b><br/>";
						
						$list = array( "Collage Making", "Face Painting", "Mehandi Design", "Poster Making", "3D Rangoli/Painting", "T-shirt Painting", "", "", "", "Bandwars", "Fashion Jalwa", "Solo Dance", "Duet Dance", "Group Dance", "Mimicry/Standup Comedy", "Solo Singing", "Duet Singing", "Group Singing", "Skit/Play" );
						$events_ = decodeEvents( $events );
						
						$c = 1;
						for ( $i = 1; $i <= count($events_); $i++ )
						{
							if ( $events_[($i-1)] != "-1" )
							{
								echo $c.". ".$list[(int)$events_[($i-1)]-1]."<br>";
								$c++;
							}
						}
						
						if ( $c == 1 )
						{
							echo "You are not registered for any events yet.";
						}
					?></li>
					</ul>
					<h3 style="margin:40px 0;">General Rules:</h3>
					<ul style="padding:20px 40px;line-height: 2;">
                        <li style="color:red;">Rules of final round will be uploaded on 20th March, 2018.</li>
						<li>All the participant are required to get a <b>no-objection certificate</b> from the appropriate authority of respective institutions.
						</li>
						<li>The names of participants for each event separately should be submitted at the time of registration on A4 size sheet duly signed by principal/teacher in-cahrge.
						</li>
						<li>It is compulsory for all the participants to bring their college identity cards. The participants should wear the ID cards provided by the host college (IET, Lucknow) at all times.
						</li>
						<li>Participants of all the competitions are required to report 30 minutes prior to the start of their event at assigned venues.
						</li>
						<li><b>All the decisions of the judges shall be final. In case of any in discipline anywhere in the campus may result in disqualification of the individual or teams.</b>
						</li>
						<li>Medical support will be provided by us(IET Lucknow).
						</li>
						<li>Each college has to provide the point of contact to us(IET Lucknow).
						</li>
						<li>Kindly fill the accommodation by 18th March, 2018.
						</li>
					</ul>
					<h5 style="margin:40px 20px;">
						IET Campus Awaits for you welcome.<br> Good Luck<br> Team Dr. Abdul Kalam Arts and Cutural Fest<br>
					</h5>
				</div>
				<!-- details>

		<!-- change password-->
				<div class="main-page" id=changepassword style="display:none;">
					<div class="forms">
						<div class="form-grids row widget-shadow" data-example-id="basic-forms">
							<div class="form-title">
								<h4>Change Password:</h4>
							</div>
							<div class="form-body">
								<form action="<?php echo validateForm("home.php");?>" method="post">
									<div class="form-group"> <label>Old Password</label> <input type="password" class="form-control" id="oldpassword" placeholder="Old Password" name="oldpassword" required=""> </div>
									<div class="form-group"> <label>New Password</label> <input type="password" class="form-control" id="newpassword" placeholder="New Password" name="newpassword" required="" onchange=validateLength()> </div>
									<div class="form-group"> <label>Confirm Password</label> <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword" required="" onchange=validatePassword()> </div>
									<!--<div class="form-group"> <label for="exampleInputFile">File input</label> <input type="file" id="exampleInputFile">
									<p class="help-block">Example block-level help text here.</p>
								</div>
								<div class="checkbox"> <label> <input type="checkbox"> Check me out </label> </div--><button type="submit" class="btn btn-default">Submit</button> </form>
							</div>
						</div>
					</div>
				</div>
				<!-- block end -->


				<!-- acoomodation-->
				<div class="main-page" id=accomodation style="display:none;">
					<h3>Guidelines:</h3>
					<ul style="padding:20px 40px;line-height: 2;">
						<li>Participants will have to register themselves for the event on This Link <a href=http://aktu.ac.in/pravah>http://aktu.ac.in/pravah</a>.
							<br> Registration link will be active from 10th March 2018 to 20th March 2018.
						</li>
						<li>Registration fees for Participant is 1000 per person. Registration fee for faculty member accompanying is Rs. 750 per person. Registration fee for Others is Rs. 1000 per person which includes:
							<br>
							<ul style="padding:10px 20px;">
								<li>Fooding, from 25th March 2018 (Lunch) to 28th March 2018 (Breakfast)</li>
								<li>Tshirt.</li>
								<li>Lodging etc.</li>
							</ul>
						</li>
						<li><b>Fee will have to be paid through UPI and "different zones will have different UPI number".</b></li>
						<li><b>Fill your transaction ID and submit after paying your fee through UPI.</b></li>
						<li>All the travelling expenses will be borne by participants and faculty themselves.</li>
						<li>Participants are suggested to report to the venue by morning of <b>25th March 2018</b> in order to avoid chaos.</li>
						<li>For any further query you can contact at <a href="mailto:aktu.pravah@aktu.ac.in">aktu.pravah@aktu.ac.in</a> or on our <a href=http://www.facebook.com/aktu.pravah>Facebook</a> page.</li>
					</ul>
					<h3 class="title1" style="margin-top:40px">Accommodation</h3>
					<div class="row">
						<div class="col-md-6 validation-grids widget-shadow" data-example-id="basic-forms">
							<div class="form-title">
								<h4>Accommodation forms:</h4>
							</div>
							<div class="form-body">
								<form action="../transaction.php" method="post">
									<div class="form-group" id=askAccommodation style="display:none;">
										<label>Do you want Accomodation</label>
										<select requred="" id=valueAcc onchange=enableOthers()>
											<option value="0">No</option>
											<option value="1">Yes</option>
										</select>
									</div>
									<div class="form-group" id="UPI" style="display:none">Pay your Accommodation through <b>UPI to Number: <?php echo "".$UPI[((int)$_zone)-1]; ?></b><!--</b><br><br><i><b>After completing your payment through the above mentioned UPI number, save your transaction ID, you will be asked to provide your transaction ID at this very portal after 48 hours. Afterwards, a confirmation message will be sent to your email address.</b></i>-->
									</div>
									<div class="form-group" id="pending" style="display:none; color:#ad0f5e">Payment Awaiting verification
									</div>
									<div class="form-group" id="confirm" style="display:none; color:green">Payment Verified
									</div>
                                    <div class="form-group" id="filled"><?php if ( $transactionID != "000000000000" ){ echo "Filled Transaction ID: ".$transactionID; } ?>
									</div>
									<div class="form-group" id="askID" style="display:none">Enter your transaction ID:
									</div>
									<div class="form-group" id="TID" style="display:none">
										<input type="text" class="form-control" name="transactionID" id="transactionID" placeholder="Transaction ID" required>
									</div>
									<div class="form-group" id="Sbutton" style="display:none">
										<button type="submit" class="btn btn-primary" ><?php if ( $transactionStatus == 0 ) { echo "Submit"; } else if ( $transactionStatus == 1 ) { echo "Update filled transaction ID."; } else { echo ""; } ?></button>
									</div>
                                    <div class="form-group">Check your Allotted hostel on 22nd March, 2018.
                                    </div>
                                </form>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<!--div class="blank-page widget-shadow scroll" id="style-2 div1"-->

				</div>
				<!-- block end-->


				<!-- team block-->
				<div class="main-page" id="teams" style="display:none;">
					<div class="forms">
						<h3 class="title1">Your Team</h3>
						<div class="form-grids row widget-shadow" data-example-id="basic-forms">

							<div class="form-body">
								<form action="../addteam.php" method="post">
									<div class="form-group"> <label>Enter you team members registered email in following format</label>
										<input type="text" class="form-control" placeholder="mail1@example.com;mail2@example.com;mail@3@example.com;" name="teams" required=""> </div>


									<button type="submit" class="btn btn-default">Submit</button> </form>
							</div>
						</div>
						<h3 class="title1" style="margin:30px 0">Team members</h3>
						<ul style="margin-top:40px;list-style-type: none;padding:20px;line-height: 2;">
							<?php 
						
							$mysqli = new mysqli($server, $user, $dbpassword, $database);
							if ($mysqli->connect_errno) {
								die("Failed to connect to MySQL: " . $mysqli->connect_error);
							}
							
							$arr = decodeTeam($team);
							$names = array( "", "", "", "", "", "", "", "", "", "", "", "" );
							$c = 0;
						
							if ( count($arr) > 0 )
							{
								for ( $i = 0; $i < count($arr); $i++ )
								{
									$id = $mysqli->real_escape_string($arr[$i]);
									$query = $mysqli->query("SELECT firstname, lastname FROM accounts WHERE id=$id");
								
									if ( $query && ( $query->num_rows > 0 ) )
									{
										$ro = $query->fetch_assoc();
										$names[$c] = $ro["firstname"]." ".$ro["lastname"];
										$c++;
										
										$query->close();
									}
								}
							}
							
							$mysqli->close();
							
							echo "
							<li>
							$names[0]
							</li>
							<li>
							$names[1]
							</li>
							<li>
							$names[2]
							</li>
							<li>
							$names[3]
							</li>
							<li>
							$names[4]
							</li>
							<li>
							$names[5]
							</li>
							<li>
							$names[6]
							</li>
							<li>
							$names[7]
							</li>
							<li>
							$names[8]
							</li>
							<li>
							$names[9]
							</li>
							<li>
							$names[10]
							</li>
							<li>
							$names[11]
							</li>";
							?>
						</ul>
					</div>

				</div>
				<!--block end-->
			</div>


			<!--footer-->
			<div class="footer">
				<p><a href=../../index.html target="_blank">Pravah</a>. For any query <a href="http://aktu.ac.in/pravah/contact.html">Click here</a> <br>Ashutosh Ranjan: +918005341531 (Hospitality Assistant Coordinator)</p>
			</div>
			<!--//footer-->
		</div>
		<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById('cbp-spmenu-s1'),
				showLeftPush = document.getElementById('showLeftPush'),
				body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle(this, 'active');
				classie.toggle(body, 'cbp-spmenu-push-toright');
				classie.toggle(menuLeft, 'cbp-spmenu-open');
				disableOther('showLeftPush');
			};

			function disableOther(button) {
				if (button !== 'showLeftPush') {
					classie.toggle(showLeftPush, 'disabled');
				}
			}

			function validateLength() {
				var pass1 = document.getElementById("newpassword").value;
				if (pass1.length < 8)
					document.getElementById("newpassword").setCustomValidity("Passwords too small");
				else
					document.getElementById("newpassword").setCustomValidity('');
			}

			function validatePassword() {
				var pass1 = document.getElementById("newpassword").value;
				var pass2 = document.getElementById("confirmpassword").value;
				if (pass1 != pass2)
					document.getElementById("confirmpassword").setCustomValidity("Passwords Don't Match");
				else
					document.getElementById("confirmpassword").setCustomValidity('');
				//empty string means no validation error
			}

		</script>
		<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.js"></script>
		<script src="js/home.js?ver=3.1"></script>
		<?php 
		if ( $active == 1 )
		{
			echo "<script> enableTeams();</script>";
		}
		
		if ( $active_ == 1 )
		{
			echo "<script> alert('Invalid password');</script>"; 
		}
		
		if ( $activeT == 1 )
		{
			echo "<script> alert('Transaction ID successfully saved. Please wait for 24 hours for confirmation of payment.');</script>"; 
		}
		
		if ( $zone == "Lucknow" )
		{
			echo "<script> enableCheckbox(); </script>";
		}
		else
		{
			echo "<script> enableField(); </script>";
		}
		
		if ( $transactionStatus == 1 )
		{
			echo "<script> pendingPayment(); </script>";
		}
		
		if ( $transactionStatus == 2 )
		{
			echo "<script> confirmPayment(); </script>";
		}
		?>
	</body>

	</html>
