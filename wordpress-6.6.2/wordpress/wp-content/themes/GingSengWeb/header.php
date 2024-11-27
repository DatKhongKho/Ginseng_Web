<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gingseng Web By Group 11</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <?php wp_head(); ?>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-decoration-none">
                    <div class="logo-container">
                        <?php
                        if (has_custom_logo()) {
                            // Hiển thị logo tùy chỉnh và áp dụng kiểu CSS
                            the_custom_logo();
                        } else {
                            // Nếu không có logo tùy chỉnh, hiển thị tên trang web
                            echo '<span class="h1 text-uppercase text-primary bg-dark px-2">GingSeng</span>';
                            echo '<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Web</span>';
                        }
                        ?>
                    </div>
                </a>
            </div>


            <div class="col-lg-4 col-6 text-left">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" placeholder="Search for products" value="<?php echo get_search_query(); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Thông tin liên lạc</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;" aria-expanded="false" aria-controls="navbar-vertical">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main_categories', // Vị trí menu đã đăng ký trong functions.php
                            'menu_class' => 'navbar-nav w-100',
                            'container' => false,
                            'items_wrap' => '%3$s', // Loại bỏ thẻ <ul> và chỉ giữ lại các <li>
                            'depth' => 2, // Cho phép menu có cấp độ con (sub-menu)
                        ));
                        ?>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'headerLocationOne', // Vị trí menu đã đăng ký
                                'menu_class' => 'navbar-nav', // Lớp CSS cho các mục menu
                                'container' => false, // Không cần bao bọc trong <div>
                                'items_wrap' => '%3$s', // Chỉ giữ lại các <li> không có thẻ <ul>
                                'depth' => 2, // Cho phép menu có cấp độ con
                                'link_before' => '<span class="nav-link text-light px-3 py-2 d-inline-block rounded">', // Định dạng liên kết
                                'link_after' => '</span>', // Đóng thẻ span
                            ));
                            ?>
                        </div>

                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">

                            <?php
                            // Kiểm tra xem người dùng có đăng nhập không
                            if (is_user_logged_in()) {
                                $user_id = get_current_user_id();
                                // Lấy danh sách sản phẩm yêu thích từ metadata người dùng
                                $wishlist = get_user_meta($user_id, '_wishlist', true);
                                $wishlist_count = is_array($wishlist) ? count($wishlist) : 0;
                            } else {
                                $wishlist_count = 0;
                            }
                            ?>

                            <!-- Yêu thích -->
                            <a href="<?php echo get_permalink(get_page_by_path('wishlist')); ?>" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                    <?php echo $wishlist_count; ?>
                                </span>
                            </a>



                            <!-- Giỏ hàng -->
                            <a href="<?php echo the_permalink() . '/cart' ?>" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span id="cart-count" class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                                </span>
                            </a>



                            <!-- Dropdown tài khoản -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm dropdown-toggle text-warning" data-toggle="dropdown">
                                    <?php
                                    if (is_user_logged_in()) {
                                        echo get_avatar(get_current_user_id(), 30) . ' ' . wp_get_current_user()->display_name;
                                    } else {
                                        echo 'My Account';
                                    }
                                    ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php if (is_user_logged_in()): ?>
                                        <a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>">Dashboard</a>
                                        <a class="dropdown-item" href="<?php echo the_permalink() . '/order' ?>">My Orders</a>
                                        <a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('edit-account'); ?>">Edit Account</a>
                                        <a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('customer-logout'); ?>">Sign Out</a>
                                    <?php else: ?>
                                        <a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('login'); ?>">Sign In</a>
                                        <a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('register'); ?>">Register</a>
                                    <?php endif; ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <!-- Breadcrumb Start -->
    <?php if (!is_home()) { ?>
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <?php

                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                        }


                        ?>
                    </nav>
                </div>
            </div>
        </div>
    <?php       } ?>
    <!-- Breadcrumb End -->