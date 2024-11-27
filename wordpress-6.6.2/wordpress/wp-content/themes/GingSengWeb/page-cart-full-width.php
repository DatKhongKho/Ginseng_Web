<?php

/**
 * Template Name: Cart
 */
?>

<?php get_header(); ?>

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item): ?>
                        <?php
                        $product = $cart_item['data'];
                        $product_name = $product->get_name();
                        $product_price = wc_price($product->get_price());
                        $product_quantity = $cart_item['quantity'];
                        $product_total = wc_price($cart_item['line_total']);
                        $product_image = wp_get_attachment_image_src($product->get_image_id(), 'thumbnail')[0];
                        ?>
                        <tr>
                            <td class="align-middle">
                                <img src="<?php echo esc_url($product_image); ?>" alt="" style="width: 50px;">

                            </td>
                            <td> <?php echo esc_html($product_name); ?></td>
                            <td class="align-middle"><?php echo $product_price; ?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus update-cart" data-cart-item-key="<?php echo $cart_item_key; ?>" data-action="decrease">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $product_quantity; ?>" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus update-cart" data-cart-item-key="<?php echo $cart_item_key; ?>" data-action="increase">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?php echo $product_total; ?></td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-danger remove-cart-item" data-cart-item-key="<?php echo $cart_item_key; ?>">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6><?php echo WC()->cart->get_cart_subtotal(); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium"><?php echo wc_price(WC()->cart->get_shipping_total()); ?></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5><?php echo WC()->cart->get_total(); ?></h5>
                    </div>
                    <a href="<?php echo the_permalink() . '/checkout' ?>" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<?php get_footer(); ?>
<script>
    jQuery(document).ready(function($) {
        $('.remove-cart-item').on('click', function() {
            var cartItemKey = $(this).data('cart-item-key');

            if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                return;
            }

            console.log('Đang gửi yêu cầu AJAX với cart_item_key:', cartItemKey); // Debug

            $.ajax({
                url: wc_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'remove_cart_item',
                    cart_item_key: cartItemKey,
                },
                success: function(response) {
                    console.log('Phản hồi từ server:', response); // Debug

                    if (response.success) {
                        alert('Sản phẩm đã được xóa khỏi giỏ hàng.');
                        location.reload();
                    } else {
                        alert('Xóa sản phẩm thất bại: ' + response.data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi AJAX:', error);
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                },
            });
        });
    });
</script>