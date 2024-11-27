<?php wp_footer(); ?>
<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">
                <?php echo esc_html(get_theme_mod('footer_contact_title', 'Get In Touch')); ?>
            </h5>
            <p class="mb-4">
                <?php echo esc_html(get_theme_mod('footer_contact_paragraph', 'No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no')); ?>
            </p>
            <p class="mb-2">
                <i class="fa fa-map-marker-alt text-primary mr-3"></i>
                <?php echo esc_html(get_theme_mod('footer_contact_address', '123 Street, New York, USA')); ?>
            </p>
            <p class="mb-2">
                <i class="fa fa-envelope text-primary mr-3"></i>
                <?php echo esc_html(get_theme_mod('footer_contact_email', 'info@example.com')); ?>
            </p>
            <p class="mb-0">
                <i class="fa fa-phone-alt text-primary mr-3"></i>
                <?php echo esc_html(get_theme_mod('footer_contact_phone', '+012 345 67890')); ?>
            </p>
        </div>

        <div class="col-lg-8 col-md-12">
            <div class="row">
                <!-- Menu Footer One -->
                <div class="col-md-4 mb-5">
                    <?php
                    $menu_one_name = wp_get_nav_menu_name('themLocationOne');
                    if ($menu_one_name) :
                    ?>
                        <h5 class="text-secondary text-uppercase mb-4"><?php echo esc_html($menu_one_name); ?></h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'themLocationOne',
                            'container' => 'div',
                            'menu_class' => 'd-flex flex-column justify-content-start',
                            'link_before' => '<i class="fa fa-angle-right mr-2"></i>',
                            'fallback_cb' => false
                        ));
                        ?>
                    <?php endif; ?>
                </div>

                <!-- Menu Footer Two -->
                <div class="col-md-4 mb-5">
                    <?php
                    $menu_two_name = wp_get_nav_menu_name('themLocationTwo');
                    if ($menu_two_name) :
                    ?>
                        <h5 class="text-secondary text-uppercase mb-4"><?php echo esc_html($menu_two_name); ?></h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'themLocationTwo',
                            'container' => 'div',
                            'menu_class' => 'd-flex flex-column justify-content-start',
                            'link_before' => '<i class="fa fa-angle-right mr-2"></i>',
                            'fallback_cb' => false
                        ));
                        ?>
                    <?php endif; ?>
                </div>

                <!-- Menu Footer Three -->
                <div class="col-md-4 mb-5">
                    <?php
                    $menu_three_name = wp_get_nav_menu_name('themLocationThree');
                    if ($menu_three_name) :
                    ?>
                        <h5 class="text-secondary text-uppercase mb-4"><?php echo esc_html($menu_three_name); ?></h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'themLocationThree',
                            'container' => 'div',
                            'menu_class' => 'd-flex flex-column justify-content-start',
                            'link_before' => '<i class="fa fa-angle-right mr-2"></i>',
                            'fallback_cb' => false
                        ));
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                by
                <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
</body>

</html>