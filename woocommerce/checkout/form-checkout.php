<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if (! defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
    action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data"
    aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">

    <?php if ($checkout->get_checkout_fields()) : ?>

        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

        <div class="" id="customer_details">
            <div class="">
                <?php do_action('woocommerce_checkout_billing'); ?>
            </div>

            <div class="">
                <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>
        </div>

        <?php do_action('woocommerce_checkout_after_customer_details'); ?>

    <?php endif; ?>

    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

    <div class="flex gap-4 border-t border-gray-200 pt-6 pb-5">
        <h3 id="order_review_heading"><?php esc_html_e('Payment Method', 'woocommerce'); ?></h3>
        <span id="payment-methods">
            <svg xmlns="http://www.w3.org/2000/svg" width="117" height="18" fill="none">
                <rect width="23.168" height="16.147" x=".351" y=".926" fill="#fff" rx="2.457" />
                <rect width="23.168" height="16.147" x=".351" y=".926" stroke="#F2F4F7" stroke-width=".702"
                    rx="2.457" />
                <path fill="#172B85" fill-rule="evenodd"
                    d="M7.548 11.709H6.1L5.017 7.45c-.051-.196-.16-.369-.321-.45a4.6 4.6 0 0 0-1.326-.451v-.164H5.7c.321 0 .562.246.602.532l.563 3.072L8.31 6.385h1.406zm2.972 0H9.154l1.125-5.324h1.366zm2.892-3.85c.04-.286.28-.45.562-.45.442-.041.924.041 1.326.246l.24-1.147a3.4 3.4 0 0 0-1.244-.246c-1.326 0-2.29.737-2.29 1.76 0 .78.683 1.188 1.165 1.435.522.245.723.41.683.655 0 .368-.402.532-.803.532-.483 0-.965-.123-1.406-.328l-.242 1.147a3.8 3.8 0 0 0 1.487.287c1.486.04 2.41-.696 2.41-1.802 0-1.393-1.889-1.474-1.889-2.088m6.667 3.85-1.084-5.324H17.83a.61.61 0 0 0-.563.41l-2.008 4.914h1.406l.28-.778h1.728l.161.778zm-2.048-3.89.401 2.006h-1.124z"
                    clip-rule="evenodd" />
                <rect width="23.168" height="16.147" x="31.242" y=".926" fill="#fff" rx="2.457" />
                <rect width="23.168" height="16.147" x="31.242" y=".926" stroke="#F2F4F7" stroke-width=".702"
                    rx="2.457" />
                <path fill="#ED0006" fill-rule="evenodd"
                    d="M42.951 12.39a4.78 4.78 0 0 1-3.087 1.124c-2.63 0-4.761-2.106-4.761-4.704s2.131-4.703 4.76-4.703c1.179 0 2.257.423 3.088 1.123a4.78 4.78 0 0 1 3.088-1.123c2.63 0 4.76 2.106 4.76 4.703s-2.13 4.704-4.76 4.704a4.78 4.78 0 0 1-3.088-1.123"
                    clip-rule="evenodd" />
                <path fill="#FFBF0F" fill-rule="evenodd"
                    d="M42.951 12.39a4.67 4.67 0 0 0 1.673-3.58 4.67 4.67 0 0 0-1.673-3.58 4.78 4.78 0 0 1 3.088-1.123c2.63 0 4.76 2.106 4.76 4.703s-2.13 4.704-4.76 4.704a4.78 4.78 0 0 1-3.088-1.123"
                    clip-rule="evenodd" />
                <path fill="#FF5E00" fill-rule="evenodd"
                    d="M42.951 12.39a4.67 4.67 0 0 0 1.673-3.58 4.67 4.67 0 0 0-1.673-3.58 4.67 4.67 0 0 0-1.672 3.58 4.67 4.67 0 0 0 1.672 3.58"
                    clip-rule="evenodd" />
                <rect width="23.168" height="16.147" x="62.132" y=".926" fill="#fff" rx="2.457" />
                <rect width="23.168" height="16.147" x="62.132" y=".926" stroke="#F2F4F7" stroke-width=".702"
                    rx="2.457" />
                <path fill="#FD6020" d="m71.61 16.723 13.339-4.037v1.93a2.106 2.106 0 0 1-2.106 2.107z" />
                <path fill="#0B141D" fill-rule="evenodd"
                    d="M82.417 6.972c.734 0 1.138.34 1.138.98.036.49-.294.906-.734.981l.99 1.396h-.77l-.844-1.358h-.073v1.358H81.5V6.972zm-.293 1.546h.183c.404 0 .587-.188.587-.528 0-.302-.183-.49-.587-.49h-.183zm-2.79 1.81h1.762v-.565H79.96v-.905h1.1v-.566h-1.1v-.755h1.137v-.565h-1.761zM77.5 9.236l-.844-2.263h-.66l1.358 3.432h.33l1.357-3.432h-.66zm-7.448-.566c0 .943.733 1.735 1.65 1.735.294 0 .551-.075.808-.188V9.46c-.183.226-.44.377-.734.377a1.05 1.05 0 0 1-1.064-1.056v-.075a1.117 1.117 0 0 1 1.028-1.17c.293 0 .587.151.77.378V7.16c-.22-.15-.514-.188-.77-.188-.954-.076-1.688.716-1.688 1.697m-1.138-.415c-.367-.15-.477-.226-.477-.415.037-.226.22-.415.44-.377.184 0 .367.113.514.264l.33-.453c-.256-.226-.587-.377-.917-.377-.514-.037-.954.377-.99.906v.037c0 .453.183.717.77.906.147.037.293.113.44.188.11.076.184.189.184.34 0 .264-.22.49-.44.49h-.037a.73.73 0 0 1-.66-.453l-.404.415c.22.415.66.641 1.1.641.588.038 1.065-.414 1.101-1.018v-.113c-.036-.453-.22-.68-.954-.98m-2.128 2.075h.624V6.972h-.624zm-2.899-3.357h1.101c.88.037 1.578.792 1.541 1.697 0 .49-.22.943-.587 1.283-.33.264-.734.414-1.137.377h-.918zm.807 2.79a1.14 1.14 0 0 0 .844-.263c.22-.226.33-.528.33-.868 0-.301-.11-.603-.33-.83a1.14 1.14 0 0 0-.844-.264h-.183v2.226z"
                    clip-rule="evenodd" />
                <path fill="#FD6020" fill-rule="evenodd"
                    d="M74.381 6.894c-.917 0-1.688.754-1.688 1.735 0 .943.734 1.735 1.688 1.773s1.688-.755 1.725-1.735c-.037-.981-.77-1.773-1.725-1.773"
                    clip-rule="evenodd" />
                <rect width="23.168" height="16.147" x="93.023" y=".926" fill="#1F72CD" rx="2.457" />
                <rect width="23.168" height="16.147" x="93.023" y=".926" stroke="#F2F4F7" stroke-width=".702"
                    rx="2.457" />
                <path fill="#fff" fill-rule="evenodd"
                    d="m96.951 6.543-2.233 5.087h2.673l.332-.81h.757l.332.81h2.943v-.619l.262.62h1.522l.263-.633v.633h6.12l.744-.79.697.79 3.144.006-2.241-2.536 2.241-2.558h-3.095l-.725.775-.675-.775h-6.658l-.572 1.313-.585-1.313h-2.668v.598l-.296-.598zm.518.722h1.303l1.481 3.45v-3.45h1.428l1.144 2.474 1.055-2.474h1.42v3.651h-.864l-.007-2.86-1.26 2.86h-.774l-1.267-2.86v2.86H99.35l-.337-.819h-1.821l-.337.818h-.953zm12.136 0h-3.514v3.649h3.46l1.115-1.21 1.075 1.21h1.124L111.232 9.1l1.633-1.835h-1.075l-1.11 1.196zm-11.502.618-.6 1.458h1.199zm8.856.805V8.02h2.193l.957 1.065-1 1.072h-2.15V9.43h1.917v-.742z"
                    clip-rule="evenodd" />
            </svg>
        </span>
    </div>

    <?php do_action('woocommerce_checkout_before_order_review'); ?>

    <div id="order_review" class="woocommerce-checkout-review-order">
        <!-- This section handles the order changes -->
        <?php do_action('woocommerce_checkout_payment_hook'); ?>
        <?php do_action('woocommerce_checkout_order_review'); ?>

    </div>

    <div class="form-row place-order">
        <button type="submit" class="btn-primary w-full" name="woocommerce_checkout_place_order" id="place_order"
            value="<?php esc_attr_e('Place order', 'woocommerce'); ?>">
            <?php esc_html_e('Confirm Payment', 'woocommerce'); ?>
        </button>
        <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
    </div>

    <?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>