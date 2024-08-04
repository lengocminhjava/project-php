<?php get_header('login'); ?>
<?php echo form_success('email'); ?>
<div id="wp-form-login">
    <h1 id="head_form_login">Lấy lại mật khẩu</h1>
    <form action="" id="form-login" method="POST">
        <input type="email" name="email" value="<?php echo value_form('email') ?>" placeholder="Email" id="email">
        <?php echo form_error('email'); ?>
        <input type="submit" name="btn-reset" value="Lấy lại mật khẩu" id="btn-login">
        <?php echo form_error('account'); ?>
    </form>
    <p> <a href="?mod=users&controllers=index&action=login" id="lost-pass">Đăng nhập</a></p>
    <p> <a href="?mod=users&controllers=index&action=reg" id="lost-pass">Đăng kí</a></p>
</div>

</body>

</html>