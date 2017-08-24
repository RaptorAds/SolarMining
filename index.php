<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php
session_start();
include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
?>
	<head>
		<!-- BASICS -->
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SolarMine - Sustainable Cryptocurrency Mining</title>
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/isotope.css" media="screen" />	
		<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link href="css/responsive-slider.css" rel="stylesheet">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:400,300,200,100,500,600,700,800,900">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/overwrite.css?v=1"> 
        <link rel="stylesheet" href="css/style.css?v=2">
		<link rel="stylesheet" type="text/css" href="css/overlay.css?v=2" />
		<!-- skin -->
		<link rel="stylesheet" href="skin/default.css">
    </head>
	 
    <body>
	<style>
	html, body {
		font-family:  PingFangSC, \5FAE\8F6F\96C5\9ED1 ,Helvetica,Arial;
	}
	</style>
	<div class="header">
	<section id="header" class="appear">
		
		<div class="navbar navbar-fixed-top" role="navigation" data-0="line-height:100px; height:100px; background-color:rgba(0,0,0,0.3);" data-300="line-height:60px; height:60px; background-color:rgba(0,0,0,1);">
			
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="fa fa-bars color-white"></span>
					</button>
					<h1><a class="navbar-brand" href="index.php" data-0="line-height:90px;" data-300="line-height:50px;">SolarMine
					</a></h1>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav" data-0="margin-top:20px;" data-300="margin-top:5px;">
						<li class="active"><a href="#index">Home</a></li>
						<li>
							<?php if (!isset($_SESSION['username'])) {
									echo "<a href='#index' data-toggle='modal' data-target='#signup'>Signup</a>";
								} else {   
									echo "<a href='#index' data-toggle='modal' data-target='#accountPage'>My Account</a>";
								}
							?>
						</li>
						<li><a href="#section-about">About</a></li>
						<li><a href="#team">White Paper</a></li>
						<li><a href="#line-pricing">Roadmap</a></li>
						<li><a href="#section-contact">FAQ</a></li>
						<?php 
						if (isset($_SESSION['username'])) {
							#echo "<li><a>&nbsp;|&nbsp;" .$_SESSION['username']. "</a></li>";
							echo "<li><a href='./login/logout.php'>Logout</a></li>";
						} else { 
							echo "<li><a href='#index' data-toggle='modal' data-target='#login'>Login</a></li>";
						}
						?>
					</ul>
				</div><!--/.navbar-collapse -->
			</div>
		
		
	</section>
	</div>
	

<section class="featured">
	<div id="index">
		<!-- Responsive slider - START -->
    	<div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true" style="padding-top: 100px;">
		<div class="slides" data-group="slides">
		<style>
		.image { 
		   position: relative; 
		   width: 100%; /* for IE 6 */
		}

		h2 { 
		   position: absolute; 
		   top: 200px; 
		   left: 0; 
		   width: 100%; 
		}
		h2 span { 
		   color: white; 
		   font: bold 24px/45px Helvetica, Sans-Serif;
		   background: rgb(0, 0, 0);
		   background: rgba(0, 0, 0, 0.7);
		   padding: 10px; 
		}
		h2 span.spacer {
		   padding:0 5px;
		}
		</style>
		<div class="image">
			<img src="img/solarfarm.png" alt="" />
			<h2><span>Next Generation Cryptocurrency Mining</span></h2>
		</div>
		</div>
    	</div>
      <!-- Responsive slider - END -->
	</div>
	</section>
	<!--about-->
	<section id="section-about" class="section appear clearfix">
		<div class="container">
			<div class="about">
				<div class="row mar-bot40">
					<div class="col-md-offset-3 col-md-6">
						<div class="title">
							<div class="wow bounceIn">
							<h1 class="section-heading animated" data-animation="bounceInUp">SolarMine Project</h1>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 " style="width:  100%;">
						<div class="company mar-left10">
							<h4>Next generation cryptocurrency project combining solar power and cryptpocurrency mining.</h4>
							<p>We will introduce token “SOM” for secondary market. ICO participants will get the tokens and ROI in the form of SOM.  The project will develop large-scale solar farm which will provide electricity support for clustered mining operation.  The issue of SOM will allow investors to trade in secondary market and achieve premium with liquidity. Meanwhile, the asset of mining hardware and the stable daily mining yields will support the price of SOM.  Investors of SolarMine will profit from </p>
						</div>
						<div class="list-style">
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-xs-12">
									<ul>
										<li>Sustainable & Renewable Energy</li>
										<li>High Efficiency Clustered Mining</li>
									</ul>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
									<ul>
										<li>Monthly Dividend Payouts</li>
										<li>Investment Liquidity</li>
										<li>Asset Transparency</li>
									</ul>
								</div>
								
							</div>
						</div>
					</div>
				</div>
					
			</div>
			
		</div>
	</section>
	<!--/about-->
		</section>			
		<!-- team -->
		<section id="team" class="team-section appear clearfix">
		<div class="container">

				<div class="row mar-bot10">
					<div class="col-md-offset-3 col-md-6">
						<div class="section-header">
						<div class="wow bounceIn">
						
							<h1 class="section-heading animated" data-animation="bounceInUp">Stable and Sustainable Mining</h1>
					
						</div>
						</div>
					</div>
				</div>

					<div class="row align-center mar-bot45">
						<div class="col-md-4">
						<div class="wow bounceIn" data-animation-delay="4.8s">
							<div class="team-member">
								<div class="profile-picture">
									<img src="img/benefit1.png" alt="">
									<div class="profile-overlay"></div>
								</div>
								<div class="team-detail">
									<h4>Stable and Steady Profit</h4>
									<span> </span>
								</div>
								<div class="team-bio">
								<p>The solar powered mining-based project adopts a reserve redemption mechanism to protect users’ income, with a stable, sustained and clear revenue model</p>
								</div>
							</div>
						</div>
						</div>
						<div class="col-md-4">
							
							<div class="wow bounceIn">
							<div class="team-member">
								<div class="profile-picture">
									<img src="img/benefit2.png" alt="">
									<div class="profile-overlay"></div>
								</div>
								<div class="team-detail">
									<h4>Flexibility</h4>
									<span> </span>
								</div>
								<div class="team-bio">
								<p>Provide stable ROI benefits for investors.  Trade "SOM" freely in the trading market at any time to participate in or exit the project.</br></br></br></p>
								</div>
							</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="wow bounceIn">
							<div class="team-member">
								<div class="profile-picture">
									<img src="img/benefit3.png" alt="">
									<div class="profile-overlay"></div>
								</div>
								<div class="team-detail">
									<h4>Transparency</h4>
									<span> </span>
								</div>
								<div class="team-bio">
								<p>The dividends will be payout monthly and asset of the project will be publicized weekly.</br></br></br></br></p>
								</div>
							</div>
							</div>
						</div>
						
					</div>
						
		</div>
		</section>
		<!-- /team -->
		<section id="line-pricing" class="section appear clearfix">
			<div class="container pad-top50">
				<div class="row mar-bot10 ">
					<div class="col-md-offset-3 col-md-6">
						<div class="section-header">
							<div class="wow bounceIn">						
								<h1 class="section-heading animated" data-animation="bounceInUp">Roadmap</h1>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			</br></br></br>
			<!-- Begin Timeline -->
			<div class="bar" style="text-align: center;" ></div>
			<div class="timeline">
				<p>
				<div class="entry">
					<h4>Seed-ICO</h4>
					<p>12/01/2017 - 12/15/2017</p>
				</div>
				<div class="entry">
					<h4>Pre-ICO</h4>
					<p>12/15/2017 - 12/31/2017</p>
				</div>
				<div class="entry">
					<h4>Official-ICO</h4>
					<p>12/31/2017 - 01/31/2018</p>
				</div>
				<div class="entry">
					<h4>Operations Setup</h4>
					<p>2018 Q1</p>
				</div>
				<div class="entry">
					<h4>Operations</h4>
					<p>2018 Q2 - Regular Disclosure</p>
				</div>
				</p>
			</div>
			
		<!-- End Timeline -->
		</section>
		</br></br></br></br></br></br></br>
		<!-- contact -->
		<section id="section-contact" class="section appear clearfix">
		<div class="container">
				
				<div class="row mar-bot40">
					<div class="col-md-offset-3 col-md-6">
						<div class="section-header">
							<h1 class="section-heading animated" data-animation="bounceInUp">FAQ</h1>
						</div>
					</div>
				</div>
				<div class="indexMod modFAQ" id="faqpoint">
        <div class="container">
            <ul class="faqList">
                <li class="faqItem">
                    <a class="ques collapsed" data-toggle="collapse" href="#ans1" aria-expanded="false">1. What is the SOM?
					<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans1" aria-expanded="false" style="height: 0px;">
                        <p>SOM (SolarMine) is a cryptocurrency mining project.  The project will introduce the token “SOM” within ethereum protocol and is equipped with liquidity, decentralization and transparency.
                        </p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans2">2. What is the total volume of SOM and initial distribution? <span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans2">
                        <p>Total: 2 hundred million (200,000,000) SOM. The SOM supply will be allocated as follows:
                        </p>
                        <table class="SOMShare">
                            <tbody><tr>
                                <td>Ratio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Distribution&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">20%</td>
                                <td style="vertical-align: top;">Founding Team</td>
                                <td style="vertical-align: top;">Assign to the founding team for their human, material, resource and technical contributions during project development. The freezing period is 2 years, SOM will be unlocked by 25% every six months</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">80%</td>
                                <td style="vertical-align: top;">ICO</td>
                                <td style="vertical-align: top;">All the ICO funds of SOM will be used for the purchase of miners</td>
                            </tr>
                        </tbody></table>
                        <p></p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans4">3. What crypto-currencies are accepted?<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans4">
                        <p>SOM are sold against Bitcoin (BTC) and Ether (ETH).
                        </p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans5">4. What is the price of SOM?
<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans5">
                        <table class="priceTable">
                            <tbody><tr>
                                <td>Project&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Seed-ICO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Pre-ICO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Official-ICO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Thailand Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>12/01/17 18:00 - 12/15/17 18:00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>12/15/17 18:00 - 12/31/17 18:00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>12/31/17 18:00 - 01/31/18 18:00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td>1 BTC</td>
                                <td>22000</td>
                                <td>21000</td>
                                <td>20000</td>
                            </tr>
                            <tr>
                                <td>1 ETH</td>
                                <td>2200</td>
                                <td>2100</td>
                                <td>2000</td>
                            </tr>
                        </tbody></table>
                        <p>The SOM includes three price tiers. There’s 10% premium during Seed-ICO. Namely, 1 BTC = 22000 SOM, 1 ETH = 2200 SOM.
                        </p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans6">5. How can I participate?
<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans6">
                        <p>Please sign up on www.somico.com to purchase token</p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans7">6. How are the funds secured?<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans7">
                        <p>All funds collected during ICO will be deposited in secured multi-sig wallets, with which all outgoing transaction have to be verified by multiple parties.</p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans8">7.  When does SOM trading get online?<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans8">
                        <p>The expected time is in December.</p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans9">8. How will the funds raised be used?<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans9">
                        <p>Funds raised from ICO will be used to deploy solar farm installations to support clustered mining operations.</p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans10">9. What is the reserves mechanism？<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans10">
                        <p>Mining income with specific ratio will be allocated to the reserves, purchasing new miners and operation costs.</p>
                    </div>
                </li>
                <li class="faqItem">
                    <a class="ques" data-toggle="collapse" href="#ans11">10. How will the reserves be kept?<span class="faqCollaspe"></span></a>
                    <div class="ansBox collapse" id="ans11">
                        <p>Reserves will be kept in BTC and ETH in the ratio of 6:4.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
				
			</div>
		</section>
	<section id="footer" class="section footer">
		<div class="container">
			<div class="row animated opacity mar-bot0" data-andown="fadeIn" data-animation="animation">
				<div class="col-sm-12 align-center">
                    <ul class="social-network social-circle">
                        <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                    </ul>				
				</div>
			</div>

			<div class="row align-center copyright">
					<div class="col-sm-12"><p>Copyright &copy; 2017 SolarMine - Raptor Consulting Company Limited</p></div>
			</div>
		</div>

	</section>
	<a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	

	<script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.isotope.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/fancybox/jquery.fancybox.pack.js"></script>
	<script src="js/skrollr.min.js"></script>		
	<script src="js/jquery.scrollTo-1.4.3.1-min.js"></script>
	<script src="js/jquery.localscroll-1.2.7-min.js"></script>
	<script src="js/stellar.js"></script>
	<script src="js/responsive-slider.js"></script>
	<script src="js/jquery.appear.js"></script>
	<script src="js/validate.js"></script>
	<script src="js/grid.js"></script>
    <script src="js/main.js"></script>
	<script src="js/wow.min.js"></script>
	<script>
	 wow = new WOW(
	 {
	
		}	) 
		.init();
	</script>
	<!-- Modal Overlay -->
	<style>
	.btn {
		height: 32px;
		line-height: 32px;
		padding: 0 10px;
		min-width: 80px;
		font-size: 14px;
		border-radius:  4px;
	}
	.btn2 {
		background-color: #00b6ea;
		border: 1px solid #00b6ea;
		color: #fff;
	}
	.form-control{
		border-radius:  4px;
	}
	select,
	textarea,
	input[type="text"],
	input[type="password"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="date"],
	input[type="month"],
	input[type="time"],
	input[type="week"],
	input[type="number"],
	input[type="email"],
	input[type="url"],
	input[type="search"],
	input[type="tel"],
	input[type="color"],
	.uneditable-input {
	  -webkit-border-radius: 4 !important;
		 -moz-border-radius: 4 !important;
			  border-radius: 4 !important;
	}	
	.form-control{
		margin-top: 5px !important;
	}
	.alert-danger{
		margin-top: 10px !important;
	}
	.line-btn, input[type="submit"], button[type="submit"]{
		margin-top: 5px; !important;
	}
	.alert-success {
		margin-top: 5px; !important;
	}
	.m_table{width:100%}.m_table tr{height:40px;}.m_table tr{border-bottom:1px solid #e5e5e5}.m_table tr:first-child{border-bottom:none}.m_table th,.m_table td{padding:0 10px;word-wrap:break-word;font-size:12px;}@media (min-width: 767px){.m_table th,.m_table td{font-size:14px}}.m_table th{background-color:#f4f6f7;font-weight:normal;color:#333333}.m_table a+a{margin-left:5px}.m_paging{text-align:center;line-height:30px;margin-top:25px}
	</style>
	  <div class="modal fade" id="signup" role="dialog" style="padding:  5px;">
		<div class="modal-dialog">
			<div class="modal-content" style="padding: 30px;">
				<div class="logoBox">
					<span class="welcomeMsg">Please create new account</span>
				</div>
				<div class="container" style="width:  97%;">
				<form class="form-signup" id="usersignup" name="usersignup" method="post" action="./login/createuser.php">
					<input name="newuser" id="newuser" type="text" class="form-control" placeholder="Username" autofocus>
					<input name="email" id="email" type="text" class="form-control" placeholder="Email">
					<input name="password1" id="password1" type="password" class="form-control" placeholder="Password">
					<input name="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password">
					</br>
					<a href="javascript:void(0)" name="submitSignup" id="submitSignup" class="btn btn2 btnSubmit" type="submit">Sign up</a>
					<div id="message"></div>
				</form>
				</div>
			</div>
		</div>
	  </div>
	  <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="//code.jquery.com/jquery.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script type="text/javascript" src="./login/js/bootstrap.js"></script> -->
    <script src="./login/js/signup.js?v=3"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<script>

	$( "#usersignup" ).validate({
	  rules: {
		email: {
			email: true,
			required: true
		},
		password1: {
		  required: true,
		  minlength: 4
		},
		password2: {
		  equalTo: "#password1"
		}
	  }
	});
	</script>
	<!-- End Modal Signup Form -->
	<!-- Modal Login Form -->
	<div class="modal fade" id="login" role="dialog" style="padding:  5px;">
		<div class="modal-dialog">
		<div class="modal-content" style="padding: 30px;">
		<form class="form-signin" name="form1" method="post" action="./login/checklogin.php">
	    <div class="logoBox">
			<span class="welcomeMsg">Please login to your account</span>
		</div>
		<div class="form-group" id="accountEmail-box">
		  <label class="control-label" for="">Username/Email:</label>
		  <input type="text" class="form-control" id="myusername" name="myusername" placeholder="Enter your username">
		  <p class="errorMsg" id="regist-email-error"></p>
		</div>
		<div class="form-group" id="password-box">
		  <label class="control-label" for="">Password:</label>
		  <input type="password" class="form-control" id="mypassword" name="mypassword" placeholder="Enter your password">
		  <p class="errorMsg" id="regist-password-error"></p>
		</div>
			<a href="javascript:void(0)" class="btn btn2 btnSubmit" id="submitLogin" name="submitLogin" type="submit">Sign In</a>
			<a href="javascript:void(0)" class="btn btn2 btnSubmit" id="submitForgot" name="submitForgot" type="submit">Forgot Password</a>
			<div id="messageSignIn"></div>
		</form>
		</div>
		</div>
	  </div>
	<script src="./login/js/login.js?v=3"></script>
	<script src="./login/js/forgotpassword.js?v=3"></script>
	<!-- End Model Login Form -->
	<!-- Modal Account Form -->
	<div class="modal fade" id="accountPage" role="dialog" style="padding:  5px;">
	<div class="modal-dialog" style="width:  95%;">
	<div class="modal-content" style="padding: 15px;">
		<?php
			## Get Transactions from DB ##
			$mysqli = new mysqli("localhost", "natsoon", "IloveUMass#316", "ico");

			/* check connection */
			if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}
			
			$query = "SELECT 
						coinType
						, sum(amount) as amount
					FROM 
						CoinTransaction 
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
			}
			/* free result set */
			$result->close();

			/* close connection */
			$mysqli->close();	
		?>
		<div class="logoBox">
		<span class="welcomeMsg">Welcome to Solar Mine (SOM) &nbsp;&nbsp;&nbsp;<a id='showTransaction' href="javascript:void(0)" data-toggle='modal' data-target='#detailPage' data-remote='false' class="btn btn2 btnSubmit" >Detail</a></span>
		</div>
		<div class="form-group" id="SOM-box">
		  <label class="control-label" >Your SOM:  </label>
		  <input type="text" class="form-control" id="ValueSOM" value='<?php echo $netSOM; ?>' readonly style='cursor: default !important;'>
		</div>
		<div class="form-group" id="BTC-box">
		  <label class="control-label" >Your BTC:</label>
		  <a id='depositBTC' href="javascript:void(0)" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn2 btnSubmit">Deposit</a>
		  <input type="text" class="form-control" id="ValueBTC" value='<?php echo $netBTC; ?>' readonly style='cursor: default !important;'>
		</div>
		<div class="form-group" id="LTC-box">
		  <label class="control-label">Your LTC:</label>
		  <a id='depositLTC' href="javascript:void(0)" data-remote="false" data-toggle="modal" data-target="#myModal-LTC" class="btn btn2 btnSubmit">Deposit</a>
		  <input type="text" class="form-control" id="ValueLTC" value='<?php echo $netLTC; ?>' readonly style='cursor: default !important;'>
		</div>
		<div class="form-group" id="ETH-box">
		  <label class="control-label" >Your ETH:</label>
		  <a id='depositETH' href="javascript:void(0)" data-remote="false" data-toggle="modal" data-target="#myModal-ETH" class="btn btn2 btnSubmit">Deposit</a>
		  <input type="text" class="form-control" id="ValueETH" value='<?php echo $netETH; ?>' readonly style='cursor: default !important;'>
		</div>
	</div>
	</div>
	</div>
	<!-- End Model Account Form -->
	<!-- Modal Transaction Detail Form -->
	<div class="modal fade" id="detailPage" role="dialog" style="padding:  5px; padding-top:  15px;">
	<div class="modal-dialog modal-lg" style="width: 90%; padding:  5px; padding-left: 10px">
	<div class="modal-content" style="padding: 15px; padding-bottom: 60px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Transaction Details</h4>
		  </div>
		  <div class="modal-body-transaction" id="modal-body-transaction">
		  <!-- Auto Load - External Source -->
			...
		  </div>
	</div>
	</div>
	</div>
	<!-- End Model Transaction Detail Form -->
	<!-- Deposit Form (BTC) -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Deposit Bitcoin</h4>
		  </div>
		  <div class="modal-body" id="modal-body">
		  <!-- Auto Load - External Source -->
			...
		  </div>
		</div>
	  </div>
	</div>
	<!-- Deposit Form (ETH) -->
	<div class="modal fade" id="myModal-ETH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Deposit Ethereum</h4>
		  </div>
		  <div class="modal-body" id="modal-body-ETH">
		  <!-- Auto Load - External Source -->
			...
		  </div>
		</div>
	  </div>
	</div>
	<!-- Deposit Form (LTC) -->
	<div class="modal fade" id="myModal-LTC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Deposit Litecoin</h4>
		  </div>
		  <div class="modal-body" id="modal-body-LTC">
		  <!-- Auto Load - External Source -->
			...
		  </div>
		</div>
	  </div>
	</div>
	<script type="text/javascript"> 
		$("#depositBTC").click(function(){
			$("#modal-body").load("./modal/depositBTC.php"); 
		});
		$("#showTransaction").click(function(){
			$("#modal-body-transaction").load("./modal/transactions.php"); 
		});
		$("#depositETH").click(function(){
			$("#modal-body-ETH").load("./modal/depositETH.php"); 
		});
		$("#depositLTC").click(function(){
			$("#modal-body-LTC").load("./modal/depositLTC.php"); 
		});
		
	</script> 
	<!-- End Deposit Form -->
	
	</body>
</html>