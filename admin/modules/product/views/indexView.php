<?php get_header();
$page = !empty($_GET['page']) ? $_GET['page'] : 1; ?>

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
                            <h5 class="m-0 pt-1 ">Danh sách sản phẩm</h5>
                            <div class="form-search form-inline" style="position:absolute; right:0px;top:75px">
                                <form action="" method="POST">
                                    <input type="" name="search" class="form-control form-search" placeholder="Tìm kiếm">
                                    <input type="submit" style="position:absolute; right:210px;top:50px" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation example">
                                <?php
                                global $num_page, $page;
                                $list_pagging = get_pagin($num_page, $page, "?mod=product&controllers=index&action=index");
                                ?>
                            </nav>
                            <div class="analytic">
                                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
                            </div>
                            <?php echo form_error('select') ?>
                            <form action="" method="POST">
                                <div class="form-action form-inline py-3">
                                    <select class="form-control mr-1" name="select_op" id="">
                                        <option value="1">Chọn</option>
                                        <option value="2">Xóa</option>
                                        <option value="3">Công khai</option>
                                        <option value="4">Không công khai</option>
                                    </select>
                                    <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary">
                                </div>

                                <?php if (!empty($list_products)) { ?>
                                    <table class="table table-striped table-checkall">
                                        <thead>
                                            <tr>
                                                <?php
                                                global $error, $success;
                                                if (isset($_SESSION['ok'])) {
                                                    $success = $_SESSION['ok'];
                                                    echo form_success('ok');
                                                    unset($_SESSION['ok']);
                                                } else {
                                                    if (isset($_SESSION['errore'])) {
                                                        $error = $_SESSION['errore'];
                                                        echo form_error('errore');
                                                        unset($_SESSION['errore']);
                                                        // redirect("?mod=post&controller=indexCategory&action=category");
                                                        // echo form_error('errore');
                                                    }
                                                }
                                                unset($_SESSION['errore']);
                                                ?>
                                                <th scope="col">
                                                    <input name="checkall" type="checkbox">
                                                </th>
                                                <th scope="col">#</th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Ảnh</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Danh mục</th>
                                                <th scope="col">Ngày tạo</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Tác vụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = $start++;
                                            foreach ($list_products as $item) {
                                                $i++;
                                            ?>
                                                <tr class="">
                                                    <td>
                                                        <input type="checkbox" name="cat[]" value="<?php echo $item['id'] ?>" id="check_box">
                                                    </td>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $item['code']; ?></td>
                                                    <td><img src="<?php echo $item['thumbnail']; ?>" alt=""></td>
                                                    <!--http://via.placeholder.com/80X80// -->
                                                    <td><a href="#"><?php echo $item['title_product']; ?></a></td>
                                                    <td><?php echo currency_format($item['price']); ?>
                                                        <span style="display: block;
                                                    color:tomato;
                                                    font-size:14px;
                                                    ">
                                                            <del> <?php echo currency_format($item['discount']); ?></del>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $item['category']; ?></td>
                                                    <td><?php echo date('l,jS F Y', $item['created_at']) . '<br>' . date('h:m:i A') ?></td>
                                                    <td><span class="badge badge-success status"><?php echo rename_data($item['status']); ?></span></td>
                                                    <td>
                                                        <a href="?mod=product&controller=index&action=update&id=<?php echo $item['id']; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                        <a href="?mod=product&controller=index&action=delete&page=<?php echo $page ?>&id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                            </form>
                        <?php } ?>
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