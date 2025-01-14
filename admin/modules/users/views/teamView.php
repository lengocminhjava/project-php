<?php get_header(); ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar('login'); ?>
            <div id="wp-content">
                <div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                            <h5 class="m-0 ">Danh sách thành viên</h5>
                            <div class="form-search form-inline">
                                <form action="#">
                                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="analytic">
                                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
                            </div>
                            <div class="form-action form-inline py-3">
                                <select class="form-control mr-1" id="">
                                    <option>Chọn</option>
                                    <option>Tác vụ 1</option>
                                    <option>Tác vụ 2</option>
                                </select>
                                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                            </div>
                            <table class="table table-striped table-checkall">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall">
                                        </th>
                                        <th scope="col">#</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Quyền</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <th scope="row">1</th>
                                        <td>Phan Văn Cương</td>
                                        <td>phancuong</td>
                                        <td>phancuong.qt@gmail.com</td>
                                        <td>Admintrator</td>
                                        <td>26:06:2020 14:00</td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <th scope="row">2</th>
                                        <td>Phan Trần Minh Anh</td>
                                        <td>minhanh</td>
                                        <td>minhanh@gmail.com</td>
                                        <td>Editor</td>
                                        <td>26:06:2020 14:00</td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <th scope="row">3</th>
                                        <td>Nguyễn Hồng Nhung</td>
                                        <td>hongnhung</td>
                                        <td>hongnhung@gmail.com</td>
                                        <td>Editor</td>
                                        <td>26:06:2020 14:00</td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
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
                            </nav>
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