<?php
//Danh sách sản phẩm bảng (tbl_product)
function get_list_product($start, $num_page)
{
    $result = db_fetch_array("SELECT `tbl_products`.* , `tbl_category_products`.`slug_url`
    FROM `tbl_products`
    INNER JOIN `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id` LIMIT {$start},{$num_page}");
    return $result;
}
function product_category()
{
    return db_fetch_array("SELECT `tbl_products`.* ,`tbl_category_products`.* FROM `tbl_products` INNER JOIN`tbl_category_products` ON `tbl_products`.`product_id` = `tbl_category_products`.`id`");
}
function get_list_product_a_z($field)
{
    $result = db_fetch_array("SELECT `tbl_products`.* , `tbl_category_products`.`slug_url`
    FROM `tbl_products`
    INNER JOIN `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id` ORDER BY  `$field` ASC");
    return $result;
}
function get_list_product_z_a($field)
{
    $result = db_fetch_array("SELECT `tbl_products`.* , `tbl_category_products`.`slug_url`
    FROM `tbl_products`
    INNER JOIN `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id`  ORDER BY  `$field` DESC;");
    return $result;
}
function get_list_product_small_500()
{
    $result = db_fetch_array("SELECT `tbl_products`.* , (`price`-`discount`) as `poster` , `tbl_category_products`.`slug_url`
    FROM `tbl_products`
    INNER JOIN `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id` WHERE  `price`<500000");
    return $result;
}
function get_list_product_to_price($field_1, $field_2)
{
    $result = db_fetch_array("SELECT `tbl_products`.* , `tbl_category_products`.`slug_url`
    FROM `tbl_products`
    INNER JOIN `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id` WHERE  `price` >= '{$field_1}' AND `price`<'{$field_2}'");
    return $result;
}
function get_list_product_to_title($data)
{
    $result = db_fetch_array("SELECT `tbl_products`.* , `tbl_category_products`.`slug_url`
    FROM `tbl_products`
    INNER JOIN `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id` WHERE  `title_product` LIKE '%{$data}%'");
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
function product($data, $field)
{
    $result = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `id` = {$data}");
    return $result[$field];
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
//Lấy id dựa theo slug
function name_slug($data, $field)
{
    $item = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `slug_url` = '{$data}'");
    return $item[$field];
}
function data_menu()
{
    return db_fetch_array("SELECT * FROM `tbl_category_products`");
}
//Lấy danh sach thoản mãn
function list_product_by_parent_id($id)
{
    return db_fetch_array("SELECT * FROM `tbl_category_products` WHERE `parent_id` = {$id}");
}
function  list_product_by_id($id)
{
    return  db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `id` = {$id} ");
}
//Lấy danh sách sản phẩm thỏa mãn
function list_product($data)
{
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` IN ({$data})");
}
function list_product_aj($data)
{
    return db_fetch_array("SELECT `tbl_products`.*,`tbl_category_products`.`slug_url` FROM `tbl_products` INNER JOIN  `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id` WHERE `tbl_products`.`product_id` IN ({$data})");
}
function list_product_a_z($data)
{
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` IN ({$data}) ORDER BY `title_product` ");
}
//Tổng số bản ghi trong bảng products 
function num_products()
{
    return db_num_rows("SELECT * FROM `tbl_products`");
}
//Sản phẩm bán chạy
function selling_products()
{
    return db_fetch_array("SELECT `tbl_products`.*,`tbl_category_products`.`slug_url` FROM `tbl_products` INNER JOIN  `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id`  WHERE `selling` ='selling'");
}
function list_product_slug()
{
    return db_fetch_array("SELECT * FROM `tbl_category_products`");
}
function list_parent_id($data)
{
    return db_fetch_array("SELECT * FROM `tbl_category_products` WHERE `slug_url` = '{$data}'");
}
function check_pro_id()
{
    return  db_fetch_array("SELECT * FROM `tbl_products`");
}
function Check_id_prarent_id_category($data)
{
    $check = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `id` = {$data}");
    if ($check > 0)
        return true;
    return false;
}
function menu_data()
{
    return db_fetch_array("SELECT * FROM `tbl_category_products`");
}
function category_name()
{
    $item = db_fetch_array("SELECT * FROM `tbl_category_products` WHERE `parent_id` = 0 ");
    return $item;
}
//Lấy danh sách theo id của tên category_parent_id = 0
function list_product_num($id)
{
    $result = array();
    //Kiểm tra xem có id thuộc  vào danh sách ko
    $list_parent = list_list_id($id);
    //Nhóm lại
    $list = data_tree(data_menu(), $id);
    //Tìm danh sách theo id
    $list_parent = list_list_id($id);
    //Nhóm lại
    $list_pro = array_merge($list, $list_parent);
    //Tìm danh sách theo id
    //Nhóm lại
    //In ra các id thỏa mãn
    foreach ($list_pro as $v) {
        $result[] = (int)$v['id'];
    }
    //Viết về dạng chuỗi
    $list_cat = implode(',', $result);
    //Danh sách của sản phẩm 
    $list_product = list_product($list_cat);
    return $list_product;
}

function num_list($id)
{
    $result = array();
    $list_product_by_parent_id_0 = category_name();
    // show_array($list_product_by_parent_id_0);
    $num = array();
    foreach ($list_product_by_parent_id_0 as $v) {
        $num[] = $v['id'];
    };
    if ($id == 1)  $result = list_product_num($num[0]);
    if ($id == 2)  $result = list_product_num($num[1]);
    if ($id == 28) $result = list_product_num($num[2]);
    if ($id == 29) $result = list_product_num($num[3]);
    return $result;
}
function check_pr_id($data)
{
    $check = db_num_rows("SELECT * FROM `tbl_category_products` WHERE `id` = '{$data}'");
    if ($check > 0)
        return true;
    return false;
}
function has_child_four($number, $data)
{
    if ($number == 0) {
        $result = $data['id'];
    } else {
        $result_child = list_product_by_id($number);
        $i = (int)$result_child['parent_id'];
        $result = (int) has_child_four($i, $result_child);
    }
    return $result;
}
function list_list_title_name($data)
{
    return db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `title` = '{$data}'");
}
function searchforcondition($title)
{
  
}
