<?php get_header(); ?>


<?php
$args = array(
    'post_type' => 'blog',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
);

$query = new WP_Query($args);

$recent_blogs = $query->posts;

?>

<main id="shop">
    <section class="bg-black">
        <div class="block_content px-[60px] lg:px-[100px] py-[64px]">
            <h1 class="text-[36px] text-white font-semibold tracking-tight">All Articles</h1>
        </div>
    </section>
    <section>
        <div class="block_content">
            <div class="py-[30px] px-[30px] lg:px-[60px]">
                <form id="search-blogs" class="relative flex gap-4">
                    <input type="text"
                        class="w-full border border-[#D0D5DD] rounded-[8px] px-3 py-3 text-gray-paragraph"
                        placeholder="Search">
                    <button type="submit"
                        class="flex items-center gap-2  bg-black rounded-[8px] px-[18px] py-[10px] text-white font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                            <path
                                d="M16 16.5L13.0834 13.5833M15.1667 8.58333C15.1667 12.4954 11.9954 15.6667 8.08333 15.6667C4.17132 15.6667 1 12.4954 1 8.58333C1 4.67132 4.17132 1.5 8.08333 1.5C11.9954 1.5 15.1667 4.67132 15.1667 8.58333Z"
                                stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Search
                    </button>
                </form>
                <div class="mt-20">
                    <div id="videos-container" class="flex flex-wrap gap-[2%] gap-y-[80px]"></div>
                    <!-- print videos -->
                </div>

                <div class="flex w-full flex-wrap md:flex-nowrap gap-[32px] pb-[60px]">
                    <div class="w-full md:w-1/2">
                        <figure>
                            <a href="<?php echo get_permalink($recent_blogs[0]->ID); ?>">
                                <img loading="lazy" class="rounded-[20px] object-cover w-full"
                                    src="<?php echo get_the_post_thumbnail_url($recent_blogs[0]->ID, 'full') ?>">
                            </a>
                        </figure>
                        <div class="mt-6 flex gap-2">
                            <p class="text-sm font-semibold text-[#47546799]">
                                <?php echo get_the_author_meta('display_name', $recent_blogs[0]->post_author); ?>
                            </p>
                            <span
                                class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                            <p class="text-sm font-semibold text-[#47546799]">
                                <?php echo get_the_date('d M Y', $recent_blogs[0]->ID); ?>
                            </p>
                            <?php if (!empty(get_field('read_time',  $recent_blogs[0]->ID))) : ?>
                                <span
                                    class="text-sm font-semibold text-[#47546799] flex justify-center items-center">•</span>
                                <p class="text-sm font-semibold text-[#47546799]">
                                    Read Time:
                                    <?php echo  get_field('read_time', $recent_blogs[0]->ID) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="flex justify-between my-3">
                            <a href="<?php echo get_permalink($recent_blogs[0]->ID); ?>">
                                <h3 class="text-rich-black text-[24px] font-semibold leading-[32px]">
                                    <?php echo get_the_title($recent_blogs[0]->ID); ?></h3>
                            </a>
                            <a href="<?php echo get_permalink($recent_blogs[0]->ID); ?>"
                                class="hover:translate-x-[2px] hover:translate-y-[-2px] transition-transform mt-[5px]">
                                <svg xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#0B141D" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <p class="text-gray-paragraph text-[16px]">
                            <?php echo get_the_excerpt($recent_blogs[0]->ID); ?>
                        </p>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col gap-[32px] ">
                        <?php for ($i = 1; $i < 3; $i++) : ?>
                            <div class="flex flex-wrap md:flex-nowrap gap-[24px]">
                                <figure class="w-full md:w-1/2">
                                    <a href="<?php echo get_permalink($recent_blogs[$i]->ID); ?>">
                                        <img loading="lazy" class="rounded-[20px] object-cover"
                                            src="<?php echo get_the_post_thumbnail_url($recent_blogs[$i]->ID, 'full') ?>">
                                    </a>
                                </figure>
                                <div class="w-full md:w-1/2">
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
                                        <a href="<?php echo get_permalink($recent_blogs[$i]->ID); ?>"
                                            class="hover:underline">
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
                <div id="blogs-container" class="flex flex-wrap gap-[2%] md:mt-[60px] gap-y-[60px]">

                </div>
            </div>
    </section>
</main>



<?php get_footer(); ?>