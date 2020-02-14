<?php
/*
Filename: signup.php
Purpose: Establish connection to MySQL database and register the participant.
Author: Harshal Dev
Last edited: 26/02/18
*/
$salt = "somesaltysalt";
$server = "localhost";
$user = "ietlunxt_encore";
$dbpassword = "df#!BFLBdP3H";
$database = "ietlunxt_encore";

if ( $_SERVER["REQUEST_METHOD"] == "POST" )
{
	// Validate and store the details sent to the php script.
	$firstname = validateForm($_POST["firstname"]);
	$lastname = validateForm($_POST["lastname"]);
	$dob = validateForm($_POST["dob"]);
	
	$gender = validateForm($_POST["gender"]);
	$email = validateForm($_POST["email"]);
	
	$password = strtoupper(md5(validateForm($_POST["password"])."".$salt));
	$phone = validateForm($_POST["phone"]);
	$fathername = validateForm($_POST["fathername"]);
	$mothername = validateForm($_POST["mothername"]);
	$aadhaar = validateForm($_POST["aadhaar"]);
	
	$zone = validateForm($_POST["zone"]);
	
	$tshirt = validateForm($_POST["tshirt"]);
	$college = validateForm($_POST["college"]);
	$rollno = validateForm($_POST["rollno"]);
	$youare = validateForm($_POST["youare"]);
	
	$event1 = validateForm($_POST["event1"]);
	$event2 = validateForm($_POST["event2"]);
	$event3 = validateForm($_POST["event3"]);
	
	$events = $event1."".$event2."".$event3;
	
	// Establish connection to our database.
	$mysqli = new mysqli($server, $user, $dbpassword, $database);
	if ($mysqli->connect_errno) {
		die("Failed to connect to MySQL: " . $mysqli->connect_error);
	}
	
	// Check whether or not the entered email is already registered.
	$email = $mysqli->real_escape_string($email);
	$result = $mysqli->query("SELECT id FROM accounts WHERE email='$email'");
	
	if ( $result && ( $result->num_rows > 0 ) )
	{
		$row = $result->fetch_assoc();
		
		setcookie("aexist", "1", time() + (86400 * 30), "/");
		header("Location: registration.php");
		exit;
		
		/*
		echo "An account already exists.";
		*/
		$result->close();
	}
	else
	{
		// Register our new participant.
		if ( $query = $mysqli->query("INSERT INTO accounts SET firstname='".$mysqli->real_escape_string($firstname)."', lastname='".$mysqli->real_escape_string($lastname)."', dob='".$mysqli->real_escape_string($dob)."', gender=$gender, email='$email', accpassword='".$mysqli->real_escape_string($password)."', mobile='".$mysqli->real_escape_string($phone)."', fathername='".$mysqli->real_escape_string($fathername)."', mothername='".$mysqli->real_escape_string($mothername)."', aadhaar='".$mysqli->real_escape_string($aadhaar)."', zone=$zone, college='".$mysqli->real_escape_string($college)."', rollno='".$mysqli->real_escape_string($rollno)."', events='".$mysqli->real_escape_string($events)."', youare=$youare, tshirt='".$mysqli->real_escape_string($tshirt)."'") )
		{
			setcookie("register", "1", time() + (86400 * 30), "/");
			header("Location: registration.php");
			exit;
			/*
			echo "Registration successful.";
			*/
		}
		else
		{
			die($mysqli->error);
		}
	}
	
	$mysqli->close();
}
else
{
	header("Location: registration.php");
	exit;
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
?>