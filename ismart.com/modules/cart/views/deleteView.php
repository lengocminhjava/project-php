<?php
$id = (int) $_GET['id'];

delete_cart($id);
if (!empty($id)) {
    redirect("?mod=cart&controllers=index&action=show");
} else redirect("?");
