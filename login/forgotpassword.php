<?php
$pagetype = 'loginpage';
$title = 'Forgot Password';
require 'partials/pagehead.php';
?>
<link rel="stylesheet" type="text/css" href="../css/isotope.css" media="screen" />	
<link rel="stylesheet" href="../js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/bootstrap-theme.css">
<link href="css/responsive-slider.css" rel="stylesheet">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:400,300,200,100,500,600,700,800,900">
<link rel="stylesheet" href="../css/animate.css">
<link rel="stylesheet" href="../css/font-awesome.css">
<link rel="stylesheet" href="../css/overwrite.css?v=1"> 
<link rel="stylesheet" href="../css/style.css?v=2">
<link rel="stylesheet" type="text/css" href="../css/overlay.css?v=2" />
<!-- skin -->
<link rel="stylesheet" href="../skin/default.css">
<style>
.navbar {
	min-height:  0px;
	height:  0px;
}
label.error {
	font-size: 14px;
}
</style>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="js/resetpw.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
</head>
<body>
    <div class="container logindiv">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form class="text-center" id="forgotpassword" name="forgotpassword" method="post">
                <h3 class="form-signup-heading"><?php echo $title;?></h3>
                <br>
                <div class="form-group">
                    <input name="email" id="email" type="text" class="form-control input-lg" placeholder="Email Address" autofocus> </div>
                <div class="form-group">
                    <button name="Submit" id="submitbtn" class="btn btn-lg btn-primary btn-block" type="submit">Send Reset Email</button>
                </div>
            </form>
            <div id="message"></div>
            <p id="orlogin" class="text-center"><a href="index.php">Return to Login</a></p>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <script>
        $("#forgotpassword").validate({
            rules: {
                email: {
                    email: true
                    , required: true
                }
            }
        });
    </script>
</body>
</html>
