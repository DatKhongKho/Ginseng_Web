<?php

/**
 *Template Name: Home
 */
?>

<?php get_header(); ?>
<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <?php get_template_part('slider') ?>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/offer-1.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/offer-2.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        <?php
        // Lấy tất cả các danh mục sản phẩm từ WooCommerce
        $args = array(
            'taxonomy'   => 'product_cat',   // Taxonomy cho sản phẩm
            'orderby'    => 'name',          // Sắp xếp theo tên
            'order'      => 'ASC',           // Sắp xếp theo thứ tự tăng dần
            'hide_empty' => true,            // Chỉ hiển thị các danh mục có sản phẩm
        );

        $categories = get_terms($args); // Lấy danh sách các danh mục

        if ($categories) {
            foreach ($categories as $category) {
                // Lấy hình ảnh của danh mục
                $category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $category_image_url = wp_get_attachment_url($category_image_id);
        ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="<?php echo get_term_link($category); ?>">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                <!-- Hiển thị ảnh nếu có, nếu không sẽ dùng ảnh mặc định -->
                                <?php if ($category_image_url) { ?>
                                    <img class="img-fluid" src="<?php echo $category_image_url; ?>" alt="<?php echo $category->name; ?>">
                                <?php } else { ?>
                                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/default-cat.jpg" alt="<?php echo $category->name; ?>">
                                <?php } ?>
                            </div>
                            <div class="flex-fill pl-3">
                                <h6><?php echo $category->name; ?></h6>
                                <small class="text-body"><?php echo $category->count; ?> Products</small>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<!-- Categories End -->



<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>

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
<!-- Products End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/offer-1.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/offer-2.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Highly Rated Products</span></h2>
    <div class="row px-xl-5">
        <?php $args = array(
            'posts_per_page' => 8,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'meta_key'       => '_wc_average_rating',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
        ); ?>
        <?php $getposts = new WP_query($args); ?>
        <?php global $wp_query;
        $wp_query->in_the_loop = true; ?>
        <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
            <?php global $product; ?>
            <?php
            $rating_count = $product->get_rating_count();
            $review_count = $product->get_review_count();
            $average      = $product->get_average_rating();
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', ['class' => 'img-fluid w-100']); ?>
                        </a>
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square btn-add-to-cart" href="#" data-product-id="<?php echo get_the_ID(); ?>">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-square add-to-wishlist" data-product-id="<?php the_ID(); ?>"><i class="far fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?php the_title(); ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?php echo $product->get_price_html(); ?></h5>
                        </div>
                        <?php if ($rating_count > 0) : ?>
                            <?php echo wc_get_rating_html($average, $rating_count); ?>
                        <?php else: ?>
                            <div class="star-rating">
                                <span style="width:0%"><strong class="rating">0</strong> trên 5 dựa trên <span class="rating">0</span> đánh giá</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
</div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-1.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-2.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-3.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-4.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-5.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-6.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-7.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->
<?php get_footer() ?>