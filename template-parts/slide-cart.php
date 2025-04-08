<?php

?>
<div id="slide-cart"
    class="w-[500px] h-[100vh]  overflow-y-auto  py-[50px] fixed z-[99999999] bg-white right-0 translate-x-[800px] top-[0px] rounded-lg">
    <div class="relative">
        <div class="flex justify-between items-center mb-[20px] px-[40px]">
            <h2 class="text-[#060843] text-[20px] font-bold tracking-[-0.4px]">Cart</h2>
            <span id="close" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                    <path d="M13.5 14L0.5 1M13.5 1L0.5 14" stroke="#060843" stroke-linecap="round" />
                </svg>
            </span>
        </div>
        <div id="items-container" class="gap-[32px] flex flex-col">
            <!-- Render the products -->
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
    "use strict";

    function fetchCartContents() {
        $.ajax({
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%',
                'get_refreshed_fragments'),
            type: 'POST',
            success: function(response) {
                console.log(response);
                if (response.fragments) {
                    const itemsContainer = $('#items-container');
                    itemsContainer.empty(); // Clear existing items

                    setTimeout(() => {
                        itemsContainer.append(response.fragments[
                            'div.widget_shopping_cart_content']);
                    }, 300);

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

    // Fetch cart contents after adding a product to the cart
    $(document).ajaxComplete(function(event, xhr, settings) {
        if (settings.url.indexOf('wc-ajax=add_to_cart') !== -1) {
            console.log('Product added to cart via AJAX.');
            fetchCartContents();
        }
    });

    $('#close').click(function() {
        $('#slide-cart').removeClass('active');
    });
});
</script>