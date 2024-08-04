<?php
function construct()
{
  load_model('index');
}
function showAction()
{

  // load('helper','product_detail');
  $list_add = list_product_mvc();
  $data['list_add'] = $list_add;
  load_view('show', $data);
}
function addAction()
{

  load_view('add');
}
function deleteAction()
{
  $id = $_GET['id'];
  delete_cart($id);
  redirect("?mod=cart&controller=index&action=show");
}
function updateAction()
{
  $id = $_POST['id'];
  load_view('update');
}
function checkAction()
{
  $list_add = list_product_mvc();
  $data['list_add'] = $list_add;
  load_view('check', $data);
}
function qtyAction()
{

  load_view('qty');
}
function checkoutAction()
{
  load('lib', 'email');
  $list_order  =  $_SESSION['cart']['buy'];
  show_array($list_order);
  $list_city = get_list_city();
  $street = $_POST['street'];
  global $error, $success, $fullname, $email, $number, $phone_number, $commune, $street, $notes;
  if (isset($_POST['order'])) {
    $error = array();
    $success = array();
    if (empty($_POST['fullname'])) {
      $error['fullname'] = "Không được bỏ trống trường này";
    } else {
      $fullname = $_POST['fullname'];
    }
    if (empty($_POST['email'])) {
      $error['email'] = "Bạn cần nhập thông tin";
    } else {
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Bạn nhập sai định dạng";
      } else
        $email = $_POST['email'];
    }
    if (!empty($_POST['number'])) {
      if (is_numeric($_POST['number']) == FALSE) {
        $error['number'] = "Không phải là kiểu số";
      } else
        $number = $_POST['number'];
    }
    if (empty($_POST['phone_number'])) {
      $error['phone_number'] = "Không được bỏ trống tên đăng nhập";
    } else {
      if (!is_phone($_POST['phone_number'])) {
        $error['phone_number'] = "Số điện thoại không đúng";
      } else {
        $phone_number = $_POST['phone_number'];
      }
    }
    if ($_POST['select_city'] == 999) {
      $error['select_city'] = "Bạn chưa chọn tỉnh";
    }
    $city = $_POST['select_city'];
    // show_array($city);
    if ($_POST['select_district'] == 999) {
      $error['select_district'] = "Bạn chưa chọn huyện";
    }
    $district = $_POST['select_district'];
    // show_array($district);
    if (empty($_POST['commune'])) {
      $error['commune'] = "Không được bỏ trống trường này";
    } else {
      $commune = $_POST['commune'];
    }
    if (!empty($_POST['street'])) {
      $street = $_POST['street'];
    }
    if (!empty($_POST['notes'])) {
      $notes = $_POST['notes'];
    }
    if (empty($error)) {
      $content = "";
      $cart_total = cat_total() + 19000;
      $time = time();

      $content .= '
            <div id="wrapper2" style="max-width: 700px;
            margin: 0 auto;">
                <h1 style=" text-align: center;">Cảm ơn quý khách đã đặt hàng tại ismart</h1>
                <p class="highlight" style="font-size: 16px;
                font-style: italic;
                font-weight: 600;
                text-transform: capitalize;">ismart rất vui thông báo đơn hàng #11222 đã được tiếp nhận và đang trong quá trình xử lí ismart sẽ thông báo đến quý khách ngay khi đơn hàng chuẩn bị được giao</p>
                <div class="text"style=" font-size: 20px;
                text-align: center;
                padding-bottom:30px;"><span style="text-transform: uppercase;
                color: #00337C;">Thông tin đơn hàng #11222</span> (ngày ' . date("m/d/y G.i:s<br>", $time) . ' )</div>
                <div class="order"style=" display:flex;
                margin-bottom: 30px;  justify-content: space-between;">
                    <div class="information"style="min-width:30%;">
                        <p class="tt" style="font-weight: bold;">Thông tin thanh toán</p>
                        <p>Họ và tên</p>
                        <p>' . $fullname . '</p>
                        <p class="e">
                        <p>Email</p>
                         <a style="" href="">' . $email . '</a> </p>
                        <p>Số điện thoại ' . $phone_number . '</p>
                    </div>
                    <div class="logo" style="min-width:30%;  margin-right:60px;margin-left:60px"> <img style=" min-width:70%; height:150px;
                 " src="https://www.ismart.org.br/wp-content/uploads/2022/01/LOGO-ismart.png" /></div>
                    <div class="more"style="margin-right:0;padding-right:0">
                        <p class="tt"style="font-weight: bold;">Địa chỉ giao hàng</p>
                        <p class="adress"style="text-transform: capitalize;">' . $street . ',' . $commune . ' ,
                        ' . $district . ', ' . $city . ' </p>
                        <p>' . $notes . '</p>
                    </div>
                </div>
                <div class="show" style=" border-top: 3px solid #00425A;
                padding :20px ;
                text-align: center;">
                    <table style="border:1px solid #868585;  border-collapse:collapse;">
                    <tr>
                    <th style="border:1px solid #868585;padding:10px 0px;
                  }    width: 200px; background-color:#BFACE2;">Mã sản phẩm</th>
                    <th style="border:1px solid #868585; padding:10px 0px;
                  }  width: 200px;  background-color:white;">Ảnh sản phẩm</th>
                    <th style="border:1px solid #868585;padding:10px 0px;
                  }   width: 200px; background-color:#eee;">Tên sản phẩm</th>
                    <th style="border:1px solid #868585; padding:10px 0px;
                  }  width: 200px;background-color:white;">Giá sản phẩm</th>
                    <th style="border:1px solid #868585; padding:10px 0px;
                  }  width: 200px; background-color:#eee;">Số lượng</th>
                    <th style="border:1px solid #868585;padding:10px 0px;
                  }   width: 200px;">Thành tiền</th>
                </tr>';
      foreach ($_SESSION['cart']['buy'] as $item) {
        $content .= '
                        <tr>
                            <td style="border:1px solid #868585;    width: 200px;">' . $item['code'] . '</td>
                            <td class="thumb" style="border:1px solid #868585; width: 200px;"><img src="http://localhost/admin-unitop.com/admin/' . $item['thumb'] . '" style=" max-width: 100%;
                            height: auto;
                            display: block;
                            margin-left: auto;
                            margin-right: auto;" alt=""> </td>
                            <td style="border:1px solid #868585;    width: 200px;"> ' . $item['title'] . ' </td>
                            <td style="border:1px solid #868585;    width: 200px;">' . $item['price'] . '</td>
                            <td class="nb" style="border:1px solid #868585;    width: 200px;"> ' . $item['code'] . '</td>
                            <td style="border:1px solid #868585;    width: 200px;">' . $item['qty'] . ' </td>
                            <td style="border:1px solid #868585;    width: 200px;">' . $item['sub_total'] . '</td>
                        </tr>
        ';
      }

      $content .= '
                    </table>
                </div>
                <div class="end">
                    <p><strong>Phương thức thanh toán:</strong>Thanh toán tiền mặt khi nhận hàng</p>
                    <p><strong>Thời gian giao dự kiến:</strong>Sau từ 2 - 5 ngày kể từ khi giao hàng</p>
                    <p><strong>Phí vận chuyển:</strong>19.000đ</p>
                    <p>Tổng số tiền thanh toán là :' . $cart_total . '<p>
                </div>
        
            </div>
        ';
    }
    if (!empty($email) && !empty($content))
      send_mail($email, 'Fail', 'check', $content);
  }
  $data = array(
    'list_order' => $list_order,
    'list_city' => $list_city
  );
  load_view('checkout', $data);
}
function updateAjaxAction()
{
  $id = (int)$_POST['id'];
  $list_city = list_city($id);
  $output = "";
  if (!empty($list_city)) {
    foreach ($list_city as $item) {
      $output .=
        '<option value="' . $item['name'] . '" id="district">' . $item['name'] . '</option> ';
    }
  } else {
    $output .= '<option id="district">vui lòng chọn</option>';
  }
  $data = array(
    'output' => $output
  );

  echo json_encode($data);
}
function buy_nowAction()
{
  $id = $_GET['id'];
  add_cart_mvc($id);
  $list_order  =  $_SESSION['cart']['buy'];
  $list_city = get_list_city();
  $data = array(
    'list_order' => $list_order,
    'list_city' => $list_city
  );
  load_view('checkout', $data);
}
function changeAction()
{
  $id = $_POST['id'];
  $qty = $_POST['qty'];
  $quantity = $_POST['quantity'];
  if ($qty > 0) {
    if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
      $qty = $_SESSION['cart']['buy'][$id]['qty'] + $qty;
      if ($qty > $quantity) {
        $qty = $quantity;
      }
    }
    $list_product_mvc_1 = get_list_product_mvc_by_id($id);
    //   show_array($list_product_mvc_1);
    foreach ($list_product_mvc_1 as $item) {
      // show_array($item);
      $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['id'],
        'code' => $item['code'],
        'title' => $item['title_product'],
        'price' => $item['price'],
        'discount' => $item['discount'],
        'thumb' => $item['thumbnail'],
        'content' => $item['detail_product'],
        'num_qty' => $item['num_qty'],
        'slug' => $item['slug_url'],
        'qty' => $qty,
        'sub_total' => $item['price'] * $qty
      );
    };
    update_cart_mvc();
  }
  $data = array(
    'qty' => $qty
  );
}
