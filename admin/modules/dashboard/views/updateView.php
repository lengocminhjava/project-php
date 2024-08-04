<?php get_header(); ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar(); ?>
            <div id="wp-content">
                <div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Sửa
                            <span style="text-align:center; position: absolute;left: 250px;"> <?php
                                                                                                echo form_success('account') ?></span>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="fullname">Họ và tên khách hàng</label>
                                    <input class="form-control" type="text" value="" name="fullname" id="fullname">
                                    <?php echo form_error('fullname') ?>
                                </div>
                                <div class="form-group">
                                    <label for="num">Số lượng</label>
                                    <input class="form-control" type="number" value="" name="num" id="num">
                                </div>
                                <?php echo form_error('num') ?>
                                <div class="form-group">
                                    <label for="total_money">Giá trị</label>
                                    <input class="form-control" value="<?php echo $cliennt_by_id['total_money']; ?>" type="number" name="total_money" id="total_money" readonly="readonly">
                                </div>
                                <?php echo form_error('email') ?>
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại</label>
                                    <input class="form-control" value="" type="text" name="phone_number" id="phone_number">
                                </div>
                                <?php echo form_error('phone_number') ?>
                                <div class="form-group">
                                    <label>
                                        <h6> Ảnh đại diện</h6>
                                    </label>
                                    <p>
                                        <img class="form-input" src="<?php echo $client_thumnail['thumbnail']; ?>" width="220" height="320" alt="">
                                    </p>
                                    <input type="file" name="file" onchange="show_upload_image()">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <textarea name="address" value="" class="form-control" id="address" cols="30" rows="5"></textarea>
                                </div>
                                <?php echo form_error('address') ?>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <select class="form-control" name="position" id="position">
                                        <option value="1">Chọn trạng thái</option>
                                        <option>Đang xử lí</option>
                                        <option>Đã hủy</option>
                                        <option>Thành công</option>
                                    </select>
                                    <?php echo form_error('position') ?>
                                </div>
                                <?php echo form_error('upload_image'); ?>-
                                <button type="submit" name="btn_update_client" class="btn btn-primary">Update</button>
                                <?php echo form_error('account'); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="public/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        CKEDITOR.replace('describe', {
            filebrowserBrowseUrl: 'public/Ckeditor/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'public/Ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            width: ['100%'],
            height: ['456px']
        });
    </script>
</body>

</html>