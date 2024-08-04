<?php
function get_user_by_username($username)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if (!empty($item))
        return $item;
}
function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}
function check_is_active($username, $password)
{
    $item =  db_fetch_row("SELECT `is_active` FROM `tbl_users` WHERE `username`='{$username}' AND `password`='{$password}' ");
    return $item;
}
function check_username($username, $password)
{
    $check = db_num_rows("SELECT *FROM `tbl_users` WHERE `username` ='{$username}' AND  `password` = '{$password}'");
    if ($check > 0)
        return true;
    return false;
}

return false;
function check_username_email($username, $email)
{
    $check = db_num_rows("SELECT *FROM `tbl_users` WHERE `username` ='{$username}' OR  `email` = '{$email}'");
    if ($check > 0)
        return true;
    return false;
}
return false;

function check_new_active_token($active_token)
{
    $check = db_num_rows("SELECT *FROM `tbl_users` WHERE  `active_token` = '{$active_token}'");
    if ($check > 0)
        return true;
    return false;
}
function is_active($active_token)
{
    db_update('tbl_users', array('is_active' => '1'), "`active_token`='{$active_token}'");
}
function  is_active_0($control)
{
    db_update('tbl_users', array('is_active' => '0'), "`active_token`='{$control}'");
}
function check_new_email($email)
{
    $check = db_num_rows("SELECT *FROM `tbl_users` WHERE  `email` = '{$email}'");
    if ($check > 0)
        return true;
    return false;
}
function update_token($data, $email)
{
    db_update('tbl_users', $data, "`email`='{$email}'");
}
function check_new_reset_token($reset_token)
{
    $check = db_num_rows("SELECT *FROM `tbl_users` WHERE  `reset_token` = '{$reset_token}'");
    if ($check > 0)
        return true;
    return false;
}
return false;
function update_new_pass($data, $reset_token)
{
    db_update('tbl_users', $data, "`reset_token`='{$reset_token}'");
}
function time_active_0()
{
    $time = time();
    $data = db_fetch_row("SELECT * FROM `tbl_users` WHERE `is_active` = '0'");
    if (!empty($data)) {
        $result = $time - $data['created_at'];
        if ($result > 2 * 24 * 3600)
            db_delete("tbl_users", "`id` = {$data['id']}");
    }
    return false;
}
function add_data($data)
{
    db_insert("tbl_users", $data);
}
function update_users($data, $username)
{
    db_update('tbl_users', $data, "`username` = '{$username}'");
}
function  get_info_post($field, $id)
{
    $item = db_fetch_row("SELECT `{$field}` FROM `tbl_users`WHERE `id`={$id}");
    return $item[$field];
}

function get_user_by_active_token($active_token)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}'");
    if (!empty($item))
        return $item;
}