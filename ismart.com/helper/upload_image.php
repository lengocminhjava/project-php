<?php
//upload file đúng định dạng
function is_image($type, $size)
{
    #Xử lí upload đúng file ảnh
    $type_allow = array('png', 'jpg', 'gif', 'jpeg');
    if (!in_array(strtolower($type), $type_allow)) {
        return false;
    } else {
        if ($size > 21000000) {
            return false;
        }
    }
    return true;
}
function upload_image($dir, $file_type)
{
    $upload_dir = $dir;
    $upload_file = $upload_dir . $_FILES['file']['name'];
    if (file_exists($upload_file)) {
        $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        $new_file_name = $file_name . "-copy.";
        $new_upload_file = $upload_dir . $new_file_name . $file_type;
        $k = 1;
        while (file_exists($new_upload_file)) {
            $new_file_name = $file_name . "-copy({$k}).";
            $k++;
            $new_upload_file = $upload_dir . $new_file_name . $file_type;
        }
        $upload_file = $new_upload_file;
    }
    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        return $upload_file;
    }
    return false;
}
