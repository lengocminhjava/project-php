<?php
function construct()
{
    load_model('indexCategory');
}
function categoryAction()
{
    load('helper', 'category');
    global $error, $success, $name, $friendly_url, $parent_category;
    if (isset($_POST['category'])) {
        $error = array();
        $success = array();
        if (empty($_POST['name_title'])) {
            $error['name_title'] = "Không được bỏ trống trường này";
        } else {
            if (check_name_title($_POST['name_title'])) {
                $error['name_title'] = "Tên đã tồn tại";
            } else
                $name = $_POST['name_title'];
            $friendly_url = create_slug($_POST['name_title']);
        }
        if ($_POST['parent_category'] == 999999999) {
            $parent_category = 0;
        } else
            $parent_category = $_POST['parent_category'];
        if (empty($error)) {
            $data = array(
                'title' => $name,
                'parent_id' => $parent_category,
                'slug_url' => $friendly_url
            );
            add_category($data);
            $success['category'] = "Thêm thành công";
        }
    }
    $list_category = list_category();

    $list_new = search_data($list_category, 0, 0);
    $data = array(
        'list_category' => $list_category,
        'list_new' => $list_new
    );

    load_view('category', $data);
}
function updateAction()
{
    $cat_id = (int)$_GET['id'];
    global $error, $cat_title, $success, $friendly_url;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Không được để trống trường tiêu đề";
        } else {
            if (check_name_title($_POST['cat_title'])) {
                $error['cat_title'] = "Tiêu đề đã được tồn tại trước đó";
            } else {
                $cat_title = $_POST['cat_title'];
                $friendly_url = create_slug($_POST['cat_title']);
            }
        }
        if (empty($error)) {

            $data = array(
                'title' => $cat_title,
                'slug_url' => $friendly_url,
            );
            update_category($cat_id, $data);
            $success['cat'] = "Cập nhật dữ liệu thành công";
        }
    }
    $list_category = list_category();
    $category_info = get_info_category($cat_id);

    $data_update = array(
        'category_info' => $category_info,
        'list_category' => $list_category
    );
    load_view('update_category', $data_update);
}
function deleteAction()
{
    global $error, $success;
    $id = (int)$_GET['id'];
    if (list_post($id)) {
        $error['errore'] = "Không thể xóa vì nó có khóa ngoại";
        $_SESSION['errore'] = $error;
        redirect("?mod=post&controller=indexCategory&action=category");
    } else {
        if (check_parent_id($id)) {
            $error['b'] = "Không thể xóa vì còn tồn tại lớp con";
            // $_SESSION['errore'] = $error;
            $_SESSION['b'] = $error;
            redirect("?mod=post&controller=indexCategory&action=category");
        } else {
            delete($id);
            $success['ok'] = "Xóa thành công";
            $_SESSION['ok'] = $success;
            redirect("?mod=post&controller=indexCategory&action=category");
        }
    }
}
