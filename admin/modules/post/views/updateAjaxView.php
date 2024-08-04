<?php
global $success;
$id = (int)$_GET['id'];
$value = $_GET['value'];
$data = array(
    'title' => $value
);
update_list($data, $id);
// $result = db_fech_row($id);
echo $result;
