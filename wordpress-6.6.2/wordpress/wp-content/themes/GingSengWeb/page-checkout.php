<?php

/**
 * Template Name: Checkout
 */

// Kiểm tra người dùng đã đăng nhập
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(home_url('/page-checkout')));
    exit;
}

get_header();

// Lấy thông tin người dùng
$user_id = get_current_user_id();
$billing_address = get_user_meta($user_id, 'billing_address_1', true);
$billing_city = get_user_meta($user_id, 'billing_city', true);
$billing_postcode = get_user_meta($user_id, 'billing_postcode', true);
$billing_country = get_user_meta($user_id, 'billing_country', true);
$billing_phone = get_user_meta($user_id, 'billing_phone', true);
$billing_email = get_user_meta($user_id, 'billing_email', true);

// Lấy giỏ hàng
$cart_items = WC()->cart->get_cart();
$subtotal = WC()->cart->get_subtotal();
$shipping = WC()->cart->get_shipping_total();
$total = WC()->cart->get_total('edit');

// Xử lý khi nhấn "Thanh Toán"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    if (empty($cart_items)) {
        wc_add_notice('Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.', 'error');
    } else {
        // Tạo đơn hàng mới
        $order = new WC_Order();

        // Thêm sản phẩm vào đơn hàng
        foreach ($cart_items as $cart_item) {
            $product = $cart_item['data'];
            $order->add_product($product, $cart_item['quantity']);
        }

        // Thêm địa chỉ thanh toán
        $order->set_address([
            'first_name' => 'Họ',  // Thay đổi theo thông tin thực tế
            'last_name'  => 'Tên',  // Thay đổi theo thông tin thực tế
            'address_1'  => $billing_address,
            'city'       => $billing_city,
            'postcode'   => $billing_postcode,
            'country'    => $billing_country,
            'phone'      => $billing_phone,
            'email'      => $billing_email,
        ], 'billing');

        // Cập nhật tổng đơn hàng
        $order->calculate_totals();
        $order->update_status('pending');
        $order_id = $order->get_id();

        // Dọn giỏ hàng
        WC()->cart->empty_cart();

        // Làm mới trang thay vì chuyển hướng
        wc_add_notice('Đơn hàng đã được tạo thành công. Bạn có thể xem chi tiết đơn hàng của mình tại trang quản lý.', 'success');
    }
}

?>

<!-- Checkout Form -->
<form method="POST">
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Địa chỉ nhận hàng</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Họ và tên</label>
                            <input class="form-control" type="text" value="<?php echo esc_attr($billing_address); ?>" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Thành phố</label>
                            <input class="form-control" type="text" value="<?php echo esc_attr($billing_city); ?>" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" value="<?php echo esc_attr($billing_email); ?>" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" value="<?php echo esc_attr($billing_phone); ?>" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" type="text" value="<?php echo esc_attr($billing_address); ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php foreach ($cart_items as $cart_item): ?>
                            <div class="d-flex justify-content-between">
                                <p><?php echo $cart_item['data']->get_name() . ' (x' . $cart_item['quantity'] . ')'; ?></p>
                                <p><?php echo wc_price($cart_item['data']->get_price() * $cart_item['quantity']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?php echo wc_price($subtotal); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><?php echo wc_price($shipping); ?></h6>
                        </div>
                    </div>

                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php echo wc_price($total); ?></h5>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck" required>
                                <label class="custom-control-label" for="directcheck">Thanh Toán Khi Nhận Hàng</label>
                            </div>
                        </div>

                        <button type="submit" name="place_order" class="btn btn-block btn-primary font-weight-bold py-3">Thanh Toán</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php get_footer(); ?>