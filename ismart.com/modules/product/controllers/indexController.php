<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $page, $start, $number_page, $total_row, $num_page, $start, $error;
    $page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $number_page = 15; //Số bản ghi lấy
    $total_row =  num_rows(); //Tổng số bản ghi
    $num_page = ceil($total_row / $number_page); //Số trang
    $start = ($page - 1) * $number_page;
    $list_product = get_list_product($start, $number_page);
    $num_list_product = num_products();
    $list_title = category_name();
    // show_array($list_product);
    if (isset($_POST['filter'])) {
        $error = array();
        if ($_POST['select'] == 1) {
            $error['select'] = 'Vui lòng chọn';
        } elseif (($_POST['select']) == 2) {
            $list_product = get_list_product_a_z('title_product');
        } elseif (($_POST['select']) == 3) {
            $list_product = get_list_product_z_a('title_product');
        } elseif (($_POST['select']) == 4) {
            $list_product = get_list_product_a_z('price');
        } elseif (($_POST['select']) == 5) {
            $list_product = get_list_product_z_a('price');
        }
    }
    $data = array(
        'list_product' => $list_product,
        'num_list_product' => $num_list_product,
        'list_title' => $list_title
    );

    load_view('index', $data);
}
function categoryAction()
{
    load_model('category');
    $list_title = category_name();
    $num_list_product = num_products();
    $slug = !empty($_GET['slug']) ? $_GET['slug'] : 'Không lấy đc';
    $name = name_slug($slug, 'title');
    $id = (int)name_slug($slug, 'id');
    // Viết danh sách các parent_id
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
            $result[] = (int)$item['id'];
        }
    if (!empty($result))
        //Viết về dạng chuỗi
        $list_cat =  implode(',', $result);
    if (!empty($list_cat))
        //Danh sách của sản phẩm 
        $list_product = list_product($list_cat);
    $data = array(
        'name' => $name,
        'list_product' => $list_product,
        'num_list_product' => $num_list_product,
        'list_title' => $list_title
    );
    if (isset($POST['r-price'])) {
        if ($POST['r-price'] == 1) {
            $number = $_POST['r-price'];
            echo ($number);
        }
    }
    load_view('category', $data);
}
function detailAction()
{
    load_model('category');
    $id = (int)$_GET['id'];
    $list_product = get_list_product_by_id_($id);
    $image_product = get_image_by_id($id)['thumbnail'];
    $list_selling = selling_products();
    $list_row_product =  get_list_product_by_id($id);
    $product_id = (int) $list_row_product['product_id'];
    $list_row_category = list_list_id($product_id);
    $number = (int) $list_row_category[0]['parent_id'];
    // echo $number;
    $list_pro = (int) has_child_four($number, $list_row_category);
    // echo ($list_pro);
    $same_list = num_list($list_pro);

    $data = array(
        // 'same_category' => $same_category,
        'list_product' => $list_product,
        'same_list' => $same_list,
        'image_product' => $image_product,
        'list_selling' => $list_selling
    );
    // show_array($list_product);
    load_view('detail', $data);
}
function cartAction()
{
    load_view('cart');
}
function checkoutAction()
{
    load_view('checkout');
}
function ajaxAction()
{
    load_model('category');
    // $list_product = searchforcondition('Điện thoại');
    // show_array($list_product);
    if (isset($_POST['brand']) && !empty($_POST['brand'])) {
        $id = list_list_title_name($_POST['brand'])['id'];
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
        }
        $result = array();
        if (!empty($list_pro))
            //In ra các id thỏa mãn
            foreach ($list_pro as $item) {
                $result[] = (int)$item['id'];
            }
        if (!empty($result))
            //Viết về dạng chuỗi
            $list_cat =  implode(',', $result);
        //Danh sách của sản phẩm 
        $query = "SELECT `tbl_products`.*,`tbl_category_products`.`slug_url` FROM `tbl_products` INNER JOIN  `tbl_category_products`
        ON `tbl_products`.`product_id` = `tbl_category_products`.`id`";
        if (empty($_POST['price'])) {
            $query .= "WHERE `tbl_products`.`product_id` IN ({$list_cat})";
        } else {
            if ($_POST['price'] == 1) {
                $query .= "WHERE `tbl_products`.`product_id` IN ({$list_cat}) AND `tbl_products`.`price` < '500000'";
            }
            if ($_POST['price'] == 2) {
                $query .= "WHERE `tbl_products`.`product_id` IN ({$list_cat}) AND `tbl_products`.`price` > '500000' AND `tbl_products`.`price` < '1000000'";
            }
            if ($_POST['price'] == 3) {
                $query .= "WHERE `tbl_products`.`product_id` IN ({$list_cat}) AND `tbl_products`.`price` > '1000000' AND `tbl_products`.`price` < '5000000'";
            }
            if ($_POST['price'] == 4) {
                $query .= "WHERE `tbl_products`.`product_id` IN ({$list_cat}) AND `tbl_products`.`price` > '5000000' AND `tbl_products`.`price` < '10000000'";
            }
            if ($_POST['price'] == 5) {
                $query .= "WHERE `tbl_products`.`product_id` IN ({$list_cat}) AND `tbl_products`.`price` > '10000000'";
            }
        }
    } else {
        $query = "SELECT `tbl_products`.*,`tbl_category_products`.`slug_url` FROM `tbl_products` INNER JOIN  `tbl_category_products`
        ON `tbl_products`.`product_id` = `tbl_category_products`.`id`";
        if (isset($_POST['price'])) {
            if ($_POST['price'] == 1) {
                $query .= "WHERE  `tbl_products`.`price` < '500000'";
            }
            if ($_POST['price'] == 2) {
                $query .= "WHERE`tbl_products`.`price` > '500000' AND `tbl_products`.`price` < '1000000'";
            }
            if ($_POST['price'] == 3) {
                $query .= "WHERE `tbl_products`.`price` > '1000000' AND `tbl_products`.`price` < '5000000'";
            }
            if ($_POST['price'] == 4) {
                $query .= "WHERE `tbl_products`.`price` > '5000000' AND `tbl_products`.`price` < '10000000'";
            }
            if ($_POST['price'] == 5) {
                $query .= "WHERE`tbl_products`.`price` > '10000000'";
            }
        }
    }
    $list_product = db_fetch_array($query);
    $output = "";

    if (!empty($list_product)) {
        foreach ($list_product as $v) {
            $output .= '<li class="item">
            <a href="danh-muc/chi-tiet/' . $v['slug_url'] . '-' . $v['id'] . '.html' . ' " title="" class="thumb">
                <img src="../admin/' . $v['thumbnail'] . '">
            </a>
            <a href="danh-muc/chi-tiet/' . $v['slug_url'] . '-' . $v['id'] . 'html' . '" title="" class="product-name">' . $v['title_product'] . '</a>
            <div class="price">
                <span class="new"> ' . currency_format($v['price']) . ' </span>
                <span class="old">' . currency_format($v['discount']) . '</span>
            </div>
            <div class="action clearfix">
                <a href="?mod=product&controller=index&action=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                <a href="?mod=product&controller=index&action=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
            </div>
        </li>';
        }
    } else {
        $output .= 'Không có sản phẩm yêu cầu';
    }
    $num = count($list_product);
    $data = array(
        'output' => $output,
        'num' => $num
    );
    echo json_encode($data);
}
function ajax_countAction()
{
}
