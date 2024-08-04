<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    global $list_post, $page, $number_page, $total_row, $num_page, $start, $success, $error;
    $page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $number_page = 4; //Số bản ghi lấy
    $total_row =  num_rows(); //Tổng số bản ghi
    $num_page = ceil($total_row / $number_page); //Số trang
    $start = ($page - 1) * $number_page;
    $list_post = number_page($start, $number_page);
    // $list_category =  get_category();
    if (isset($_POST['btn_update_new'])) {
        $error = array();
        $success = array();
        if (!empty($_POST['cat'])) {
            $list_cat = implode(',', $_POST['cat']);
            if ($_POST['select_op'] == 1) {
                delete_cat($list_cat);
                $success['update_ok'] = "Thành công";
                $_SESSION['update_ok'] = $success;
                redirect("?mod=post&controller=index&action=index&page=$page");
            }
            if ($_POST['select_op'] == 2) {
                $data = array(
                    'status' => 'pending'
                );
                update_cat($data, $list_cat);

                $success['update_ok'] = "Thành công";
                $_SESSION['update_ok'] = $success;
                redirect("?mod=post&controller=index&action=index&page=$page");
            }
            if ($_POST['select_op'] == 3) {
                $data = array(
                    'status' => 'public'
                );
                update_cat($data, $list_cat);
                $success['update_ok'] = "Thành công";
                $_SESSION['update_ok'] = $success;
                redirect("?mod=post&controller=index&action=index&page=$page");
            }
        } else {
            if (!empty($_POST['select_op']) && $_POST['select_op'] == 99) {
                $error['select'] = "Vui lòng chọn";
            } else
                $error['select'] = "Chưa chọn nội dụng cần thực hiện";
        }
    }

    if (isset($_POST['btn_search'])) {
        if (!empty($_POST['search'])) {
            if (!empty(search_product($_POST['search']))) {
                $list_post = search_product($_POST['search']);
            } else
                $error['search'] = "Không tồn tại giá trị";
        } else
            $error['search'] = "Không tồn tại giá trị";
    }
    $data = array(
        'page' => $page,
        'list_post' => $list_post
    );
    load_view('index', $data);
}
function addAction()
{
    load('helper', 'upload_image');
    $info_user = get_user_by_username(user_login());
    $user_id = $info_user['id'];
    $user_name = $info_user['fullname'];
    $list_category = get_category();
    global $name_post, $post_content, $success, $friendly_url, $exampleRadios, $error, $post_thumb, $category, $data;
    if (isset($_POST['btn_addPost'])) {
        $error = array();
        $success = array();
        if (empty($_POST['name_title'])) {
            $error['name_title'] = "Không được bỏ trống trường này";
        } else {
            if (check_post_title($_POST['name_title'])) {
                $error['name_title'] = "Dữ liệu đã bị trùng";
            } else
                $name_post = $_POST['name_title'];
            $friendly_url = create_slug($_POST['name_title']);
        }
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Bạn chưa nhập nội dung bài viết";
        } else {
            $post_content = $_POST['post_content'];
        }
        if (!empty($_POST['a']) && $_POST['a'] == 9) {
            $error['a'] = "Vui lòng chọn danh mục";
        } else
            $category = (int)$_POST['a'];
        if (!empty($category)) {
            $category_by_id = get_category_by_id($category)['title'];
        }
        // $control = $_POST['control'];
        $exampleRadios = $_POST['exampleRadios'];
        //upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "Bạn chưa upload tệp";
        }
        $post_thumb = upload_image("public/uploads/post/", $type);

        if (empty($error)) {
            $data = array(
                'title' => $name_post,
                'content' => $post_content,
                // 'category' => $control,
                'base_url' => $friendly_url,
                'creat_date' => time(),
                'thumbnail' => $post_thumb,
                'status' => $exampleRadios,
                'parent_id' => $category,
                'category' => $category_by_id,
                'poster_id' => $user_id,
                'poster' => $user_name,
            );

            add_post($data);
            $success['post'] = "Thêm thành công";
        }
    }
    $list_post = list_post();
    // $list_category =  get_category();
    $data = array(
        'friendly_url' => $friendly_url,
        'list_post' => $list_post,
        'list_category' => $list_category
    );
    //  $OK = iloveyoubaybe(1,2);
    load_view('add', $data);
}
function updateAjaxAction()
{
    // $value = $_GET['value'];
    // $id=(int)$_GET['id'];
    // update_list($value,$id);
    load_view('updateAjax');
}
function deleteAction()
{
    $id = $_GET['id'];
    $page = $_GET['page'];
    delete($id);
    redirect("?mod=post&controller=index&action=index&page=$page");
}
function updateAction()
{
    load('helper', 'upload_image');
    $post_id = (int)$_GET['id'];
    $list_category = get_category();
    $info_post = db_fech_row_($post_id);
    $category_id = (int) $info_post['parent_id'];
    $get_title_category = get_category_by_id($category_id)['title'];
    global $name_post, $post_content, $error, $success, $friendly_url, $exampleRadios, $error, $post_thumb, $category, $type, $size;
    if (isset($_POST['btn_updatePost'])) {
        $error = array();
        $success = array();
        if (empty($_POST['name_title'])) {
            $error['name_title'] = "Không được bỏ trống trường này";
        } else {
            $data =  check_name_product_update('title', $post_id);
            if (check_post_title($_POST['name_title']) && $_POST['name_title'] != $data) {
                $error['name_title'] = "Dữ liệu đã bị trùng";
            } else
                $name_post = $_POST['name_title'];
            $friendly_url = create_slug($_POST['name_title']);
        }
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Bạn chưa nhập nội dung bài viết";
        } else {
            $post_content = $_POST['post_content'];
        }
        if (!empty($_POST['category']) && $_POST['category'] == 9) {
            $error['categoryy'] = "Vui lòng chọn";
        } else {
            $category = $_POST['category'];
        }
        // $control = $_POST['control'];
        $exampleRadios = $_POST['exampleRadios'];
        //upload file
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
                        $post_thumb = "";
                        $path = "public/uploads/post/"; // file luu vào thu muc chua file upload
                        $tmp_name = $_FILES['file']['tmp_name'];
                        $name = $_FILES['file']['name'];
                        $type = $_FILES['file']['type'];
                        $size = $_FILES['file']['size'];
                        // Upload file
                        move_uploaded_file($tmp_name, $path . $name);
                        $post_thumb  = $path . $name;
                    }
                } else {
                    $error['image'] =  "file được chọn không hợp lệ";
                }
            }
        } else {
            $post_thumb = get_info_post('thumbnail', $post_id);
        }

        if (empty($error)) {
            $data = array(
                'title' => $name_post,
                'content' => $post_content,
                // 'category' => $control,
                'base_url' => $friendly_url,
                'creat_date' => time(),
                'thumbnail' => $post_thumb,
                'status' => $exampleRadios,
                'parent_id' => $category,
                'category' => $get_title_category
            );

            update_list($data, $post_id);
            $success['post'] = "Cập nhật thành công thành công";
        }
    }

    // show_array($info_post);
    // $list_category =  get_category();
    $data = array(
        'friendly_url' => $friendly_url,
        'info_post' =>  $info_post,
        'list_category' => $list_category
    );
    //  $OK = iloveyoubaybe(1,2);
    load_view('update', $data);
}
