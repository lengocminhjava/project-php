<?php get_header(); ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#" title=""><?php echo $name; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $name ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <span class="num_pr"><?php echo count($list_product); ?></span> trên <?php echo $num_list_product; ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="1">Sắp xếp</option>
                                    <option value="2">Từ A-Z</option>
                                    <option value="3">Từ Z-A</option>
                                    <option value="4">Giá cao xuống thấp</option>
                                    <option value="5">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if (!empty($list_product)) { ?>
                    <div class="section-detail">
                        <ul class="list-item search clearfix" id="item_product" style="min-height:500px;">
                            <?php foreach ($list_product as $item) { ?>
                                <li class="item">
                                    <a href="?page=detail_product" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail']; ?>">
                                    </a>
                                    <a href="?page=detail_product" title="" class="product-name"><?php echo $item['title_product']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['discount']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <ul class="list-item oke clearfix" id="item_product" style="min-height:500px;"></ul>
                    </div>
                <?php } else { ?>
                    <p style="min-height:600px;">Không tìm thấy sản phẩm nào</p>
                <?php } ?>
            </div>
        </div>
        <?php get_sidebar('category'); ?>
    </div>
</div>
<?php get_footer(); ?>