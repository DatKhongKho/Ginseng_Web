<?php
function my_custom_wc_theme_support()
{

    add_theme_support('woocommerce');

    add_theme_support('wc-product-gallery-lightbox');

    add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', 'my_custom_wc_theme_support');
function load_my_styles_and_scripts()
{
    // Danh sách các file CSS
    $styles = array(
        'google-fonts-roboto' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap',
        'font-awesome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
        'animate' => get_template_directory_uri() . '/lib/animate/animate.min.css',
        'owl-carousel' => get_template_directory_uri() . '/lib/owlcarousel/assets/owl.carousel.min.css',
        'custom-style' => get_template_directory_uri() . '/css/style.css',
        'news-style' => get_template_directory_uri() . '/css/news.css',
        'sign_in-style' => get_template_directory_uri() . '/css/sign_in.css',
        'sign_up-style' => get_template_directory_uri() . '/css/sign_up.css',
        'header-main-style' => get_template_directory_uri() . '/css/header-main.css',
        wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css', array(), null)
    );

    // Enqueue tất cả các file CSS
    foreach ($styles as $handle => $src) {
        wp_enqueue_style($handle, $src, array(), null);
    }

    // Danh sách các file JS
    $scripts = array(
        'jquery' => 'https://code.jquery.com/jquery-3.4.1.min.js',
        'bootstrap-bundle' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js',
        'easing' => get_template_directory_uri() . '/lib/easing/easing.min.js',
        'owl-carousel' => get_template_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js',
        'jq-bootstrap-validation' => get_template_directory_uri() . '/mail/jqBootstrapValidation.min.js',
        'contact' => get_template_directory_uri() . '/mail/contact.js',
        'main' => get_template_directory_uri() . '/js/main.js'
    );

    // Enqueue tất cả các file JS
    foreach ($scripts as $handle => $src) {
        wp_enqueue_script($handle, $src, array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'load_my_styles_and_scripts');


function add_menu()
{
    function setpostview($postID)
    {
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    function getpostviews($postID)
    {
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }
    register_nav_menus(array(
        'headerLocationOne' => 'Header Main Menu',
        'headerLocationTwo' => 'Header Right Menu',
        'themLocationOne' => 'Footer Menu One',
        'themLocationTwo' => 'Footer Menu Two',
        'themLocationThree' => 'Footer Menu Three',
        'themLocationFour' => 'Footer Menu Four',
        'themLocationFive' => 'Footer Menu Five',
    ));
}
add_action('init', 'add_menu');
function customize_footer_section($wp_customize)
{
    // Thêm section cho Footer
    $wp_customize->add_section('footer_contact_section', array(
        'title' => __('Footer Contact', 'yourtheme'),
        'priority' => 30,
    ));

    // Tùy chọn Title
    $wp_customize->add_setting('footer_contact_title', array(
        'default' => 'Get In Touch',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_contact_title_control', array(
        'label' => __('Title', 'yourtheme'),
        'section' => 'footer_contact_section',
        'settings' => 'footer_contact_title',
        'type' => 'text',
    ));
    // Tùy chọn Paragraph Content (Đoạn văn mb-4)
    $wp_customize->add_setting('footer_contact_paragraph', array(
        'default' => 'No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_contact_paragraph_control', array(
        'label' => __('Paragraph Content', 'yourtheme'),
        'section' => 'footer_contact_section',
        'settings' => 'footer_contact_paragraph',
        'type' => 'textarea',
    ));
    // Tùy chọn Address
    $wp_customize->add_setting('footer_contact_address', array(
        'default' => '123 Street, New York, USA',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_contact_address_control', array(
        'label' => __('Address', 'yourtheme'),
        'section' => 'footer_contact_section',
        'settings' => 'footer_contact_address',
        'type' => 'text',
    ));

    // Tùy chọn Email
    $wp_customize->add_setting('footer_contact_email', array(
        'default' => 'info@example.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('footer_contact_email_control', array(
        'label' => __('Email', 'yourtheme'),
        'section' => 'footer_contact_section',
        'settings' => 'footer_contact_email',
        'type' => 'email',
    ));

    // Tùy chọn Phone
    $wp_customize->add_setting('footer_contact_phone', array(
        'default' => '+012 345 67890',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_contact_phone_control', array(
        'label' => __('Phone', 'yourtheme'),
        'section' => 'footer_contact_section',
        'settings' => 'footer_contact_phone',
        'type' => 'text',
    ));
}
add_action('customize_register', 'customize_footer_section');

function wpdocs_custom_excerpt_length($length)
{
    return 25;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length');
function register_my_menus()
{
    register_nav_menus(
        array(
            'main_categories' => __('Main Categories Menu'),
            'main_menu' => __('Main Menu'),
        )
    );
}
add_action('after_setup_theme', 'register_my_menus');
function theme_customize_register($wp_customize)
{
    // Đăng ký phần cài đặt cho ảnh carousel
    $wp_customize->add_section('carousel_section', array(
        'title' => __('Carousel Settings', 'theme'),
        'priority' => 30,
    ));

    // Hình ảnh đầu tiên của carousel
    $wp_customize->add_setting('carousel_image_1', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'carousel_image_1', array(
        'label' => __('Carousel Image 1', 'theme'),
        'section' => 'carousel_section',
        'settings' => 'carousel_image_1',
    )));

    // Tiêu đề và mô tả carousel
    $wp_customize->add_setting('carousel_title_1', array(
        'default' => 'Men Fashion',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('carousel_title_1', array(
        'label' => __('Carousel Title 1', 'theme'),
        'section' => 'carousel_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('carousel_description_1', array(
        'default' => 'Lorem rebum magna amet lorem magna erat diam stet...',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('carousel_description_1', array(
        'label' => __('Carousel Description 1', 'theme'),
        'section' => 'carousel_section',
        'type' => 'textarea',
    ));
    // Đăng ký phần cài đặt cho ảnh carousel
    $wp_customize->add_section('carousel_section', array(
        'title' => __('Carousel Settings', 'theme'),
        'priority' => 30,
    ));

    // Hình ảnh đầu tiên của carousel
    $wp_customize->add_setting('carousel_image_2', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'carousel_image_2', array(
        'label' => __('Carousel Image 2', 'theme'),
        'section' => 'carousel_section',
        'settings' => 'carousel_image_2',
    )));
    // Tiêu đề và mô tả carousel

    $wp_customize->add_setting('carousel_title_2', array(
        'default' => 'Men Fashion',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('carousel_title_2', array(
        'label' => __('Carousel Title 2', 'theme'),
        'section' => 'carousel_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('carousel_description_2', array(
        'default' => 'Lorem rebum magna amet lorem magna erat diam stet...',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('carousel_description_2', array(
        'label' => __('Carousel Description 2', 'theme'),
        'section' => 'carousel_section',
        'type' => 'textarea',
    ));
    // Đăng ký phần cài đặt cho ảnh carousel
    $wp_customize->add_section('carousel_section', array(
        'title' => __('Carousel Settings', 'theme'),
        'priority' => 30,
    ));

    // Hình ảnh đầu tiên của carousel
    $wp_customize->add_setting('carousel_image_3', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'carousel_image_3', array(
        'label' => __('Carousel Image 3', 'theme'),
        'section' => 'carousel_section',
        'settings' => 'carousel_image_3',
    )));
    // Tiêu đề và mô tả carousel
    $wp_customize->add_setting('carousel_title_3', array(
        'default' => 'Men Fashion',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('carousel_title_3', array(
        'label' => __('Carousel Title 3', 'theme'),
        'section' => 'carousel_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('carousel_description_3', array(
        'default' => 'Lorem rebum magna amet lorem magna erat diam stet...',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('carousel_description_3', array(
        'label' => __('Carousel Description 3', 'theme'),
        'section' => 'carousel_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'theme_customize_register');
// Đăng ký hỗ trợ logo tùy chỉnh
function theme_custom_logo_setup()
{
    add_theme_support('custom-logo', array(
        'height'      => 10, // Chiều cao tối đa của logo
        'width'       => 10, // Chiều rộng tối đa của logo
        'flex-height' => true, // Cho phép điều chỉnh chiều cao
        'flex-width'  => true, // Cho phép điều chỉnh chiều rộng
    ));
}
add_action('after_setup_theme', 'theme_custom_logo_setup');
function custom_product_search($query)
{
    if ($query->is_search && !is_admin()) {
        // Chỉ tìm kiếm trong sản phẩm (post type 'product')
        $query->set('post_type', 'product');
    }
    return $query;
}

// Xử lý AJAX khi người dùng thêm vào danh sách yêu thích
function add_to_wishlist()
{
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

        // Kiểm tra sản phẩm hợp lệ
        $post = get_post($product_id);
        if (!$post || 'product' !== $post->post_type) {
            wp_send_json_error(array('message' => 'Sản phẩm không hợp lệ.'));
        }

        if ($product_id > 0) {
            // Lưu ID sản phẩm vào metadata của người dùng (wishlist)
            $wishlist = get_user_meta($user_id, '_wishlist', true);

            if (!$wishlist) {
                $wishlist = array(); // Nếu chưa có danh sách yêu thích thì tạo mới
            }

            // Thêm sản phẩm vào wishlist nếu chưa có
            if (!in_array($product_id, $wishlist)) {
                $wishlist[] = $product_id;
                update_user_meta($user_id, '_wishlist', $wishlist);
                wp_send_json_success(array('message' => 'Sản phẩm đã được thêm vào danh sách yêu thích.'));
            } else {
                wp_send_json_error(array('message' => 'Sản phẩm đã có trong danh sách yêu thích.'));
            }
        } else {
            wp_send_json_error(array('message' => 'ID sản phẩm không hợp lệ.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Bạn cần đăng nhập để thực hiện hành động này.', 'redirect_to' => wp_login_url()));
    }

    wp_die(); // Đảm bảo AJAX kết thúc đúng cách
}

// Đăng ký action hook cho AJAX
add_action('wp_ajax_add_to_wishlist', 'add_to_wishlist');
add_action('wp_ajax_nopriv_add_to_wishlist', 'add_to_wishlist');

function enqueue_wishlist_script()
{
    wp_enqueue_script('jquery'); // Nạp jQuery nếu chưa có
    wp_enqueue_script('wishlist', get_template_directory_uri() . '/js/wishlist.js', array('jquery'), null, true); // Nạp script wishlist.js
    wp_localize_script('wishlist', 'ajaxurl', admin_url('admin-ajax.php')); // Cung cấp URL AJAX cho JavaScript
}
add_action('wp_enqueue_scripts', 'enqueue_wishlist_script');

add_action('wp_ajax_remove_from_wishlist', 'remove_from_wishlist');
add_action('wp_ajax_nopriv_remove_from_wishlist', 'remove_from_wishlist');

// Hàm xóa sản phẩm khỏi danh sách yêu thích
function remove_from_wishlist()
{
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

        if ($product_id > 0) {
            // Lấy danh sách sản phẩm yêu thích
            $wishlist = get_user_meta($user_id, '_wishlist', true);

            // Kiểm tra nếu sản phẩm có trong danh sách yêu thích
            if (is_array($wishlist) && in_array($product_id, $wishlist)) {
                // Xóa sản phẩm khỏi danh sách
                $wishlist = array_diff($wishlist, array($product_id));
                update_user_meta($user_id, '_wishlist', $wishlist);

                wp_send_json_success();  // Trả về thành công
            } else {
                wp_send_json_error(array('message' => 'Sản phẩm không tồn tại trong danh sách yêu thích.'));
            }
        } else {
            wp_send_json_error(array('message' => 'ID sản phẩm không hợp lệ.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Bạn cần đăng nhập để thực hiện hành động này.'));
    }

    wp_die();  // Kết thúc AJAX
}


// Xử lý yêu cầu thêm vào giỏ hàng
add_action('wp_ajax_add_to_cart', 'add_to_cart_handler');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_handler');

function add_to_cart_handler()
{
    if (!isset($_POST['product_id'])) {
        wp_send_json_error(['message' => 'Product ID is missing.']);
    }

    $product_id = intval($_POST['product_id']);
    $result = WC()->cart->add_to_cart($product_id);

    if ($result) {
        // Đồng bộ hóa giỏ hàng sau khi thêm sản phẩm
        WC()->cart->calculate_totals();
        WC()->cart->set_session();
        wp_send_json_success(['message' => 'Product added to cart.']);
    } else {
        wp_send_json_error(['message' => 'Failed to add product to cart.']);
    }
}

add_action('wp_ajax_get_cart_count', 'get_cart_count_handler');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count_handler');

function get_cart_count_handler()
{
    $cart_count = WC()->cart->get_cart_contents_count();
    wp_send_json_success(['cart_count' => $cart_count]);
}

function enqueue_custom_scripts()
{
    wp_enqueue_script('custom-cart', get_template_directory_uri() . '/js/custom-cart.js', ['jquery'], null, true);
    wp_localize_script('custom-cart', 'woocommerce_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
add_filter('woocommerce_add_to_cart_fragments', 'update_cart_count');
// Tùy chỉnh URL chuyển hướng sau khi đăng nhập
function custom_redirect_after_login($redirect_to, $request, $user)
{
    // Nếu người dùng đăng nhập thành công, chuyển hướng đến trang chủ hoặc trang khác
    return home_url(); // Hoặc trang tùy chỉnh khác
}
add_filter('woocommerce_login_redirect', 'custom_redirect_after_login', 10, 3);
remove_action('woocommerce_review_before_comment_meta', 'woocommerce_template_comment_rating', 10);
add_action('woocommerce_product_query', 'filter_products_by_price_range');
function filter_products_by_price_range($query)
{
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        // Kiểm tra nếu có tham số giá trong URL
        $price_range = isset($_GET['price_range']) ? sanitize_text_field($_GET['price_range']) : '';

        if ($price_range) {
            // Tách giá trị range (ví dụ "0-1000000" -> $min_price = 0, $max_price = 1000000)
            $price_limits = explode('-', $price_range);
            if (count($price_limits) === 2) {
                $min_price = floatval($price_limits[0]);
                $max_price = floatval($price_limits[1]);

                // Thêm điều kiện meta query để lọc sản phẩm theo giá
                $meta_query = $query->get('meta_query') ?: [];
                $meta_query[] = [
                    'key' => '_price',
                    'value' => [$min_price, $max_price],
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC',
                ];
                $query->set('meta_query', $meta_query);
            }
        }
    }
}
function handle_remove_cart_item()
{
    if (isset($_POST['cart_item_key'])) {
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

        // Ghi log giá trị nhận được
        error_log('Nhận được cart_item_key: ' . $cart_item_key);

        // Thử xóa sản phẩm khỏi giỏ hàng
        $removed = WC()->cart->remove_cart_item($cart_item_key);

        if ($removed) {
            error_log('Sản phẩm đã được xóa thành công.');
            wp_send_json_success(['message' => 'Sản phẩm đã được xóa thành công.']);
        } else {
            error_log('Không thể xóa sản phẩm với cart_item_key: ' . $cart_item_key);
            wp_send_json_error(['message' => 'Không thể xóa sản phẩm khỏi giỏ hàng.']);
        }
    } else {
        error_log('Không tìm thấy cart_item_key.');
        wp_send_json_error(['message' => 'Không tìm thấy sản phẩm để xóa.']);
    }
}
add_action('wp_ajax_remove_cart_item', 'handle_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'handle_remove_cart_item');

function enqueue_custom_cart_scripts()
{
    if (is_page_template('page-cart-full-width.php')) { // Thay 'template-cart.php' bằng tên file template giỏ hàng của bạn
        wp_enqueue_script('wc-cart-fragments');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_cart_scripts');
function enqueue_woocommerce_cart_scripts()
{
    if (is_cart() || is_checkout() || is_page_template('page-cart-full-width.php')) {
        wp_enqueue_script('wc-cart-fragments');
        wp_enqueue_script('wc-add-to-cart');
        wp_localize_script('wc-cart-fragments', 'wc_cart_params', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_woocommerce_cart_scripts');
