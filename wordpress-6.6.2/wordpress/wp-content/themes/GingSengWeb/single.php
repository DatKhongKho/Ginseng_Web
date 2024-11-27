<?php

/**
 *Template Name: Blog Detail
 */
?>

<?php get_header(); ?>


<main>
    <section class="news-section section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-7 col-12">
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
                                <div class="news-block-top">
                                    <img src="<?php echo $imagePostNews ?>" alt="">

                                    <div class="news-category-block">
                                        <a href="#" class="category-block-link">
                                            <?php echo get_the_category_list(',') ?>
                                        </a>


                                    </div>
                                </div>

                                <div class="news-block-info">
                                    <div class="d-flex mt-2">
                                        <div class="news-block-date">
                                            <p>
                                                <i class="bi-calendar4 custom-icon me-1"></i>
                                                <?php the_time('m,N,Y,') ?>
                                            </p>
                                        </div>

                                        <div class="news-block-author mx-5">
                                            <p>
                                                <i class="bi-person custom-icon me-1"></i>
                                                <?php the_author() ?>
                                            </p>
                                        </div>

                                        <div class="news-block-comment">
                                            <p>
                                                <i class="bi-chat-left custom-icon me-1"></i>
                                                <!-- <?php the_comment() ?> -->
                                            </p>
                                        </div>
                                        <div class="news-block-eyes">
                                            <p>
                                                <i class="bi bi-eye"></i>
                                                <?php
                                                echo getpostviews(get_the_id());
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="news-block-title mb-2">
                                        <h4> <?php the_title() ?></h4>
                                    </div>

                                    <div class="news-block-body">
                                        <p> <?php the_content() ?></p>
                                    </div>
                            <?php
                        };
                    }
                            ?>
                            <div class="social-sharing">
                                <p>Share this post:</p>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="social-share facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="social-share twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="social-share linkedin">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                            </div>

                                </div>
                            </div>
                </div>

                <?php get_sidebar() ?>

            </div>
        </div>
    </section>

    <section class="news-section section-padding section-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                    <?php
                    $categories = get_the_category(get_the_ID());
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;

                        $args = array(
                            'category__in' => $category_ids,
                            'post__not_in' => array($post->ID),
                            'showposts' => 5, // Số bài viết bạn muốn hiển thị.
                            'caller_get_posts' => 1
                        );
                        $my_query = new wp_query($args);
                        if ($my_query->have_posts()) {
                            echo '<h3>Bài viết liên quan</h3><ul class="list-news">';
                            while ($my_query->have_posts()) {
                                $my_query->the_post();
                    ?>
                                <li>
                                    <div class="new-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(85, 75)); ?></a></div>
                                    <div class="item-list">
                                        <h4><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                        <?php the_excerpt(); ?>
                                    </div>
                                </li>
                    <?php
                            }
                            echo '</ul>';
                        }
                    }
                    ?>
                </div>

            </div>

        </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>