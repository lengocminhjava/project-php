<?php get_header(); ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar(); ?>
            <div id="wp-content">
                <div class="container-fluid py-5" style="    display: flex;justify-content: center;align-items: center;">
                    <div class="row">
                        <div class="col-8">
                            <div class="card" style="width: 500px;">
                                <div class="card-header font-weight-bold">
                                    Sửa danh mục
                                </div>
                                <div class="card-body">
                                    <?php
                                    echo form_success('cat');
                                    ?>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="cat_title">Tên danh mục</label>
                                            <input class="form-control" type="text" name="cat_title" id="cat_title" value="<?php if (isset($category_info)) echo $category_info['title']; ?>">
                                            <?php echo form_error('cat_title'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="btn_update">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
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