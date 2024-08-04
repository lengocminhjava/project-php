<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php
            $list_category_products = listt_category();
            echo render_menu($list_category_products, $menu_class = 'list-item', 'sidebar-menu', 0, 0);  ?>
        </div>
    </div>
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Bộ lọc</h3>
        </div>
        <div class="section-detail">
            <form method="POST" action="get_data">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" class="search_price price_data" value="1" name="r-price"></td>
                            <td>Dưới 500.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" class="search_price price_data" value="2" name="r-price"></td>
                            <td>500.000đ - 1.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" class="search_price price_data" value="3" name="r-price"></td>
                            <td>1.000.000đ - 5.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" class="search_price price_data" value="4" name="r-price"></td>
                            <td>5.000.000đ - 10.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" class="search_price price_data" value="5" name="r-price"></td>
                            <td>Trên 10.000.000đ</td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Hãng</td>
                        </tr>
                    </thead>
                    <?php
                    if (!empty($list_title)) { ?>
                        <tbody>
                            <?php foreach ($list_title as $item) { ?>
                                <tr>
                                    <td><input type="radio" value="<?php echo $item['title'] ?>" class="search_price brand_data" name="r-brand"> <?php echo $item['title'] ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </form>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>