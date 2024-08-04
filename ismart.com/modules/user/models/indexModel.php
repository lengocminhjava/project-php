<?php

function get_list_product()
{

    return db_fetch_array("SELECT * FROM `tbl_users`");
}
function  count_fields($field)
{
    return db_num_rows("SELECT * FROM `tbl_orders` WHERE `status` ='{$field}'");
}
function sum_total_money()
{
    $item = db_fetch_array("SELECT * FROM `tbl_orders`");
    $result = 0;
    foreach ($item as $v) {
        $result += $v['total_money'];
    }
    return $result;
}
function product()
{
    return db_fetch_array("SELECT `tbl_client`.*,`tbl_orders`.* FROM`tbl_client` LEFT JOIN`tbl_orders` ON `tbl_client`.`id`=`tbl_orders`.`order_id` ");
}
