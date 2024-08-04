<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/admin-unitop.com/ismart.com/">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/order.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <script src="public/js/jquery-3.6.3.js" type="text/javascript"></script>
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="?" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="danh-muc" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="bai-viet.html" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="lien-he.html" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="">
                                <input type="text" name="search" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" name="action" id="sm-s">Tìm kiếm</button>
                                <ul class="" id="output_search">
                                </ul>
                                <style>
                                    #output_search {
                                        overflow: hidden;
                                        display: none;
                                        max-width: 31%;
                                        position: absolute;
                                        z-index: 999;
                                        background-color: #fff;
                                        padding-bottom: 0px !important;
                                        margin-bottom: 0;
                                    }

                                    #output_search li.item {
                                        display: flex;
                                        justify-content: space-between;
                                    }

                                    #output_search img {
                                        display: block;
                                        max-width: 150%;
                                        height: 50px;
                                        margin-left: auto;
                                        margin-right: auto;
                                    }
                                </style>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <!-- <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?mod=product&controller=index&action=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a> -->

                            <div id="cart-wp" class="fl-right">

                                <div id="btn-cart">
                                    <a style="color:aliceblue;" href="?mod=cart&controller=index&action=show"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    <span id="num"><?php if (number_qty() > 0) echo number_qty() ?></span>
                                </div>
                                <?php if (!empty($_SESSION['cart']['buy'])) { ?>
                                    <div id="dropdown">
                                        <p class="desc" id="dest_update">Có <span><?php echo number_qty() ?> </span> sản phẩm trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <?php foreach ($_SESSION['cart']['buy'] as $item) { ?>
                                                <li class="clearfix">
                                                    <a href="" title="" class="thumb fl-left">
                                                        <img src="../admin/<?php echo $item['thumb'] ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="" title="" class="product-name"><?php echo $item['title'] ?></a>
                                                        <p class="price"><?php echo currency_format($item['price']) ?></p>
                                                        <p class="qty" id="qty-update-<?php echo $item['id'] ?>"> Số lượng: <?php echo $item['qty'] ?></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>

                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right price_total" style="color:tomato"> <span><?php if (number_qty() > 0) echo currency_format(cat_total()) ?></span></p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="?mod=cart&controller=index&action=show" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="?mod=cart&controller=index&action=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <div id="dropdown">
                                        <img src="https://bizweb.dktcdn.net/100/368/179/themes/738982/assets/empty-cart.png?1655829755743" alt="">
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#s').keyup(function() {
                        var search = $("#s").val();
                        $.ajax({
                            url: "?mod=home&controller=index&action=search",
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                search: search
                            },
                            success: function(data) {
                                console.log(data);
                                $('#output_search').html(data.output);
                                $('#output_search').show(function() {
                                    aimate(200);
                                });
                            }
                        });
                    })
                });
            </script>