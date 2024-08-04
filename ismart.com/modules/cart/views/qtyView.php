<?php
if(isset($_POST['update_cart'])){
         get_update_qty($_POST['qty']);
         redirect("?mod=cart&controllers=index&action=show");
}
