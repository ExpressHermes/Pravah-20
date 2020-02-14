<?php
/*
Filename: forgot.php
Purpose: Check email in database and send a randomly generated string as new email.
Author: Harshal Dev
Last edited: 26/02/18
*/
$salt = "somesaltysalt";

$server = "localhost";
$user = "ietlunxt_encore";
$dbpassword = "df#!BFLBdP3H";
$database = "ietlunxt_encore";

$message1 = "Greetings,\n\nYou are receiving this email because you (or someone)\nnotified us that you have forgotton your account\npassword, as a result, we have changed your password to the following:\n";
$message2 = "\nWish you a great time at Pravah!\n\n- Team Pravah";
$email;

if ( $_SERVER["REQUEST_METHOD"] == "POST" )
{
	// Validate and store the details sent to the php script.
	$email = validateForm($_POST["email"]);
	
	// Establish connection to our database.
	$mysqli = new mysqli($server, $user, $dbpassword, $database);
	if ($mysqli->connect_errno) {
		die("Failed to connect to MySQL: " . $mysqli->connect_error);
	}
	
	// Check whether or not the entered email is registered.
	$email = $mysqli->real_escape_string($email);
	$result = $mysqli->query("SELECT id FROM accounts WHERE email='$email'");
	if ( $result && ( $result->num_rows > 0 ) )
	{
		$password = generateRandomString();
		$newpassword = strtoupper(md5($password."".$salt));
		
		$query = $mysqli->query("UPDATE accounts SET accpassword='".$mysqli->real_escape_string($newpassword)."' WHERE email='".$email."'");
		if ( $query )
		{
			mail($email, "Password Recovery", $message1."".$password."".$message2, "From: noreply@encore.ietlucknow.ac.in");
			
			setcookie("forgot", "1", time() + (86400 * 30), "/");
			header("Location: registration.php");
			exit;
		}
		else
		{
			die("Error.");
		}
	}
	else
	{
		setcookie("wrong", "1", time() + (86400 * 30), "/");
		header("Location: registration.php");
		exit;
	}
	$mysqli->close();
}
else
{
	header("Location: registration.php");
	exit;
}
		
function generateRandomString( ) 
{
	$length = 8;
	
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
	
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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