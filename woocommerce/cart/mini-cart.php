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
		class="woocommerce-mini-cart cart_list product_list_widget flex flex-col px-[40px] gap-[20px] <?php echo esc_attr($args['list_class']); ?>">
		<?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$product 	= $cart_item['data'];
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
				// var_dump("price");
				// var_dump($product_price_number);

		?>
				<li
					class="woocommerce-mini-cart-item flex items-center gap-5 border-t border-gray-200 pt-5 <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
					<?php if (empty($product_permalink)) : ?>
						<?php echo $thumbnail . wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?>
					<?php else : ?>
						<a href="<?php echo esc_url($product_permalink); ?>">
							<figure>
								<img class='w-[128px] rounded-lg' src='<?php echo ($thumbnail[0])  ?>'>
							</figure>
						</a>
					<?php endif; ?>
					<?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
					<?php
					// echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) . '</span>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
					<div class="flex flex-col w-1/2">
						<p class="product-name text-gray-900 text-[16px] font-semibold leading-[20px]">
							<?php echo esc_html($product_name); ?>
						</p>
						<p class="text-gray-600 text-[14px] font-normal leading-[20px] my-2">Expiry 06/2024</p>

						<div class="flex items-center">
							<p class="mr-4 text-[#8498AB] text-[18px] line-through">
								<s>$ <?php echo $product->get_price() * 2 ?></s>
							</p>
							<p
								class="product-price [_&_span]:text-[#13A513] [_&_span]:text-[25px] [_&_span]:font-semibold [_&_span]:leading-[32px]">
								<?php echo $product_price; ?></p>
						</div>
					</div>

					<div class="">
						<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
						);

						?>
					</div>


				</li>
		<?php
			}
		}

		do_action('woocommerce_mini_cart_contents');
		?>
	</ul>


	<?php $args = array(
		'post_type' => 'product',
		'posts_per_page' => 3,
	);
	$product_query = new WP_Query($args);
	$product_query = $product_query->posts; ?>

	<div class="bg-[#FAFBFC] px-[40px] py-[40px] mt-[50px]">
		<h2 class="text-[#060843] text-center text-[24px] font-semibold leading-[38px] tracking-[-0.48px]">
			More Recommended</h2>
		<div id="multiple-items" class="mt-[30px]">
			<?php foreach ($product_query as $key => $item) :
				global $product;
				$product = wc_get_product($item->ID);
				$product_price = $product->get_price_html();
				$product_image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full'); ?>
				<article class="mb-[40px] last:mb-0">
					<figure>
						<img class="rounded-xl aspect-video object-cover" src="<?php echo $product_image[0] ?>" alt="">
					</figure>
					<div class="mt-[24px]">
						<div class="flex items-center gap-[10px]">
							<span class="stars"></span>
							<span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
								Reviews)</span>
						</div>
						<p class="text-rich-black text-[20px] font-semibold leading-normal">
							<?php echo $product->get_name() ?>
						</p>
						<p class="text-[#475467] text-[16px] leading-normal">
							<?php echo $product->get_description() ?> </p>
						<div class="my-[15px] flex items-center">
							<span
								class="mr-4 text-[#8498AB] text-[18px] line-through">$<?php echo $product->get_price() * 2 ?></span>
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

	<div class="woocommerce-mini-cart__buttons buttons py-[40px] px-[40px] ">
		<a href="https://Pickleball/checkout/" class="btn-primary button checkout wc-forward">Procees to Checkout →</a>
		<figure class="mt-2">
			<img class="m-auto" src="<?php echo get_template_directory_uri() ?>/assets/images/payments.png"
				alt="secure checkout">
		</figure>
		<a href="/shop"
			class="cursor-pointer text-gray-600 text-center text-[16px] font-normal leading-[20px] block mt-5">Back to
			Shopping</a>
	</div>

	<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>