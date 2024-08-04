<?php get_header(); ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar('login'); ?>
            <div id="wp-content">
                <div id="content" class="container-fluid" style="display:flex;justify-content:center;align-items:center ; padding-top:0px">
                    <div class="card" style="width:70%;">
                        <div class="card-header font-weight-bold">
                            Cập nhật tài khoản
                            <span style="text-align:center; position: absolute;left: 250px;"> <?php
                                                                                                echo form_success('account') ?></span>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="fullname">Họ và tên</label>
                                    <input class="form-control" type="text" value="<?php echo $info_user['fullname']; ?>" name="fullname" id="fullname">
                                    <?php echo form_error('fullname') ?>
                                </div>
                                <div class="form-group">
                                    <label for="username">Tên đăng nhập</label>
                                    <input class="form-control" type="text" value="<?php echo $info_user['username']; ?>" name="username" id="username" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" value="<?php echo $info_user['email']; ?>" type="email" name="email" id="email">
                                </div>
                                <?php echo form_error('email') ?>
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại</label>
                                    <input class="form-control" value="<?php echo $info_user['phone_number']; ?>" type="text" name="phone_number" id="phone_number">
                                </div>
                                <?php echo form_error('phone_number') ?>
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <textarea name="address" value="" class="form-control" id="address" cols="30" rows="5"><?php echo $info_user['address']; ?></textarea>
                                </div>
                                <?php echo form_error('address') ?>
                                <div class="form-group">
                                    <label>
                                        <h6> Ảnh đại diện</h6>
                                    </label>
                                    <p>
                                        <img class="form-input" src="<?php echo $info_user['thumbnail']; ?>" width="220" height="320" alt="">
                                    </p>
                                    <input type="file" name="file" onchange="show_upload_image()">
                                </div>
                                <div class="form-group">
                                    <label for="">Chức vụ</label>
                                    <select class="form-control" name="position" id="position">
                                        <option value="1">Chọn chức vụ</option>
                                        <option>admin</option>
                                        <option>support</option>
                                    </select>
                                    <?php echo form_error('position') ?>
                                </div>
                                <?php echo form_error('upload_image'); ?>-
                                <button type="submit" name="btn_account" class="btn btn-primary">Update</button>
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
</body>

</html>