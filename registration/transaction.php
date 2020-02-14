<?php
/*
Filename: transaction.php
Purpose: Check email in database and save transaction ID.
Author: Harshal Dev
Last edited: 26/02/18
*/
$salt = "somesaltysalt";

$server = "localhost";
$user = "ietlunxt_encore";
$dbpassword = "df#!BFLBdP3H";
$database = "ietlunxt_encore";

$transactionID;
$email;

if ( $_SERVER["REQUEST_METHOD"] == "POST" )
{
	// Validate and store the details sent to the php script.
	$email = validateForm($_COOKIE["email_"]);
	$transactionID = validateForm($_POST["transactionID"]);
	
	// Establish connection to our database.
	$mysqli = new mysqli($server, $user, $dbpassword, $database);
	if ($mysqli->connect_errno) {
		die("Failed to connect to MySQL: " . $mysqli->connect_error);
	}
	
	// Check whether or not the entered email is registered.
	$email = $mysqli->real_escape_string($email);
	$query = $mysqli->query("UPDATE accounts SET transactionid='".$mysqli->real_escape_string($transactionID)."', transaction_=1 WHERE email='$email'");
	if ( $query )
	{
		setcookie("transaction", "1", time() + (86400 * 30), "/");
		header("Location: Dashboard/home.php");
		exit;
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