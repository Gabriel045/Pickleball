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
    if (is_page('shop')) {
        wp_enqueue_script(
            'page-shop-script',
            get_template_directory_uri() . '/resources/js/pageShopScrip.js',
            ['jquery'],
            theme_version,
            true
        );
    }

    if (is_singular('instructor')) {
        wp_enqueue_script(
            'page-shop-script',
            get_template_directory_uri() . '/resources/js/pageSingleInstructor.js',
            ['jquery'],
            theme_version,
            true
        );
    }

    if (is_page('instructors')) {
        wp_enqueue_script(
            'page-instructors-script',
            get_template_directory_uri() . '/resources/js/pageInstructorsScript.js',
            ['jquery'],
            theme_version,
            true
        );
    }

    if (is_page('blogs')) {
        wp_enqueue_script(
            'page-blog-script',
            get_template_directory_uri() . '/resources/js/pageBlogScript.js',
            ['jquery'],
            theme_version,
            true
        );
    }
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



// Register a custom endpoints 
include_once get_template_directory() . '/endpoint/endpoints.php';