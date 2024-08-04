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
                            Thêm bài viết
                            <span><?php echo form_success('post')  ?></span>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name_title">Tiêu đề bài viết</label>
                                    <input class="form-control" type="text" name="name_title" id="name_title">
                                    <?php echo form_error('name_title') ?>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link thân thiện</label>
                                    <input class="form-control" type="text" name="friendly_url" value="<?php if (!empty($_POST['name_title'])) echo create_slug($_POST['name_title']) ?>" id="link" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung bài viết</label>
                                    <textarea name="post_content" class="form-control ckeditor" id="content" cols="30" rows="5"></textarea>
                                    <?php echo form_error('post_content'); ?>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <h6> Ảnh đại diện</h6>
                                    </label>
                                    <p><img class="form-input" src="public/uploads/post/<?php if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                                                                                            echo $_FILES['file']['name'];
                                                                                        } ?>"></p>
                                    <input type="file" name="file">
                                    <?php echo form_error('upload_image'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="a">Danh mục</label>
                                    <select class="form-control" id="a" name="a">
                                        <option value="9">Chọn danh mục</option>
                                        <?php
                                        if (!empty($list_category)) {
                                            foreach ($list_category as $item) {
                                                if ($item['parent_id'] == 0) {
                                        ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['title']; ?></option>
                                        <?php
                                                }
                                            }
                                        }

                                        ?>
                                    </select>
                                    <?php echo form_error('categoryy'); ?>
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
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="pending">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Không công khai
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" name="btn_addPost" class="btn btn-primary">Thêm mới</button>
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
        CKEDITOR.replace('post_content', {
            filebrowserBrowseUrl: 'public/Ckeditor/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'public/Ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
    </script>
</body>

</html>