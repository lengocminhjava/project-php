<?php

function get_list_product()
{

    return db_fetch_array("SELECT `tbl_client`.*, `tbl_products`.`code`,`tbl_products`.`title_product`,`tbl_orders`.*
    FROM (`tbl_client` LEFT JOIN `tbl_orders` ON `tbl_client`.`id` = `tbl_orders`.`order_id`)
    INNER JOIN `tbl_products` ON `tbl_orders`.`product_id` = `tbl_products`.`id`");
}

function get_orders_by_id($id)
{
    return db_fetch_row("SELECT * FROM `tbl_orders` WHERE `id`= {$id}");
}
function get_client_by_id($id_client)
{
    return db_fetch_row("SELECT * FROM `tbl_client` WHERE `id`= {$id_client}");
}
function get_products_by_id($id_product)
{
    return db_fetch_row("SELECT * FROM `tbl_products` WHERE `id`= {$id_product}");
}
function update_client($data, $id_client)
{
    db_update("tbl_client", $data, "`id` = {$id_client}");
}
function  update_order($data_order, $id)
{
    db_update("tbl_orders", $data_order, "`id` = {$id}");
}

function  get_info_post($field, $id)
{
    $item = db_fetch_row("SELECT `{$field}` FROM `tbl_client`WHERE `id`={$id}");
    return $item[$field];
}
function delete($id)
{
    db_delete('tbl_orders', "`id`={$id}");
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
