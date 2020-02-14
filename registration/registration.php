<?php	
$logincookie = "login";
$email = "";

if ( isset($_COOKIE[$logincookie]) )
{
	header("Location: Dashboard/home.php");
	exit;
}

if ( isset($_COOKIE["register"]) )
{
	setcookie("register", "", time() - 3600, "/");
	echo "<script> alert('Please login with the entered credentials to complete your registration.'); </script>";
}

if ( isset($_COOKIE["wrong"]) )
{
	setcookie("wrong", "", time() - 3600, "/");
	echo "<script> alert('Invalid details entered!'); </script>";
}

if ( isset($_COOKIE["forgot"]) )
{
	setcookie("forgot", "", time() - 3600, "/");
	echo "<script> alert('A recovery email has been sent to your registered email.'); </script>";
}

if ( isset($_COOKIE["aexist"]) )
{
	setcookie("aexist", "", time() - 3600, "/");
	echo "<script> alert('An account with the email already exists.'); </script>";
}
?>

    <!doctype html>
    <html>

    <head>
        <title>प्रवाह | Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="pravah regstration, pravah, pravaah, prawah, aktu fest, fest aktu, aktu pravah, pravah aktu, iet fest, fest iet, iet lucknow" />
        <!-- font files -->
        <link href='//fonts.googleapis.com/css?family=Muli:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Nunito:400,300,700' rel='stylesheet' type='text/css'>
        <!-- /font files -->
        <!-- css files -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/style.css?ver=1.4" rel='stylesheet' type='text/css' />
        <!-- /css files -->
        <script>
            //alert('Registrations has been closed');

        </script>

    </head>

    <body>
        <div class=preloader-wrapper>
        </div>

        <h1 class="header-w3ls"><span style="font-family: Astronout; font-size: 80px">Pravah   &#39;</span><span style="font-family: BadMofo; font-size: 60px">18 </span></h1>
        <h2 style="color: white;text-align: center;margin: 40px;font-size: 20px;"><a href="NOC.docx%20(3).pdf" id=download1 target="_blank" style="color:yellow">Download NOC Format</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id=download2 target="_blank"  href="Web%20Rules%20and%20Guidelines.pdf" style="color:#f4e242">Download Rules and Guidelines for Finals</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id=download3 target="_blank"  href="Schedule.pdf" style="color:#f4e242">Download Schedule.</a></h2>
        <h2 style="color: #fff;text-align: center;margin: 40px;font-size: 20px;"><b>Only those people can register as participants who have qualified the zonal round held from 22nd February to 24 February 2018.</b><br>Please read these guidelines before Registration.<a href="iet.pdf" target="_blank" style="color:red"> Download PDF.</a></h2>
        <div class="signup-w3ls">
            <div class="signup-agile1">
                <h3>Register for Finale</h3>
                <form action="signup.php" method="post" autocomplete=off>
                    <div class="form-control">
                        <label class="header">First Name:</label>
                        <input type="text" id="firstname" name="firstname" placeholder="First Name" title="Please enter your First Name" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Last Name" title="Please enter your Last Name" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" min="1960-01-01" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Gender:</label>
                        <select name="gender" id="gender" required="">
  						<option value="1">Male</option>
  						<option value="2">Female</option>
						<option value="3">Others</option>
					</select>
                    </div>

                    <div class="form-control">
                        <label class="header">Email Address :</label>
                        <input type="email" id="email" name="email" placeholder="mail@example.com" title="Please enter a valid email" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Password :</label>
                        <input type="password" class="lock" name="password" placeholder="password" id="password" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Confirm Password :</label>
                        <input type="password" onpaste="return false;" class="lock" name="confirmpassword" placeholder="confirm password" id="confirmpassword" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Mobile Number:</label>
                        <input type="text" id="phone" name="phone" pattern="\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Are You:</label>
                        <select name="youare" id="youare" required="">
  						<option value="1">Participant</option>
  						<option value="2">Accompanying Faculty</option>
						<option value="3">Others</option>
					</select>
                    </div>

                    <div class="form-control" id=qevents>
                        <label class="header">Qualified Events:</label>
                        <select name="qualievents" id="qualievents" required="" onchange="enableRequired()">
						<option disabled>No. of events qualified</option>
  						<option selected>1</option>
  						<option>2</option>
						<option>3</option>
					</select>
                    </div>

                    <div class="form-control" id=1event>
                        <label class="header">Event 1:</label>
                        <select name="event1" id="event1" required="">
						<option disabled>Enter you first Qualified Event</option>
						<option disabled>Arts Events</option>
						<option selected value='-;' hidden></option>
  						<option value="01;">Collage Making</option>
  						<option value="02;">Face Painting</option>
						<option value="03;">Mehandi Design</option>
						<option value="04;">Poster Making</option>
						<option value="05;">3D Rangoli/Painting</option>
						<option value="06;">T-shirt Painting</option><option disabled>Cultural Events</option>
						<option value="10;">Bandwars</option>
						<option value="11;">Fashion Jalwa</option>
						<option value="12;">Solo Dance</option>
						<option value="13;">Duet Dance</option>
						<option value="14;">Group Dance</option>
						<option value="15;">Mimicry/Standup Comedy</option>
						<option value="16;">Solo Singing</option>
						<option value="17;">Duet Singing</option>
						<option value="18;">Group Singing</option>
						<option value="19;">Skit/Play</option>
					</select>
                    </div>
                    <div class="form-control" id=2event style="display: none;">
                        <label class="header">Event 2:</label>
                        <select name="event2" id="event2" required="">
						<option disabled>Enter you second Qualified Event</option>
						<option disabled>Arts Events</option>
						<option selected value='-;' hidden></option>
  						<option value="01;">Collage Making</option>
  						<option value="02;">Face Painting</option>
						<option value="03;">Mehandi Design</option>
						<option value="04;">Poster Making</option>
						<option value="05;">3D Rangoli/Painting</option>
						<option value="06;">T-shirt Painting</option><option disabled>Cultural Events</option>
						<option value="10;">Bandwars</option>
						<option value="11;">Fashion Jalwa</option>
						<option value="12;">Solo Dance</option>
						<option value="13;">Duet Dance</option>
						<option value="14;">Group Dance</option>
						<option value="15;">Mimicry/Standup Comedy</option>
						<option value="16;">Solo Singing</option>
						<option value="17;">Duet Singing</option>
						<option value="18;">Group Singing</option>
						<option value="19;">Skit/Play</option>
					</select>
                    </div>
                    <div class="form-control" id=3event style="display: none;">
                        <label class="header">Event 3:</label>
                        <select name="event3" id="event3" required="">
						<option disabled>Enter you third Qualified Event</option>
						<option disabled>Arts Events</option>
						<option selected value='-;' hidden></option>
  						<option value="01;">Collage Making</option>
  						<option value="02;">Face Painting</option>
						<option value="03;">Mehandi Design</option>
						<option value="04;">Poster Making</option>
						<option value="05;">3D Rangoli/Painting</option>
						<option value="06;">T-shirt Painting</option><option disabled>Cultural Events</option>
						<option value="10;">Bandwars</option>
						<option value="11;">Fashion Jalwa</option>
						<option value="12;">Solo Dance</option>
						<option value="13;">Duet Dance</option>
						<option value="14;">Group Dance</option>
						<option value="15;">Mimicry/Standup Comedy</option>
						<option value="16;">Solo Singing</option>
						<option value="17;">Duet Singing</option>
						<option value="18;">Group Singing</option>
						<option value="19;">Skit/Play</option>
					</select>
                    </div>

                    <div class="form-control">
                        <label class="header">Father's Name</label>
                        <input type="text" id="fathername" name="fathername" required>
                    </div>

                    <div class="form-control">
                        <label class="header">Mother's Name</label>
                        <input type="text" id="mothername" name="mothername" required>
                    </div>

                    <div class="form-control">
                        <label class="header">Aadhaar Number</label>
                        <input type="text" id="aadhaar" name="aadhaar" pattern="^\d{4}\s\d{4}\s\d{4}$" placeholder="XXXX XXXX XXXX" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Zonal Centre:</label>
                        <select name="zone" id=zone required="">
  						<option value="1">Agra</option>
  						<option value="2">Allahabad</option>
  						<option value="3">Bareilly</option>
  						<option value="4">Gautam Buddh Nagar</option>
						<option value="5">Ghaziabad</option>
  						<option value="6">Gorakhpur</option>
  						<option value="7">Lucknow</option>
  						<option value="8">Meerut</option>
					</select>
                    </div>

                    <div class="form-control">
                        <label class="header">Tshirt Size:</label>
                        <select name="tshirt" id=tshirt required="">
  						<option value="1">S</option>
  						<option value="2">M</option>
  						<option value="3">L</option>
  						<option value="4">XL</option>
						<option value="5">XXL</option>
					</select>
                    </div>

                    <div class="form-control">
                        <label class="header">College:</label>
                        <input type="text" id="college" name="college" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Roll Number:</label>
                        <input type="text" id="rollno" name="rollno" required>
                    </div>

                    <input type="submit" class="register" value="Register">

                </form>
                <script type="text/javascript">
                    window.onload = function() {
                        document.getElementById("password").onchange = validateLength;
                        document.getElementById("confirmpassword").onchange = validatePassword;
                        document.getElementById("youare").onchange = readonlyfield;
                        document.getElementById("event1").onchange = validateEvent;
                        document.getElementById("event2").onchange = validateEvent;
                        document.getElementById("event3").onchange = validateEvent;
                    }

                    function validateLength() {
                        var pass1 = document.getElementById("password").value;
                        if (pass1.length < 8)
                            document.getElementById("password").setCustomValidity("Passwords too small");
                        else
                            document.getElementById("password").setCustomValidity('');
                    }

                    function validatePassword() {
                        var pass1 = document.getElementById("password").value;
                        var pass2 = document.getElementById("confirmpassword").value;
                        if (pass1 != pass2)
                            document.getElementById("confirmpassword").setCustomValidity("Passwords Don't Match");
                        else
                            document.getElementById("confirmpassword").setCustomValidity('');
                        //empty string means no validation error
                    }
                    
                    function readonlyfield() {
                        vanishField();
                        var pass = document.getElementById("youare").value;
                        if (pass != "1") {
                            document.getElementById("rollno").setAttribute("readonly", "");
                            document.getElementById("fathername").setAttribute("readonly", "");
                            document.getElementById("mothername").setAttribute("readonly", "");
                            document.getElementById("rollno").value = '-';
                            document.getElementById("fathername").value = '-';
                            document.getElementById("mothername").value = '-';
                            document.getElementById("rollno").removeAttribute("required");
                            document.getElementById("fathername").removeAttribute("required");
                            document.getElementById("mothername").removeAttribute("required");
                        } else {
                            document.getElementById("rollno").removeAttribute("readonly");
                            document.getElementById("fathername").removeAttribute("readonly");
                            document.getElementById("mothername").removeAttribute("readonly");
                            document.getElementById("rollno").setAttribute("required", "");
                            document.getElementById("fathername").setAttribute("required", "");
                            document.getElementById("mothername").setAttribute("required", "");
                        }
                    }

                </script>
            </div>
            <div class="signup-agile2">
                <h3>LogIn With Your Account</h3>
                <form action="Dashboard/home.php" method="post">
                    <div class="form-control">
                        <label class="header">Email Address :</label>
                        <input type="email" id="email" name="email" placeholder="mail@example.com" value="<?php echo $email;?>" title="Please enter a valid email" required="">
                    </div>

                    <div class="form-control">
                        <label class="header">Password :</label>
                        <input type="password" class="lock" name="password" placeholder="Password" id="password" required="">
                    </div>
                    <input type="submit" class="login" value="LogIn">
                </form>
                <h3 style="margin-top: 40px;">Forgot Password</h3>
                <form action="forgot.php" method="post">
                    <div class="form-control">
                        <label class="header">Email Address :</label>
                        <input type="email" id="email" name="email" placeholder="mail@example.com" value="<?php echo $email;?>" title="Please enter a valid email" required="">
                    </div>
                    <input type="submit" class="login" value="Submit">
                </form>
            </div>
        </div>
        <h2 data-brackets-id="2032" style="color: white;text-align: center;margin: 40px;font-size: 20px;"> <b>Helpline Number: +918005341531<br>(Assistant Coordinator Hospitality - Ashutosh Ranjan)</b></h2>
        <div style="text-align:center"><img src="logo%20(1).png"/>
        </div>
        <script src="js/registration.js?ver=2.2"></script>
        <script src=js/jquery3.3.1.js></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script>
            setInterval(changecolor, 500);
            setTimeout(sk, 700);

            function sk() {
                setInterval(revertcolor, 500);
            }

            function changecolor() {
                document.getElementById('download1').style.color = "#ba0909";
                document.getElementById('download2').style.color = "#ba0909";
                document.getElementById('download3').style.color = "#ba0909";

            }

            function revertcolor() {
                document.getElementById('download1').style.color = "#f4e242";
                document.getElementById('download2').style.color = "#f4e242";
                document.getElementById('download3').style.color = "#f4e242";

            }

        </script>
    </body>

    </html>
