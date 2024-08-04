<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php
            $list_category_products = listt_category();
            echo render_menu($list_category_products, $menu_class = 'list-item', 'sidebar-menu', 0, 0);  ?>
            </li>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <?php if (!empty($list_selling)) { ?>
            <div class="section-detail">
                <ul class="list-item">
                    <?php foreach ($list_selling as $item) { ?>
                        <li class="clearfix">
                            <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="thumb fl-left">
                                <img src="../admin/<?php echo $item['thumbnail']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="product-name"><?php echo $item['title_product']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['price']); ?></span>
                                    <span class="old"><?php echo currency_format($item['discount']); ?></span>
                                </div>
                                <a href="danh-muc/chi-tiet/<?php echo $item['slug_url'] . '-' . $item['id'] . '.html'; ?>" title="" class="buy-now">Chi tiết</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>