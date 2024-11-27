<?php

/**
 * Template Name: Order Management
 */

get_header();

// Kiểm tra xem người dùng có quyền quản trị viên không
if (!current_user_can('manage_options')) {
    echo '<p>Bạn không có quyền truy cập trang này.</p>';
    get_footer();
    return;
}

// Lấy tất cả các đơn hàng trong WooCommerce
$args = array(
    'post_type'      => 'shop_order',
    'post_status'    => array('wc-pending', 'wc-processing', 'wc-completed', 'wc-cancelled', 'wc-refunded'),
    'posts_per_page' => -1,
);
$orders = get_posts($args);

// Xử lý cập nhật trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order_status'])) {
    if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'update_order_status')) {
        $order_id = intval($_POST['order_id']);
        $order = wc_get_order($order_id);

        if ($order) {
            // Kiểm tra trạng thái hiện tại và cập nhật nếu cần
            if ($order->get_status() === 'pending') {
                $order->update_status('processing'); // Cập nhật trạng thái đơn hàng
                echo '<div class="alert alert-success">Trạng thái đơn hàng đã được cập nhật thành công!</div>';
            } else {
                echo '<div class="alert alert-warning">Trạng thái đơn hàng hiện tại không thể cập nhật.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Đơn hàng không hợp lệ.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Xác thực không hợp lệ. Vui lòng thử lại.</div>';
    }
}

// Kiểm tra nếu có đơn hàng
if (!empty($orders)) : ?>

    <div class="container-fluid">
        <h3 class="mb-4">Quản Lý Đơn Hàng</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Người Đặt</th>
                    <th>Ngày Đặt</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order_post) :
                    $order = wc_get_order($order_post->ID);
                    $order_id = $order->get_id();
                    $order_date = $order->get_date_created()->format('d/m/Y');
                    $order_total = wc_price($order->get_total());
                    $order_status = wc_get_order_status_name($order->get_status());
                    $order_customer = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
                ?>
                    <tr>
                        <td><?php echo esc_html($order_id); ?></td>
                        <td><?php echo esc_html($order_customer); ?></td>
                        <td><?php echo esc_html($order_date); ?></td>
                        <td><?php echo esc_html($order_total); ?></td>
                        <td><?php echo esc_html($order_status); ?></td>
                        <td>
                            <a href="<?php echo esc_url(get_edit_post_link($order_id)); ?>" class="btn btn-info btn-sm">Xem</a>
                            <form method="post" action="" style="display:inline;">
                                <?php wp_nonce_field('update_order_status'); ?>
                                <input type="hidden" name="order_id" value="<?php echo esc_attr($order_id); ?>" />
                                <button type="submit" name="update_order_status" class="btn btn-warning btn-sm">Cập nhật</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
else :
    echo '<p>Không có đơn hàng nào để hiển thị.</p>';
endif;

get_footer();
?>