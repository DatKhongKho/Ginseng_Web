<div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">
    <h5 class="mt-5 mb-3">Latest News</h5>
    <?php $blogs = new WP_Query(array('posts_per_page' => 2, 'post_type' => 'post', 'order' => 'ASC'));
    if ($blogs->have_posts()) {
        while ($blogs->have_posts()) {
            $blogs->the_post();
    ?>
            <div class="news-block news-block-two-col d-flex mt-4">
                <?php $imagePostNews = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                <div class="news-block-two-col-image-wrap">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($imagePostNews); ?>" class="news-image img-fluid" alt="">
                    </a>
                </div>

                <div class="news-block-two-col-info">
                    <div class="news-block-title mb-2">
                        <h6><a href="<?php the_permalink(); ?>" class="news-block-title-link"><?php the_title(); ?></a></h6>
                    </div>

                    <div class="news-block-date">
                        <p>
                            <i class="bi-calendar4 custom-icon me-1"></i>
                            <?php the_time('F j, Y'); ?>
                        </p>
                    </div>
                </div>
            </div>
    <?php
        }
        wp_reset_postdata();
    }
    ?>

    <div class="category-block d-flex flex-column">
        <h5 class="mb-3">Categories</h5>

        <?php
        $categories = get_categories([
            'taxonomy'   => 'category',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => true
        ]);

        if (!empty($categories)) :
            foreach ($categories as $category) :
                $category_link = get_category_link($category->term_id);
        ?>
                <a href="<?php echo esc_url($category_link); ?>" class="category-block-link">
                    <?php echo esc_html($category->name); ?>
                    <span class="badge"><?php echo esc_html($category->count); ?></span>
                </a>
        <?php
            endforeach;
        else :
            echo '<p>No categories found.</p>';
        endif;
        ?>
    </div>
</div>