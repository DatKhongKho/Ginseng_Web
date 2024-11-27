<?php

/**
 *Template Name: Shop Detail
 */
?>

<?php get_header(); ?>


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <?php
                    global $product; // Đảm bảo rằng bạn đang trong vòng lặp sản phẩm WooCommerce

                    // Lấy ảnh sản phẩm chính
                    $attachment_ids = $product->get_gallery_image_ids(); // Lấy các ảnh gallery
                    $main_image_id = $product->get_image_id(); // Lấy ID ảnh chính
                    $all_images = array_merge([$main_image_id], $attachment_ids); // Gộp ảnh chính và gallery

                    // Kiểm tra và hiển thị từng ảnh trong carousel
                    if (!empty($all_images)) {
                        foreach ($all_images as $index => $attachment_id) {
                            $image_url = wp_get_attachment_image_url($attachment_id, 'full'); // Lấy URL ảnh
                            $active_class = ($index === 0) ? 'active' : ''; // Đặt class active cho ảnh đầu tiên
                    ?>
                            <div class="carousel-item <?php echo $active_class; ?>">
                                <img class="w-100 h-100" src="<?php echo esc_url($image_url); ?>" alt="Product Image">
                            </div>
                    <?php
                        }
                    } else {
                        // Nếu không có ảnh nào
                        echo '<div class="carousel-item active">
                    <img class="w-100 h-100" src="' . esc_url(wc_placeholder_img_src()) . '" alt="No Image Available">
                  </div>';
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>

        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <?php
                // Lấy đối tượng sản phẩm hiện tại
                global $product;

                if ($product):
                    // Lấy thông tin chi tiết sản phẩm
                    $product_id = $product->get_id();
                    $title = $product->get_name();
                    $price = wc_price($product->get_price());
                    $description = $product->get_description();
                    $rating_count = $product->get_rating_count();
                    $average_rating = $product->get_average_rating();
                ?>

                    <h3><?php echo esc_html($title); ?></h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <?php echo wc_get_rating_html($average_rating); // Hiển thị xếp hạng sao 
                            ?>
                        </div>
                        <small class="pt-1">(<?php echo esc_html($rating_count); ?> Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo $product->get_price_html(); ?></h3>
                    <p class="mb-4"><?php echo esc_html($description); ?></p>

                    <!-- Quantity and Add to Cart -->
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" class="d-flex">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus" type="button">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" name="quantity" class="form-control bg-secondary border-0 text-center" value="1" min="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-plus" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary px-3 btn-add-to-cart" href="#" data-product-id="<?php echo get_the_ID(); ?>">

                                <i class=" fa fa-shopping-cart mr-1 "></i> Add To Cart

                            </button>
                        </form>
                    </div>

                    <!-- Share Buttons -->
                    <div class=" d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>
                            <?php
                            global $product;
                            // Lấy mô tả sản phẩm
                            echo wpautop($product->get_description());
                            ?>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">
                                    <?php
                                    // Hiển thị số lượng đánh giá
                                    echo $product->get_review_count();
                                    ?> review for "<?php echo get_the_title($product->get_id()); ?>"
                                </h4>
                                <?php
                                // Lấy và hiển thị danh sách các đánh giá
                                $comments = get_comments(array(
                                    'post_id' => $product->get_id(), // ID sản phẩm
                                    'status'  => 'approve', // Chỉ lấy các đánh giá đã được phê duyệt
                                ));

                                // Hiển thị thông tin đánh giá
                                foreach ($comments as $comment) {
                                    $user_name = $comment->comment_author;
                                    $user_date = $comment->comment_date;
                                    $user_rating = get_comment_meta($comment->comment_ID, 'rating', true); // Lấy rating của bình luận
                                ?>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><?php echo $user_name; ?><small> - <i><?php echo $user_date; ?></i></small></h6>
                                            <div class="text-primary mb-2">
                                                <?php
                                                // Hiển thị sao dựa trên rating
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $user_rating) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    } else {
                                                        echo '<i class="far fa-star"></i>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <p><?php echo $comment->comment_content; ?></p>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            if (comments_open()) {
                                global $product;

                                if (is_user_logged_in()) {
                            ?>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Leave a review</h4>
                                        <small>Your email address will not be published. Required fields are marked *</small>
                                        <form id="review-form" action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post">
                                            <div class="d-flex my-3">
                                                <p class="mb-0 mr-2">Your Rating * :</p>
                                                <div class="text-primary">
                                                    <input type="hidden" name="rating" id="rating" value="0">
                                                    <!-- Chỉ còn icon sao -->
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Your Review *</label>
                                                <textarea id="message" name="comment" cols="30" rows="5" class="form-control" required></textarea>
                                            </div>
                                            <input type="hidden" name="comment_post_ID" value="<?php echo $product->get_id(); ?>" />
                                            <input type="hidden" name="comment_approved" value="0" />
                                            <div class="form-group mb-0">
                                                <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                            </div>
                                        </form>
                                    </div>
                                    <script>
                                        // JavaScript để xử lý rating
                                        document.querySelectorAll('.text-primary i').forEach(function(star, index) {
                                            star.addEventListener('click', function() {
                                                const value = index + 1; // Lấy vị trí ngôi sao (bắt đầu từ 1)
                                                document.getElementById('rating').value = value;

                                                // Đổi class sao khi người dùng click
                                                document.querySelectorAll('.text-primary i').forEach(function(s, i) {
                                                    if (i < value) {
                                                        s.classList.remove('far');
                                                        s.classList.add('fas'); // Sao được chọn
                                                    } else {
                                                        s.classList.remove('fas');
                                                        s.classList.add('far'); // Sao chưa chọn
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                            <?php
                                } else {
                                    echo '<p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to leave a review.</p>';
                                }
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="row px-xl-5">
                <?php
                $tax_query[] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
                ?>
                <?php $args = array('post_type' => 'product', 'posts_per_page' => 8, 'ignore_sticky_posts' => 1, 'tax_query' => $tax_query); ?>
                <?php $getposts = new WP_query($args); ?>
                <?php global $wp_query;
                $wp_query->in_the_loop = true; ?>
                <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <?php get_template_part('content/item-product') ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>


            </div>
        </div>
    </div>
</div>
<!-- Products End -->


<?php get_footer(); ?>