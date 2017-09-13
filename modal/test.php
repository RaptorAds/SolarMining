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
	$netBTC = '0.00000000';
	$netETH = '0.00000000';
	$netLTC = '0.00000000';
	$netSOM = '0.00000000';

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
  <table class="table" style="font-size: small;">
    <tr>
		<td></td>
		<td><img src="../img/convert/banner2.png" alt="" width="30"></td>
		<td><img src="../img/convert/banner4.png" alt="" width="30"></td>
		<td><img src="../img/convert/banner3.png" alt="" width="30"></td>
	</tr>
	<tr>
		<td></td>
		<td>BTC</td>
		<td>LTC</td>
		<td>ETH</td>
	</tr>
	<tr>
		<td style="text-align:  left;">Balance</td>
		<td><? echo $netBTC ?></td>
		<td><? echo $netLTC ?></td>
		<td><? echo $netETH ?></td>
	</tr>
		<tr>
		<td style="text-align:  left;">Rate (USD)</td>
		<td><? echo $PriceBTC ?></td>
		<td><? echo $PriceLTC ?></td>
		<td><? echo $PriceETH ?></td>
	</tr>
	</tr>
		<tr>
		<td style="text-align:  left;">SOM = 1 USD</td>
		<td>
			<input min="0" max="<? echo ($PriceBTC*$netBTC); ?>" id="amtSomBTC" type="number" value="0" data-rule="quantity" style="border-radius: 4px; width:  50%; max-width:  80px; text-align: center; min-width:  50px;">
		</td>
		<td>
			<input min="0" max="<? echo ($PriceLTC*$netLTC); ?>" id="amtSomLTC" type="number" value="0" data-rule="quantity" style="border-radius: 4px; width:  50%; max-width:  80px; text-align: center; min-width:  50px;">
		</td>
		<td>
			<input min="0" max="<? echo ($PriceETH*$netETH); ?>" id="amtSomETH" type="number" value="0" data-rule="quantity" style="border-radius: 4px; width:  50%; max-width:  80px; text-align: center; min-width:  50px;">
		</td>
	</tr>
	<tr>
		<td></td>
		<td><a id='buySomBTC' name='buySomBTC' href="javascript:void(0)" class="btn btn2 btnSubmit">Buy</a></td>
		<td><a id='buySomLTC' name='buySomLTC' href="javascript:void(0)" class="btn btn2 btnSubmit">Buy</a></td>
		<td><a id='buySomETH' name='buySomETH' href="javascript:void(0)" class="btn btn2 btnSubmit">Buy</a></td>
	</tr>
	<div id="messageBuyError"></div>
	<span class="paymentalert" style="color:  red;"></span>
  </table>
</div>
<script>
// Initialize Inputs
$(document).ready(function() {
    var maxBTC = <? echo ($PriceBTC*$netBTC); ?>;
	var maxLTC = <? echo ($PriceLTC*$netLTC); ?>;
	var maxETH = <? echo ($PriceETH*$netETH); ?>;
	if (maxBTC == 0){
		$("#buySomBTC").attr('disabled','disabled');
		$("#amtSomBTC").attr('disabled','disabled');
	}
	if (maxLTC == 0){
		$("#buySomLTC").attr('disabled','disabled');
		$("#amtSomLTC").attr('disabled','disabled');
	}
	if (maxETH == 0){
		$("#buySomETH").attr('disabled','disabled');
		$("#amtSomETH").attr('disabled','disabled');
	}
});
// On Input Changes
$("#amtSomBTC").bind("keyup keydown", function() {
    var amount = parseFloat($(this).val());
	var max = <? echo ($PriceBTC*$netBTC); ?>;
    if (amount) {
        if (amount < 0 || amount > <? echo ($PriceBTC*$netBTC); ?>) {
            $("span.paymentalert").html("Your input must be between 0 and <? echo ($PriceBTC*$netBTC); ?>");
			$("#amtSomBTC").val("<? echo ($PriceBTC*$netBTC); ?>");
        } else {
            $("span.paymentalert").html("");
        }
    } else {
        $("span.paymentalert").html("Please input amount you wish to purchase");
    }
	if (max == 0){
		$("span.paymentalert").html("Please input amount you wish to purchase");
		$("#buySomBTC").attr('disabled','disabled');
	}
});

$("#amtSomLTC").bind("keyup keydown", function() {
    var amount = parseFloat($(this).val());
	var max = <? echo ($PriceLTC*$netLTC); ?>;
    if (amount) {
        if (amount < 0 || amount > <? echo ($PriceLTC*$netLTC); ?>) {
            $("span.paymentalert").html("Your input must be between 0 and <? echo ($PriceLTC*$netLTC); ?>");
			$("#amtSomLTC").val("<? echo ($PriceLTC*$netLTC); ?>");
        } else {
            $("span.paymentalert").html("");
        }
    } else {
        $("span.paymentalert").html("Your payment must be a number");
    }
	if (max == 0){
		$("span.paymentalert").html("Please input amount you wish to purchase");
		$("#buySomLTC").attr('disabled','disabled')
	}
});

$("#amtSomETH").bind("keyup keydown", function() {
    var amount = parseFloat($(this).val());
	var max = <? echo ($PriceETH*$netETH); ?>;
    if (amount) {
        if (amount < 0 || amount > <? echo ($PriceETH*$netETH); ?>) {
            $("span.paymentalert").html("Your input must be between 0 and <? echo ($PriceETH*$netETH); ?>");
			$("#amtSomETH").val("<? echo ($PriceETH*$netETH); ?>");
        } else {
            $("span.paymentalert").html("");
        }
    } else {
        $("span.paymentalert").html("Your payment must be a number");
    }
	if (max == 0){
		$("span.paymentalert").html("Please input amount you wish to purchase");
		$("#buySomETH").attr('disabled','disabled')
	}
});

// On Clicks Buy
var clickType = 0;
$( "#buySomBTC" ).click(function() {
  clickType = 1;
});
$( "#buySomLTC" ).click(function() {
  clickType = 2;
});
$( "#buySomETH" ).click(function() {
  clickType = 3;
});

$('#buySomBTC').click(submitClick);
$('#buySomLTC').click(submitClick);
$('#buySomETH').click(submitClick);
  
function submitClick() {

    var buySomBTC = $("#amtSomBTC").val();
    var buySomLTC = $("#amtSomLTC").val();
    var buySomETH = $("#amtSomETH").val();

	if (clickType == 1) {
		buySomLTC = "0";
		buySomETH = "0";
	}
	if (clickType == 2) {
		buySomBTC = "0";
		buySomETH = "0";
	}
	if (clickType == 3) {
		buySomBTC = "0";
		buySomLTC = "0";
	}
	
	if (((buySomBTC == "0"|| buySomBTC < 0) && clickType == 1) || ((buySomLTC == "0"|| buySomLTC < 0) && clickType == 2) || ((buySomETH == "0"|| buySomETH < 0) && clickType == 3)) {
      $("#messageBuyError").fadeOut(0, function (){
        $(this).html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Unable to purchase amount specified</div>").fadeIn();
      })
    }
    else {
      $.ajax({
        type: "POST",
        url: "modal/ajax/buySOM.php",
        data: "buySomBTC=" + buySomBTC + "&buySomLTC=" + buySomLTC + "&buySomETH=" + buySomETH + "&clickType=" + clickType,
        success: function (html) {

          var text = $(html).text();
          //Pulls hidden div that includes "true" in the success response
          var response = text.substr(text.length - 4);

          if (response == 'true') {
			// Disable Inputs	
            $('input').attr('disabled','disabled');
			$("#buySomBTC").attr('disabled','disabled');
			$("#buySomLTC").attr('disabled','disabled');
			$("#buySomETH").attr('disabled','disabled');

			// Display Success
            $("#messageBuyError").fadeOut(0, function (){
                $(this).html(html).fadeIn();
            })
			
			// Reload Page
			setTimeout("window.location='index.php'",3000);//reload after 3 sec.
		  }
          else {
            $("#messageBuyError").fadeOut(0, function (){
                $(this).html(html).fadeIn();
            })
			$( "#amtSomBTC" ).val("0");
			$( "#amtSomLTC" ).val("0");
			$( "#amtSomETH" ).val("0");

          }
        },
        beforeSend: function () {
            $("#messageBuyError").fadeOut(0, function (){
              $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
            })
        }
      });
    }
    return false;
  };


</script>
</html>