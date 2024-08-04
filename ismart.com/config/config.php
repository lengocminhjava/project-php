<?php
session_start();
ob_start();
//Time Zone
date_default_timezone_set("Asia/Ho_Chi_Minh");
/*
 * ---------------------------------------------------------
 * BASE URL
 * ---------------------------------------------------------
 * Cấu hình đường dẫn gốc của ứng dụng
 * Ví dụ: 
 * http://hocweb123.com đường dẫn chạy online 
 * http://localhost/yourproject.com đường dẫn dự án ở local
 * 
 */

$config['base_url'] = "http://localhost/admin-unitop.com/admin/";
$config['default_module'] = 'home';
$config['default_controller'] = 'index';
$config['default_action'] = 'index';