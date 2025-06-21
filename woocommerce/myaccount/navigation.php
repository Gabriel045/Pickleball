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

<nav class="woocommerce-MyAccount-navigation relative py-[32px] px-[24px] h-auto lg:min-h-[800px] flex flex-col justify-between border-x border-[#EAECF0]"
    aria-label="<?php esc_html_e('Account pages', 'woocommerce'); ?>">

    <span id="toogle-sidebar"
        class="hidden lg:flex w-[25px] h-[25px] bg-berkley-blue rounded-lg absolute top-[50px] right-[-12px] text-white justify-center items-center cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="12px" width="12px"
            version="1.1" id="Capa_1" viewBox="0 0 185.343 185.343" xml:space="preserve" fill="#000000">
            <g id="SVGRepo_bgCarrier" stroke-width="0" />
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
            <g id="SVGRepo_iconCarrier">
                <g>
                    <g>
                        <path style="fill:#fff;"
                            d="M51.707,185.343c-2.741,0-5.493-1.044-7.593-3.149c-4.194-4.194-4.194-10.981,0-15.175 l74.352-74.347L44.114,18.32c-4.194-4.194-4.194-10.987,0-15.175c4.194-4.194,10.987-4.194,15.18,0l81.934,81.934 c4.194,4.194,4.194,10.987,0,15.175l-81.934,81.939C57.201,184.293,54.454,185.343,51.707,185.343z" />
                    </g>
                </g>
            </g>
        </svg>
    </span>

    <p id="account-accordion"
        class="block lg:hidden relative px-[10px] rounded-[5px]  text-rich-black text-[18px] font-semibold">
        Account</p>
    <ul id="account-settings">
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
        <li
            class="p-[10px] rounded-[5px]  text-rich-black text-[18px] font-semibold [&.is-active]:shadow-sm [&.is-active]:bg-[#F9FAFB] <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
            <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"
                <?php echo wc_is_current_account_menu_item($endpoint) ? 'aria-current="page"' : ''; ?>>
                <?php echo esc_html($label); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <div>
        <ul id="other-settings"
            class="[&_li]:p-[10px] [&_li]:rounded-[5px] [&_li]:text-rich-black [&_li]:text-[18px] [&_li]:font-semibold">
            <li class="woocommerce-support ">
                <a href="/faq">Support</a>
            </li>
            <li class="woocommerce-settings [&.is-active]:bg-white [&.is-active]:shadow-sm">
                <a href="/my-account/edit-account/">Settings</a>
            </li>
            <li class="woocommerce-logout flex justify-between border-t border-[#EAECF0] mt-6 lg:!pt-[24px]">
                <div class="logout-name flex flex-col">
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

    const accountAccordion = document.getElementById('account-accordion');
    accountAccordion.addEventListener('click', function() {
        accountAccordion.classList.toggle('open');
        const accountSetting = document.getElementById('account-settings');
        accountSetting.classList.toggle('active');
        const accountSetting2 = document.getElementById('other-settings');
        accountSetting2.classList.toggle('active');
    });

    const toggleSidebar = document.getElementById('toogle-sidebar');
    toggleSidebar.addEventListener('click', function() {
        document.querySelector('.woocommerce-MyAccount-navigation').classList.toggle('collapsed');
    });
});
</script>

<?php do_action('woocommerce_after_account_navigation'); ?>