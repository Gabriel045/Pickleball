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
    // wp_enqueue_style(
    //     'slick-theme',
    //     get_template_directory_uri() . '/assets/slick/slick-theme.css',
    // );

    wp_enqueue_style(
        'slick-css',
        get_template_directory_uri() . '/assets/slick/slick.css',
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

    global $post;
    if (is_page() && get_page_template_slug($post->ID) === 'template-parts/product-categories.php') {
        wp_enqueue_script(
            'page-best-sellers-script',
            get_template_directory_uri() . '/resources/js/pageBestSellerScript.js',
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

    if (isset($items['payment-methods'])) {
        $items['payment-methods'] = __('Payment Methods', 'woocommerce');
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




/**
 * WooCommerce Coupon Generation for New and Returning Users
 *
 * This code automatically generates a unique WooCommerce coupon for users upon registration or first login.
 * 
 * - On user registration (`user_register`), a unique coupon is created and assigned to the user.
 * - On user login (`wp_login`), if the user does not already have a coupon, one is generated.
 * - Coupons are unique per user,  and are restricted to the user's email.
 * - The generated coupon code is stored in user meta under 'coupon_generated'.
 *
 * Functions:
 * - generate_unique_coupon_code($user_id): Generates a unique coupon code for a given user.
 * - create_coupon_for_user($user_id): Creates a WooCommerce coupon post and assigns it to the user.
 * - create_coupon_on_user_register($user_id): Action hook to generate coupon on registration.
 * - create_coupon_on_user_login($user_login, $user): Action hook to generate coupon on first login if not already present.
 */
function generate_unique_coupon_code($user_id)
{
    $prefix = 'USER';
    $code = $prefix . '_' . substr(md5(uniqid(rand(), true)), 0, 10); // Generate a unique code
    return $code;
}

function create_coupon_for_user($user_id)
{
    $coupon_code = generate_unique_coupon_code($user_id);
    $amount = '15'; // Discount amount
    $discount_type = 'percent';
    $coupon = array(
        'post_title'   => $coupon_code,
        'post_content' => '',
        'post_status'  => 'publish',
        'post_author'  => 1,
        'post_type'    => 'shop_coupon'
    );

    $new_coupon_id = wp_insert_post($coupon);

    // Coupon meta data (use correct meta keys with underscores)
    update_post_meta($new_coupon_id, 'discount_type', $discount_type);
    update_post_meta($new_coupon_id, '_discount_type', $discount_type);
    update_post_meta($new_coupon_id, '_coupon_amount', $amount);
    update_post_meta($new_coupon_id, 'coupon_amount', $amount);
    update_post_meta($new_coupon_id, 'individual_use', 'yes');
    update_post_meta($new_coupon_id, '_individual_use', 'yes'); // No combining with other coupons
    update_post_meta($new_coupon_id, 'usage_limit', 1);
    update_post_meta($new_coupon_id, '_usage_limit', 1);
    update_post_meta($new_coupon_id, 'customer_email', get_userdata($user_id)->user_email);
    update_post_meta($new_coupon_id, '_customer_email', get_userdata($user_id)->user_email); // Restrict to user's email

    return $coupon_code;
}


// Automatically generate a coupon when the user registers or logs in for the first time
add_action('user_register', 'create_coupon_on_user_register');
function create_coupon_on_user_register($user_id)
{
    $coupon_code = create_coupon_for_user($user_id);
    update_user_meta($user_id, 'coupon_generated', $coupon_code);
}

add_action('wp_login', 'create_coupon_on_user_login', 10, 2);
function create_coupon_on_user_login($user_login, $user)
{
    $user_id = $user->ID;
    if (empty(get_user_meta($user_id, 'coupon_generated', true))) {
        $coupon_code = create_coupon_for_user($user_id);
        update_user_meta($user_id, 'coupon_generated', $coupon_code);
    }
}

include_once get_template_directory() . '/inc/add-shortcodes-cuw.php';




/**
 * On WooCommerce order processing, checks if the first offer product is purchased.
 * If found, inserts order and campaign details into the custom 'cuw_stats' database table.
 */
add_action('woocommerce_checkout_order_processed', function ($order_id, $posted_data, $order) {

    global $wpdb;
    $first_offer = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}cuw_offers ORDER BY id ASC LIMIT 1");
    $product_id = json_decode($first_offer->product)->id;
    $found = false;


    foreach ($order->get_items() as $item) {
        if ($item->get_product_id() == $product_id) {
            $found = true;
            break;
        }
    }

    if ($found) {
        $wpdb->insert(
            $wpdb->prefix . 'cuw_stats',
            [
                'campaign_id' => 2,
                'campaign_type' => 'post_purchase_upsells',
                'offer_id'    => 3,
                'order_id'    => $order_id,
                'order_item_id' => 0,
                'product_id' => $product_id,
                'product_qty' => 1,
                'user_id' => get_current_user_id(),
                'billing_email' => $order->get_billing_email(),
                'order_status' => 'processing',
                'created_at'  => current_time('timestamp')
            ]
        );
    }
}, 10, 3);


$already_purchased_error = false;

add_filter('woocommerce_add_to_cart_validation', function ($passed, $product_id, $quantity) {
    global $already_purchased_error;
    if (is_user_logged_in()) {
        $customer_orders = wc_get_orders([
            'customer_id' => get_current_user_id(),
            'status' => ['wc-completed', 'wc-processing', 'wc-on-hold'],
            'limit' => -1,
        ]);
        foreach ($customer_orders as $order) {
            foreach ($order->get_items() as $item) {
                if ($item->get_product_id() == $product_id) {
                    $already_purchased_error = true;
                    wc_add_notice(__('You can only purchase this product once.'), 'error');
                    return false;
                }
            }
        }
    }
    return $passed;
}, 10, 3);



// --- PERFORMANCE OPTIMIZATIONS ---

// 2. Lazy loading for iframes (e.g., YouTube embeds)
add_filter('embed_oembed_html', function ($html) {
    return str_replace('<iframe', '<iframe loading="lazy"', $html);
}, 10, 1);

// 3. Remove emojis scripts and styles
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

// 4. Remove oEmbed discovery links and scripts
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');


// Disable Gutenberg Block Library CSS on frontend
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // WooCommerce blocks
}, 100);



add_filter('script_loader_tag', function ($tag, $handle) {
    if (in_array($handle, ['jquery', 'jquery-migrate']) && !is_admin()) {
        return str_replace(' src', ' defer src', $tag);
    }
    if ($handle === 'slick-css') {
        return str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $tag);
    }
    return $tag;
}, 10, 2);

// Disable WooCommerce CSS on frontend
add_filter('woocommerce_enqueue_styles', function ($styles) {
    if (is_front_page()) {
        return [];
    }
    return $styles;
});

// Disable checkout-upsell-woocommerce template.css on home page
add_action('wp_enqueue_scripts', function () {
    global $wp_styles;
    if (is_front_page()) {
        foreach ($wp_styles->queue as $handle) {
            $src = $wp_styles->registered[$handle]->src;
            if (strpos($src, 'checkout-upsell-woocommerce') !== false) {
                wp_dequeue_style($handle);
                wp_deregister_style($handle);
                wp_dequeue_script($handle);
                wp_deregister_script($handle);
            }
            if (strpos($src, 'woocommerce/assets/css/brands.css') !== false) {
                wp_dequeue_style($handle);
                wp_deregister_style($handle);
            }

            if (strpos($src, 'gravityforms/assets/css/dist/gravity-forms-theme-framework.min.css') !== false) {
                wp_dequeue_style($handle);
                wp_deregister_style($handle);
            }
        }
    }
    // Disable Dashicons on frontend for non-logged-in users
    if (!is_user_logged_in() && !is_admin()) {
        wp_deregister_style('dashicons');
    }

}, 100);

// Force remove Gravity Forms theme framework CSS by handle
add_action('template_redirect', function () {
    if (!is_admin() && is_front_page()) {
        ob_start(function ($buffer) {
            return preg_replace(
                '#<link[^>]+gravity-forms-theme-framework\.min\.css[^>]+>#i',
                '',
                $buffer
            );
        });
    }
});


// --- NATIVE JQUERY AND JQUERY MIGRATE OPTIMIZATION ---
// Move jQuery and jQuery Migrate to the footer and apply defer
add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {
        wp_scripts()->add_data('jquery', 'group', 1);
        wp_scripts()->add_data('jquery-migrate', 'group', 1);
    }
}, 100);

add_filter('script_loader_tag', function ($tag, $handle) {
    if (in_array($handle, ['jquery', 'jquery-migrate']) && !is_admin()) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}, 10, 2);


// Force jQuery and jQuery Migrate to the footer even if a plugin moves them to the head
add_action('wp_print_scripts', function() {
    if (!is_admin()) {
        wp_scripts()->add_data('jquery', 'group', 1);
        wp_scripts()->add_data('jquery-migrate', 'group', 1);
    }
}, 100);
