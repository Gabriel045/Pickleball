<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if (! defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');
?>

<nav class="woocommerce-MyAccount-navigation bg-[#F9FAFB] py-[32px] px-[24px] h-auto lg:min-h-[800px] flex flex-col justify-between"
    aria-label="<?php esc_html_e('Account pages', 'woocommerce'); ?>">
    <ul>
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
            <li
                class="p-[10px] rounded-[5px]  text-rich-black text-[18px] font-semibold [&.is-active]:shadow-sm [&.is-active]:bg-white <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"
                    <?php echo wc_is_current_account_menu_item($endpoint) ? 'aria-current="page"' : ''; ?>>
                    <?php echo esc_html($label); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div>
        <ul class="[&_li]:p-[10px] [&_li]:rounded-[5px] [&_li]:text-rich-black [&_li]:text-[18px] [&_li]:font-semibold">
            <li class="woocommerce-support ">
                <a href="/contact">Support</a>
            </li>
            <li class="woocommerce-settings [&.is-active]:bg-white [&.is-active]:shadow-sm">
                <a href="/my-account/edit-account/">Settings</a>
            </li>
            <li class="flex justify-between">
                <div class="flex flex-col">
                    <span
                        class="text-[18px] font-[600] text-rich-black"><?php echo esc_html(wp_get_current_user()->display_name); ?></span>
                    <span
                        class="text-gray-paragrah text-[14px]"><?php echo esc_html(wp_get_current_user()->user_email); ?></span>
                </div>
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                        <path
                            d="M13.8333 14.8893L18 10.7227M18 10.7227L13.8333 6.55599M18 10.7227H8M8 3.22266H7C5.59987 3.22266 4.8998 3.22266 4.36502 3.49514C3.89462 3.73482 3.51217 4.11727 3.27248 4.58768C3 5.12246 3 5.82252 3 7.22266V14.2227C3 15.6228 3 16.3229 3.27248 16.8576C3.51217 17.328 3.89462 17.7105 4.36502 17.9502C4.8998 18.2227 5.59987 18.2227 7 18.2227H8"
                            stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>

        </ul>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.href;
        const settingsMenuItem = document.querySelector('.woocommerce-settings');

        if (currentUrl.includes('/edit-account/')) {
            settingsMenuItem.classList.add('is-active');
        }
    });
</script>

<?php do_action('woocommerce_after_account_navigation'); ?>