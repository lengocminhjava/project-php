<?php get_header('login'); ?>
<body>
    <div id="wp-form-login">
        <h1 id="head_form_login">Mật khẩu mới</h1>
        <form action="" id="form-login" method="POST">
            <input type="password" name="password" value="" placeholder="Password" id="password">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn-newpass" value="Lấy lại mật khẩu" id="btn-login">
            <?php echo form_error('account'); ?>
        </form>
        <p> <a href="?mod=users&controller=index&action=login" id="lost-pass">Đăng nhập</a></p>
        <p> <a href="?mod=users&controller=index&action=reg" id="lost-pass">Đăng kí</a></p>
    </div>

</body>

</html>