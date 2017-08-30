<?php
session_start();	
require "autoload.php";
require_once 'googleLib/GoogleAuthenticator.php';

$gauth = new GoogleAuthenticator();
$process_name = $_POST['process_name'];

if($process_name == "verify_code"){
	$scan_code = $_POST['scan_code'];
	$user_id = $_SESSION['username'];
	
	## Get User from DB ##
	$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	$query = "select * from members where username= '". $user_id. "'";
	$result = $mysqli->query($query);

	while($row = $result->fetch_array())
	{
		$rows[] = $row;
	}

	foreach($rows as $row)
	{
		$status		= $row['status_google'];
		$secret_key	= $row['google_auth_code'];
		$email		= $row['email'];
	}

	/* free result set */
	$result->close();	
	
	$checkResult = $gauth->verifyCode($secret_key, $scan_code, 2);    // 2 = 2*30sec clock tolerance

	if ($checkResult){
		$_SESSION['googleVerifyCode'] = $scan_code;
		echo "done";
		
		## DB ##
		$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

		/* check connection */
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$query = "update members set status_google = 1 where username= '". $user_id. "'";
		$result = $mysqli->query($query);
		$mysqli->close();		
	} 
	else{
		echo 'Note : Code not matched.';
	}
}
?>