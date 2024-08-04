<?php get_header() ?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php if (!empty($list_product)) { ?>
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left" id="thumb_list">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" style="max-width:350px;min-height:350px" src="../admin/<?php echo $image_product ?>" data-zoom-image="../admin/<?php echo $image_product ?>" />
                            </a>
                            <div id="list-thumb">
                                <?php foreach ($list_product as $item) { ?>
                                    <a href="" data-image="../admin/public/uploads/more_product/<?php echo $item['images'] ?>" data-zoom-image="../admin/public/uploads/more_product/<?php echo $item['images'] ?>">

                                        <img id="zoom" style="max-width:100%;hight:100%" src="../admin/public/uploads/more_product/<?php echo $item['images'] ?>" />

                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="public/images/img-pro-01.png" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $item['title_product'] ?></h3>
                            <div class="desc">
                                <?php echo $item['detail_product'] ?>
                            </div>
                            <div class="num-product">
                                <span class="title"><?php echo $item['category'] ?> :</span>
                                <span class="status"><?php if (($item['num_qty']) > 0) {
                                                            echo "Còn hàng";
                                                        } else {
                                                            echo "Hết hàng";
                                                        } ?></span>
                            </div>
                            <p class="price"><?php echo currency_format($item['price']); ?></p>
                            <?php if (($item['num_qty']) > 0) { ?>
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" min="0" data-quantity="<?php echo $item['num_qty']; ?>" data-id="<?php echo $item['id'] ?>" name="qty[<?php echo $item['id'] ?>]" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <a href="?mod=cart&controller=index&action=show" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <?php echo $item['description']; ?>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <?php if (!empty($same_list)) { ?>
                    <div class="section-detail">
                        <ul class="list-item" id="item_product">
                            <?php foreach ($same_list as $item) { ?>
                                <li>
                                    <a href="" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail'] ?>">
                                    </a>
                                    <a href="" title="" class="product-name"><?php echo $item['title_product'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo $item['price'] ?></span>
                                        <span class="old"><?php echo $item['price'] - $item['discount'] ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="" class="buy-now fl-right">Mua ngay</a>
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