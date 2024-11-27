<?php global $product; ?>
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