<?php

$best_seller_title = isset($args['best_seller_title']) ? $args['best_seller_title'] : '';

$text = !empty($best_seller_title) ? $best_seller_title : get_field('text');

// Query for posts of the custom post type "product"
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
);
$product_query = new WP_Query($args);
$product_query = $product_query->posts;

?>

<section id="product-slider" class="">
    <div class="block_content py-[60px] lg:py-[100px] px-[30px] lg:px-[60px]">
        <div class="[_&_span]:text-[16px] [_&_span]:text-[#0C5E5D] [_&_span]:font-[600] [_&_h2]:font-[600] [_&_h2]:text-[36px] [_&_h2]:text-rich-black
            [_&_p]:text-gray-paragrah [_&_p]:text-[20px]">
            <?php echo $text ?>
        </div>
        <div id="multiple-items" class="product-slider mt-[60px] ">
            <?php foreach ($product_query as $key => $item) :
                global $product;
                $product = wc_get_product($item->ID);
                $regular_price = wc_price($product->get_regular_price());
                $sale_price = wc_price($product->get_sale_price());
                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full'); ?>
            <article class="!flex flex-col !h-auto gap-[5px] lg:max-w-[250px] justify-between">
                <figure>
                    <a href="<?php echo get_permalink($item->ID); ?>">
                        <img class="aspect-[0.8] object-cover w-full rounded-lg"
                            src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'large')[0]; ?>"
                            alt="">
                    </a>
                </figure>
                <div class="flex items-center gap-[10px]">
                    <span class="stars"></span>
                    <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                        Reviews)</span>
                </div>
                <h4 class="text-rich-black text-[18px] font-semibold leading-[22px]">
                    <a href="<?php echo get_permalink($item->ID); ?>" class="text-rich-black hover:underline">
                        <?php echo $product->get_name() ?>
                    </a>
                </h4>
                <p class="text-gray-paragrah text-[16px] leading-[18px]">
                    <?php echo $product->get_short_description(); ?> </p>
                <div class="flex items-center">
                    <span class="mr-4 text-[#8498AB] text-[18px] line-through"><?php echo $regular_price ?></span>
                    <span
                        class="text-[#13A513] text-[25px] font-semibold leading-[32px]"><?php echo $sale_price ?></span>
                </div>

                <div class="woocommerce-variation-add-to-cart variations_button">
                    <button type="submit" class="custom_add_to_cart btn !w-full single_add_to_cart_button button">+
                        Add to Cart</button>
                    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
                    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
                    <input type="hidden" name="variation_id" class="variation_id" value="0" />
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<script>
jQuery(document).ready(() => {
    jQuery('#multiple-items').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 4000,
        slidesToShow: 6,
        slidesToScroll: 1,
        useTransform: false,
        arrows: true,
        prevArrow: "<span class='a-left  control-c prev slick-prev absolute z-[9]'><svg width='40' height='41' viewBox='0 0 40 41' fill='none' xmlns='http://www.w3.org/2000/svg'><g filter='url(#filter0_d_143_6624)'><rect x='2' y='1.28711' width='36' height='36' rx='8' fill='white'/><rect x='2.5' y='1.78711' width='35' height='35' rx='7.5' stroke='#D0D5DD'/><path d='M25.8333 19.2871H14.1666M14.1666 19.2871L20 25.1204M14.1666 19.2871L20 13.4537' stroke='#344054' stroke-width='1.66667' stroke-linecap='round' stroke-linejoin='round'/></g><defs><filter id='filter0_d_143_6624' x='0' y='0.287109' width='40' height='40' filterUnits='userSpaceOnUse' color-interpolation-filters='sRGB'><feFlood flood-opacity='0' result='BackgroundImageFix'/><feColorMatrix in='SourceAlpha' type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0' result='hardAlpha'/><feOffset dy='1'/><feGaussianBlur stdDeviation='1'/><feColorMatrix type='matrix' values='0 0 0 0 0.0627451 0 0 0 0 0.0941176 0 0 0 0 0.156863 0 0 0 0.05 0'/><feBlend mode='normal' in2='BackgroundImageFix' result='effect1_dropShadow_143_6624'/><feBlend mode='normal' in='SourceGraphic' in2='effect1_dropShadow_143_6624' result='shape'/></filter></defs></svg></span>",
        nextArrow: "<span class='a-right  control-c next slick-next absolute z-[99]'><svg width='40' height='41' viewBox='0 0 40 41' fill='none' xmlns='http://www.w3.org/2000/svg'><g filter='url(#filter0_d_143_6627)'><rect x='2' y='1.28711' width='36' height='36' rx='8' fill='white'/><rect x='2.5' y='1.78711' width='35' height='35' rx='7.5' stroke='#D0D5DD'/><path d='M14.1667 19.2871H25.8333M25.8333 19.2871L20 13.4537M25.8333 19.2871L20 25.1204' stroke='#344054' stroke-width='1.66667' stroke-linecap='round' stroke-linejoin='round'/></g><defs><filter id='filter0_d_143_6627' x='0' y='0.287109' width='40' height='40' filterUnits='userSpaceOnUse' color-interpolation-filters='sRGB'><feFlood flood-opacity='0' result='BackgroundImageFix'/><feColorMatrix in='SourceAlpha' type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0' result='hardAlpha'/><feOffset dy='1'/><feGaussianBlur stdDeviation='1'/><feColorMatrix type='matrix' values='0 0 0 0 0.0627451 0 0 0 0 0.0941176 0 0 0 0 0.156863 0 0 0 0.05 0'/><feBlend mode='normal' in2='BackgroundImageFix' result='effect1_dropShadow_143_6627'/><feBlend mode='normal' in='SourceGraphic' in2='effect1_dropShadow_143_6627' result='shape'/></filter></defs></svg></span>",
        responsive: [{
                breakpoint: 1023,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
})
</script>