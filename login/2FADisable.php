<?php
session_start();		
require "autoload.php";
require_once 'googleLib/GoogleAuthenticator.php';
$gauth = new GoogleAuthenticator();

if(empty($_SESSION['username']))
{
	echo "<script> window.location = 'index.php'; </script>";
}

$user_id = $_SESSION['username'];

## Get User from DB ##
$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

/* check connection */
if ($mysqli->connect_errno) {
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

$query = "update members set status_google = 0 where username= '". $user_id. "'";
$result = $mysqli->query($query);

echo "<script>location.reload();</script>";
echo "<script>alert('2FA has been disabled');</script>";
###############################

?>
<!DOCTYPE html>
<html>
	<head>
		<title>2FA Disable</title>
		<!-- <link rel="stylesheet" type="text/css" href="./login/css/app_style.css" charset="utf-8" /> -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

	<!-- script src="./login/js/jquery.validate.min.js"></script> -->
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

	</body>
</html>