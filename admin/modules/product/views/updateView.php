<?php get_header(); ?>

<body>
    <style>
    </style>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar(); ?>
            <div id="wp-content">
                <div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Sửa sản phẩm
                            <span><?php echo form_success('product'); ?></span>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm</label>
                                            <input class="form-control" type="text" value="<?php echo $list_product['title_product'] ?>" name="name" id="name">
                                            <?php echo form_error('name'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Mã sản phẩm</label>
                                            <input class="form-control" type="text" value="<?php echo $list_product['code'] ?>" name="code" id="code">
                                            <?php echo form_error('code'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Giá</label>
                                            <input class="form-control" type="number" value="<?php echo $list_product['price'] ?>" name="price" id="price">
                                            <?php echo form_error('code'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="intro">Chi tiết sản phẩm</label>
                                            <textarea name="product_content" class="form-control" value="" id="intro" cols="30" rows=""><?php echo $list_product['detail_product'] ?></textarea>
                                            <?php echo form_error('product_content'); ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="intro">Mô tả sản phẩm</label>
                                            <textarea name="describe" class="form-control" value="" id="intro" cols="30" rows="30"><?php echo $list_product['description'] ?></textarea>
                                            <?php echo form_error('describe'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="disscout">Giảm giá</label>
                                            <input class="form-control" type="number" value="<?php echo $list_product['discount'] ?>" name="disscout" id="disscout">
                                            <?php echo form_error('disscout'); ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="num">Số lượng</label>
                                            <input class="form-control" type="number" value="<?php echo $list_product['num_qty']; ?>" name="num" id="num">
                                            <?php echo form_error('num'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <h6> Ảnh đại diện</h6>
                                    </label>
                                    <p>
                                        <img style="width:100%!important;height:100%!important" class="form-input" src="<?php echo $list_product['thumbnail']; ?>" alt="">
                                    </p>
                                    <input type="file" name="file" onchange="show_upload_image()">
                                    <?php echo form_error('upload_image') ?>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <h6> Ảnh mô tả</h6>
                                    </label>
                                    <div class="col-6">
                                        <p>
                                            <?php if (!empty($list_image_id)) {
                                                foreach ($list_image_id as $item) { ?>
                                                    <span><img class="form-input" src="public/uploads/more_product/<?php echo ($item['images']) ? $item['images'] : false; ?>"></span>
                                            <?php
                                                }
                                            } ?>
                                        </p>
                                    </div>
                                    <input type="file" name="files[]" multiple="multiple">
                                    <?php echo form_error('upload_imagea'); ?>
                                </div>

                                <div class="col-6" style="padding-left: 0px!important;">
                                    <?php if (!empty($list_category)) { ?>
                                        <div class="form-group">
                                            <label for="">Danh mục</label>
                                            <?php echo form_error('category'); ?>
                                            <select class="form-control" name="category" id="">
                                                <option value="999999">Chọn danh mục</option>
                                                <?php foreach ($list_category as $item) { ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo (($item['id'] == $list_product['product_id']) ? 'selected' : '') ?>><?php echo $item['title']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="public" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Công khai
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="pending">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Không công khai
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-primary">Update</button>
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
        CKEDITOR.replace('product_content', {
            filebrowserBrowseUrl: 'public/Ckeditor/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'public/Ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
    </script>
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