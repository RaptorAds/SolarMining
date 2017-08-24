<form class="form-signup" id="resetform" name="resetform" method="post">
    <h3 class="form-signup-heading">Reset Password</h3>
    <br>
    <input name="userid" id="userid" placeholder="User Id" value="<?php echo $decoded->userid;?>" hidden>
    <input name="password1" id="password1" type="password" class="form-control" placeholder="New Password">
    <input name="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password">
    <a href="javascript:void()" name="submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Reset</a>
</form>
<div id="message"></div>
