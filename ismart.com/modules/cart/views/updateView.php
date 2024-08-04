 <?php
    $id = (int) $_POST['id'];
    $qty = (int)$_POST['qty'];
    $list_product_mvc_1 = get_list_product_mvc_by_id($id);
    //   show_array($list_product_mvc_2);
    // show_array($item);
    foreach ($list_product_mvc_1 as $item) {
        if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $_SESSION['cart']['buy'][$id]['qty'] =   $qty; //Cập nhật qty
            $sub_total = $qty * $item['price'];
            $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total; //Cập nhật tổng
            update_cart_mvc();
            $total = cat_total(); //Tổng
            $decs = number_qty(); //Số lượng
            $output = 'Số lượng : ' . $qty . '';
            $data = array(
                'sub_total' => currency_format($sub_total),
                'total' => currency_format($total),
                'qty' => $output,
                'decs' => $decs
            );
            echo json_encode($data);
        }
    }
    ?>
