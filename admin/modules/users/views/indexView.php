<?php
get_header();
//show_array($list_users);
?>
<div id="content">
    <h2>Danh sách thành viên</h2>
    <table>
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Tên</td>
                    <td>Email</td>
                    <td>Tuổi</td>
                    <td>Thu nhập</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list_users)) {
                    $t = 0;
                    foreach ($list_users as $user) {
                        $t ++;
                        ?>
                        <tr>
                            <td><?php echo $t; ?></td>
                            <td><?php echo $user['fullname'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['age'] ?></td>
                            <td><?php echo ($user['earn']); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
</div>

<?php
get_footer();
?>