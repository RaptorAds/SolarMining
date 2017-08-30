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

###############################
function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}

if  (IsNullOrEmptyString($secret_key)) {
	
	$secret_key = $gauth->createSecret();
	$query = "update members set google_auth_code = '". $secret_key."'  where username= '". $user_id. "'";
	## DB ##
	$mysqli2 = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}	
	$result2 = $mysqli2->query($query);
	/* close connection */
	$mysqli2->close();
}

$google_QR_Code = $gauth->getQRCodeGoogleUrl($email, $secret_key,'SolarICO');

?>
<!DOCTYPE html>
<html>
	<head>
		<title>2FA Setup</title>
		<!-- <link rel="stylesheet" type="text/css" href="./login/css/app_style.css" charset="utf-8" /> -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="container">
			<div id='device'>
			<p>Scan with Google Authenticator application on your smart phone.</p>
			<div id="img"><img src='<?php echo $google_QR_Code; ?>' /></div>
			<form name="LI-form" id="LI-form">
			<input type="hidden" id="process_name" name="process_name" value="verify_code" />
				<div class="form-group">
					<label for="email">Please enter your code below</label>
					<input type="text" name="scan_code" class="form-control" id="scan_code" required />
				  </div>
				<input type="button" class="btn btn-success btn-submit" value="Verify Code"/>
				<div id="messageError"></div>
			</form>
			</div>
		</div>
	<!-- script src="./login/js/jquery.validate.min.js"></script> -->
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function(){
			/* submit form details */
			$(document).on('click', '.btn-submit', function(ev){
				var scan_code = $("#scan_code").val();

				if (scan_code == "") {
				  $("#messageError").fadeOut(0, function (){
					$(this).html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter code from authenticator</div>").fadeIn();
				  })
				}
				else {
					var data = $("#LI-form").serialize();
					$.post('./login/check_user.php', data, function(data,status){
						console.log("submiting result ====> Data: " + data + "\nStatus: " + status);
						if( data == "done"){
							alert("2FA has been enabled");
							location.reload();
						}
						else{
							alert("Incorrect Pin, please try again.");
						}
						
					});	
				}
			});
			/* ebd submit form details */
		});
	</script>
	</body>
</html>