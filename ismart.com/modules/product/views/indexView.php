<?php get_header() ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="danh-muc" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Sản phẩm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <span class="num_pr"><?php echo count($list_product) ?></span> trên <?php echo $num_list_product; ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <?php echo form_error('select'); ?>
                                <select name="select">
                                    <option value="1">Sắp xếp</option>
                                    <option value="2">Từ A-Z</option>
                                    <option value="3">Từ Z-A</option>
                                    <option value="4">Giá thấp lên cao</option>
                                    <option value="5">Giá cao xuống thấp</option>
                                </select>
                                <button type="submit" name="filter">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if (!empty($list_product)) { ?>
                    <div class="section-detail">
                        <ul class="list-item search clearfix" style="min-height:500px;" id="item_product">
                            <?php foreach ($list_product as $item) { ?>
                                <li class="item">
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="thumb">
                                        <img src="../admin/<?php echo $item['thumbnail']; ?>">
                                    </a>
                                    <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . 'html'; ?>" title="" class="product-name"><?php echo $item['title_product']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price'] - $item['discount']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&controller=index&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&controller=index&action=buy_now&id=<?php echo $item['id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <ul class="list-item oke clearfix" style="" id="item_product">
                        </ul>
                    </div>
                <?php } else { ?>
                    <p>Không có sản phẩm nào trong giỏ</p>
                <?php } ?>
            </div>
            <div class="section" id="paging-wp" style="">
                <div class="section-detail paging_hide">
                    <?php
                    global $num_page, $page;
                    $list_pagging = get_pagin_2('list-item', $num_page, $page, "?mod=product&controller=index&action=index");
                    ?>
                </div>
            </div>

        </div>
        <?php get_sidebar('category'); ?>
    </div>
</div>
<?php get_footer(); ?>