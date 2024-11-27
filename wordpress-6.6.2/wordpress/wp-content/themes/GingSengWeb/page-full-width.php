<?php

/**
 *Template Name: Giới Thiệu
 */
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
        ?>
                <?php
                setpostview(get_the_id());
                ?>
                <?php $imagePostNews = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                <div class="news-block">
                    <div class="news-block-info">
                        <div class="news-block-title mb-12 text-center">
                            <h1> <?php the_title() ?></h1>
                        </div>
                        <div class="news-block-body">
                            <p> <?php the_content() ?></p>
                        </div>
                <?php
            };
        }
                ?>
                    </div>
                </div>
    </div>
</div>

<?php get_footer(); ?>