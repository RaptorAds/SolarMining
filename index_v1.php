<?php require "login/loginheader.php"; ?>
<html>
<head>
	<meta charset="utf-8">
	<title>SolarMine - The Green Mining ICO</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="/css/grid.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="/css/style.css" >
	<link rel="stylesheet" href="/css/menu.css?v=0.3" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://admin.raptorads.com/js/dateformat.js"></script>
	<script src="/js/index.js"></script>
</head>
<body>
<?php
define('SERVER_ROOT', '/phpGrid_Lite');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/phpGrid_Lite/conf.php");
date_default_timezone_set("Asia/Bangkok"); 

?>
<script>
$(function () {
    //Page Load
	
	//Get Reload Parameter
    var reload = location.search.split('reload=')[1];
	if (reload) {
		reload = reload.split('&')[0];
	}
	
	//Initialize 
	if (reload != "1"){
		$('input[id="dateFrom"]').setPrevious();
		$('input[id="dateTo"]').setNow();
	} else {
		$('input[id="dateFrom"]').value = '<?php if($_GET) echo $_GET['from']; ?>';
		$('input[id="dateTo"]').value = '<?php if($_GET) echo $_GET['to']; ?>';
	}
		
	$('input[id="dateFrom"]').datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$('input[id="dateTo"]').datepicker({ dateFormat: 'yy-mm-dd' }).val();
});
</script>

<div id="wrapper">
  <div id="leftWrapper">
      <div id="listView" class="list">
        <li class="list-item-active"><a href="https://admin.raptorads.com/">Campaign Summary</a></li>
        <li><a href="https://admin.raptorads.com/grid_sum.php">Offer Summary</a></li>
		<li><a href="https://admin.raptorads.com/grid_campaignInfo.php">Visit/Convert Info</a></li>
		<li><a href="https://admin.raptorads.com/grid_countdupe.php">Count Duplicate</a></li>
        <li><a href="https://admin.raptorads.com/grid_subscription.php">Conversions</a></li>
        <li><a href="https://admin.raptorads.com/login/logout.php">Logout</a></li>
      </div>
    </div>
    <div id="rightWrapper">
      <div id="header"><a id="fullPage" href="#">|||</a></div>
      <div id="contentWrapper">
        <article id="showCase">
          <div class="article-header">RaptorAds Report</div>
		  <section style="width:95%;">
		  <fieldset id="SearchPanel">
				<legend>Search</legend>
				From:  <input id="dateFrom" type="text" name="dateFrom" onChange="dateChange()" size="10" 
				value='<?php if($_GET) echo $_GET['from']; ?>' />
				To:  <input id="dateTo" type="text" name="dateTo" onChange="dateChange()" size="10" 
				value='<?php if($_GET) echo $_GET['to']; ?>' />
				Campaign Name:  <input id="CampaignName" type="text" placeholder="Enter Campaign"
				value='<?php if($_GET) echo $_GET['campaign']; ?>'/>
				<button id="searchbtn" onclick="dateChange()"> Apply Search </button>
		  </fieldset>
		  </section>
		  <section>
			<?php $grid -> display(); ?>          
		  </section>
        </article>    
      </div>
    </div>
</div>
</body>