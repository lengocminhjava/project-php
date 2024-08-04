<?php
function check_name_title($data)
{
  $check = db_num_rows("SELECT * FROM `tb_category_post` WHERE `title` = '{$data}'");
  if ($check > 0)
    return true;
  return false;
}
function list_category()
{
  return db_fetch_array("SELECT * FROM `tb_category_post`");
}
function add_category($data)
{
  db_insert("tb_category_post", $data);
}
function check_parent_id($id)
{
  $check = db_num_rows("SELECT * FROM `tb_category_post` WHERE `parent_id`={$id}");
  if ($check > 0)
    return true;
  return false;
}
function delete($id)
{
  db_delete("tb_category_post", "`id`={$id}");
}
function get_user_by_username($username)
{
  $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
  if (!empty($item))
    return $item;
}
function update_category($cat_id, $data)
{
  db_update("tb_category_post", $data, "`id` = {$cat_id}");
}
function get_info_category($cat_id)
{
  return db_fetch_row("SELECT * FROM `tb_category_post` WHERE `id` = {$cat_id}");
}
function list_post($id)
{
  $check = db_fetch_row("SELECT * FROM `tbl_post`WHERE `parent_id` = {$id}");
  if ($check > 0)
    return true;
  return false;
}
