<?php get_header('login'); ?>

<body>
    <div id="id">
        <?php echo form_success('success'); ?>
        <?php
        echo form_success('account'); ?>
        <?php echo form_error('error'); ?>
    </div>
    <div id="wp-form-login">
        <h1 id="head_form_login">Đăng nhập</h1>
        <form action="" id="form-login" method="POST">
            <input type="text" name="username" value="<?php echo value_form('username') ?>" placeholder="Username" id="username">
            <?php echo form_error('username') ?>
            <input type="password" name="password" value="" placeholder="Password" id="password">
            <?php echo form_error('password') ?>
            <input type="submit" name="btn-login" value="Đăng nhập" id="btn-login">
            <?php echo form_error('account'); ?>
        </form>
    </div>
</body>

</html>