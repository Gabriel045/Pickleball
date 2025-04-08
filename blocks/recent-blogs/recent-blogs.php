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
    <div class="block_content py-[60px] px-[60px]">
        <p class="text-[#0C5E5D] text-2xl font-semibold leading-8 mb-8">Recent blog posts</p>
        <div class="flex w-full gap-[32px]">
            <div class="w-1/2">
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
                </div>
                <div class="flex justify-between my-3">
                    <h3 class="text-rich-black text-[24px] font-semibold leading-[32px]">
                        <?php echo get_the_title($recent_blogs[0]->ID); ?></h3>
                    <a href="<?php echo get_permalink($recent_blogs[0]->ID); ?>"
                        class="hover:translate-x-[2px] hover:translate-y-[-2px] transition-transform">
                        <svg xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#0B141D" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <p class="text-gray-paragrah text-[16px]">
                    <?php echo get_the_excerpt($recent_blogs[0]->ID); ?>
                </p>
            </div>
            <div class="w-1/2 flex flex-col gap-[32px] ">
                <?php for ($i = 1; $i < count($recent_blogs); $i++) : ?>
                <div class="flex gap-[24px]">
                    <figure class="w-1/2">
                        <a href="<?php echo get_permalink($recent_blogs[$i]->ID); ?>">
                            <img class="rounded-[20px]"
                                src="<?php echo get_the_post_thumbnail_url($recent_blogs[$i]->ID, 'full') ?>">
                        </a>
                    </figure>
                    <div class="w-1/2">
                        <div class="flex gap-3">
                            <p class="text-sm font-semibold text-[#47546799]">
                                <?php echo get_the_author_meta('display_name', $recent_blogs[$i]->post_author); ?>
                            </p>
                            <span
                                class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                            <p class="text-sm font-semibold text-[#47546799]">
                                <?php echo get_the_date('d M Y', $recent_blogs[$i]->ID); ?>
                            </p>
                        </div>
                        <h3 class="text-rich-black text-[20px] font-semibold leading-[28px] mt-2">
                            <a href="<?php echo get_permalink($recent_blogs[$i]->ID); ?>" class="hover:underline">
                                <?php echo get_the_title($recent_blogs[$i]->ID); ?>
                            </a>
                        </h3>
                        <p class="text-gray-paragrah text-[16px] mt-2">
                            <?php echo get_the_excerpt($recent_blogs[$i]->ID); ?>
                        </p>
                    </div>
                </div>
                <?php endfor ?>
            </div>
        </div>
    </div>
</section>