<?php
//Danh sách sản phẩm bảng (tbl_product)
function get_list_product()
{
    $result = db_fetch_array("SELECT * FROM`tbl_products`");
    return $result;
}
function num_rows()
{
    return  db_num_rows("SELECT * FROM `tbl_products`");
}
function number_page($start, $num_page)
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` LIMIT {$start},{$num_page} ");
    return $result;
}
function check_name_product($data)
{
    $check = db_fetch_row("SELECT *FROM `tbl_products` WHERE `title_product`='{$data}'");
    if ($check > 0)
        return true;
    return false;
}
function list_category()
{
    return db_fetch_array("SELECT * FROM `tbl_category_products`");
}
function product($data, $field)
{
    $result = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `id` = {$data}");
    return $result[$field];
}
function get_user_by_username($username, $field)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if (!empty($item))
        return $item[$field];
}
function add_product($data)
{
    db_insert("tbl_products", $data);
}
function get_list_product_by_id($id)
{
    return db_fetch_row("SELECT * FROM `tbl_products` WHERE `id` = {$id}");
}
function update_product($data, $id)
{
    db_update("tbl_products", $data, "`id` = {$id}");
}
function get_info_post($field, $id)
{
    $info_post_id = db_fetch_row("SELECT `$field` FROM `tbl_products` WHERE `id` = '{$id}'");
    return  $info_post_id[$field];
}
function check_name_product_update($data, $id)
{
    $check = db_fetch_row("SELECT * FROM `tbl_products` WHERE `id`='{$id}'");
    return $check[$data];
}
function delete_img($id)
{
    db_delete("img_products", "`id_product` = {$id}");
}
function delete($id)
{
    db_delete("tbl_products", "`id` = {$id}");
}
function list_order()
{
    return db_fetch_array("SELECT * FROM `tbl_orders`");
}
function check_id_order($id)
{
    $check = db_fetch_row("SELECT * FROM `tbl_orders` WHERE `product_id` = {$id}");
    if ($check > 0)
        return true;
    return false;
}
function check_id_img($id)
{
    $check = db_fetch_row("SELECT * FROM `img_products` WHERE `id_product` = {$id}");
    if ($check > 0)
        return true;
    return false;
}
function  delete_cat($data)
{
    db_delete("tbl_products", "`id` IN ({$data})");
}
function update_cat($data, $list_cat)
{
    db_update("tbl_products", $data, "`id` IN ({$list_cat})");
}
function search_product($value)
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `title_product` LIKE '%{$value}%' OR `category` LIKE '%{$value}%'");
    return $result;
}
function check_id_order_in($data)
{
    $check = db_fetch_row("SELECT * FROM `tbl_orders` WHERE `product_id` IN ({$data})");
    if ($check > 0)
        return true;
    return false;
}
function check_id_product_category($data)
{
    $check = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `id` IN ({$data})");
    if ($check > 0)
        return true;
    return false;
}
function product_by_title($title, $field)
{
    $item = db_fetch_row("SELECT * FROM `tbl_products` WHERE `title_product` = '{$title}'");
    return $item[$field];
}
function add_image_product($data)
{
    db_insert("img_products", $data);
}
function show_image($id)
{
    return db_fetch_array("SELECT * FROM `img_products` WHERE `id_product` = {$id}");
}
function  delete_image($id)
{
    db_delete("img_products", "`id_product` = {$id}");
}
function delete_image_array($data)
{
    db_delete("img_products", "`images` = '{$data}'");
}
function  add_image_banner($data)
{
    db_insert("`tbl_banner`", $data);
}
function show_banner()
{
    return db_fetch_array("SELECT * FROM `tbl_banner`");
}
function check_id_img_pro($data)
{
    $check = db_fetch_row("SELECT * FROM `img_products` WHERE `id_product` IN ({$data})");
    if ($check > 0)
        return true;
    return false;
}
