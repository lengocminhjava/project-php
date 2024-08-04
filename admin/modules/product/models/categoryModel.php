<?php
function check_name_title($data)
{
  $check = db_num_rows("SELECT * FROM `tbl_category_products` WHERE `title` = '{$data}'");
  if ($check > 0)
    return true;
  return false;
}
function list_category()
{
  return db_fetch_array("SELECT * FROM `tbl_category_products`");
}
function add_category($data)
{
  db_insert("tbl_category_products", $data);
}
function delete($id)
{
  db_delete("tbl_category_products", "`id`={$id}");
}
function get_user_by_username($username, $field)
{
  $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
  if (!empty($item))
    return $item[$field];
}
function update_category($cat_id, $data)
{
  db_update("tbl_category_products", $data, "`id` = {$cat_id}");
}
function get_info_category($cat_id)
{
  return db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `id` = {$cat_id}");
}
function list_product_id($id)
{
  $check = db_fetch_row("SELECT * FROM `tbl_products`WHERE `product_id` = {$id}");
  if ($check > 0)
    return true;
  return false;
}
function check_parent_id_pr($id)
{
  $check = db_num_rows("SELECT * FROM `tbl_category_products` WHERE `parent_id`={$id}");
  if ($check > 0)
    return true;
  return false;
}
