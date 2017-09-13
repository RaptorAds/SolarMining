<?php
try {
    //Get Post Data
    $buySomBTC = str_replace(' ', '', $_POST['buySomBTC']);
	$buySomLTC = str_replace(' ', '', $_POST['buySomLTC']);
	$buySomETH = str_replace(' ', '', $_POST['buySomETH']);
	$clickType = str_replace(' ', '', $_POST['clickType']);

	//== Check Values == Click Type (1-BTC, 2-LTC, 3-ETH)
    if (($buySomBTC == '' || $buySomBTC == '0') && $clickType == '1') {
        throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purcahse amount specified (BTC)</div><div id="returnVal" style="display:none;">false</div>');
    }
	if (($buySomLTC == '' || $buySomLTC == '0') && $clickType == '2') {
        throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purcahse amount specified (LTC)</div><div id="returnVal" style="display:none;">false</div>');
    }
	if (($buySomETH == '' || $buySomETH == '0') && $clickType == '3') {
        throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to purcahse amount specified (ETH)</div><div id="returnVal" style="display:none;">false</div>');
    }
	
	//== Convert Deposit to SOM 
	if ($clickType == '1'){
		
		
	}		
	
	
	//== Successs
	echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Thank you for your purchase</div><div id="returnVal" style="display:none;">true</div>';

} catch (Exception $x) {

    echo $x->getMessage();
}

?>