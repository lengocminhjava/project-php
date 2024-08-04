<?php
defined('APPPATH') or exit('Không được quyền truy cập phần này');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| Đây là những phần được load tự động khi ứng dụng khởi động
|
| 1. Libraries
| 2. Helper file
|
*/

/*
 * ------------------------------------------------------------------
 * Autoload Libraries
 * ------------------------------------------------------------------
 * Ví dụ: 
 * $autoload['lib'] = array('validation', 'pagging');
 */


$autoload['lib'] = array('validation', 'pagging');

/*
 * ------------------------------------------------------------------
 * Autoload Helper
 * ------------------------------------------------------------------
 * Ví dụ:
 * $autoload['helper'] = array('data','string');
 */


$autoload['helper'] = array('data', 'url', 'format', 'users','cart');

// function is_username($username)
// {
//     $partten = "/^()[A-Za-z0-9_\.]{6,32}$/";
//     if (!preg_match($partten, $username, $matchs))
//         return FALSE;
//     return true;
// }
// $partten = "/^(|09|08|01[2|6|8|9])+(|[0-9]{8}|$/";
// function is_password($password)
// {
//     $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
//     if (!preg_match($partten, $password, $matchs))
//         return FALSE;
//     return true;
// }
// function is_phone($phone)
// {
//     $partten = "/^(09|08|01[2|6|8|9])+([0=9]{8})$/";
//     if (!preg_match($partten, $phone, $matchs))
//         return FALSE;
//     return true;
// }
// //form_error
// function form_error($lable_field)
// {
//     global $error;
//     if (!empty($error[$lable_field]))
//         return "<p class='error'>{$error[$lable_field]};</p>";
// }
// function set_value($lable_field)
// {
//     global $$lable_field;
//     if (!empty($$lable_field))
//         return $$lable_field;
// }

