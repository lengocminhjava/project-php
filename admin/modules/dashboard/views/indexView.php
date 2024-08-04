<?php get_header(); ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar(); ?>
            <div id="wp-content">
                <div class="container-fluid py-5">
                    <div class="row">
                        <div class="col">
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo count_fields('successful'); ?></h5>
                                    <p class="card-text">Đơn hàng giao dịch thành công </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header">ĐANG XỬ LÝ</div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo count_fields('processing'); ?></h5>
                                    <p class="card-text" style="font-size: 18px;">Số lượng đơn hàng đang xử lý</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header">DOANH SỐ</div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo jam_read_num_forvietnamese($list_order) ?></h5>
                                    <p class="card-text" style="font-size: 18px;">Doanh số hệ thống</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header">ĐƠN HÀNG HỦY</div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo count_fields('cancelled'); ?></h5>
                                    <p class="card-text" style="font-size: 18px;">Số đơn bị hủy trong hệ thống</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end analytic  -->
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            ĐƠN HÀNG MỚI
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table_pd">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mã</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Ảnh đại diện</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <?php

                                if (!empty($list_product)) {
                                ?>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($list_product as $item) {
                                            $i++; ?>
                                            <tr>
                                                <th scope="row" style="vertical-align: inherit;"><span class="i" style="padding: 5px 7px;"><?php echo $i ?></span></th>
                                                <td style="color:#dc3545;;"><?php echo $item['code']; ?></td>
                                                <td>
                                                    <p> <?php echo $item['fullname']; ?></p>
                                                    <span><?php echo $item['phone_number']; ?></span>
                                                </td>
                                                <td style="max-width:70%; ;"><img class="img" src="<?php echo $item['thumbnail'] ?>" alt=""></td>
                                                <td><a href="#"><?php echo $item['title_product'] ?></a></td>
                                                <td style="text-align:center"><?php echo $item['num'] ?></td>
                                                <td>
                                                    <span><?php echo currency_format($item['total_money'])  ?></span>
                                                </td>
                                                <td><span class="badge badge-warning status"><?php echo rename_pro($item['status']) ?></span></td>
                                                <td><?php echo date('l,jS F Y', $item['created_at']) . '<br>' . date('h:m:i A') ?></td>
                                                <td>
                                                    <a href="?mod=dashboard&controller=index&action=update&id=<?php echo $item['id']; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="?mod=dashboard&controller=index&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } ?>
                            </table>
                            <!-- <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">Trước</span>
                                            <span class="sr-only">Sau</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav> -->
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