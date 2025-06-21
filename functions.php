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
// add_filter('woocommerce_coupons_enabled', '__return_false');



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



/**
 * Register New Endpoint.
 *
 * @return void.
 */
function register_new_item_endpoint()
{
    // add_rewrite_endpoint('my-videos', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-lessons', EP_ROOT | EP_PAGES);
}
add_action('init', 'register_new_item_endpoint');


/**
 * Add content to the new tab.
 *
 * @return  string.
 */
// function add_my_videos_content()
// {
//     get_template_part('/template-parts/my-videos');
// }
// add_action('woocommerce_account_my-videos_endpoint', 'add_my_videos_content');

function add_my_lessons_content()
{
    get_template_part('/template-parts/my-lessons');
}
add_action('woocommerce_account_my-lessons_endpoint', 'add_my_lessons_content');




// Sobrescribe el contenido del dashboard de WooCommerce
remove_action('woocommerce_account_dashboard', 'woocommerce_account_dashboard', 10);

add_action('woocommerce_account_dashboard', function () {
    get_template_part('/template-parts/my-videos');
});



add_filter('woocommerce_account_menu_items', 'customize_account_menu_items');

function customize_account_menu_items($items)
{
    // Remove an item from the menu (e.g., "Downloads")
    unset($items['downloads']);
    unset($items['edit-account']);
    unset($items['customer-logout']);
    unset($items['edit-address']);


    // Change the name of a menu item (e.g., "Dashboard")
    if (isset($items['dashboard'])) {
        $items['dashboard'] = __('My Videos', 'woocommerce');
    }


    // Add a new item to the menu
    // $items['my-videos'] = __('My Videos', 'woocommerce');


    // Reorder the menu items to make "My Videos" the second item
    // $position = 1; // Position where "My Videos" should appear (0-based index)

    // if (isset($items['my-videos'])) {
    //     $my_videos = array('my-videos' => $items['my-videos']);
    //     unset($items['my-videos']);
    //     $items = array_slice($items, 0, $position, true) + $my_videos + array_slice($items, $position, null, true);
    // }


    return $items;
}



add_filter('woocommerce_payment_gateway_supports', 'filter_payment_gateway_supports', 10, 3);
function filter_payment_gateway_supports($supports, $feature, $payment_gateway)
{
    // Here in the array, set the allowed payment method IDs (slugs)
    $allowed_payment_method_ids = array('bacs', 'cheque', 'cod');

    if (in_array($payment_gateway->id, $allowed_payment_method_ids) && $feature === 'add_payment_method') {
        $supports = true;
    }
    return $supports;
}



add_action('woocommerce_before_calculate_totals', function ($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;

    $discount = get_field('discount_percentage', 'options');
    $discount = $discount / 100;

    $found = false;
    // Check if there is at least one product in the cart
    if (count($cart->get_cart()) > 0 && !empty($discount)) {
        $found = true;
    }

    // If found, change the price of all products
    if ($found) {
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $product_ids_in_cart = array_column($cart->get_cart(), 'product_id');
            $product_ids_in_cart =  [$product_ids_in_cart[0]];
            // If the current product is NOT in the cart, change the price
            if (!in_array($cart_item['product_id'], $product_ids_in_cart)) {
                $cart_item['data']->set_price($cart_item['data']->get_price() * (1 - $discount));
            }
        }
    }
});
