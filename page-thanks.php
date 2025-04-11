<?php get_header(); ?>


<?php


$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$recent_products = new WP_Query($args);
$recent_products = $recent_products->posts;
?>

<main>

    <section>
        <div id="thanks-page" class="block_content py-[60px] px-[100px]">
            <p class="text-caribbean-green font-semibold">Lorem Ipsum</p>
            <h2 class="text-rich-black text-[30px] font-semibold mt-6 mb-4">Payment Successful</h2>
            <p class="text-gray-paragrah text-[18px]">Lorem ipsum dolor sit amet consectetur. Felis gravida lobortis
                erat auctor. Pellentesque pellentesque
                porta ornare risus vel nunc viverra enim. Eu sit sit urna nibh</p>
        </div>
    </section>
    <section class="bg-[#FAFBFC]">
        <div class="block_content py-[60px] px-[100px]">
            <h2 class="text-caribbean-green  text-[30px] font-semibold mb-16 text-center">Checkout our other courses
            </h2>
            <div class="m-auto max-w-[768px]">
                <?php foreach ($recent_products as $key => $item) :
                    global $product;
                    $product = wc_get_product($item->ID);
                    $product_price = $product->get_price_html();
                    $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full');

                ?>
                    <article class="flex mb-10 last:mb-0  gap-[24px]">
                        <figure class="">
                            <a href="<?php echo get_permalink($item->ID); ?>">
                                <img class="w-[370px] aspect-video rounded-xl" src="<?php echo $product_image[0] ?>" alt="">
                            </a>
                        </figure>
                        <div class="">
                            <div class="flex items-center gap-[10px]">
                                <span class="stars"></span>
                                <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                                    Reviews)</span>
                            </div>
                            <p class="text-rich-black text-[20px] font-semibold leading-normal mt-3">
                                <a href="<?php echo get_permalink($item->ID); ?>">
                                    <?php echo $product->get_name() ?>
                                </a>
                            </p>
                            <p class="text-gray-paragrah text-[16px] leading-normal">
                                <?php echo $product->get_description() ?> </p>
                            <div class="my-[15px] flex items-center">
                                <span
                                    class="mr-4 text-[#8498AB] text-[18px] line-through">$<?php echo $product->get_price() * 2 ?></span>
                                <span
                                    class="text-[#13A513] text-[28px] font-semibold leading-[32px]"><?php echo $product_price ?></span>
                            </div>

                            <div class="woocommerce-variation-add-to-cart variations_button">
                                <button type="submit"
                                    class="custom_add_to_cart btn !w-full single_add_to_cart_button button">+
                                    Add to Cart</button>
                                <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
                                <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
                                <input type="hidden" name="variation_id" class="variation_id" value="0" />
                            </div>
                        </div>
                    </article>
                <?php endforeach  ?>
                <div class="mt-12">
                    <a class="btn-primary w-fit m-auto" href="/my-account">No thanks, bring me to my course</a>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    jQuery(document).ready(function($) {
        "use strict";
        $('.custom_add_to_cart').click(function(e) {
            e.preventDefault();
            var id = $(this).next().next().attr('value');
            // Data to be sent to the server
            var data = {
                quantity: 1,
                product_id: id,
            };
            $(this).text('Loading...');
            $.ajax({
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%',
                    'add_to_cart'),
                type: 'POST',
                data: data,
                success: function(response) {
                    if (!response) {
                        console.log('No response from server');
                        return;
                    }
                    if (response.error) {
                        return;
                    }
                    if (response) {
                        console.log("product added to cart");
                        $('#slide-cart').addClass('active');
                        $('.custom_add_to_cart').text('+ Add to Cart');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.error('Status:', status);
                    console.error('Response:', xhr.responseText);
                }
            });

        });
    });
</script>

<?php get_footer(); ?>