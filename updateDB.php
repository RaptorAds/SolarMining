<?php

	## Get Unconfirmed Transactions from DB ##
	$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	$query = "SELECT address, coinType FROM CoinTransaction WHERE confirmations = 0";
	$result = $mysqli->query($query);

	while($row = $result->fetch_array())
	{
		$rows[] = $row;
	}
	
	## Loop Through Pending Unconfirmed Transactions and Update ##
	foreach($rows as $row)
	{
		$address = $row['address'];
		$sh = curl_init();
		
		if ($row['coinType'] == 'btc') {
			curl_setopt($sh, CURLOPT_URL, "https://api.blockcypher.com/v1/btc/main/addrs/" . $address );
		} elseif ($row['coinType'] == 'ltc') {
			curl_setopt($sh, CURLOPT_URL, "https://api.blockcypher.com/v1/ltc/main/addrs/" . $address );
		} else {
			curl_setopt($sh, CURLOPT_URL, "https://api.blockcypher.com/v1/eth/main/addrs/" . $address );
		}
		
		curl_setopt($sh, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($sh, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($sh, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($sh, CURLOPT_SSL_VERIFYPEER, 0);
		
		$results = curl_exec($sh);
		$report_results = json_decode($results, true);
		
		if (curl_errno($sh)) {
			echo 'Error:' . curl_error($sh);
		}

		if ($report_results['final_balance'] <> '0'){
			echo $report_results['final_balance'] . "</br>";
			if ($report_results['final_balance']){
					$amount = $report_results['final_balance'];
			} 				
			
			$mysqli2 = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

			/* check connection */
			if ($mysqli2->connect_errno) {
				printf("Connect failed: %s\n", $mysqli2->connect_error);
				exit();
			}
			
			$query = "UPDATE CoinTransaction SET amount = '". $amount ."', confirmations = 1 WHERE address = '" . $address . "'";
			$result2 = $mysqli2->query($query);

			/* free result set */
			$result2->close();

			/* close connection */
			$mysqli2->close();	
		}		
	}
	/* free result set */
	$result->close();

	/* close connection */
	$mysqli->close();
	
?>