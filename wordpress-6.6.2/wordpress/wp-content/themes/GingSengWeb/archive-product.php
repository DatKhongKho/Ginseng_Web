<?php

/**
 *Template Name: Shop
 */
?>

<?php get_header(); ?>

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form method="get" action="">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-all" name="price_range" value="">
                        <label class="custom-control-label" for="price-all">All Price</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1" name="price_range" value="0-1000000">
                        <label class="custom-control-label" for="price-1">$0 - $1,000,000</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2" name="price_range" value="1000000-4000000">
                        <label class="custom-control-label" for="price-2">$1,000,000 - $4,000,000</label>
                    </div>
                    <!-- Thêm các khoảng giá khác tương tự -->
                    <button type="submit" class="btn btn-primary mt-3">Apply Filter</button>
                </form>


            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">

                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                // WP_Query to fetch products (you can adjust the parameters as needed)
                $args = array(
                    'post_type' => 'product', // Assuming 'product' is the post type for your products
                    'posts_per_page' => 12, // Show 8 products per page
                    'paged' => $paged, // Thêm tham số paged
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('full', ['class' => 'img-fluid w-100']);
                                    } else {
                                        echo '<img class="img-fluid w-100" src="' . get_template_directory_uri() . '/img/default-product.jpg" alt="">';
                                    }
                                    ?>

                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square btn-add-to-cart" href="#" data-product-id="<?php echo get_the_ID(); ?>">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a class="btn btn-outline-dark btn-square add-to-wishlist" data-product-id="<?php the_ID(); ?>"><i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5><?php echo get_post_meta(get_the_ID(), '_price', true); ?></h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <?php
                                        global $product;

                                        if ($product) {
                                            // Lấy tổng số sao trung bình
                                            $average_rating = $product->get_average_rating();
                                            // Lấy tổng số đánh giá
                                            $review_count = $product->get_review_count();

                                            // Hiển thị biểu tượng sao
                                            echo wc_get_rating_html($average_rating);

                                            // Hiển thị tổng số đánh giá
                                            echo '<small>(' . $review_count . ')</small>';
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <!-- Shop Product End -->
        <div class="col-12">
            <nav>
                <style>
                    .pagination {
                        display: flex;
                        justify-content: center;
                        gap: 8px;
                        list-style-type: none;
                        padding: 0;
                        margin: 20px 0;
                    }

                    .pagination .page-numbers {
                        display: inline-block;
                        padding: 8px 12px;
                        font-size: 14px;
                        font-weight: bold;
                        color: #333;
                        text-decoration: none;
                        border: 1px solid #ddd;
                        border-radius: 4px;
                        transition: all 0.3s ease-in-out;
                    }

                    .pagination .page-numbers:hover,
                    .pagination .page-numbers:focus {
                        color: #fff;
                        background-color: #007bff;
                        border-color: #007bff;
                    }

                    .pagination .current {
                        color: #fff;
                        background-color: #007bff;
                        border-color: #007bff;
                        pointer-events: none;
                    }

                    .pagination .prev,
                    .pagination .next {
                        font-size: 16px;
                    }

                    .pagination .prev.page-numbers,
                    .pagination .next.page-numbers {
                        color: #007bff;
                        font-weight: normal;
                    }
                </style>
                <ul class="pagination justify-content-center">
                    <?php
                    // Hiển thị phân trang nếu có nhiều trang
                    if (have_posts()) :
                        global $wp_query;
                        $big = 999999999; // bất kỳ số nào lớn hơn số trang

                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $query->max_num_pages, // Dùng $query thay vì $wp_query
                            'prev_text' => __('Previous'),
                            'next_text' => __('Next'),
                        ));
                    endif;
                    ?>
                </ul>
            </nav>
        </div>

    </div>
</div>
<!-- Shop Product End -->
</div>
</div>
<!-- Shop End -->


<?php get_footer(); ?>
<script>
    document.querySelectorAll('input[name="price_range"]').forEach(function(input) {
        input.addEventListener('change', function() {
            const value = this.value;
            const currentUrl = new URL(window.location.href);
            if (value) {
                currentUrl.searchParams.set('price_range', value);
            } else {
                currentUrl.searchParams.delete('price_range');
            }
            window.location.href = currentUrl.toString();
        });
    });
</script>