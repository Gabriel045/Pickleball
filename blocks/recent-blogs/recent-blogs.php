<?php
$args = array(
    'post_type' => 'blog',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC'
);

$recent_blogs = new WP_Query($args);
$recent_blogs = $recent_blogs->posts;
?>

<section id="recent-blog_posts" class="">
    <div class="block_content py-[60px] px-[30px] lg:px-[60px]">
        <h3 class=" text-[36px] font-semibold leading-8 mb-8">Recent blog posts</h3>
        <div class="flex flex-wrap lg:flex-nowrap w-full gap-[32px]">
            <div class="w-full lg:w-1/2">
                <figure>
                    <img class="rounded-[20px]"
                        src="<?php echo get_the_post_thumbnail_url($recent_blogs[0]->ID, 'full') ?>">
                </figure>
                <div class="mt-6 flex gap-3">
                    <p class="text-sm font-semibold text-[#47546799]">
                        <?php echo get_the_author_meta('display_name', $recent_blogs[0]->post_author); ?>
                    </p>
                    <span class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                    <p class="text-sm font-semibold text-[#47546799]">
                        <?php echo get_the_date('d M Y', $recent_blogs[0]->ID); ?>
                    </p>
                    <?php if (!empty(get_field('read_time', $recent_blogs[0]->ID))) : ?>
                        <span class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                        <p class="text-sm font-semibold text-[#47546799]">
                            Read Time:
                            <?php echo  get_field('read_time', $recent_blogs[0]->ID) ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="flex justify-between my-3">
                    <a href="<?php echo get_permalink($recent_blogs[0]->ID); ?>"
                        class="flex justify-between w-full group ">
                        <h3 class="text-rich-black text-[24px] font-semibold leading-[32px]">
                            <?php echo get_the_title($recent_blogs[0]->ID); ?></h3>
                        <svg class="group-hover:translate-x-[2px] group-hover:translate-y-[-2px] transition-transform"
                            xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#0B141D" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <p class="text-gray-paragraph text-[16px]">
                    <?php echo get_the_excerpt($recent_blogs[0]->ID); ?>
                </p>
            </div>
            <div class="w-full lg:w-1/2 flex flex-col gap-[32px] ">
                <?php for ($i = 1; $i < count($recent_blogs); $i++) : ?>
                    <div class="flex lg:flex-nowrap flex-wrap gap-[24px]">
                        <figure class="w-full lg:w-1/2">
                            <a href="<?php echo get_permalink($recent_blogs[$i]->ID); ?>">
                                <img class="rounded-[20px]"
                                    src="<?php echo get_the_post_thumbnail_url($recent_blogs[$i]->ID, 'full') ?>">
                            </a>
                        </figure>
                        <div class="w-full lg:w-1/2">
                            <div class="flex gap-2">
                                <p class="text-xs font-semibold text-[#47546799]">
                                    <?php echo get_the_author_meta('display_name', $recent_blogs[$i]->post_author); ?>
                                </p>
                                <span
                                    class="text-xs font-semibold text-[#47546799] flex justify-center items-center">•</span>
                                <p class="text-xs font-semibold text-[#47546799]">
                                    <?php echo get_the_date('d M Y', $recent_blogs[$i]->ID); ?>
                                </p>
                                <?php if (!empty(get_field('read_time',  $recent_blogs[$i]->ID))) : ?>
                                    <span
                                        class="text-xs font-semibold text-[#47546799] flex justify-center items-center">•</span>
                                    <p class="text-xs font-semibold text-[#47546799]">
                                        Read Time:
                                        <?php echo  get_field('read_time', $recent_blogs[$i]->ID) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-rich-black text-[20px] font-semibold leading-[28px] mt-2">
                                <a href="<?php echo get_permalink($recent_blogs[$i]->ID); ?>" class="hover:underline">
                                    <?php echo get_the_title($recent_blogs[$i]->ID); ?>
                                </a>
                            </h3>
                            <p class="text-gray-paragraph text-[18px] mt-2">
                                <?php
                                $excerpt = get_the_excerpt($recent_blogs[$i]->ID);
                                $words = explode(' ', wp_strip_all_tags($excerpt));
                                if (count($words) > 20) {
                                    $excerpt = implode(' ', array_slice($words, 0, 20)) . '...';
                                }
                                echo $excerpt;
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endfor ?>
            </div>
        </div>
    </div>
</section>