<?php get_header(); ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">

            <?php get_sidebar('login'); ?>
            <div id="wp-content">
                <div id="content" class="container-fluid" style="display:flex;justify-content:center;align-items:center">
                    <div class="card" style="width:60%;">
                        <div class="card-header font-weight-bold">
                            Cập nhật mật khẩu
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="name">Mật khẩu cũ</label>
                                    <input class="form-control" type="password" name="password_old" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="name">Mật khẩu mới</label>
                                    <input class="form-control" type="password" name="password_new" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="name">Xác nhận mật khẩu</label>
                                    <input class="form-control" type="password" name="password_new" id="name">
                                </div>
                                <button type="submit" name="update_pass" class="btn btn-primary">Chấp nhận</button>
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