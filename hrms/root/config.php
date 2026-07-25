<?php

/*
 File = config.php
 Date = 03-11-2025 */
// session start
session_start();
error_reporting(E_ALL);
// website full url
define('APP_NAME', 'Radhe HRMS ');
define('SITE_LOCAL_URL', 'http://localhost/hrmsradhe/');
define('SITE_NAME', 'Radhe HRMS Software');
define('SITE_LIVE_URL', 'http://radhe.oceanhub.co.in/radhe_hrms/hrms/');

// site running in live server or locaL
define('SITE_MODE', '1');
define('DB_PREFIX', 'tbl_');


// other configuration
if (SITE_MODE == 0) {
    define('SITE_URL', SITE_LOCAL_URL);
    define('ADMIN_URL', SITE_LOCAL_URL . 'admin/');
    // db configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_DATABASE', 'radhe_hrms');
} else {
    define('SITE_URL', SITE_LIVE_URL);
    define('ADMIN_URL', SITE_LIVE_URL . 'admin/');
    // db configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'jrosvllq_radhe_hrms_testing');
    define('DB_PASS', 'lYFfBBq$7%#3^S5W');
    define('DB_DATABASE', 'jrosvllq_radhe_hrms_testing');
}

require_once('define.php');

// class call function
date_default_timezone_set('Asia/Calcutta');
require_once("ai_core/class.core.php");
require_once('include/class.phpmailer.php');
