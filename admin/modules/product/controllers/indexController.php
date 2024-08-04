<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $page, $start, $number_page, $total_row, $num_page, $start, $success, $error;
    $page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $number_page = 5; //Số bản ghi lấy
    $total_row =  num_rows(); //Tổng số bản ghi
    $num_page = ceil($total_row / $number_page); //Số trang
    $start = ($page - 1) * $number_page;
    $list_products = number_page($start, $number_page);
    // $list_category =  get_category();
    if (isset($_POST['btn_action'])) {
        $error = array();
        $success = array();
        if (!empty($_POST['cat'])) {
            if ($_POST['select_op'] == 1) {
                $error['select'] = "Chưa chọn nội dụng cần thực hiện";
            }
            $list_cat = implode(',', $_POST['cat']);
            if ($_POST['select_op'] == 2) {
                if (check_id_order_in($list_cat) || check_id_img_pro($list_cat)) {
                    $error['errore'] = "Không thể xóa vì có khóa ngoại";
                    $_SESSION['errore'] = $error;
                    // redirect("?mod=product&controller=index&action=index&page={$page}");
                } else {
                    delete_cat($list_cat);
                    $success['ok'] = "Xóa thành công";
                    $_SESSION['ok'] = $success;
                    // redirect("?mod=product&controller=index&action=index&page={$page}");
                }
                $success['update_ok'] = "Thành công";
                $_SESSION['update_ok'] = $success;
                // redirect("?mod=product&controller=index&action=index&page=$page");
            }
            if ($_POST['select_op'] == 4) {
                $data = array(
                    'status' => 'pending'
                );
                update_cat($data, $list_cat);
                $success['update_ok'] = "Thành công";
                redirect("?mod=product&controller=index&action=index&page=$page");
                $success['update_ok'] = "Thành công";
            }
            if ($_POST['select_op'] == 3) {
                $data = array(
                    'status' => 'public'
                );
                update_cat($data, $list_cat);
                $success['update_ok'] = "Thành công";
                redirect("?mod=product&controller=index&action=index&page=$page");
                $success['update_ok'] = "Thành công";
            }
        } else {
            if (!empty($_POST['select_op']) && $_POST['select_op'] == 1) {
                $error['select'] = "Vui lòng chọn";
            } else
                $error['select'] = "Chưa chọn nội dụng cần thực hiện";
        }
    }
    if (isset($_POST['btn_search'])) {
        if (!empty($_POST['search'])) {
            if (!empty(search_product($_POST['search']))) {
                $list_products = search_product($_POST['search']);
            } else
                $error['search'] = "Không tồn tại giá trị";
        } else
            $error['search'] = "Không tồn tại giá trị";
    }
    $data = array(
        'list_products' => $list_products,
        'start' => $start
    );
    load_view('index', $data);
}
function addAction()
{
    load('helper', 'upload_image');
    global $error, $success;
    $info_user = get_user_by_username(user_login(), 'fullname');
    $info_user_id = get_user_by_username(user_login(), 'id');
    if (isset($_POST['add_product'])) {
        $error = array();
        $success = array();
        if (empty($_POST['name'])) {
            $error['name'] = "Không được bỏ trống trường này";
        } else {
            if (check_name_product($_POST['name'])) {
                $error['name'] = "Tên đã tồn tại";
            } else
                $name = $_POST['name'];
        }
        if (empty($_POST['code'])) {
            $error['code'] = "Không được bỏ trống trường này";
        } else {
            $code = $_POST['code'];
        }
        if (empty($_POST['price'])) {
            $error['price'] = "Không được bỏ trống trường này";
        } else {
            $price = $_POST['price'];
        }
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được bỏ trống trường này";
        } else {
            $content = $_POST['product_content'];
        }
        if (empty($_POST['describe'])) {
            $error['describe'] = "Không được bỏ trống trường này";
        } else {
            $describe = $_POST['describe'];
        }
        if (empty($_POST['num'])) {
            $error['num'] = "Không được bỏ trống trường này";
        } else {
            $num = $_POST['num'];
        }
        if (empty($_POST['disscout']))
            $disscout = 0;
        else
            $disscout = $_POST['disscout'];
        if (($_POST['category']) == 999999) {
            $error['category'] = "Vui lòng chọn";
        } else {
            $category = $_POST['category'];
            $category_title = product($category, 'title');
        }
        // echo'<pre>';
        // print_r($_FILES);
        // var_dump($_FILES);
        // die();
        if (isset($_FILES['files']) && !empty($_FILES['files']['name'])) {
            foreach ($_FILES['files']['name'] as $key => $value) {
                $types = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
                $sizes = $_FILES['files']['size'][$key];
                if (!is_image($types, $sizes)) {
                    $error['upload_imagea'] = "kích thước hoặc kiểu ảnh không đúng";
                } else {
                    move_uploaded_file($_FILES['files']['tmp_name'][$key], 'public/uploads/more_product/' . $value);
                }
            }
        } else {
            $error['upload_image'] = "Bạn chưa upload tệp";
        }

        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // show_array($_FILES['file']);
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "Bạn chưa upload tệp";
        }
        $product_thumb = upload_image("public/uploads/products/", $type);
        if (isset($_FILES['files']) && !empty($_FILES['files']['name'])) {
            foreach ($_FILES['files']['name'] as $key => $value) {
                $types = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
                $sizes = $_FILES['files']['size'][$key];
                if (!is_image($types, $sizes)) {
                    $error['upload_imagea'] = "kích thước hoặc kiểu ảnh không đúng";
                } else {
                    move_uploaded_file($_FILES['files']['tmp_name'][$key], 'public/uploads/more_product/' . $value);
                }
            }
        } else {
            $error['upload_image'] = "Bạn chưa upload tệp";
        }
        $exampleRadios = $_POST['exampleRadios'];
        if (empty($error)) {
            $data = array(
                'code' => $code,
                'title_product' => $name,
                'thumbnail' => $product_thumb,
                'price' => $price,
                'discount' => $disscout,
                'product_id' => $category,
                'category' => $category_title,
                'num_qty' => $num,
                'created_at' => time(),
                'status' => $exampleRadios,
                'poster' => $info_user,
                'poster_id' => $info_user_id,
                'detail_product' => $content,
                'description' => $describe
            );
            add_product($data);
            $success['product'] = "Thêm thành công";
            if (!empty($data['title_product']))
                $id_product = (int)product_by_title($data['title_product'], 'id');
            // echo $id_product;
            foreach ($_FILES['files']['name'] as $key => $value) {
                $data_image = array(
                    'id_product' => $id_product,
                    'images' =>  $value
                );
                add_image_product($data_image);
            }
        }
    }
    $list_banner =  show_banner();
    if (!empty($id_product)) {
        $list_image_id = show_image($id_product);
    } else  $list_image_id =  "";
    $list_category = list_category();
    $data = array(
        'list_banner' => $list_banner,
        'list_category' => $list_category,
        'list_image_id' => $list_image_id
    );
    load_view('add', $data);
}
function updateAction()
{
    load('helper', 'upload_image');
    $id = (int)$_GET['id'];
    global $error, $success;
    $info_user = get_user_by_username(user_login(), 'fullname');
    $info_user_id = get_user_by_username(user_login(), 'id');
    $list_product = get_list_product_by_id($id);
    if (isset($_POST['add_product'])) {
        $error = array();
        $success = array();
        if (empty($_POST['name'])) {
            $error['name'] = "Không được bỏ trống trường này";
        } else {
            $data = check_name_product_update('title_product', $id);
            if (check_name_product($_POST['name']) && ($_POST['name'] != $data)) {
                $error['name'] = "Đã trùng vs tên trong giỏ hàng vui lòng kiêm tra lại";
            } else {
                $name = $_POST['name'];
            }
        }
        if (empty($_POST['code'])) {
            $error['code'] = "Không được bỏ trống trường này";
        } else {
            $code = $_POST['code'];
        }
        if (empty($_POST['price'])) {
            $error['price'] = "Không được bỏ trống trường này";
        } else {
            $price = $_POST['price'];
        }
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được bỏ trống trường này";
        } else {
            $content = $_POST['product_content'];
        }
        if (empty($_POST['describe'])) {
            $error['describe'] = "Không được bỏ trống trường này";
        } else {
            $describe = $_POST['describe'];
        }
        if (empty($_POST['num'])) {
            $error['num'] = "Không được bỏ trống trường này";
        } else {
            $num = $_POST['num'];
        }
        if (empty($_POST['disscout'])) {
            $disscout = 0;
        } else
            $disscout = $_POST['disscout'];

        if (($_POST['category']) == 999999) {
            $error['category'] = "Vui lòng chọn";
        } else {
            $category = $_POST['category'];
            $category_title = product($category, 'title');
        }
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            //TRường hơp người dùng không chọn ảnh
            if (empty($file_name)) {
                $product_thumb = $list_product['thumbnail'];
            } else {
                // show_array($_FILES['file']);
                $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $size = $_FILES['file']['size'];
                if (!is_image($type, $size)) {
                    $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
                }
                $product_thumb = upload_image("public/uploads/products/", $type);
            }
        }
        if (isset($_FILES['files'])) {
            $files = $_FILES['files'];
            $file_names = $files['name'];
            // show_array($file_names);
            //TRường hơp người dùng không chọn ảnh
            if (!empty($file_names[0])) {
                delete_image($id);
                foreach ($_FILES['files']['name'] as $key => $value) {
                    $types = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
                    $sizes = $_FILES['files']['size'][$key];
                    if (!is_image($types, $sizes)) {
                        $error['upload_imagea'] = "kích thước hoặc kiểu ảnh không đúng";
                    } else {
                        move_uploaded_file($_FILES['files']['tmp_name'][$key], 'public/uploads/more_product/' . $value);
                    }
                }
            } else {
                $imagee =  show_image($id);
                foreach ($imagee as $item) {
                    if ($item['images'] == '') {
                        delete_image_array($item['images']);
                    }
                }
            }
        }
        $exampleRadios = $_POST['exampleRadios'];
        if (empty($error)) {
            $data = array(
                'code' => $code,
                'title_product' => $name,
                'thumbnail' => $product_thumb,
                'price' => $price,
                'discount' => $disscout,
                'product_id' => $category,
                'category' => $category_title,
                'num_qty' => $num,
                'created_at' => time(),
                'status' => $exampleRadios,
                'poster' => $info_user,
                'poster_id' => $info_user_id,
                'detail_product' => $content,
                'description' => $describe
            );
            update_product($data, $id);
            $success['product'] = "Update thành công";
            foreach ($_FILES['files']['name'] as $key => $value) {
                $data_image = array(
                    'id_product' => $id,
                    'images' =>  $value
                );
                add_image_product($data_image);
            }
        }
    }
    $list_product = get_list_product_by_id($id);
    $list_category = list_category();
    $list_image_id = show_image($id);
    $data = array(
        'list_image_id' => $list_image_id,
        'list_category' => $list_category,
        'list_product' => $list_product
    );
    load_view('update', $data);
}
function categoryAction()
{
    load_view('category');
}
function deleteAction()
{
    global $success;
    $id = (int)$_GET['id'];
    if (!empty($_GET['page'])) $page = (int)$_GET['page'];
    if (check_id_order($id)) {
        $error['errore'] = "Không thể xóa vì có khóa ngoại";
        $_SESSION['errore'] = $error;
        redirect("?mod=product&controller=index&action=index&page={$page}");
    } else {
        delete_img($id);
        delete($id);
        $success['ok'] = "Xóa thành công";
        $_SESSION['ok'] = $success;
        redirect("?mod=product&controller=index&action=index&page={$page}");
    }
}
