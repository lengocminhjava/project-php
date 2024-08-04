<?php
function get_pagin($num_page, $page, $base_url = "")
{
    global $num_page, $page;

    $str_pagging = " <ul class='pagination'> ";

    for ($i = 1; $i <= $num_page; $i++) {
        $str_pagging .= "<li class='page-item'><a class='page-link' href='{$base_url}&page={$i}'>$i</a></li>";
    }
    $str_pagging .= "</ul>";
    echo $str_pagging;
}
?>