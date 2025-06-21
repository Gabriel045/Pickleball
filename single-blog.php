<?php get_header(); ?>

<?php
$author_id = $post->post_author;
$author_name = get_the_author_meta('display_name', $author_id);
$read_time =  get_field('read_time');


$args = array(
    'post_type' => 'blog',
    'posts_per_page' => 2,
    'orderby' => 'rand'
);

$random_blogs = new WP_Query($args);
$random_blogs = $random_blogs->posts;


$most_selling_products = wc_get_products(array(
    'status' => 'publish',
    'limit' => 2,
    'orderby' => 'meta_value_num',
    'meta_key' => 'total_sales',
    'order' => 'DESC',
));

?>


<main id="shop">
    <section id="">
        <div class="block_content pt-[60px] lg:pt-[100px] pb-[60px] lg:pb-[180px] px-[30px] lg:px-[100px]">
            <div class="flex flex-wrap lg:flex-nowrap lg:gap-[80px]">
                <div class="w-full lg:w-[65%]">
                    <div class="subheader">
                        <div class="flex justify-between">
                            <div class="flex items-center gap-[10px]">
                                <p class="text-sm font-semibold text-[#47546799]">
                                    <?php echo esc_html($author_name); ?>
                                </p>
                                <span
                                    class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                                <p class="text-sm font-semibold text-[#47546799]">
                                    Updated on: <?php echo get_the_modified_date('M d, Y'); ?>
                                </p>
                            </div>
                            <div class="flex justify-end gap-[20px]">
                                <button type="button"
                                    class="w-[44px] h-[44px] rounded-full bg-[#ea6645] flex justify-center items-center relative group"
                                    aria-label="Copy Link" onclick="navigator.clipboard.writeText(window.location.href); 
                                        const tooltip = this.querySelector('.copy-tooltip'); 
                                        tooltip.classList.remove('hidden'); 
                                        setTimeout(() => tooltip.classList.add('hidden'), 1500);">
                                    <svg width="20" height="20" aria-hidden="true" focusable="false" data-prefix="fas"
                                        data-icon="link" class="svg-inline--fa fa-link css-ns878m" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="#fff"
                                            d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z">
                                        </path>
                                    </svg>
                                    <span
                                        class="copy-tooltip hidden fixed top-[160px] left-1/2 -translate-x-1/2 bg-[#0E375E] text-white text-lg rounded px-2 py-1 z-10 whitespace-nowrap">Link
                                        Copied</span>
                                </button>
                                <a class="bg-[#1A94DA] w-[44px] h-[44px] rounded-full flex justify-center items-center"
                                    href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>"
                                    target="_blank" role="button" aria-label="Share via Twitter">
                                    <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fab"
                                        data-icon="x-twitter" class="svg-inline--fa fa-x-twitter css-ns878m" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#fff"
                                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                                        </path>
                                    </svg>
                                </a>
                                <a class="w-[44px] h-[44px] rounded-full  bg-[#314E89] flex justify-center items-center"
                                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                    target="_blank" role="button" aria-label="Share via Facebook">
                                    <svg width="20" height="20" aria-hidden="true" focusable="false" data-prefix="fab"
                                        data-icon="facebook-f" class="svg-inline--fa fa-facebook-f css-ns878m"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="#fff"
                                            d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                                        </path>
                                    </svg>
                                </a>
                                <a class="w-[44px] h-[44px] rounded-full  bg-[#2d93ad] flex justify-center items-center"
                                    href="sms:?&amp;body=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                                    role="button" aria-label="Share via SMS">
                                    <svg width="20" height="20" aria-hidden="true" focusable="false" data-prefix="fas"
                                        data-icon="comment-sms" class="svg-inline--fa fa-comment-sms css-ns878m"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#fff"
                                            d="M256 448c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9c-5.5 9.2-11.1 16.6-15.2 21.6c-2.1 2.5-3.7 4.4-4.9 5.7c-.6 .6-1 1.1-1.3 1.4l-.3 .3 0 0 0 0 0 0 0 0c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c28.7 0 57.6-8.9 81.6-19.3c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9zM96 212.8c0-20.3 16.5-36.8 36.8-36.8H152c8.8 0 16 7.2 16 16s-7.2 16-16 16H132.8c-2.7 0-4.8 2.2-4.8 4.8c0 1.6 .8 3.1 2.2 4l29.4 19.6c10.3 6.8 16.4 18.3 16.4 30.7c0 20.3-16.5 36.8-36.8 36.8H112c-8.8 0-16-7.2-16-16s7.2-16 16-16h27.2c2.7 0 4.8-2.2 4.8-4.8c0-1.6-.8-3.1-2.2-4l-29.4-19.6C102.2 236.7 96 225.2 96 212.8zM372.8 176H392c8.8 0 16 7.2 16 16s-7.2 16-16 16H372.8c-2.7 0-4.8 2.2-4.8 4.8c0 1.6 .8 3.1 2.2 4l29.4 19.6c10.2 6.8 16.4 18.3 16.4 30.7c0 20.3-16.5 36.8-36.8 36.8H352c-8.8 0-16-7.2-16-16s7.2-16 16-16h27.2c2.7 0 4.8-2.2 4.8-4.8c0-1.6-.8-3.1-2.2-4l-29.4-19.6c-10.2-6.8-16.4-18.3-16.4-30.7c0-20.3 16.5-36.8 36.8-36.8zm-152 6.4L256 229.3l35.2-46.9c4.1-5.5 11.3-7.8 17.9-5.6s10.9 8.3 10.9 15.2v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V240l-19.2 25.6c-3 4-7.8 6.4-12.8 6.4s-9.8-2.4-12.8-6.4L224 240v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-6.9 4.4-13 10.9-15.2s13.7 .1 17.9 5.6z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <h1 class="text-[36px] font-semibold mt-[10px]"><?php the_title() ?></h1>
                    </div>
                    <div
                        class="text-gray-paragrah text-[16px] lg:text-[18px] leading-[28px] [_&_hr]:my-[24px]
                             [_&_ul]:my-[15px] [_&_ol]:my-[15px] [_&_ul]:list-decimal [_&_ul]:list-inside  
                             [_&_ol]:list-decimal [_&_ol]:list-inside
                           [_&_h4]:text-black [_&_h4]:text-[24px]  [_&_h4]:font-semibold  [_&_h4]:leading-[32px] [_&_h4]:my-[20px]
                           [_&_h3]:text-black [_&_h3]:text-[30px]  [_&_h3]:font-semibold  [_&_h3]:leading-[38px] [_&_h3]:my-[20px]
                           [_&_h2]:text-black [_&_h2]:text-[36px]  [_&_h2]:font-semibold  [_&_h2]:leading-[45px] [_&_h2]:my-[20px]
                             [_&_p]:pb-[15px] [_&_li]:pb-[10px] [_&_img]:rounded-[12px] [_&_img]:my-[40px] [_&_figcaption]:mt-[-30px]">
                        <?php the_content(); ?>
                    </div>
                    <div class="conclution p-[32px] rounded-[32px] bg-[#FAFBFC] mt-12  text-[16px] 
                        lg:text-[18px] text-gray-paragrah leading-[28px]
                        [_&_p]:pb-[15px] [_&_li]:pb-[10px]">
                        <h3 class="text-black text-[30px]  font-semibold  leading-[38px] mb-[20px]">Conclusion</h3>
                        <?php echo get_field('conclusion'); ?>
                    </div>
                </div>
                <div id="side-bar" class="w-full lg:w-[35%] p-[30px] rounded-[15px] bg-[#FAFBFC]">
                    <h3 class="text-center text-[25px] font-[700] text-[#060843] mb-[30px]">Related blogs</h3>
                    <div class="flex flex-col gap-[30px]">
                        <?php foreach ($random_blogs as $key => $card) : ?>
                            <article>
                                <figure>
                                    <img class="rounded-[10px]"
                                        src="<?php echo get_the_post_thumbnail_url($card->ID, "full") ?>">
                                </figure>
                                <div class="mt-2 flex gap-3">
                                    <p class="text-sm font-semibold text-[#47546799]">
                                        <?php echo get_the_author_meta('display_name', $card->post_author); ?> </p>
                                    <span
                                        class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                                    <p class="text-sm font-semibold text-[#47546799]">
                                        <?php echo get_the_date('d M Y', $card->ID); ?>
                                    </p>
                                </div>
                                <div class="flex justify-between">
                                    <a href="<?php echo get_permalink($card->ID); ?>">
                                        <h3 class="text-rich-black text-[24px] font-semibold leading-[32px]">
                                            <?php echo get_the_title($card->ID); ?>
                                        </h3>
                                    </a>
                                    <a href="<?php echo get_permalink($card->ID); ?>"
                                        class="hover:translate-x-[2px] hover:translate-y-[-2px] transition-transform">
                                        <svg xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#0B141D" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>
                                <p class="text-gray-paragrah text-[16px]">
                                    <?php echo get_the_excerpt($card->ID); ?>
                                </p>
                            </article>
                        <?php endforeach ?>
                    </div>
                    <h3 class="text-center text-[25px] font-[700] text-[#060843] mb-[30px] mt-[50px]">
                        Top Selling Courses
                    </h3>
                    <div class="flex flex-col gap-[30px]">
                        <?php foreach ($most_selling_products as $product) :
                            $regular_price = wc_price($product->get_regular_price());
                            $sale_price = wc_price($product->get_sale_price());
                        ?>
                            <article class="">
                                <figure>
                                    <a href="<?php echo get_permalink($product->get_id()); ?>" tabindex="0">
                                        <img decoding="async" class="rounded-xl"
                                            src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>">
                                    </a>
                                </figure>
                                <div class="mt-[24px]">
                                    <div class="flex items-center gap-[10px]">
                                        <span class="stars"></span>
                                        <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0
                                            (59
                                            Reviews)</span>
                                    </div>
                                    <h4 class="text-rich-black text-[20px] font-semibold leading-normal">
                                        <a href="<?php echo get_permalink($product->get_id()); ?>"
                                            class="text-rich-black hover:underline" tabindex="0">
                                            <?php echo $product->get_name(); ?>
                                        </a>
                                    </h4>
                                    <p class="text-gray-paragrah text-[16px] leading-normal">
                                        <?php echo wp_trim_words($product->get_short_description(), 15, '...'); ?>
                                    </p>
                                    <div class="my-[10px] flex items-center">
                                        <span
                                            class="mr-4 text-[#8498AB] text-[18px] line-through"><?php echo $regular_price ?></span>
                                        <span
                                            class="text-[#13A513] text-[28px] font-semibold leading-[32px]"><?php echo $sale_price ?></span>
                                    </div>

                                    <div class="woocommerce-variation-add-to-cart variations_button">
                                        <button type="submit"
                                            class="custom_add_to_cart btn !w-full single_add_to_cart_button button">+
                                            Add to Cart</button>
                                        <input type="hidden" name="add-to-cart"
                                            value="<?php echo absint($product->get_id()); ?>" />
                                        <input type="hidden" name="product_id"
                                            value="<?php echo absint($product->get_id()); ?>" />
                                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                                    </div>
                                </div>
                            </article>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>