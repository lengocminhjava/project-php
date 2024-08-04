<?php
// Sẩn phẩm _ slug
function get_list_product()
{
    return db_fetch_array("SELECT `tbl_products`.* , `tbl_category_products`.`slug_url`
    FROM `tbl_products`
    INNER JOIN `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id`");
}
function search_model($value)
{
    return  db_fetch_array("SELECT `tbl_products`.* , `tbl_category_products`.`slug_url` FROM `tbl_products`INNER JOIN `tbl_category_products` ON `tbl_products`.`product_id` = `tbl_category_products`.`id`  WHERE `tbl_products`.`title_product` LIKE '%{$value}%'");
}
//Đếm theo điều kiện
function  count_fields($field)
{
    return db_num_rows("SELECT * FROM `tbl_orders` WHERE `status` ='{$field}'");
}
//Tổng giá
function sum_total_money()
{
    $item = db_fetch_array("SELECT * FROM `tbl_orders`");
    $result = 0;
    foreach ($item as $v) {
        $result += $v['total_money'];
    }
    return $result;
}
//Người mua hàng
function product()
{
    return db_fetch_array("SELECT `tbl_client`.*,`tbl_orders`.* FROM`tbl_client` LEFT JOIN`tbl_orders` ON `tbl_client`.`id`=`tbl_orders`.`order_id` ");
}
//Bán chạy
function selling_products()
{
    return db_fetch_array("SELECT `tbl_products`.*,`tbl_category_products`.`slug_url` FROM `tbl_products` INNER JOIN  `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id`  WHERE `selling` ='selling'");
}
// Láy sản phẩm theo tên
function category($name)
{
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `category` = '$name'");
}
//Nổi bật
function featured_products()
{
    return db_fetch_array("SELECT `tbl_products`.*,`tbl_category_products`.`slug_url` FROM `tbl_products` INNER JOIN  `tbl_category_products`
    ON `tbl_products`.`product_id` = `tbl_category_products`.`id`  WHERE `featured_products` ='highlights'");
}
//Check để lấy con của id
function check_parent_id($id)
{
    $check = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `parent_id` = {$id}");
    if ($check > 0)
        return true;
    return false;
}
//danh mục con
function  list_product_child($id)
{
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` = {$id}");
}
//danh sách parent_id = 0
function category_name()
{
    $item = db_fetch_array("SELECT * FROM `tbl_category_products` WHERE `parent_id` = 0 ");
    return $item;
}
function name_slug($data, $field)
{
    $item = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `slug_url` = '{$data}'");
    return $item[$field];
}
//Kiểm tra parent_id có bằng id không
function check_parent_id_2($id)
{
    $check  = db_fetch_row("SELECT * FROM `tbl_category_products` WHERE `parent_id` = {$id}");
    if ($check > 0)
        return true;
    return false;
}
//Lấy danh sach thoản mãn
function list_product_by_parent_id($id)
{
    return db_fetch_array("SELECT * FROM `tbl_category_products` WHERE `parent_id` = {$id}");
}
function  list_product_by_id($id)
{
    return db_fetch_array("SELECT * FROM `tbl_category_products` WHERE `id` = {$id} ");
}
//Lấy danh sách sản phẩm thỏa mãn
function list_product($data)
{
    return db_fetch_array("SELECT `tbl_products`.*,`tbl_category_products`.`slug_url` FROM `tbl_products` LEFT JOIN `tbl_category_products` ON `tbl_products`.`product_id` = `tbl_category_products`.`id` WHERE `product_id` IN ({$data})");
}
//Tổng số bản ghi trong bảng products 
function num_products()
{
    return db_num_rows("SELECT * FROM `tbl_products`");
}
//Lọc từng sản phẩm theo theo đa cấp menu
function list_product_num($id)
{
    $item_parent_id = array();
    foreach (data_menu() as $item) {
        $item_parent_id[] = $item['parent_id'];
    }
    //Kiểm tra xem có id thuộc  vào danh sách ko
    if (in_array($id, $item_parent_id)) {
        // Tìm danh sách theo parent_id
        $list = data_tree(data_menu(), $id);
        //Tìm danh sách theo id
        $list_parent = list_list_id($id);
        //Nhóm lại
        $list_pro = array_merge($list, $list_parent);
    } else
        // In ra products
        $list_product = list_list_parent_id_id($id);
    $result = array();
    if (!empty($list_pro))
        //In ra các id thỏa mãn
        foreach ($list_pro as $item) {
            $result[] = $item['id'];
        }
    if (!empty($result))
        //Viết về dạng chuỗi
        $list_cat =  implode(',', $result);
    if (!empty($list_cat))
        //Danh sách của sản phẩm 
        $list_product = list_product($list_cat);
    return $list_product;
}
function list_product_category_test()
{
    db_fetch_array("SELECT  * FROM `tbl_category_products`");
}
//Danh sách banner
function list_banner()
{
    return db_fetch_array("SELECT * FROM `tbl_banner`");
}
function data_menu()
{
    return db_fetch_array("SELECT * FROM `tbl_category_products`");
}
function list_list_id($data)
{
    return db_fetch_array("SELECT * FROM `tbl_category_products` WHERE `id` = {$data}");
}
function list_list_parent_id_id($data)
{
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` = {$data}");
}
