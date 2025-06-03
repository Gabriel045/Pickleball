<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (WC()->cart && ! WC()->cart->is_empty()) : ?>

    <ul
        class="woocommerce-mini-cart cart_list product_list_widget flex flex-col !px-[20px] lg:!px-[40px] gap-[20px] <?php echo esc_attr($args['list_class']); ?>">
        <?php
        do_action('woocommerce_before_mini_cart_contents');

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $product     = $cart_item['data'];
            $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                /**
                 * This filter is documented in woocommerce/templates/cart/cart.php.
                 *
                 * @since 2.1.0
                 */
                $product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                $thumbnail         = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full');
                $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

        ?>
                <li
                    class="woocommerce-mini-cart-item  first:pt-[35px] flex items-center gap-5 border-t border-gray-200 pt-5 <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                    <?php if (empty($product_permalink)) : ?>
                        <?php echo $thumbnail . wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url($product_permalink); ?>">
                            <figure>
                                <img class='!w-[128px] !h-[85px] rounded-lg !m-0 object-cover' src='<?php echo ($thumbnail[0])  ?>'>
                            </figure>
                        </a>
                    <?php endif; ?>
                    <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                    <?php
                    // echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) . '</span>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                    <div class="flex flex-col w-1/2">
                        <h4 class="product-name text-gray-900 text-[16px] font-semibold leading-[18px]">
                            <a class="hover:underline" href="<?php echo esc_url($product_permalink); ?>">
                                <?php echo esc_html($product_name); ?>
                            </a>
                        </h4>
                        <div class="flex items-center gap-[10px]">
                            <p class="text-[#8498AB] text-[16px]">
                                <s>$<?php echo $product->get_price() * 2 ?></s>
                            </p>
                            <p
                                class="product-price [_&_span]:text-[#13A513] [_&_span]:text-[20px] lg:[_&_span]:text-[25px] [_&_span]:font-semibold [_&_span]:leading-[32px]">
                                <?php echo $product_price; ?></p>
                        </div>
                    </div>

                    <div class="remove-button">
                        <?php echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-success_message="%s"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none"><path d="M2.76523 12.5472C2.39568 12.5472 2.07944 12.4157 1.8165 12.1528C1.55356 11.8898 1.42187 11.5734 1.42142 11.2034V2.4686H0.749512V1.12479H4.10904V0.452881H8.14047V1.12479H11.5V2.4686H10.8281V11.2034C10.8281 11.5729 10.6966 11.8894 10.4337 12.1528C10.1707 12.4162 9.85428 12.5476 9.48428 12.5472H2.76523ZM9.48428 2.4686H2.76523V11.2034H9.48428V2.4686ZM4.10904 9.85956H5.45285V3.81241H4.10904V9.85956ZM6.79666 9.85956H8.14047V3.81241H6.79666V9.85956Z" fill="#060843"/></svg></a>',
                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                /* translators: %s is the product name */
                                esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                                esc_attr($product_id),
                                esc_attr($cart_item_key),
                                esc_attr($_product->get_sku()),
                                /* translators: %s is the product name */
                                esc_attr(sprintf(__('&ldquo;%s&rdquo; has been removed from your cart', 'woocommerce'), wp_strip_all_tags($product_name)))
                            ),
                            $cart_item_key
                        ); ?>
                    </div>


                </li>
        <?php
            }
        }

        do_action('woocommerce_mini_cart_contents');
        ?>
    </ul>


    <div class="checkout-btn woocommerce-mini-cart__buttons buttons pt-[60px] lg:px-[40px] ">
        <a href="/checkout/" class="btn-primary button checkout wc-forward">Proceed to Checkout →</a>
        <figure class="mt-2 hidden lg:block">
            <svg class="m-auto" xmlns="http://www.w3.org/2000/svg" width="117" height="18" viewBox="0 0 117 18" fill="none">
                <rect x="0.580155" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" fill="white" />
                <rect x="0.580155" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" stroke="#F2F4F7"
                    stroke-width="0.702059" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.77642 11.7076H6.33037L5.246 7.44903C5.19453 7.25314 5.08525 7.07995 4.92449 6.99833C4.52332 6.79321 4.08125 6.62996 3.599 6.54763V6.38367H5.92849C6.24999 6.38367 6.49112 6.62996 6.53131 6.916L7.09394 9.98787L8.53929 6.38367H9.94516L7.77642 11.7076ZM10.749 11.7076H9.38327L10.5078 6.38367H11.8735L10.749 11.7076ZM13.6404 7.85855C13.6806 7.5718 13.9217 7.40785 14.203 7.40785C14.6451 7.36668 15.1266 7.44901 15.5285 7.65343L15.7696 6.50715C15.3678 6.3432 14.9257 6.26086 14.5245 6.26086C13.199 6.26086 12.2345 6.99831 12.2345 8.0218C12.2345 8.80041 12.9177 9.20923 13.4 9.45552C13.9217 9.7011 14.1226 9.86506 14.0824 10.1106C14.0824 10.479 13.6806 10.643 13.2794 10.643C12.7971 10.643 12.3149 10.5202 11.8735 10.3151L11.6324 11.462C12.1147 11.6664 12.6364 11.7488 13.1186 11.7488C14.6049 11.7892 15.5285 11.0525 15.5285 9.94668C15.5285 8.55412 13.6404 8.4725 13.6404 7.85855ZM20.308 11.7076L19.2236 6.38367H18.0588C17.8177 6.38367 17.5766 6.54763 17.4962 6.79321L15.4882 11.7076H16.8941L17.1747 10.9297H18.9021L19.0628 11.7076H20.308ZM18.2599 7.81736L18.661 9.82387H17.5365L18.2599 7.81736Z"
                    fill="#172B85" />
                <rect x="31.4708" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" fill="white" />
                <rect x="31.4708" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" stroke="#F2F4F7"
                    stroke-width="0.702059" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M43.1804 12.3895C42.3492 13.0902 41.2709 13.5132 40.0926 13.5132C37.4635 13.5132 35.3322 11.4072 35.3322 8.80938C35.3322 6.21155 37.4635 4.10559 40.0926 4.10559C41.2709 4.10559 42.3492 4.52858 43.1804 5.22926C44.0117 4.52858 45.09 4.10559 46.2683 4.10559C48.8974 4.10559 51.0287 6.21155 51.0287 8.80939C51.0287 11.4072 48.8974 13.5132 46.2683 13.5132C45.09 13.5132 44.0117 13.0902 43.1804 12.3895Z"
                    fill="#ED0006" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M43.1804 12.3895C44.204 11.5267 44.853 10.2429 44.853 8.80938C44.853 7.37582 44.204 6.09204 43.1804 5.22928C44.0117 4.52859 45.09 4.10559 46.2683 4.10559C48.8974 4.10559 51.0287 6.21155 51.0287 8.80938C51.0287 11.4072 48.8974 13.5132 46.2683 13.5132C45.09 13.5132 44.0117 13.0902 43.1804 12.3895Z"
                    fill="#FFBF0F" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M43.1804 12.3895C44.2039 11.5267 44.8529 10.2429 44.8529 8.80935C44.8529 7.37579 44.2039 6.09201 43.1804 5.22925C42.1568 6.09201 41.5078 7.37579 41.5078 8.80935C41.5078 10.2429 42.1568 11.5267 43.1804 12.3895Z"
                    fill="#FF5E00" />
                <rect x="62.3613" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" fill="white" />
                <rect x="62.3613" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" stroke="#F2F4F7"
                    stroke-width="0.702059" />
                <path d="M71.8391 16.7215L85.1782 12.6847V14.6154C85.1782 15.7786 84.2353 16.7215 83.0721 16.7215H71.8391Z"
                    fill="#FD6020" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M82.6464 6.97052C83.3803 6.97052 83.7839 7.30999 83.7839 7.95122C83.8206 8.44158 83.4904 8.85649 83.0501 8.93193L84.0408 10.3275H83.2702L82.4263 8.96965H82.3529V10.3275H81.7291V6.97052H82.6464ZM82.3529 8.51701H82.5364C82.94 8.51701 83.1235 8.32841 83.1235 7.98894C83.1235 7.68718 82.94 7.49859 82.5364 7.49859H82.3529V8.51701ZM79.5641 10.3275H81.3254V9.76176H80.1879V8.85649H81.2887V8.2907H80.1879V7.53631H81.3254V6.97052H79.5641V10.3275ZM77.7295 9.23368L76.8856 6.97052H76.2251L77.5827 10.403H77.913L79.2706 6.97052H78.6101L77.7295 9.23368ZM70.2809 8.6679C70.2809 9.61089 71.0148 10.403 71.9321 10.403C72.2256 10.403 72.4825 10.3276 72.7393 10.2144V9.46001C72.5559 9.68632 72.299 9.8372 72.0055 9.8372C71.4184 9.8372 70.9414 9.38457 70.9414 8.78106V8.70562C70.9047 8.10211 71.3817 7.57403 71.9688 7.53631C72.2623 7.53631 72.5559 7.68719 72.7393 7.91351V7.15912C72.5192 7.00824 72.2256 6.97052 71.9688 6.97052C71.0148 6.89508 70.2809 7.68719 70.2809 8.6679ZM69.1434 8.25298C68.7765 8.10211 68.6664 8.02667 68.6664 7.83807C68.7031 7.61175 68.8866 7.42316 69.1067 7.46088C69.2902 7.46088 69.4736 7.57403 69.6204 7.72491L69.9507 7.27228C69.6938 7.04596 69.3636 6.89508 69.0333 6.89508C68.5196 6.85736 68.0793 7.27228 68.0426 7.80035V7.83807C68.0426 8.2907 68.2261 8.55474 68.8132 8.74334C68.9599 8.78106 69.1067 8.8565 69.2535 8.93193C69.3636 9.00737 69.437 9.12053 69.437 9.27141C69.437 9.53545 69.2168 9.76176 68.9966 9.76176H68.9599C68.6664 9.76176 68.4095 9.57317 68.2995 9.30913L67.8958 9.72404C68.116 10.139 68.5563 10.3653 68.9966 10.3653C69.5837 10.403 70.0607 9.95036 70.0974 9.34685V9.23369C70.0607 8.78106 69.8773 8.55474 69.1434 8.25298ZM67.0152 10.3275H67.639V6.97052H67.0152V10.3275ZM64.1165 6.97052H65.0338H65.2172C66.0979 7.00824 66.795 7.76263 66.7583 8.66789C66.7583 9.15825 66.5382 9.61088 66.1713 9.95036C65.841 10.2144 65.4374 10.3653 65.0338 10.3275H64.1165V6.97052ZM64.9236 9.76177C65.2172 9.79949 65.5474 9.68633 65.7676 9.49774C65.9877 9.27142 66.0978 8.96966 66.0978 8.63019C66.0978 8.32843 65.9877 8.02668 65.7676 7.80036C65.5474 7.61176 65.2172 7.4986 64.9236 7.53632H64.7402V9.76177H64.9236Z"
                    fill="#0B141D" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M74.6106 6.8927C73.6933 6.8927 72.9227 7.64709 72.9227 8.6278C72.9227 9.57078 73.6566 10.3629 74.6106 10.4006C75.5646 10.4383 76.2985 9.64622 76.3352 8.66552C76.2985 7.68481 75.5646 6.8927 74.6106 6.8927V6.8927Z"
                    fill="#FD6020" />
                <rect x="93.2519" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" fill="#1F72CD" />
                <rect x="93.2519" y="0.925248" width="23.1679" height="16.1474" rx="2.45721" stroke="#F2F4F7"
                    stroke-width="0.702059" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M97.1802 6.54175L94.9469 11.6294H97.6205L97.952 10.8182H98.7096L99.041 11.6294H101.984V11.0103L102.246 11.6294H103.768L104.031 10.9972V11.6294H110.151L110.895 10.8393L111.592 11.6294L114.736 11.6359L112.495 9.09977L114.736 6.54175H111.641L110.916 7.31726L110.242 6.54175H103.583L103.012 7.85491L102.426 6.54175H99.7584V7.1398L99.4616 6.54175H97.1802ZM97.6977 7.26417H99.001L100.482 10.7141V7.26417H101.91L103.054 9.73777L104.109 7.26417H105.529V10.9149H104.665L104.658 8.05421L103.398 10.9149H102.624L101.357 8.05421V10.9149H99.5791L99.242 10.0964H97.4207L97.0843 10.9142H96.1316L97.6977 7.26417ZM109.835 7.26417H106.32V10.9127H109.78L110.895 9.70354L111.97 10.9127H113.094L111.461 9.09903L113.094 7.26417H112.019L110.91 8.45948L109.835 7.26417ZM98.3316 7.88182L97.7316 9.33981H98.931L98.3316 7.88182ZM107.188 8.68653V8.02009V8.01945H109.381L110.338 9.08526L109.338 10.1569H107.188V9.42933H109.105V8.68653H107.188Z"
                    fill="white" />
            </svg>
        </figure>
        <a href="/shop"
            class="back-shoping cursor-pointer text-gray-600 text-center text-[16px] font-normal leading-[20px] block mt-5">Back
            to
            Shopping</a>
    </div>



    <?php $args = array(
        'post_type' => 'product',
        'posts_per_page' => 3,
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    );
    $product_query = new WP_Query($args);
    $product_query = $product_query->posts; ?>

    <div class="more-recommended bg-[#FAFBFC] px-[30px] lg:px-[40px] py-[40px] mt-[50px]">
        <h2 class="text-[#060843] text-center text-[24px] font-semibold leading-[38px] tracking-[-0.48px]">
            More Recommended</h2>
        <div id="multiple-items" class="mt-[30px] flex-wrap lg:flex-nowrap">
            <?php foreach ($product_query as $key => $item) :
                global $product;
                $product = wc_get_product($item->ID);
                $product_price = $product->get_price_html();
                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full'); ?>
                <article class="lg:mb-[40px] last:mb-0">
                    <figure>
                        <a href="<?php echo esc_url(get_permalink($item->ID)); ?>">
                            <img class="rounded-xl aspect-video object-cover" src="<?php echo $product_image[0] ?>" alt="">
                        </a>
                    </figure>
                    <div class="mt-[24px]">
                        <div class="flex items-center gap-[10px]">
                            <span class="stars"></span>
                            <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                                Reviews)</span>
                        </div>
                        <h3 class="text-rich-black text-[20px] font-semibold leading-[20px]">
                            <a class="hover:underline" href="<?php echo esc_url(get_permalink($item->ID)); ?>">
                                <?php echo $product->get_name(); ?>
                            </a>
                        </h3>
                        <p class="text-gray-paragrah text-[16px] leading-normal">
                            <?php echo $product->get_short_description(); ?> </p>
                        <div class="flex items-center gap-[10px]">
                            <span
                                class="mr-4 text-[#8498AB] text-[16px] lg:text-[18px] line-through">$<?php echo $product->get_price() * 2 ?></span>
                            <span
                                class="text-[#13A513] text-[28px] font-semibold leading-[32px]"><?php echo $product_price ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- 
	<p class="woocommerce-mini-cart__total total">
		<?php
        /**
         * Hook: woocommerce_widget_shopping_cart_total.
         *
         * @hooked woocommerce_widget_shopping_cart_subtotal - 10
         */
        do_action('woocommerce_widget_shopping_cart_total');
        ?>
	</p> -->

    <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

    <?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

<?php else : ?>

    <p class="woocommerce-mini-cart__empty-message px-[40px]">
        <?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>