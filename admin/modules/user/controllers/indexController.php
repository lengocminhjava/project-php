<?php
function construct()
{

    load_model('index');
}
function indexAction()
{
    // load('helper','format');
    // $list = product();
    // show_array($list);
    $list_order =  sum_total_money();
    $list_product = get_list_product();
    // show_array($list_product);
    $data = array(
        'list_order' => $list_order,
        'list_product' => $list_product
    );
    // show_array($list_product);   
    load_view('index', $data);
}

function Action()
{
}

function editAction()
{
}
