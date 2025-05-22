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
    <section class="lg:min-h-[360px]"
        style="background: linear-gradient(358deg, rgba(14, 55, 94, 0.50) 1.21%, rgba(11, 44, 74, 0.50) 98.39%), url('/wp-content/uploads/2025/04/7ac67b2fee68763562dbaaf5e43ec5bd.jpeg') no-repeat center center / cover;">
        <div class="block_content px-[30px] lg:px-[100px] py-[60px] lg:py-[100px] flex flex-col justify-center">
            <h1 class="text-[30px] lg:text-[36px] text-white font-semibold tracking-tight">
                <?php the_title(); ?>
            </h1>
            <p class="my-[24px] text-[#FFFFFF99] text-[14px] font-normal leading-[30px]">
                <?php echo get_the_excerpt(); ?>
            </p>
            <p class="text-white font-inter text-[16px] lg:text-[18px] font-semibold leading-[28px]">
                <?php echo $author_name ?> • <?php echo get_the_date('d M Y'); ?>
            </p>
            <p class="text-white font-inter text-[12px] lg:text-[14px] font-semibold leading-[28px]">
                Estimate read time: <?php echo $read_time ?>
            </p>
        </div>
    </section>
    <section id="">
        <div class="block_content pt-[60px] lg:pt-[100px] pb-[60px] lg:pb-[180px] px-[30px] lg:px-[100px]">
            <div class="flex flex-wrap lg:flex-nowrap lg:gap-[80px]">
                <div class="w-full lg:w-[65%]">
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
                        <?php foreach ($most_selling_products as $product) : ?>
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
                                    <div class="my-[15px] flex items-center">
                                        <span
                                            class="mr-4 text-[#8498AB] text-[18px] line-through">$<?php echo $product->get_price() * 2 ?></span>
                                        <span
                                            class="text-[#13A513] text-[28px] font-semibold leading-[32px]"><?php echo $product->get_price_html() ?></span>
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