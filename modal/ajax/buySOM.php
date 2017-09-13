<?php
session_start();

## Get Exchange Rate
#== BTC =========
$service_url = 'https://api.coinbase.com/v2/prices/BTC-USD/buy';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER,array(
	'Content-Type: application/json; charset=utf-8',
	'Accept: application/json',
));
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);	

$curl_response = curl_exec($curl);
$response = json_decode($curl_response, true);

# Set BTC
$PriceBTC = $response["data"]["amount"];

#== LTC =========
$service_url = 'https://api.coinbase.com/v2/prices/LTC-USD/buy';
// set url 
curl_setopt($curl, CURLOPT_URL, $service_url); 
$curl_response = curl_exec($curl);
$response = json_decode($curl_response, true);
# Set LTC
$PriceLTC = $response["data"]["amount"];

#== ETH =========
$service_url = 'https://api.coinbase.com/v2/prices/ETH-USD/buy';
// set url 
curl_setopt($curl, CURLOPT_URL, $service_url); 
$curl_response = curl_exec($curl);
$response = json_decode($curl_response, true);
# Set LTC
$PriceETH = $response["data"]["amount"];

# Close
curl_close ($curl);

try {
	// Check Logged In
	if (!isset($_SESSION['username'])){
		 throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please login to the system</div><div id="returnVal" style="display:none;">false</div>');
	}
    //Get Post Data
    $buySomBTC = str_replace(' ', '', $_POST['buySomBTC']);
	$buySomLTC = str_replace(' ', '', $_POST['buySomLTC']);
	$buySomETH = str_replace(' ', '', $_POST['buySomETH']);
	$clickType = str_replace(' ', '', $_POST['clickType']);
	$rateBTC = str_replace(' ', '', $_POST['rateBTC']);
	$rateLTC = str_replace(' ', '', $_POST['rateLTC']);
	$rateETH = str_replace(' ', '', $_POST['rateETH']);
	
	// To protect MySQL injection
	$buySomBTC = stripslashes($buySomBTC);
	$buySomLTC = stripslashes($buySomLTC);
	$buySomETH = stripslashes($buySomETH);
	$clickType = stripslashes($clickType);
	$rateBTC = stripslashes($rateBTC);
	$rateLTC = stripslashes($rateLTC);
	$rateETH = stripslashes($rateETH);
	

	//== Check Rate is Effective
	if (abs($PriceBTC-$rateBTC) > 10 || abs($PriceLTC-$rateLTC) > 3 || abs($PriceETH-$rateETH) > 5) {
		throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Exchange Rate is not effective, please refresh page.</div><div id="returnVal" style="display:none;">false</div>');
	}
		
	//== Check Values == Click Type (1-BTC, 2-LTC, 3-ETH)
    if (($buySomBTC == '' || $buySomBTC == '0') && $clickType == '1') {
        throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purchase amount specified (BTC)</div><div id="returnVal" style="display:none;">false</div>');
    }
	if (($buySomLTC == '' || $buySomLTC == '0') && $clickType == '2') {
        throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purchase amount specified (LTC)</div><div id="returnVal" style="display:none;">false</div>');
    }
	if (($buySomETH == '' || $buySomETH == '0') && $clickType == '3') {
        throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purchase amount specified (ETH)</div><div id="returnVal" style="display:none;">false</div>');
    }
	
	// Check confirmed amount prior update & insert purchase //
	$confirmedBTC = 0;
	$confirmedLTC = 0;
	$confirmedETH = 0;
	
	## Get confirmed Transactions from DB ##
	$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	$query = "SELECT coinType, sum(amount) as amount FROM CoinTransaction WHERE confirmations = 1 and memberId in (select id from members where username='".$_SESSION['username']."') group by coinType";
	$result = $mysqli->query($query);

	while($row = $result->fetch_array())
	{
		$rows[] = $row;
	}
	
	## Loop Through confirmed Transactions and Update ##
	foreach($rows as $row)
	{
		 if ($row['coinType'] == 'btc'){
			 $confirmedBTC = $row['amount'];
		 }
		 if ($row['coinType'] == 'ltc'){
			 $confirmedLTC = $row['amount'];
		 }
		 if ($row['coinType'] == 'eth'){
			 $confirmedETH = $row['amount'];
		 }
	}		
	
	/* free result set */
	$result->close();

	/* close connection */
	$mysqli->close();
	
	//== Convert Deposit to SOM 
	if ($clickType == '1' && floatval($buySomBTC/$rateBTC) <=  floatval($confirmedBTC)){
		//BTC
		$query2 = "Insert
		INTO 
			CoinTransaction (memberId, coinType, address, amount, confirmations)
		VALUES 
			(
			(select id from members where username = '".$_SESSION['username']."')
			, 'btc'
			, 'SOM'
			, '". floatval($buySomBTC/$rateBTC*-1) ."'
			, '1'
			);
		";
		$query2 = $query2 . "Insert
		INTO 
			CoinTransaction (memberId, coinType, address, amount, confirmations)
		VALUES 
			(
			(select id from members where username = '".$_SESSION['username']."')
			, 'SOM'
			, 'btc'
			, '". floatval($buySomBTC) ."'
			, '1'
			);
		";
		
	} else if ($clickType == '2' && floatval($buySomLTC/$rateLTC) <=  floatval($confirmedLTC)) {
		//LTC
				$query2 = "Insert
		INTO 
			CoinTransaction (memberId, coinType, address, amount, confirmations)
		VALUES 
			(
			(select id from members where username = '".$_SESSION['username']."')
			, 'ltc'
			, 'SOM'
			, '". floatval($buySomLTC/$rateLTC*-1) ."'
			, '1'
			);
		";
		$query2 = $query2 . "Insert
		INTO 
			CoinTransaction (memberId, coinType, address, amount, confirmations)
		VALUES 
			(
			(select id from members where username = '".$_SESSION['username']."')
			, 'SOM'
			, 'ltc'
			, '". floatval($buySomLTC) ."'
			, '1'
			);
		";
	} else if ($clickType == '3' && floatval($buySomETH/$rateETH) <=  floatval($confirmedETH)) {
		//ETH
				$query2 = "Insert
		INTO 
			CoinTransaction (memberId, coinType, address, amount, confirmations)
		VALUES 
			(
			(select id from members where username = '".$_SESSION['username']."')
			, 'eth'
			, 'SOM'
			, '". floatval($buySomETH/$rateETH*-1) ."'
			, '1'
			);
		";
		$query2 = $query2 . "Insert
		INTO 
			CoinTransaction (memberId, coinType, address, amount, confirmations)
		VALUES 
			(
			(select id from members where username = '".$_SESSION['username']."')
			, 'SOM'
			, 'eth'
			, '". floatval($buySomETH) ."'
			, '1'
			);
		";
	} else {
		 throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purchase amount specified</div><div id="returnVal" style="display:none;">false</div>');
	}
	
	error_log("sql:  ". $query2);
	
	//== Update DB
	$mysqli2 = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

	/* check connection */
	if ($mysqli2->connect_errno) {
		printf("Connect failed: %s\n", $mysqli2->connect_error);
		exit();
	}
	
	//== Successs	
	if ($mysqli2->multi_query($query2) === TRUE) {
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Thank you for your purchase</div><div id="returnVal" style="display:none;">true</div>';
	} else {
		echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purchase amount specified</div><div id="returnVal" style="display:none;">false</div>';
	}

	/* close connection */
	$mysqli2->close();	
	

} catch (Exception $x) {

    echo $x->getMessage();
}

?>