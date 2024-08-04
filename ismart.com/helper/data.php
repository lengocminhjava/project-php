<?php
function show_array($data)
{
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
function rename_data($data)
{
    global $array;
    $array = array(
        'public' => 'Công khai',
        'pending' => 'Không công khai'
    );
    return $array[$data];
}
function rename_data_($data)
{
    global $array;
    $array = array(
        'Công khai' => 'public',
        'Ẩn' => 'pending'
    );
    return $array[$data];
}
function rename_pro($data)
{
    global $array;
    $array = array(
        'processing' => 'Đang xử lí',
        'successful' => 'Hoàn thành',
        'cancel' => 'Đơn hủy'
    );
    return $array[$data];
}
if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}
function childen_of_data($data, $id)
{
    foreach ($data as $v) {
        if ($v['parent_id'] == $id)
            return true;
    }
    return false;
}

function search_data($data, $parent_id = 0, $level = 0)
{
    $result = array();
    foreach ($data as $v) {
        $v['level'] = $level;
        if ($v['parent_id'] == $parent_id) {
            $result[] = $v;
            if (childen_of_data($data, $v['id'])) {
                $result_child = search_data($data, $v['id'], $level + 1);
                $result = array_merge($result, $result_child);
            }
        }
    }
    return $result;
}
function has_child($data, $id)
{
    foreach ($data as $v) {
        if ($v['parent_id'] == $id) return true;
    }
    return false;
}
function data_tree($data, $parent_id = 0)
{
    $result = array();
    foreach ($data as $v) {
        if ($v['parent_id'] == $parent_id) {
            $result[] = $v;
            if (has_child($data, $v['id'])) {
                $result_child = data_tree($data, $v['id']);
                $result = array_merge($result, $result_child);
            }
        }
    }

    return $result;
}

function check_parent($data, $level = 0)
{
    $result = array();
    $result_child = array();
    foreach ($data as $v) {
        $v['level'] = $level;
        if ($v['parent_id'] == 0) {
            $result[] = $v;
        } else
        if ($v['parent_id'] == $v['id']) {
            $result_child[] = $v;
            $result = array_merge($result, $result_child);
        }
    }
    return $result;
}
function listt_category()
{
    return db_fetch_array("SELECT * FROM `tbl_category_products`");
}
function render_menu($data, $menu_class, $menu_id, $parent_id = 0,   $level = 0)
{
    if ($level == 0)
        $result = "<ul class='{$menu_class}' id='{$menu_id}'>";
    else
        $result = "<ul class='sub-menu'>";
    foreach ($data as $v) {
        if ($v['parent_id'] == $parent_id) {
            $result .= "<li>";
            if ($parent_id == 0)
                $result .= "<a href='danh-muc/{$v['slug_url']}'title=''>{$v['title']}</a>";
            else
                $result .= "<a href='danh-muc/{$v['slug_url']}-{$v['id']}.html'title=''>{$v['title']}</a>";
            if (childen_of_data($data, $v['id'])) {
                $result .= render_menu($data, $menu_id, $menu_class, $v['id'], $level + 1);
            }
            $result .= "</li>";
        }
    }
    $result .= "</ul>";
    return $result;
}

function list_child_parent($data, $parent_id = 0, $level = 0)
{
    $result = array();
    foreach ($data as $v) {
        $v['level'] = $level;
        if ($v['parent_id'] == $parent_id) {
            $result[] = $v;
            if (childen_of_data($data, $v['id'])) {
                $result_child = search_data($data, $v['id'], $level + 1);
            }
        }
    }
    return $result_child;
}

