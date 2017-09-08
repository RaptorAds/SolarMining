<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Convert Deposit</title>
	<link rel="stylesheet" href="../css/convert/bootstrap.min.css">
	<link rel="stylesheet" href="../css/convert/styles.css?v4">
	<link rel="stylesheet" href="../css/convert/purple.css">
	<link href="../css/convert/app.min.css" rel="stylesheet">
</head>
<body class="page pre" style="">
<section class="packages grey-bg" id="packages">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="pricing pricing-5">
<div class="col-sm-3 text-center hidden-sm hidden-xs">
<div class="pricing__title">
</div>
<ul>
<li>
<span>Exchange rate</span>
</li>
<li>
<span>Balance</span>
</li>
<br><br><br><br><br><br><br><br>
</ul>
</div>
<div class="col-md-3 col-sm-4 text-center">
<div class="pricing__title">
<div class="price">
<h2>
<span class="sign">$</span>
<span class="amount switch-data">BTC	</span>
<span class="month switch-data"> /USD</span>
<div class="most-popular1">
<img src="../img/convert/banner2.png" alt="" width="50">
</div>
</h2>
</div>
</div>
<ul>
<li>
<span class="hidden-lg hidden-md">Exchange rate</span>
<span class="text">PriceHere</span>
</li>
<li>
<span class="hidden-lg hidden-md">Balance</span>
<span class="text"><?php echo $netBTC; ?></span>
</li>
	<div class="calculator">
					<div class="calculator__investment should-appear appeared">
						<div class="calculator-controls" id="controls-investment">
							<button class="calculator-controls__button calculator-controls__button_less" data-action="less">
								<span class="calculator-controls__button-text">–</span>
							</button>
							<label class="calculator-controls__input-wrapper">
								<input class="calculator-controls__input" id="input-investment" type="number" min="0" step="100">
								<span class="calculator-controls__input-mask" id="input-investment-mask" style="">$0</span>
							</label>
							<button class="calculator-controls__button calculator-controls__button_more" data-action="more">
								<span class="calculator-controls__button-text">+</span>
							</button>
						</div>
					</div>
										<div class="calculator__tokens should-appear appeared">
						<div class="calculator-controls" id="controls-tokens">
							<button class="calculator-controls__button calculator-controls__button_less" data-action="less">
								<span class="calculator-controls__button-text">–</span>
							</button>
								<label class="calculator-controls__input-wrapper">
								<input class="calculator-controls__input" id="input-tokens" type="number" min="0" step="100">
								<span class="calculator-controls__input-mask" id="input-tokens-mask">0</span></label>
							<button class="calculator-controls__button calculator-controls__button_more" data-action="more">
								<span class="calculator-controls__button-text">+</span>
							</button>
						</div>
					</div>
<br><br><br><br>	
<li>
<a href="https://uploadfiles.io/register?pid=1" class="btn btn-default btn-lg standard-button"><i  aria-hidden="true"></i> Convert</a>
</li>
</ul>
</div>
<div class="col-md-3 col-sm-4 text-center pricing--emphasise">
<div class="pricing__title">
<div class="price">
<h2>
<span class="sign">$</span>
<span class="amount switch-data">LTC</span>
<span class="month switch-data"> /USD</span>
<div class="most-popular1">
<img src="../img/convert/banner4.png" alt="" width="60">
</div>
</h2>
</div>
</div>
<ul>
<li>
<span class="hidden-lg hidden-md">Exchange rate</span>
<span class="text">PriceHere</span>
</li>
<li>
<span class="hidden-lg hidden-md">Balance</span>
<span class="text"><?php echo $netLTC; ?></span>
</li>
	<div class="calculator">
					<div class="calculator__investment should-appear appeared">
						<div class="calculator-controls" id="controls-investment">
							<button class="calculator-controls__button calculator-controls__button_less" data-action="less">
								<span class="calculator-controls__button-text">–</span>
							</button>
							<label class="calculator-controls__input-wrapper">
								<input class="calculator-controls__input" id="input-investment" type="number" min="0" step="100">
								<span class="calculator-controls__input-mask" id="input-investment-mask" style="">$0</span>
							</label>
							<button class="calculator-controls__button calculator-controls__button_more" data-action="more">
								<span class="calculator-controls__button-text">+</span>
							</button>
						</div>
					</div>
										<div class="calculator__tokens should-appear appeared">
						<div class="calculator-controls" id="controls-tokens">
							<button class="calculator-controls__button calculator-controls__button_less" data-action="less">
								<span class="calculator-controls__button-text">–</span>
							</button>
								<label class="calculator-controls__input-wrapper">
								<input class="calculator-controls__input" id="input-tokens" type="number" min="0" step="100">
								<span class="calculator-controls__input-mask" id="input-tokens-mask">0</span></label>
							<button class="calculator-controls__button calculator-controls__button_more" data-action="more">
								<span class="calculator-controls__button-text">+</span>
							</button>
						</div>
					</div>
<br><br><br><br>	

<li>
<a href="https://uploadfiles.io/register?pid=11" class="btn btn-default btn-lg standard-button"><i  aria-hidden="true"></i> Convert</a>
</li></ul>
</div>
<div class="col-md-3 col-sm-4 text-center ">
<div class="pricing__title">
<div class="price">
<h2>
<span class="sign">$</span>
<span class="amount switch-data">ETH</span>
<span class="month switch-data"> /USD</span>
<span class="month switch-data hide"> /yr</span>
<div class="most-popular1">
<img src="../img/convert/banner3.png" alt="" width="70">
</div>
</h2>
</div>
</div>
<ul>
<li>
<span class="hidden-lg hidden-md">Exchange rate</span>
<span class="text">PriceHere</span>
</li>
<li>
<span class="hidden-lg hidden-md">Balance</span>
<span class="text"><?php echo $netETH; ?></span>
</li>
	<div class="calculator">
					<div class="calculator__investment should-appear appeared">
						<div class="calculator-controls" id="controls-investment">
							<button class="calculator-controls__button calculator-controls__button_less" data-action="less">
								<span class="calculator-controls__button-text">–</span>
							</button>
							<label class="calculator-controls__input-wrapper">
								<input class="calculator-controls__input" id="input-investment" type="number" min="0" step="100">
								<span class="calculator-controls__input-mask" id="input-investment-mask" style="">$0</span>
							</label>
							<button class="calculator-controls__button calculator-controls__button_more" data-action="more">
								<span class="calculator-controls__button-text">+</span>
							</button>
						</div>
					</div>
										<div class="calculator__tokens should-appear appeared">
						<div class="calculator-controls" id="controls-tokens">
							<button class="calculator-controls__button calculator-controls__button_less" data-action="less">
								<span class="calculator-controls__button-text">–</span>
							</button>
								<label class="calculator-controls__input-wrapper">
								<input class="calculator-controls__input" id="input-tokens" type="number" min="0" step="100">
								<span class="calculator-controls__input-mask" id="input-tokens-mask">0</span></label>
							<button class="calculator-controls__button calculator-controls__button_more" data-action="more">
								<span class="calculator-controls__button-text">+</span>
							</button>
						</div>
					</div>
<br><br><br><br>	
<li>
<a href="https://uploadfiles.io/register?pid=12" class="btn btn-default btn-lg standard-button"><i aria-hidden="true"></i> Convert</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div></section>
</body></html>