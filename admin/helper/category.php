<?php
// Kiểm tra $parent_id có =$id hay không nếu có thì return true , không thì false
function childen_of_data($data, $id)
{
    foreach ($data as $v) {
        if ($v['parent_id'] == $id)
            return true;
    }
    return false;
}
//Tìm các giá trị của $parent_id = $parent_id;
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
function cuutuimi($item)
{
    global $error;
    $error = array();
    if (!empty($item['parent_id'] == $item['id'])) {
        return $item['id'];
    } else {
        return $error;
        $error['namee'] = 'Mày nhập sai rồi cấm xóa';
    }
}
