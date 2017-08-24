<?php
    $pagetype = 'loginpage';
    $title = 'Reset Password';
    require 'partials/pagehead.php';
    #require 'vendor/autoload.php';
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
<?php

$jwt = $_GET['t'];

use \Firebase\JWT\JWT;
require '/vendor/firebase/php-jwt/src/JWT.php';

try {

    $decoded = JWT::decode($jwt, $conf->jwt_secret, array('HS256'));

    $email = $decoded->email;
    $tokenid = $decoded->tokenid;
    $userid = $decoded->userid;
    $pw_reset = $decoded->pw_reset;

    $validToken = TokenHandler::selectToken($tokenid, $userid, 0);

    if ($validToken && ($decoded->pw_reset == "true")) {

        require "partials/resetform.php";

    } else {

        echo "<br><br><div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Invalid or expired token, please resubmit <a href='".$conf->base_url."/login/forgotpassword.php'>forgot password form</a></div><div id='returnVal' style='display:none;'>false</div>";
    };

} catch (Exception $e) {

    echo "<br><br><div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$e->getMessage()."<br>Token failure, try re-sending request <a href='".$conf->base_url."/login/forgotpassword.php'>here</a></div><div id='returnVal' style='display:none;'>false</div>";
}
?>
<div id="message"></div>
<script>
$("#resetform").validate({
    rules: {
        password1: {
            required: true <?php if( $conf->password_policy_enforce == "true"){echo ", minlength: ". $conf->password_min_length;};?>
        }
        , password2: {
            required: true
            , equalTo: "#password1"
        }
    }
});
</script>
</div>
<div class="col-sm-4"></div>
</div>
</body>
