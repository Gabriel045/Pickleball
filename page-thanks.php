<?php get_header(); ?>


<?php

$text = get_field('thank_you_text');
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$recent_products = new WP_Query($args);
$recent_products = $recent_products->posts;

$video_url = get_field('video_url');
?>

<main>

    <section>
        <div id="thanks-page" class="block_content py-[60px] px-[30px] lg:px-[100px]">
            <!-- <p class="text-caribbean-green font-semibold">Lorem Ipsum</p> -->
            <!-- <h2 class="text-rich-black text-[24px] lg:text-[30px] font-semibold mt-6 mb-4">Payment Successful</h2>
            <p class="text-gray-paragraph text-[16px] lg:text-[18px]">Lorem ipsum dolor sit amet consectetur. Felis
                gravida lobortis
                erat auctor. Pellentesque pellentesque
                porta ornare risus vel nunc viverra enim. Eu sit sit urna nibh</p> -->
            <div class="[_&_h2]:text-rich-black [_&_h2]:text-[24px] [_&_h2]:lg:text-[30px] [_&_h2]:font-semibold [_&_h2]:mt-6 
            [_&_p]:text-gray-paragraph [_&_p]:text-[16px] [_&_p]:lg:text-[18px] mb-4"><?php echo $text; ?></div>
            <?php if (!empty($video_url)) : ?>
                <div class="flex justify-center mt-10">
                    <iframe width="1024px" class="aspect-video" src="<?php echo esc_url($video_url); ?>"
                        allowFullScreen="true" allow="autoplay;encrypted-media"></iframe>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section class="bg-[#FAFBFC]">
        <div class="block_content py-[30px] lg:py-[60px] px-[30px] lg:px-[100px]">
            <h2 class="text-[24px] lg:text-[30px] font-semibold mb-[30px] lg:mb-[60px] text-center">
                Checkout our other instructionals </h2>
            <div class="m-auto max-w-[768px] flex flex-col gap-[2%] flex-wrap">
                <?php foreach ($recent_products as $key => $item) :
                    global $product;
                    $product = wc_get_product($item->ID);
                    $product_price = $product->get_price_html();
                    $regular_price = wc_price($product->get_regular_price());
                    $sale_price = wc_price($product->get_sale_price());
                    $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full');

                ?>
                    <article
                        class="w-full flex flex-wrap lg:flex-nowrap mb-14 lg:mb-10 last:mb-0  gap-[12px] lg:gap-[24px]">
                        <figure class="h-fit w-[35%] lg:w-[20%]">
                            <a class="block " href="<?php echo get_permalink($item->ID); ?>">
                                <img class="lg:h-full rounded-xl object-cover" src="<?php echo $product_image[0] ?>" alt="">
                            </a>
                        </figure>
                        <div class="w-full lg:w-[60%] lg:flex lg:flex-col lg:justify-center">
                            <div class="flex items-center flex-wrap gap-[10px]">
                                <span class="stars"></span>
                                <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                                    Reviews)</span>
                            </div>
                            <h4 class="text-rich-black text-[20px] font-semibold leading-normal mt-1 lg:mt-3">
                                <a href="<?php echo get_permalink($item->ID); ?>">
                                    <?php echo $product->get_name() ?>
                                </a>
                            </h4>
                            <p class="text-gray-paragraph text-[16px] leading-normal">
                                <?php echo $product->get_short_description(); ?>
                            </p>
                            <div class="my-2 lg:my-4 flex items-center price">
                                <span
                                    class="mr-4 text-red-500 text-[18px] line-through"><?php echo $regular_price  ?></span>
                                <span
                                    class="text-[#13A513] text-[26px] font-semibold leading-[32px]"><?php echo $sale_price ?></span>
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
                <div class="mt-12 flex justify-center w-full">
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