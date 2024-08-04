<?php get_header(); ?>

<body>
    <div id="warpper" class="nav-fixed">
        <?php get_content(); ?>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <?php get_sidebar(); ?>
            <div id="wp-content">
                <div id="content" class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Danh mục sản phẩm
                                    <span><?php echo form_success('category'); ?></span>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="name_title">Tên danh mục</label>
                                            <input class="form-control" type="text" name="name_title" id="name_title">
                                            <?php echo form_error('name_title'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Link thân thiện</label>
                                            <input class="form-control" type="text" name="name" value="<?php if (!empty($_POST['name_title'])) echo create_slug($_POST['name_title']) ?>" id="name" readonly="readonly">
                                        </div>
                                        <?php if (!empty($list_category)) { ?>
                                            <div class="form-group">
                                                <label for="">Danh mục cha</label>
                                                <select class="form-control" name="parent_category" id="">
                                                    <option value="999999999">Chọn danh mục</option>
                                                    <?php foreach ($list_category as $item) { ?>
                                                        <option value="<?php echo $item['id']; ?>"> <?php echo $item['title']; ?> </option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('parent_category'); ?>
                                            </div>
                                        <?php } ?>
                                        <button type="submit" name="category" class="btn btn-primary">Thêm mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Danh sách
                                    <span><?php
                                            global $error, $success;
                                            if (isset($_SESSION['okz'])) {
                                                $success = $_SESSION['okz'];
                                                echo form_success('okz');
                                                unset($_SESSION['okz']);
                                            } else 
                                                if (isset($_SESSION['errore'])) {
                                                $error = $_SESSION['errore'];
                                                echo form_error('errore');
                                                unset($_SESSION['errore']);
                                                // redirect("?mod=post&controller=indexCategory&action=category");
                                                // echo form_error('errore');
                                            } else
                                            if (isset($_SESSION['bz'])) {
                                                // unset($_SESSION['errore']);
                                                $error = $_SESSION['bz'];
                                                echo form_error('bz');
                                                unset($_SESSION['bz']);
                                                // redirect("?mod=post&controller=indexCategory&action=category");
                                                // echo form_error('errore');
                                            }
                                            ?></span>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" style="text-align:center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên danh mục</th>
                                                <th scope="col">Slug</th>
                                                <th scope="col">Tác vụ</th>
                                            </tr>
                                        </thead>
                                        <?php if (!empty($list_new)) { ?>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                foreach ($list_new as $item) {
                                                    $i++; ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i ?></th>
                                                        <td style="max-width:150px;text-algin:center;"><?php echo $item['level'] . "-" . str_repeat('--**', $item['level']) . $item['title']; ?></td>
                                                        <td style="width:30%"><?php echo $item['slug_url']  ?></td>
                                                        <td style="width:10%"> <a href="?mod=product&controller=category&action=update&id=<?php echo $item['id']; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                            <a href="?mod=product&controller=category&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        <?php } ?>
                                    </table>
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