<?php get_header(); ?>


<main>
    <section id="cart">
        <div class="block_content px-52 py-16">
            <h1 class="text-[#0B141D] text-3xl font-semibold leading-[60px] tracking-[-0.72px] mb-16">Your Order</h1>

            <div id="cart-container" class="min-h-[300px]">
                <!-- Render the products -->
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
});
</script>


<?php get_footer(); ?>