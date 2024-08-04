<?php
function value_form($label_field)
{
    global $$label_field;
    if (!empty($$label_field)) return $$label_field;
    return false;
};
function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field])) return "<p class='error'> $error[$label_field] </p>";
    return false;
}
function form_success($label_field)
{
    global $success;
    if (!empty($success[$label_field])) return "<p class='success'> $success[$label_field] </p>";
    return false;
}
// Tên đăng nhập
function is_username($username)
{
    $partten = "/^()[A-Za-z0-9_\.]{6,32}$/";
    if (!preg_match($partten, $username, $matchs))
        return FALSE;
    return true;
}
// Mật khẩu
function is_password($password)
{
    $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (!preg_match($partten, $password, $matchs))
        return FALSE;
    return true;
}
//Số điện thoại
function is_phone($phone)
{
    $partten = "/^(09|08|03|01[2|6|8|9])+([0-9]{8,12})$/";
    if (!preg_match($partten, $phone, $matchs))
        return FALSE;
    return true;
}
