<?php 
$id = (int) $_GET['id'];
$date = time();
add_cart_mvc($id);
// show_array($list_add);
redirect("?mod=cart&controller=index&action=show");
