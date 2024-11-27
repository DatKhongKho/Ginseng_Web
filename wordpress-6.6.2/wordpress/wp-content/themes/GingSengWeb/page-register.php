<?php

/**
 * Template Name: Register
 */
?>
<?php get_header(); ?>

<div class="unique-register-form">
    <form class="register-form" method="post">
        <h2>Đăng Ký</h2>
        <div class="form-group">
            <label for="username">Tên người dùng</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên người dùng" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Xác nhận mật khẩu</label>
            <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Nhập lại mật khẩu" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Đăng Ký">
        </div>
    </form>
</div>

<?php
// Xử lý đăng ký người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $confirm_password = sanitize_text_field($_POST['confirm-password']);

    // Kiểm tra sự tồn tại của tên người dùng và email
    if (username_exists($username)) {
        echo '<p>Tên người dùng đã tồn tại, vui lòng chọn tên khác.</p>';
    } elseif (email_exists($email)) {
        echo '<p>Email đã được đăng ký, vui lòng sử dụng email khác.</p>';
    } elseif ($password !== $confirm_password) {
        echo '<p>Mật khẩu không khớp, vui lòng kiểm tra lại.</p>';
    } else {
        // Tạo người dùng
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass'  => $password, // WordPress sẽ tự động mã hóa mật khẩu
        );

        // Thêm người dùng vào cơ sở dữ liệu
        $user_id = wp_insert_user($userdata);

        // Kiểm tra và thông báo
        if (!is_wp_error($user_id)) {
            echo '<p>Tài khoản đã được tạo thành công. <a href="' . wp_redirect('/login') . '">Đăng nhập</a></p>';
        } else {
            echo '<p>Lỗi: ' . $user_id->get_error_message() . '</p>';
        }
    }
}

get_footer();
?>