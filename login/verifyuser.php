<?php
$pagetype = 'loginpage';
$title = 'Verify User';
require 'partials/pagehead.php';
?>
</head>
<body>
<div class="container">

<?php
//Pulls variables from url. Can pass 1 (verified) or 0 (unverified/blocked) into url
$uid_decoded = base64_decode($_GET['uid']);
$idarr = array($uid_decoded);
$uids = json_encode($idarr);

$userarr = UserData::userDataPull($uids, 0);

try {
    //Updates the verify column on user
    $vresponse = Verify::verifyUser($userarr, 1);

    //Success
    if ($vresponse['status'] == true) {

        echo '<form class="form-signin" action="'.$conf->signin_url.'"><div class="alert alert-success">'.$conf->active_msg.'</div><br><a href="http://solarico.raptorads.com/">Login</a></form>';

        //Send verification email
        $m = new MailSender;

        //SEND MAIL
        $m->sendMail($userarr, 'Active');

    } else {
        //Echoes error from MySQL
        echo $vresponse['message'];
    }

} catch (Exception $ex) {

    echo $ex->getMessage();
}
?>
</div>
</body>
</html>
