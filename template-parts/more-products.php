   <?php $args = array(
        'post_type' => 'product',
        'posts_per_page' => 3,
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    );
    $product_query = new WP_Query($args);
    $product_query = $product_query->posts;
    ?>
   <div class="more-recommended bg-[#FAFBFC] px-[30px] lg:px-[40px] py-[40px] mt-[50px] rounded-[20px]">
       <h2 class="text-[#060843] text-center text-[24px] font-semibold leading-[24px] tracking-[-0.48px]">
           Add one of these to your order to get 10% off!</h2>
       <p class="text-[#060843] text-center text-[16px] mt-3">This special price is only available right now while
           you're
           checking out</p>

       <div id="" class="mt-[30px] flex-wrap lg:flex-nowrap gap-[20px] flex flex-col">
           <?php foreach ($product_query as $key => $item) :
                global $product;
                $product = wc_get_product($item->ID);
                $regular_price = wc_price($product->get_regular_price());
                $sale_price = wc_price($product->get_sale_price());
                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'full'); ?>
               <article class="flex gap-5">
                   <figure>
                       <a href="<?php echo esc_url(get_permalink($item->ID)); ?>">
                           <?php
                            $medium_image = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID), 'medium');
                            ?>
                           <img class="rounded-xl aspect-[0.8] object-cover w-[136px]"
                               src="<?php echo esc_url($medium_image[0]); ?>" alt="">
                       </a>
                   </figure>
                   <div
                       class="mt-0 flex flex-col justify-center <?php echo $current_url == "checkout" ? 'w-1/2' : 'w-[65%]' ?>">
                       <div class="flex items-center gap-[10px]">
                           <span class="stars"></span>
                           <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                               Reviews)</span>
                       </div>
                       <h3 class="text-rich-black font-semibold leading-[22px] text-[18px] ">
                           <a class="hover:underline" href="<?php echo esc_url(get_permalink($item->ID)); ?>">
                               <?php echo $product->get_name(); ?>
                           </a>
                       </h3>
                       <p class="text-gray-paragraph leading-[18px] text-[16px]">
                           <?php echo $product->get_short_description(); ?> </p>
                       <div class="flex items-center gap-[10px]">
                           <span
                               class="mr-4 text-red-500 text-[16px] lg:text-[18px] line-through"><?php echo $regular_price ?></span>
                           <span
                               class="text-[#13A513] font-semibold leading-[32px] text-[22px]"><?php echo $sale_price ?></span>
                       </div>
                       <div class="woocommerce-variation-add-to-cart variations_button">
                           <button type="submit"
                               class="add_to_cart_checkout custom_add_to_cart btn !w-full single_add_to_cart_button button !text-[14px]">+
                               Add to Cart</button>
                           <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
                           <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
                           <input type="hidden" name="variation_id" class="variation_id" value="0" />
                       </div>
                   </div>
               </article>
           <?php endforeach; ?>
       </div>
   </div>