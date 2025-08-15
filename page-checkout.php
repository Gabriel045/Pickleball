<?php get_header(); ?>

<main id="checkout-page">
    <section>
        <div class="block_content px-[30px] lg:px-[100px] py-[60px]">
            <div class="flex flex-wrap lg:flex-nowrap lg:gap-[100px]">
                <div class="w-full lg:w-[55%]">
                    <h2 class="text-rich-black text-[18px] font-[600] mb-10">Your Order</h2>
                    <div id="cart-container" class="min-h-[236px]">
                        <!-- Cart contents will be dynamically loaded here -->
                    </div>
                    <?php get_template_part('template-parts/aditional-info-cart'); ?>
                    <?php get_template_part('template-parts/more-products'); ?>
                </div>
                <div class="w-full lg:w-[45%] pt-[60px] lg:pt-0">
                    <div id="checkout-form">
                        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<style>
    #slide-cart {
        display: none;
    }
</style>

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


        // Force checkout update
        function updateCheckout() {
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

        // Add to cart ajax 
        function addToCart() {
            jQuery(".add_to_cart_checkout").click(function(e) {
                e.preventDefault();
                var id = jQuery(this).next().next().attr("value");
                // Data to be sent to the server
                var data = {
                    quantity: 1,
                    product_id: id,
                };
                jQuery(this).text("Loading...");
                jQuery.ajax({
                    url: wc_add_to_cart_params.wc_ajax_url
                        .toString()
                        .replace("%%endpoint%%", "add_to_cart"),
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (!response) {
                            console.log("No response from server");
                            return;
                        }
                        if (response.error) {
                            console.log(response);
                            jQuery(".add_to_cart_checkout").text("+ Add to Cart");
                            return;
                        }
                        if (response) {
                            console.log("product added to cart");
                            jQuery(".add_to_cart_checkout").text("+ Add to Cart");
                            fetchCartContents();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        console.error("Status:", status);
                        console.error("Response:", xhr.responseText);
                    },
                });
            });
        }

        // Listen for the event of removing a product from the cart
        $(document).ajaxComplete(function(event, xhr, settings) {
            // Check if the AJAX request is for removing an item from the cart
            if (settings.url.indexOf('wc-ajax=remove_from_cart') !== -1) {
                fetchCartContents(); // Force the checkout to update
                updateCheckout();
            }
            if (settings.url.indexOf('wc-ajax=get_refreshed_fragments') !== -1) {
                addToCart();
                updateCheckout();
            }
        });


    });
</script>

<?php get_footer(); ?>