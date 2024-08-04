<?php get_header();
global $error, $success; ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar(); ?>
            <div id="wp-content">
                <div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                            <h5 class="m-0 pt-1">Danh sách bài viết</h5>
                            <div class="form-search form-inline" style="position:absolute; right:0px;top:75px">
                                <form action="#" method="POST">
                                    <input type="" name="search" class="form-control form-search" placeholder="Tìm kiếm">
                                    <input type="submit" style="position:absolute; right:210px;top:50px" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                                    <?php echo form_error('search') ?>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation example">
                                <?php
                                global $num_page, $page;
                                $list_pagging = get_pagin($num_page, $page, "?mod=post&controllers=index&action=index");
                                ?>
                            </nav>
                            <div class="analytic">
                                <a href="" class="text-primary">Trạng thái 1 <?php $success;
                                                                                if (isset($_SESSION['update_ok'])) {
                                                                                    $success = $_SESSION['update_ok'];
                                                                                    echo form_success('update_ok');
                                                                                    unset($_SESSION['update_ok']);
                                                                                }


                                                                                ?><span class="text-muted">(10)</span></a>
                                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
                            </div>

                            <form action="" method="POST">
                                <?php
                                echo form_error('select');
                                ?>
                                <div class="form-action form-inline py-3">
                                    <select class="form-control mr-1" name="select_op" id="">
                                        <option value="99">Chọn</option>
                                        <option value="1">Xóa</option>
                                        <option value="2">Ẩn</option>
                                        <option value="3">Công khai</option>
                                    </select>
                                    <input type="submit" name="btn_update_new" value="Áp dụng" class="btn btn-primary">
                                </div>

                                <table class="table table-striped table-checkall">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <input name="checkall" type="checkbox">
                                            </th>
                                            <th scope="col">#</th>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Tiêu đề</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Ngày tạo</th>
                                            <th scope="col">Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <?php if (!empty($list_post)) { ?>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($list_post as $item) {
                                                $i++; ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="cat[]" value="<?php echo $item['id'] ?>" id="check_box">
                                                    </td>
                                                    <td scope="row"><?php echo $i ?></td>
                                                    <td><img src="<?php echo $item['thumbnail'] ?>" alt=""></td>
                                                    <td>
                                                        </p><textarea class="fimlName" id="<?php echo $item['id'] ?>" cols="30" rows="5"><?php echo $item['title'] ?></textarea>
                                                    </td>
                                                    <?php echo form_success('update') ?>
                                                    <td><?php echo $item['category'] ?></td>
                                                    <td><span class="badge badge-success status"><?php echo rename_data($item['status']); ?></span></td>
                                                    <td><?php echo date('l,jS F Y', $item['creat_date']) . '<br>' . date('h:m:i A') ?></td>
                                                    <td><a href="?mod=post&controller=index&action=update&id=<?php echo $item['id']; ?>"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                        <a href="?mod=post&controller=index&action=delete&page=<?php echo $page ?>&id=<?php echo $item['id'] ?>"> <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        <p>Không có mục nào cần tìm kiếm vui lòng quay trở lại <a href="?mod=post&controller=index&action=index">Trang tìm kiếm</a></p>
                                    <?php } ?>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/jquery.js"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>