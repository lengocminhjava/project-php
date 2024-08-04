<?php
function construct()
{
    load('helper', 'category');
    load_model('index');
}
function indexAction()
{
    // load('helper','format');
    // $list = product();
    // show_array($list);
    $list_banner = list_banner();
    $list_order =  sum_total_money();
    $list_product = get_list_product();
    // show_array($list_product);
    $list_selling = selling_products();
    // show_array($list_selling);
    $list_featured_products = featured_products();
    // if (check_parent_id($id)) {
    // } else {
    //     $list_product = list_product_child($id);
    // 
    $list_product_by_parent_id_0 = category_name();
    // show_array($list_product_by_parent_id_0);
    $num = array();
    foreach ($list_product_by_parent_id_0 as $v) {
        $num[] = $v['id'];
    }
    $list_product_1 = list_product_num($num[0]);
    $list_product_2 = list_product_num($num[1]);
    $list_product_3 = list_product_num($num[2]);
    $list_product_4 = list_product_num($num[3]);

    // show_array($list_productt);
    $data = array(
        'list_product_1' => $list_product_1,
        'list_product_2' => $list_product_2,
        'list_product_3' => $list_product_3,
        'list_product_4' => $list_product_4,
        'list_selling' => $list_selling,
        'list_order' => $list_order,
        'list_product' => $list_product,
        'list_featured_products' => $list_featured_products,
        'list_banner' => $list_banner
    );
    // show_array($list_product);   
    load_view('index', $data);
}

function searchAction()
{
    $search = $_POST['search'];
    $result = search_model($search);
    $output = "";
    foreach ($result as $item) {
        $output .=
            '<li class="item">
            <div class="thumb">
            <a href="danh-muc/chi-tiet/' . $item['slug_url'] . '-' . $item['id'] . '.html' . ' " title="" class="thumb">
                <img src="../admin/' . $item['thumbnail'] . '">
            </a>
            </div>
            <div class="informtion">
            <a href="danh-muc/chi-tiet/' . $item['slug_url'] . '-' . $item['id'] . '.html' . '" title="" class="product-name">' . $item['title_product'] . '</a>
            <div class="price">
                <span class="new"> ' . currency_format($item['price']) . ' </span>
                <span class="old">' . currency_format($item['discount']) . '</span>
            </div>
            <div>
            </li>';
    }
    $data = array(
        'output' => $output
    );
    echo json_encode($data);
}
