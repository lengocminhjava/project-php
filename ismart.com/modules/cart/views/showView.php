<?php get_header(); ?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng đa cấp</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive" style="min-height: 500px; text-align:center; position:relative;">
                <?php if (!empty($list_add)) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_add as $item) { ?>
                                <tr>
                                    <td><?php echo $item['code']; ?></td>
                                    <td>
                                        <a href="" title="" class="thumb">
                                            <img src="../admin/<?php echo $item['thumb']; ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" title="" class="name-product"><?php echo $item['title']; ?></a>
                                    </td>
                                    <td><?php echo currency_format($item['price']); ?></td>
                                    <td>
                                        <input type="number" data-id="<?php echo $item['id'] ?>" min="1" max="<?php echo $item['num_qty'] ?>" name="qty[<?php echo $item['id'] ?>]" value="<?php echo $item['qty'] ?>" class="num-order">
                                    </td>
                                    <td id="sub-total-<?php echo $item['id'] ?>"><?php echo currency_format($item['sub_total']) ?></td>
                                    <td>
                                        <a href="?mod=cart&controller=index&action=delete&id=<?php echo $item['id'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" id="#total-price" class="fl-right">Tổng giá: <span><?php echo currency_format(cat_total()) ?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a>
                                            <a href="?mod=cart&controller=index&action=checkout" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?" title="" id="buy-more">Mua tiếp</a><br />
                <a href="?mod=cart&controller=index&action=delete" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    <?php } else { ?>
        <p> Hiện tại không có sản phẩm nào vui lòng trờ về <a href="?">Trang chủ</a> ( <a href="danhmuc" title="" id="buy-more">Mua tiếp</a>)</p>
        <p id="cart-empty" style="position: absolute;left: 50%;transform: translateX(-40%);"> <img style="width:80%;height:500px;" src="https://bizweb.dktcdn.net/100/368/179/themes/738982/assets/empty-cart.png?1655829755743" alt=""></p>
    <?php } ?>
    </div>
</div>
<?php get_footer(); ?>