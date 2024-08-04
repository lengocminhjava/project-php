<?php get_header(); ?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <?php if (!empty($list_banner)) { ?>
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <?php foreach ($list_banner as $item) { ?>
                            <div class="item">
                                <img src="../admin/<?php echo $item['image'] ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if (!empty($list_featured_products)) { ?>
                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item" id="item_product">
                            <?php foreach ($list_featured_products as $item) { ?>
                                <li>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail']; ?>">
                                    </a>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="product-name"><?php echo $item['title_product']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price'] - $item['discount']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <?php if (!empty($list_product_1)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix" id="item_product">
                            <?php foreach ($list_product_1 as $item) { ?>
                                <li>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail'] ?>">
                                    </a>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="product-name"><?php echo $item['title_product'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']) ?></span>
                                        <span class="old"><?php echo currency_format($item['price'] - $item['discount']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <?php if (!empty($list_product_2)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix" id="item_product">
                            <?php foreach ($list_product_2 as $item) { ?>
                                <li>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail'] ?>">
                                    </a>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="product-name"><?php echo $item['title_product'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']) ?></span>
                                        <span class="old"><?php echo currency_format($item['price'] - $item['discount']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Máy tính bảng</h3>
                </div>
                <?php if (!empty($list_product_3)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix" id="item_product">
                            <?php foreach ($list_product_3 as $item) { ?>
                                <li>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail'] ?>">
                                    </a>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="product-name"><?php echo $item['title_product'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']) ?></span>
                                        <span class="old"><?php echo currency_format($item['price'] - $item['discount']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Phụ kiện</h3>
                </div>
                <?php if (!empty($list_product_4)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix" id="item_product">
                            <?php foreach ($list_product_4 as $item) { ?>
                                <li>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail'] ?>">
                                    </a>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="product-name"><?php echo $item['title_product'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']) ?></span>
                                        <span class="old"><?php echo currency_format($item['price'] - $item['discount']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer() ?>