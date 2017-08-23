<?php
session_start();		
?>
<style>
	.m_table{width:100%}.m_table tr{height:40px;}.m_table tr{border-bottom:1px solid #e5e5e5}.m_table tr:first-child{border-bottom:none}.m_table th,.m_table td{padding:0 10px;word-wrap:break-word;font-size:12px;}@media (min-width: 767px){.m_table th,.m_table td{font-size:14px}}.m_table th{background-color:#f4f6f7;font-weight:normal;color:#333333}.m_table a+a{margin-left:5px}.m_paging{text-align:center;line-height:30px;margin-top:25px}
</style>
<html>
<div class="form-group" id="Detail-box">
			<table class="m_table">
			<?php
			## Get Transactions from DB ##
			$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

			/* check connection */
			if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}
			
			$query = "SELECT 
						address
						, coinType
						, Case When confirmations = 1 Then 'Confirmed' Else 'Pending' End As 'confirmations'
						, amount
						, mod_timestamp
					FROM 
						CoinTransaction 
					WHERE memberId in (select id from members where username = '" . $_SESSION['username'] ."')";
			$result = $mysqli->query($query);

			while($row = $result->fetch_array())
			{
				$rows[] = $row;
			}
			
			?>
			<tbody>
				<tr>
					<th>Time</th>
					<th>Type</th>
					<th>Amount</th>
					<th>Status</th>
				</tr>
				<?php	
					foreach($rows as $row)
					{
						if ($row['mod_timestamp']){
							if ($row['coinType'] == 'btc') {
								$explorer = "https://live.blockcypher.com/btc/address/" . $row['address'] ;
							} elseif ($row['coinType'] == 'ltc') {
								$explorer = "https://live.blockcypher.com/ltc/address/" . $row['address'] ;
							} else {
								$explorer = "https://etherscan.io/address/" . $row['address'] ;
							}
							
							echo "<tr>";
							echo "<td>" . $row['mod_timestamp'] . "</td>";
							echo "<td>" . strtoupper($row['coinType']) . "</td>";
							echo "<td>" . $row['amount'] . "</td>";
							echo "<td><a href='" .$explorer. "' target='_blank'>" . $row['confirmations'] . "</a></td>";
							echo "</tr>";
						}
					}
					/* free result set */
					$result->close();

					/* close connection */
					$mysqli->close();				
				?>
			</tbody>
			</table>
		</div>
</html>