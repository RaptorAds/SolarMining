<?php

require_once('../vendor/autoload.php');

use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration; 
use Coinbase\Wallet\Resource\Account;
use Coinbase\Wallet\Resource\Address;
use Coinbase\Wallet\Enum\CurrencyCode;
use Coinbase\Wallet\Resource\Transaction;
use Coinbase\Wallet\Value\Money;

	$apiKey = 'e1mSUBOTKXY3w49z';
	$apiSecret = 'I2NkibuQGZ3wojG3z5q7jcVPjGW6wnE6';	
	$configuration = Configuration::apiKey($apiKey, $apiSecret);
	$client = Client::create($configuration);
	
	#Generate address from API	

	$account = $client->getPrimaryAccount();
	$address = new Address([
		'name' => 'SolarICO - BTC'
	]);
	$client->createAccountAddress($account, $address);
	$BTCAddress = $address->getAddress();
		
?>
<script type="text/javascript" src="../js/qrcode.js"></script>
<style>
#qrcode {
  width: 70px;
  height:70px;
  margin-top:5px;
} 
</style>
<html>
	<h>Please deposit BTC to the below address or QR code.</h>	
	<input id="text" type="text" value="<?php echo $BTCAddress; ?>" style="width:80%" readonly/><br />
	<div id="qrcode"></div>
	</br></br>
	<h>Note:  Each deposit generated a new address.  You can see all your transactions in the detail page.</h> 
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 100,
	height : 100
});

function makeCode () {		
	var elText = document.getElementById("text");
	
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