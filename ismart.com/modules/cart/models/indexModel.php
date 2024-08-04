<?php
function get_list_product_mvc_by_id($id)
{
  $result = db_fetch_array("SELECT `tbl_products`.* ,`tbl_category_products`.`slug_url` FROM `tbl_products` INNER JOIN`tbl_category_products` ON `tbl_products`.`product_id` = `tbl_category_products`.`id` WHERE `tbl_products`.`id`={$id}");
  return $result;
}
function get_list_city()
{
  return db_fetch_array("SELECT * FROM `tbl_conscious`");
}
function list_city($id)
{
  return db_fetch_array("SELECT * FROM `tbl_district` WHERE `id_category` = {$id}");
}
