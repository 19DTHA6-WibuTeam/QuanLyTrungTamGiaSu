<?php
error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

define('API_URL', 'https://ttgs-api.phatnef.me'); // http://localhost:3004
define('ADMIN_PASSWORD', 'Wibu@2022'); // Mật khẩu đăng nhập Admin
define('DATA_PER_PAGE', 20); // Số dữ liệu hiển thị trên mỗi trang
// define('RECAPTCHA_SITE_KEY', '6LeShkgfAAAAAD17sscX7kYWeY4yrHcbNR__Smsv');
// define('RECAPTCHA_SECRET_KEY', '6LeShkgfAAAAAGhsTOj5fVVt_MtHxiX-XmyF--yC');

require_once('function.php');
require_once('class.php');
