<?php
    //DATABASE CONNECTION VARIABLES
    $host = 'localhost'; // Host name
    $username = 'develop'; // Mysql username
    $password = 'sw#Admin123'; // Mysql password
    $db_name = 'ico'; // Database name

    $tbl_prefix = ""; //Prefix for all database tables
    $tbl_members = $tbl_prefix."members";
    $tbl_memberinfo = $tbl_prefix."member_info";
    $tbl_admins = $tbl_prefix."admins";
    $tbl_attempts = $tbl_prefix."login_attempts";
    $tbl_deleted = $tbl_prefix."deleted_members";
    $tbl_tokens = $tbl_prefix."tokens";
    $tbl_cookies = $tbl_prefix."cookies";
    $tbl_appConfig = $tbl_prefix."app_config";
    $tbl_mailLog = $tbl_prefix."mail_log";