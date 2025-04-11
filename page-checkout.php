<?php get_header(); ?>

<main id="checkout-page">
    <section>
        <div class="block_content px-[100px] py-[60px]">
            <div class="flex gap-[100px]">
                <div class="w-[55%]">
                    <h2 class="text-rich-black text-[18px] font-[600] mb-10">Your Order</h2>
                    <div id="cart-container">
                        <!-- Cart contents will be dynamically loaded here -->
                    </div>
                    <div>
                        <?php get_template_part('template-parts//review-slider'); ?>
                    </div>
                </div>
                <div class="w-[45%]">
                    <div id="checkout-form">
                        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    jQuery(document).ready(function($) {
        "use strict";

        function fetchCartContents() {
            $.ajax({
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%',
                    'get_refreshed_fragments'),
                type: 'POST',
                data: {
                    'page': 'checkout',
                    'action': 'fetch_cart_data' // Added action to send data
                },
                success: function(response) {
                    if (response.fragments) {
                        const itemsContainer = $('#cart-container');
                        itemsContainer.empty(); // Clear existing items
                        itemsContainer.append(response.fragments[
                            'div.widget_shopping_cart_content']);
                    } else {
                        console.error('Error fetching cart contents:', response);
                    }
                },
                error: function(error) {
                    console.error('AJAX Error:', error);
                }
            });
        }

        // First fetch cart contents when the page loads
        fetchCartContents();

        // Periodically fetch cart contents to keep it updated
        setInterval(fetchCartContents, 30000); // Fetch every 30 seconds

        // Force checkout update
        function updateCheckout() {
            console.log("AJAX");
            $.ajax({
                url: wc_checkout_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_update_order_review',
                    security: wc_checkout_params.update_order_review_nonce,
                    post_data: $('form.woocommerce-checkout').serialize(),
                },
                success: function(response) {
                    if (response.fragments) {
                        // Update checkout fragments
                        $.each(response.fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                },
                error: function(error) {
                    console.error('Error updating checkout:', error);
                },
            });
        }

        // Listen for the event of removing a product from the cart
        $(document).ajaxComplete(function(event, xhr, settings) {
            // Check if the AJAX request is for removing an item from the cart
            if (settings.url.indexOf('wc-ajax=remove_from_cart') !== -1) {
                updateCheckout(); // Force the checkout to update
            }
        });

    });
</script>

<?php get_footer(); ?>