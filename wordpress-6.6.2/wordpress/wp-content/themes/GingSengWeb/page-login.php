<?php

/**
 * Template Name: Login
 */
?>
<?php get_header(); ?>

<div class="unique-login-form">
    <form class="login-form" method="post" action="<?php echo esc_url(wp_login_url()); ?>">
        <h2>Đăng Nhập</h2>

        <?php
        // Hiển thị thông báo lỗi nếu có
        if (isset($_GET['login']) && $_GET['login'] == 'failed') {
            echo '<p class="error">Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng thử lại.</p>';
        }
        ?>

        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="log" id="username" class="form-control" placeholder="Nhập tên đăng nhập" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="pwd" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Đăng Nhập">
        </div>
        <div class="form-group">
            <a href="<?php echo wp_lostpassword_url(); ?>">Quên mật khẩu?</a>
        </div>
    </form>
</div>

<?php get_footer(); ?>