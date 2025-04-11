<?php
define('theme_version', time());
function dd($data = '')
{
    if ($data != '') {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } else {
        echo "No Text";
    }
}


// Adding theme styles and scripts
add_action('wp_enqueue_scripts', 'af_add_theme_scripts');

function af_add_theme_scripts()
{

    wp_enqueue_script(
        'theme-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        theme_version,
        true
    );

    wp_enqueue_script(
        'script',
        get_template_directory_uri() . '/resources/js/main.js',
        ['jquery'],
        theme_version,
        true
    );

    // Tailwind
    wp_enqueue_style(
        'tailwind',
        get_template_directory_uri() . '/src/output.css',
        [],
        theme_version
    );

    // slick
    wp_enqueue_style(
        'slick-css',
        get_template_directory_uri() . '/assets/slick/slick.css',
    );
    wp_enqueue_style(
        'slick-theme',
        get_template_directory_uri() . '/assets/slick/slick-theme.css',
    );
    wp_enqueue_script(
        'slick-js',
        get_template_directory_uri() . '/assets/slick/slick.min.js',
        ['jquery'],
        theme_version,
        array(
            'strategy' => 'defer'
        )
    );
}

//Register ACF blocks
include_once('acf-blocks.php');

add_theme_support('post-thumbnails');


//Add Menu 
function menu()
{
    register_nav_menus(array(
        'primary' => 'Primary Navigation',
        'an-extra-menu' => 'An Extra Menu',
    ));
}

add_action('after_setup_theme', 'menu');


//Register general settings page
if (function_exists('acf_add_options_page')) {

    if (function_exists('acf_add_options_page')) {

        acf_add_options_page(array(
            'page_title'    => 'Theme General Settings',
            'menu_title'    => 'Theme Settings',
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'position' => '3.5',
            'redirect'      => false
        ));
    }
}


// Set the default quantity to 1 for all products in the cart
add_action('wp', function () {
    if (function_exists('WC') && WC()->cart) {
        $cart_items = WC()->cart->get_cart();
        foreach ($cart_items as $cart_item_key => $cart_item) {
            WC()->cart->set_quantity($cart_item_key, 1);
        }
    }
});




// Detaching `payment` from `woocommerce_checkout_order_review` hook
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
// Attaching `payment` to my `woocommerce_checkout_payment_hook`
add_action('woocommerce_checkout_payment_hook', 'woocommerce_checkout_payment', 10);


// Disable the order notes field on the WooCommerce checkout page
add_filter('woocommerce_enable_order_notes_field', '__return_false', 10000);

// Disable the use of coupons in WooCommerce
add_filter('woocommerce_coupons_enabled', '__return_false');



// Redirect customers to a custom page after a successful checkout
add_action('template_redirect', 'correct_redirect');

function correct_redirect()
{
    /* we need only thank you page */
    if (is_wc_endpoint_url('order-received') && isset($_GET['key'])) {
        wp_redirect('/thanks');
        exit;
    }
}


// Register a custom endpoint for getting videos
add_action('rest_api_init', function () {
    register_rest_route('custom/v2', '/get_videos', array(
        'methods' => 'POST',
        'callback' => 'get_videos_handler',
        'permission_callback' => '__return_true',
    ));
});

// Handle the request to get videos
function get_videos_handler($request)
{
    $search = $request->get_param('search');
    $category = $request->get_param('category');

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => $search,
    );

    if ($category && $category != 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }


    $query = new WP_Query($args);
    $query =  $query->posts;

    $result = array();

    foreach ($query as $post) {
        global $product;
        $product = wc_get_product($post->ID);
        $product_price = $product->get_price();
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];

        $result[] = array(
            'id' => $post->ID,
            'link' => get_permalink($post->ID),
            'thumbnail' =>  $product_image,
            'title' =>  $product->get_name(),
            'description' => $product->get_description(),
            'price' => $product_price,
        );
    };

    return  $result;
}
