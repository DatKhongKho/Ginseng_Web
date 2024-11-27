<?php

/**
 *Template Name: Blog
 */
?>
<?php get_header(); ?>
<section class="news-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-12">
                <?php $blogs = new WP_Query(array('posts_per_page' => 2, 'post_title' => 'post', 'order' => 'ASC', 'paged' => get_query_var('paged') ? get_query_var('paged') : 1,));
                if ($blogs->have_posts()) {
                    while ($blogs->have_posts()) {
                        $blogs->the_post();
                ?>
                        <?php $imagePostNews = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                        <div class="news-block">


                            <div class="news-block-info">

                                <div class="news-block-title mb-2">
                                    <h4><a href="<?php the_permalink(); ?>" class="news-block-title-link"><?php the_title(); ?></a></h4>
                                </div>
                                <div class="news-block-top">
                                    <a href="<?php echo site_url("/blog-detail") ?>">
                                        <img src="<?php echo $imagePostNews ?>"
                                            class="news-image img-fluid"
                                            alt=""
                                            style="width: 300px; height: auto; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    </a>
                                </div>
                                <div class="news-block-body">
                                    <p><?php echo wp_trim_words(get_the_content(), 25) ?></p>
                                </div>
                                <div class="d-flex mt-2">
                                    <div class="news-block-date">
                                        <p>
                                            <i class="bi-calendar4 custom-icon me-1"></i>
                                            <?php the_time() ?>
                                        </p>
                                    </div>

                                    <div class="news-block-author mx-5">
                                        <p>
                                            <i class="bi-person custom-icon me-1"></i>
                                            <?php the_author() ?>
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
                            </div>
                        </div>
                <?php
                    };
                }
                ?>
            </div>

            <?php get_sidebar() ?>

        </div>
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
                echo paginate_links(array(
                    'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'format'    => '?paged=%#%',
                    'current'   => max(1, get_query_var('paged')),
                    'total'     => $blogs->max_num_pages,
                    'prev_text' => __('Previous'),
                    'next_text' => __('Next'),
                ));
                ?>
            </ul>
        </nav>

    </div>
</section>

<?php get_footer(); ?>