<?php get_header(); ?>
<?php
$cart_items = WC()->cart->get_cart();

foreach ($cart_items as $cart_item_key => $cart_item) {
    $product = $cart_item['data'];
    $quantity = $cart_item['quantity'];
    $product_name = $product->get_name();
    $product_price = $product->get_price();
}


?>

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
        console.log("fired")
        $.ajax({
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%',
                'get_refreshed_fragments'),
            type: 'POST',
            success: function(response) {
                if (response.fragments) {
                    const itemsContainer = $('#cart-container');
                    itemsContainer.empty(); // Clear existing items
                    console.log(itemsContainer)
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
});
</script>
<style>
#cart-container .woocommerce-mini-cart {
    padding: 0px;
}

#cart-container .woocommerce-mini-cart-item .remove-button {
    width: 30%;
    display: flex;
    justify-content: end;
}

#cart-container .woocommerce-mini-cart-item>a img {
    width: 200px;
}

#cart-container #multiple-items {
    display: flex;
    gap: 40px;
}

#cart-container .woocommerce-mini-cart__buttons {
    display: flex;
    gap: 30px;
    position: relative;
}

#cart-container .woocommerce-mini-cart__buttons figure {
    position: absolute;
    bottom: -25px;
    left: 90px;
}

#cart-container .woocommerce-mini-cart__buttons .back-shoping {
    margin: 0;
    border-radius: 8px;
    background: #FAFBFC;
    box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);
    display: flex;
    padding: 16px 28px;
    justify-content: center;
    align-items: center;
    gap: 12px;
}

#cart-container .woocommerce-mini-cart__buttons .back-shoping:hover {
    transform: translateY(-2px);
}
</style>


<?php get_footer(); ?>