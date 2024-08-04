<?php get_header(); ?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?e" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=cart&controller=index&action=show" title="">Giỏ hàng</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (!empty($list_order)) {
    ?>
        <div id="wrapper" class="wp-inner clearfix">
            <form method="POST" action="" name="form-checkout">
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>
                    </div>

                    <div class="section-detail">

                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" value="<?php echo value_form('fullname') ?>" name="fullname" id="fullname">
                                <?php echo form_error('fullname'); ?>
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input value="<?php echo value_form('email') ?>" type="email" name="email" id="email">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="number">Số CMT (cccd) Không bắt buộc</label>
                                <input type="tel" value="<?php echo value_form('number') ?>" name="number" id="number">
                                <?php echo form_error('number'); ?>
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone_number">Số điện thoại</label>
                                <input type="tel" value="<?php echo value_form('phone_number') ?>" name="phone_number" id="phone_number">
                                <?php echo form_error('phone_number'); ?>
                            </div>
                        </div>
                        <?php if (!empty($list_city)) { ?>
                            <div class="form-row clearfix">
                                <div class="form-col fl-left">
                                    <label for="phone">Tỉnh, Thành</label>

                                    <select name="select_city" id="select-city" class="form-col" id="" style="padding:8px 0px;margin-bottom:15px;text-align:center ;">
                                        <option value="999" style="font-size: 18px;">Chọn tỉnh thành</option>
                                        <?php foreach ($list_city as $item) { ?>
                                            <option id="city_name" value="<?php echo  $item['id'] ?>" style="font-size: 18px;"><?php echo $item['title'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('select_city'); ?>

                                </div>

                                <div class=" form-col fl-right">
                                    <label for="district">Quận ,Huyện</label>
                                    <select name="select_district" class="form-col district" id="" style="padding:8px 0px">
                                        <option value="999" style="text-align:center">Chọn Quận Huyện</option>

                                    </select>
                                    <?php echo form_error('select_district'); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class=" form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="commune">Xã , Phường</label>
                                <input type="text" value="<?php echo value_form('commune') ?>" class="" name="commune"></input>
                                <?php echo form_error('commune'); ?>
                            </div>
                            <div class="form-col fl-right">
                                <label for="street">Đường , Số nhà</label>
                                <input type="text" value="<?php echo value_form('street') ?>" class="" name="street"></input>
                                <?php echo form_error('street'); ?>
                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea rows="8" value="<?php echo value_form('notes') ?>" cols="78" name="notes"></textarea>
                                <?php echo form_error('notes'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>

                                    <td>Tổng</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($list_order as $item) { ?>
                                    <tr class="cart-item">
                                        <td class="product-name"><?php echo $item['title'] ?><strong class="product-quantity">x <?php echo $item['qty'] ?></strong></td>

                                        <td class="product-total"><?php echo currency_format($item['sub_total']) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price"><?php echo currency_format(cat_total())  ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                    <label for="direct-payment">Thanh toán tại cửa hàng</label>
                                </li>
                                <li>
                                    <input type="radio" checked="checked" id="payment-home" name="payment-method" value="payment-home">
                                    <label for="payment-home">Thanh toán tại nhà</label>
                                </li>
                            </ul>
                        </div>
                        <div class="place-order-wp clearfix">
                            <input type="submit" id="order-now" name="order" value="Đặt hàng">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php } else {
        redirect(); ?>
    <?php } ?>
</div>
<?php get_footer(); ?>