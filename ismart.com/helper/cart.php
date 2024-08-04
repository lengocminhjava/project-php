



<?php
function add_cart_mvc($id)
{
    $list_product_mvc_1 = get_list_product_mvc_by_id($id);
    $qty = 1;
    //   show_array($list_product_mvc_1);
    foreach ($list_product_mvc_1 as $item) {
        // show_array($item);
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
        }
        $_SESSION['cart']['buy'][$id] = array(
            'id' => $item['id'],
            'code' => $item['code'],
            'title' => $item['title_product'],
            'price' => $item['price'],
            'discount' => $item['discount'],
            'thumb' => $item['thumbnail'],
            'content' => $item['detail_product'],
            'num_qty' => $item['num_qty'],
            'qty' => $qty,
            'sub_total' => $item['price'] * $qty
        );
        // show_array($_SESSION['cart']['buy']);
    };
    update_cart_mvc();
}
function update_cart_mvc()
{
    if (isset($_SESSION['cart'])) {
        $number_qty = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $number_qty += $item['qty'];
            $total += $item['sub_total'];
        }
        $_SESSION['cart']['total'] =
            array(
                'number' => $number_qty,
                'cat_total' => $total
            );
    }
}
function list_product_mvc()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_add_cart'] = "?mod=cart&controllers=index&action=update&id={$item['id']}";
            $item['url_delete_cart'] = "?mod=cart&controllers=index&action=delete&id={$item['id']}";
        }
        return $_SESSION['cart']['buy'];
    }
}

function cat_total()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['total']['cat_total'];
    }
}
function delete_cart($id)
{

    if (isset($_SESSION['cart'])) {
        if (!empty($id)) {
            unset($_SESSION['cart']['buy'][$id]);
            update_cart_mvc();
        } else {
            unset($_SESSION['cart']);
            redirect("?");
        }
    }
}
function  get_update_qty($qty)
{

    foreach ($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_total'] =  $new_qty * $_SESSION['cart']['buy'][$id]['price'];
    }
    update_cart_mvc();
}
function  get_qty($qty)
{

    foreach ($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        return $new_qty;
    }
}
function number_qty()
{
    if (isset($_SESSION['cart'])) {
        return  $_SESSION['cart']['total']['number'];
    }
}
