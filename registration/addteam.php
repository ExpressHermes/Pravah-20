<?php
/*
Filename: addteam.php
Purpose: Establish connection to MySQL database and login the participant.
Author: Harshal Dev
Last edited: 26/02/18
*/

$server = "localhost";
$user = "ietlunxt_encore";
$dbpassword = "df#!BFLBdP3H";
$database = "ietlunxt_encore";

$emails;
$email;

$team = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST" )
{
	// Validate and store the details sent to the php script.
	$email = $_COOKIE["email_"];
	$emails = validateForm($_POST["teams"]);

	// Establish connection to our database.
	$mysqli = new mysqli($server, $user, $dbpassword, $database);
	if ($mysqli->connect_errno) {
		die("Failed to connect to MySQL: " . $mysqli->connect_error);
	}
	
	// Return saved team.
	$teamResult = $mysqli->query("SELECT team FROM accounts WHERE email='".$mysqli->real_escape_string($email)."'");
	if ( $teamResult && ( $teamResult->num_rows > 0 ) )
	{
		$trow = $teamResult->fetch_assoc();
		if ( substr($trow["team"], 0, 2) == "-;" )
		{
			$team = "";
		}
		else
		{
			$team = $trow["team"];
		}
	}
	
	if ( substr($emails, strlen($emails)-1, 1) != ";" )
	{
		$emails = $emails.";";
	}
	
	// Check whether or not the entered email is registered.
	$decode = decodeEmail( $emails );
	$members = "";
	for ( $i = 0; $i < count($decode); $i++ )
	{
		$result = $mysqli->query("SELECT id FROM accounts WHERE email='".$mysqli->real_escape_string($decode[$i])."'");
		if ( $result && ( $result->num_rows > 0 ) )
		{
			$row = $result->fetch_assoc();
			$members = $members."".$row["id"].";";
			
			$result->close();
		}
	}
	
	$members = $team."".$members;
	
	if ( strlen($team) == 0 && strlen($members) == 0 ) 
	{
		$members = "-;-;-;-;-;-;-;-;-;-;-;-;";
	}	
	
	$query = $mysqli->query("UPDATE accounts SET team='".$mysqli->real_escape_string($members)."' WHERE email='".$mysqli->real_escape_string($email)."'");
	if ( $query )
	{
		setcookie("team", "1", time() + (86400 * 30), "/");
		header("Location: Dashboard/home.php");
		exit;
	}
	else
	{
		die("Error.");
	}
		
	$mysqli->close();
}
else
{
	echo "Something went wrong, you shouldn't be on this page.";
}

function decodeEmail ($str)
{
	$values = array();
	$index = 0;
	$last = 0;
	for ( $i = 0; $i < strlen($str); $i++ )
	{
		if ( substr($str, $i, 1) == ";" )
		{	
			$values[$index] = substr($str, $last, $i-$last);
		
			$last = ($i+1);
			$index++;
		}
	}
	
	return $values;
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