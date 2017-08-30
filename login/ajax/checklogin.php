<?php
//'true' triggers login success
ob_start();
require '../autoload.php';
require_once '../googleLib/GoogleAuthenticator.php';

// Define $myusername and $mypassword
$username = $_POST['myusername'];
$password = $_POST['mypassword'];
$my2fa 	  = $_POST['my2fa'];

// To protect MySQL injection
$username = stripslashes($username);
$password = stripslashes($password);
$my2fa = stripslashes($my2fa);

// 2fa
$gauth = new GoogleAuthenticator();
$response = '';

// 2fa check

## Get User from DB ##
$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

/* check connection */
if ($mysqli->connect_errno) {
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

$query = "select * from members where username= '". $username. "'";
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
$mysqli->close();	

if ($status == '1'){
	$checkResult = $gauth->verifyCode($secret_key, $my2fa , 2);    // 2 = 2*30sec clock tolerance
} else {
	//2fa off
	$checkResult = 'true';
}
if ($checkResult) {
	$checkResult = 'true';
} else{
	$checkResult = 'false';
}

// End check 2fa

$loginCtl = new LoginHandler;
$lastAttempt = $loginCtl->checkAttempts($username);
$max_attempts = AppConfig::pullSetting("max_attempts", "unsigned");

//First Attempt
if ($lastAttempt['lastlogin'] == '') {

    $lastlogin = 'never';
    $loginCtl->insertAttempt($username);
    $response = $loginCtl->checkLogin($checkResult,$username, $password);

} elseif ($lastAttempt['attempts'] >= $max_attempts) {

    //Exceeded max attempts
    $loginCtl->updateAttempts($username);
    $response = $loginCtl->checkLogin($checkResult,$username, $password);

} else {

    $response = $loginCtl->checkLogin($checkResult, $username, $password, $_POST['remember']);
	
};

if ($lastAttempt['attempts'] < $max_attempts && $response != 'true' ){
    $loginCtl->updateAttempts($username);
    $resp = new RespObj($username, $response);
    $jsonResp = json_encode($resp);
    echo $jsonResp;

} else {
	
    $resp = new RespObj($username, $response);
    $jsonResp = json_encode($resp);
    echo $jsonResp;
	
}

unset($resp, $jsonResp);
ob_end_flush();
