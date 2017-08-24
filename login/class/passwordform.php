<?php
class PasswordForm extends DbConn
{
    public function resetPw ($uid, $password_raw)
    {
        try {
            $resp = array();

            $password = PasswordCrypt::encryptPw($password_raw);

            $db = new DbConn;
            $tbl_members = $db->tbl_members;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("UPDATE ".$tbl_members." SET password = :password where id = :id");
            $stmt->bindParam(':id', $uid);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $resp['message'] = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Reset! <a href="'.AppConfig::pullSetting("base_url")."/login".'">Click here to sign in!</a></div><div id="returnVal" style="display:none;">true</div>';
            $resp['status'] = true;

            return $resp;

        } catch (PDOException $e) {

            $resp['message'] = 'Error: ' . $e->getMessage();
            $resp['status'] = false;

            return $resp;
        }

    }
}
