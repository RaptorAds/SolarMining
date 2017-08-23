<?php
session_start();
require_once('../vendor/autoload.php');

use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration; 
use Coinbase\Wallet\Resource\Address;

date_default_timezone_set("ISO");

	$apiKey = 'e1mSUBOTKXY3w49z';
	$apiSecret = 'I2NkibuQGZ3wojG3z5q7jcVPjGW6wnE6';	
	$configuration = Configuration::apiKey($apiKey, $apiSecret);
	$client = Client::create($configuration);
	
	#Generate address from API	

	$account = $client->getAccount('58f9d03fa68baf0224246f98');
	$address = new Address([
		'name' => 'SolarICO - LTC'
	]);
	$client->createAccountAddress($account, $address);
	$LTCAddress = $address->getAddress();
		
?>
<script type="text/javascript" src="../js/qrcode.js"></script>
<style>
#qrcode_LTC {
  width: 70px;
  height:70px;
  margin-top:5px;
} 
</style>
<html>
	<h>Please deposit to the below address or QR code.</h>	
	<input id="text_LTC" type="text" value="<?php echo $LTCAddress; ?>" style="width:95%" readonly/><br />
	<div id="qrcode_LTC"></div>
	</br></br>
	<h>Note:  Each deposit generated a new address.  You can see all your transactions in the detail page.</h> 
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode_LTC"), {
	width : 100,
	height : 100
});

function makeCode () {		
	var elText = document.getElementById("text_LTC");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});

</script>
</script>
</html>