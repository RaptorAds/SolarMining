<?php
session_start();		
?>
<style>
	.m_table{width:100%}.m_table tr{height:40px;}.m_table tr{border-bottom:1px solid #e5e5e5}.m_table tr:first-child{border-bottom:none}.m_table th,.m_table td{padding:0 10px;word-wrap:break-word;font-size:12px;}@media (min-width: 767px){.m_table th,.m_table td{font-size:14px}}.m_table th{background-color:#f4f6f7;font-weight:normal;color:#333333}.m_table a+a{margin-left:5px}.m_paging{text-align:center;line-height:30px;margin-top:25px}

	.pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}	
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
			<thead>
			<tr>
				<th>Time (UTC-7) </th>
				<th>Type</th>
				<th>Amount</th>
				<th>Status</th>
			</tr>
			</thead>
			<tbody id="myTable">
				<?php	
					foreach($rows as $row)
					{
						if ($row['mod_timestamp']){
							if ($row['coinType'] == 'btc' &&  $row['address'] != 'SOM') {
								$explorer = "https://live.blockcypher.com/btc/address/" . $row['address'] ;
							} elseif ($row['coinType'] == 'ltc' &&  $row['address'] != 'SOM') {
								$explorer = "https://live.blockcypher.com/ltc/address/" . $row['address'] ;
							} elseif ($row['coinType'] == 'eth' &&  $row['address'] != 'SOM')  {
								$explorer = "https://etherscan.io/address/" . $row['address'] ;
							} else {
								$explorer = "#";
							}
							
							echo "<tr>";
							echo "<td>" . $row['mod_timestamp'] . "</td>";
							echo "<td>" . strtoupper($row['coinType']) . "</td>";
							echo "<td>" . $row['amount'] . "</td>";
							if ($explorer == '#'){
								echo "<td><a href='" .$explorer. "'>" . $row['confirmations'] . "</a></td>";
							} else {
								echo "<td><a href='" .$explorer. "' target='_blank'>" . $row['confirmations'] . "</a></td>";
							}
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
			<div class="col-md-12 text-center">
			<ul class="pagination pagination-lg pager" id="myPager"></ul>
			</div>
		<script>
		$.fn.pageMe = function(opts){
			var $this = this,
			defaults = {
				perPage: 7,
				showPrevNext: false,
				hidePageNumbers: false
			},
			settings = $.extend(defaults, opts);
			
			var listElement = $this;
			var perPage = settings.perPage; 
			var children = listElement.children();
			var pager = $('.pager');
			
			if (typeof settings.childSelector!="undefined") {
				children = listElement.find(settings.childSelector);
			}
			
			if (typeof settings.pagerSelector!="undefined") {
				pager = $(settings.pagerSelector);
			}
			
			var numItems = children.size();
			var numPages = Math.ceil(numItems/perPage);

			pager.data("curr",0);
			
			if (settings.showPrevNext){
				$('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
			}
			
			var curr = 0;
			while(numPages > curr && (settings.hidePageNumbers==false)){
				$('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
				curr++;
			}
			
			if (settings.showPrevNext){
				$('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
			}
			
			pager.find('.page_link:first').addClass('active');
			pager.find('.prev_link').hide();
			if (numPages<=1) {
				pager.find('.next_link').hide();
			}
			  pager.children().eq(1).addClass("active");
			
			children.hide();
			children.slice(0, perPage).show();
			
			pager.find('li .page_link').click(function(){
				var clickedPage = $(this).html().valueOf()-1;
				goTo(clickedPage,perPage);
				return false;
			});
			pager.find('li .prev_link').click(function(){
				previous();
				return false;
			});
			pager.find('li .next_link').click(function(){
				next();
				return false;
			});
			
			function previous(){
				var goToPage = parseInt(pager.data("curr")) - 1;
				goTo(goToPage);
			}
			 
			function next(){
				goToPage = parseInt(pager.data("curr")) + 1;
				goTo(goToPage);
			}
			
			function goTo(page){
				var startAt = page * perPage,
					endOn = startAt + perPage;
				
				children.css('display','none').slice(startAt, endOn).show();
				
				if (page>=1) {
					pager.find('.prev_link').show();
				}
				else {
					pager.find('.prev_link').hide();
				}
				
				if (page<(numPages-1)) {
					pager.find('.next_link').show();
				}
				else {
					pager.find('.next_link').hide();
				}
				
				pager.data("curr",page);
				pager.children().removeClass("active");
				pager.children().eq(page+1).addClass("active");
			
			}
		};

		$(document).ready(function(){
			
		  $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:7});
			
		});
		</script>
</html>