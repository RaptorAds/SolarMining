<?php
session_start();
require_once('../vendor/autoload.php');
date_default_timezone_set("ISO");

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


## Get Balance
if (isset($_SESSION['username'])){
	$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	$query = "SELECT 
				b.status_google as status_google
				,coinType
				, sum(amount) as amount
			FROM 
				CoinTransaction
				left join members b on b.id = CoinTransaction.memberId
			WHERE 
				memberId in (select id from members where username = '" . $_SESSION['username'] ."')
			GROUP BY
				coinType
			";
	$result = $mysqli->query($query);

	while($row = $result->fetch_array())
	{
		$rows[] = $row;
	}
	/* Initiailize amount */
	$netBTC = '0.00';
	$netETH = '0.00';
	$netLTC = '0.00';
	$netSOM = '0.00';

	foreach($rows as $row)
	{
		if ($row['coinType'] == 'btc') 
		{
			$netBTC =  $row['amount'] ;
		} elseif ($row['coinType'] == 'ltc') {
			$netLTC =  $row['amount'] ;
		} elseif ($row['coinType'] == 'eth') {
			$netETH =  $row['amount'] ;
		} elseif ($row['coinType'] == 'som') {
			$netSOM =  $row['amount'] ;
		}
		/* Initilize Status 2FA */
		$googleAuthStatus =  $row['status_google'] ;
	}
	/* free result set */
	$result->close();

	/* close connection */
	$mysqli->close();

}
## End Balance





	
?>
<html>
<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td  {
	border-top: 0;
}
.table {
	text-align:  center;
}
.table-responsive {
	border:  0;
}

</style>
<div class="table-responsive">
  <table class="table">
    <tr>
		<td></td>
		<td><img src="../img/convert/banner2.png" alt="" width="30"></td>
		<td><img src="../img/convert/banner4.png" alt="" width="30"></td>
		<td><img src="../img/convert/banner3.png" alt="" width="30"></td>
	</tr>
	<tr>
		<td></td>
		<td>Bitcoin</td>
		<td>Litecoin</td>
		<td>Ethereum</td>
	</tr>
	<tr>
		<td>Balance:</td>
		<td><? echo $netBTC ?></td>
		<td><? echo $netLTC ?></td>
		<td><? echo $netETH ?></td>
	</tr>
		<tr>
		<td>Rate (USD):</td>
		<td><? echo $PriceBTC ?></td>
		<td><? echo $PriceLTC ?></td>
		<td><? echo $PriceETH ?></td>
	</tr>
	
  </table>
</div>
</html>