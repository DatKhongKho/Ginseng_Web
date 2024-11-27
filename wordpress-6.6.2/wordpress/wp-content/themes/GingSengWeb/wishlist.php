<?php
/* Template Name: Wishlist */

get_header();

// Kiểm tra xem người dùng có đăng nhập không
if (is_user_logged_in()) {
    $user_id = get_current_user_id();
    // Lấy danh sách sản phẩm yêu thích từ metadata người dùng
    $wishlist = get_user_meta($user_id, '_wishlist', true);

    if (!empty($wishlist)) {
        // Chuyển danh sách sản phẩm yêu thích thành chuỗi id và tạo một truy vấn để lấy sản phẩm
        $args = array(
            'post_type' => 'product', // Chỉ lấy các sản phẩm
            'posts_per_page' => -1,   // Lấy tất cả sản phẩm trong danh sách yêu thích
            'post__in' => $wishlist,  // Chỉ lấy sản phẩm có ID trong danh sách yêu thích
            'orderby' => 'post__in'   // Sắp xếp theo thứ tự trong danh sách
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            echo '<h2 class="wishlist-title">Danh sách sản phẩm yêu thích của bạn</h2>';
            echo '<div class="wishlist-products row">'; // Sử dụng Bootstrap grid
            while ($query->have_posts()) : $query->the_post();
?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 wishlist-product">
                    <div class="product-item bg-light rounded shadow-sm">
                        <div class="product-img position-relative overflow-hidden">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('medium', ['class' => 'img-fluid w-100']);
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/img/default-product.jpg" class="img-fluid w-100" alt="product image">';
                            }
                            ?>
                            <div class="product-action position-absolute top-50 start-50 translate-middle">
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark btn-sm">
                                    <i class="fa fa-search"></i> Xem chi tiết
                                </a>
                                <!-- Nút Xóa -->
                                <a href="#" class="btn btn-outline-danger btn-sm remove-from-wishlist" data-product-id="<?php echo get_the_ID(); ?>">
                                    <i class="fa fa-trash"></i> Xóa
                                </a>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <h5 class="product-title"><?php the_title(); ?></h5>
                            <p class="product-price">
                                <?php echo wc_price(get_post_meta(get_the_ID(), '_price', true)); ?>
                            </p>
                        </div>
                    </div>
                </div>
<?php
            endwhile;
            echo '</div>'; // Đóng row
        else :
            echo '<p class="text-center">Không có sản phẩm yêu thích nào.</p>';
        endif;
        wp_reset_postdata();
    } else {
        echo '<p class="text-center">Chưa có sản phẩm nào trong danh sách yêu thích của bạn.</p>';
    }
} else {
    echo '<p class="text-center">Bạn cần đăng nhập để xem danh sách yêu thích.</p>';
}

get_footer();

// Thêm CSS trực tiếp vào mã PHP
?>
<style>
    /* Cải tiến giao diện danh sách yêu thích */
    .wishlist-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
        color: #333;
    }

    .wishlist-products .product-item {
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .wishlist-products .product-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .wishlist-products .product-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #333;
    }

    .wishlist-products .product-price {
        color: #007bff;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .product-action {
        z-index: 10;
    }

    .product-action .btn {
        background-color: rgba(0, 0, 0, 0.1);
        color: #333;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .product-action .btn:hover {
        background-color: #007bff;
        color: white;
    }

    /* Nút Xóa */
    .remove-from-wishlist {
        margin-top: 5px;
        background-color: #f44336;
        color: white;
    }

    .remove-from-wishlist:hover {
        background-color: #d32f2f;
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.remove-from-wishlist').on('click', function(e) {
            e.preventDefault();

            var product_id = $(this).data('product-id'); // Lấy ID sản phẩm cần xóa
            var button = $(this); // Lưu lại nút đã nhấn để dễ dàng thay đổi sau

            // Gửi yêu cầu AJAX
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>', // Đường dẫn tới admin-ajax.php
                type: 'POST',
                data: {
                    action: 'remove_from_wishlist', // Tên action trong WordPress
                    product_id: product_id,
                },
                beforeSend: function() {
                    button.prop('disabled', true); // Vô hiệu hóa nút khi đang xử lý
                },
                success: function(response) {
                    if (response.success) {
                        button.closest('.wishlist-product').fadeOut(); // Ẩn sản phẩm đã xóa
                    } else {
                        alert('Không thể xóa sản phẩm.');
                    }
                },
                complete: function() {
                    button.prop('disabled', false); // Kích hoạt lại nút
                }
            });
        });
    });
</script>