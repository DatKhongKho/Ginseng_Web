<?php get_header(); ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Kết quả tìm kiếm cho: <?php echo get_search_query(); ?></h2>

    <?php if (have_posts()) : ?>
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <?php if ('product' == get_post_type()) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <?php else: ?>
                                    <img src="default-image.jpg" class="card-img-top" alt="No Image">
                                <?php endif; ?>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p class="text-center">Không tìm thấy sản phẩm nào khớp với từ khóa của bạn.</p>
    <?php endif; ?>

</div>

<?php get_footer(); ?>