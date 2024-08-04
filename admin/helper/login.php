<?php
//  in_aray = kiểm tra 1 giá trị có thuộc vào hay ko
function info_user($field = 'id')
{
    global $list_users;
    if (isset($_SESSION['is_login'])) {
        foreach ($list_users as $user) {
            if ($_SESSION['user_login'] == $user['username']) {
                if (array_key_exists($field, $user)) { // key có thuôc vào hay ko

                    return $user[$field];
                }
            }
        }
    }
    return false;
}
