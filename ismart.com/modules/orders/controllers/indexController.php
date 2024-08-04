<?php
function construct()
{
    load('helper', 'login');
    load('lib', 'email');
    load_model('index');
}
function indexAction()
{
    // load('helper','format');
    $list_order =  sum_total_money();
    $list_product = get_list_product();
    // show_array($list_product);
    $data = array(
        'list_order' => $list_order,
        'list_product' => $list_product
    );
    // show_array($list_product);   
    load_view('index', $data);
}

function updateAction()
{
    $rename = array(
        'Đã hủy' => 'cancelled',
        'Thành công' => 'successful',
        'Đang xử lí' => 'processing'
    );
    $id = (int) $_GET['id']; //orders
    $cliennt_by_id = get_orders_by_id($id);
    // show_array($cliennt_by_id);
    $id_client = $cliennt_by_id['order_id'];
    $client_thumnail = get_client_by_id($id_client);
    $id_product = (int)$cliennt_by_id['product_id'];
    $product = get_products_by_id($id_product);

    // show_array($client_thumnail);
    $discout = (int)$product['discount'];
    // echo $discout;
    load('helper', 'upload_image');
    global $error, $fullname, $phone_number, $position, $address, $success, $thumbnail, $type, $size, $total_monmey, $num, $name, $tmp_name, $path, $total_money;
    if (isset($_POST['btn_update_client'])) {
        $error = array();
        $success = array();
        // echo 'hello';
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không bỏ trống trường này";
        } else {
            $fullname = $_POST['fullname'];
        }
        if (empty($_POST['num'])) {
            $error['num'] = "Không bỏ trống trường này";
        } else {
            $num = $_POST['num'];
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
        if (($_POST['position'] == 1)) {
            $error['position'] = "Vui lòng chọn";
        } else {
            $position =  $_POST['position'];
            // echo $position;
        }
        if (empty($_POST['address'])) {
            $error['address'] = "Không bỏ trống trường này";
        } else {
            $address = $_POST['address'];
        }
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            if ($_FILES["file"]["name"] != NULL) {

                if (
                    $_FILES["file"]["type"] == "image/jpeg"
                    || $_FILES["file"]["type"] == "image/png"
                    || $_FILES["file"]["type"] == "image/gif"
                    || $_FILES["file"]["type"] == "image/jpg"
                ) {
                    if ($_FILES["file"]["size"] > 21000000) {
                        // echo "file quá nang";
                        $error['image'] = "file quá nang";
                    }
                    // kiem tra su ton tai cua file
                    elseif (file_exists("" . $_FILES["file"]["name"])) {
                        $error['image'] = $_FILES["file"]["name"] . " file đã tồn tại ";
                    } else {
                        $thumbnail = "";
                        $path = "public/uploads/clients/"; // file luu vào thu muc chua file upload
                        $tmp_name = $_FILES['file']['tmp_name'];
                        $name = $_FILES['file']['name'];
                        $type = $_FILES['file']['type'];
                        $size = $_FILES['file']['size'];
                        // Upload file
                        move_uploaded_file($tmp_name, $path . $name);
                        $thumbnail  = $path . $name;
                    }
                } else {
                    $error['image'] =  "file được chọn không hợp lệ";
                }
            }
        } else {
            $thumbnail = get_info_post('thumbnail', $id_client);
        }

        // echo $total_money;
        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'phone_number' => $phone_number,
                'address' => $address,
                'thumbnail' => $thumbnail,
                'created_at' => time(),
            );
            update_client($data, $id_client);
            $total_money = $discout * $num;
            // echo $total_money;
            $data_order = array(
                'total_money' => $total_money,
                'num' => $num,
                'status' => $rename[$position],
                'created_at' => time()
            );
            update_order($data_order, $id);
            $success['account'] = 'Cập nhật thành công';
        }
    }
    $cliennt_by_id = get_orders_by_id($id);
    $data = array(
        'cliennt_by_id' => $cliennt_by_id,
        'client_thumnail' => $client_thumnail
    );
    load_view('update', $data);
}
function deleteAction()
{
    $id = (int)$_GET['id'];
    delete($id);
    redirect("?mod=orders&controller=index&action=index");
}
function addAction()
{
    load_view('add');
}
