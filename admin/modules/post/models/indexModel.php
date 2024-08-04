<?php
function list_post()
{
  return db_fetch_array("SELECT * FROM `tbl_post`");
}
function update_list($data, $id)
{
  db_update("tbl_post", $data, "`id`= {$id}");
  // return ['title' => 'Cập nhật thành công', 'class' => 'successs'];
}
function db_fech_row_($id)
{
  return db_fetch_row("SELECT * FROM `tbl_post` WHERE `id` = {$id}");
}
function number_page($start, $num_page)
{
  $result = db_fetch_array("SELECT * FROM `tbl_post` LIMIT {$start},{$num_page} ");
  return $result;
}
function num_rows()
{
  $result = db_num_rows("SELECT * FROM `tbl_post`");
  return $result;
}
function search($value)
{
  $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `title` LIKE '%{$value}%' OR `category` LIKE '%{$value}%' OR `status` LIKE '%{$value}%'");
  return $result;
}
function check_post_title($data)
{
  $check = db_num_rows("SELECT * FROM `tbl_post` WHERE `title` = '{$data}'");
  if ($check > 0)
    return true;
  return false;
}
function slug_url_exists($data)
{
  $check = db_num_rows("SELECT * FROM `tbl_post` WHERE `base_url` = '{$data}'");
  if ($check > 0)
    return true;
  return false;
}
function add_post($data)
{
  db_insert("tbl_post", $data);
}
function  delete_cat($data)
{
  db_delete("tbl_post", "`id` IN ({$data})");
}
function update_cat($data, $list_cat)
{
  db_update("tbl_post", $data, "`id` IN ({$list_cat})");
}
function search_product($value)
{
  $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `title` LIKE '%{$value}%' OR `category` LIKE '%{$value}%'");
  return $result;
}
function  delete($id)
{
  db_delete('tbl_post', "`id` = {$id}");
}
function get_category()
{
  return db_fetch_array("SELECT * FROM `tb_category_post`");
}
function get_info_post($field, $post_id)
{
  $info_post_id = db_fetch_row("SELECT `$field` FROM `tbl_post` WHERE `id` = '{$post_id}'");
  return  $info_post_id[$field];
}
function get_category_by_id($category_id)
{
  $item = db_fetch_row("SELECT * FROM `tb_category_post` WHERE `id`={$category_id}");
  return $item;
}
function get_user_by_username($username)
{
  $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
  if (!empty($item))
    return $item;
}
function check_name_product_update($data, $id)
{
  $check = db_fetch_row("SELECT *FROM `tbl_post` WHERE `id`='{$id}'");
  return $check[$data];
}
