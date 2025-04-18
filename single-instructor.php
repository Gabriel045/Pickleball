<?php get_header(); ?>

<?php
$categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
));

$courses = get_field('courses', $id);

$course_categories = array();

if ($courses && is_array($courses)) {
    foreach ($courses as $course) {
        $categories = wp_get_post_terms($course, 'product_cat');
        foreach ($categories as $category) {
            $course_categories[] = $category->name;
        }
    }
}

$course_categories = array_unique($course_categories); // Remove duplicates

// echo "<pre>";
// var_dump($course_categories);
// echo "</pre>";
?>


<main id="shop">
    <section
        style="background: linear-gradient(358deg, #0E375E 1.21%, #0B2C4A 98.39%), linear-gradient(180deg, #060843 0%, #02031B 100%)">
        <div class="block_content  px-[30px] lg:px-[100px] py-[64px]">
            <div class="flex flex-wrap lg:flex-nowrap lg:gap-[64px]">
                <div class="w-full lg:w-1/5  max-[1024px]:mb-14">
                    <figure>
                        <img class="max-[1024px]:w-[150px] max-[1024px]:h-[150px]"
                            src="<?php echo get_the_post_thumbnail_url($post, 'full') ?>" alt="intructor_imagen"
                            class="w-[300px] rounded-[15px]">
                    </figure>
                </div>
                <div class="w-full lg:w-4/5 flex flex-col justify-center">
                    <div class="flex flex-wrap lg:flex-nowrap gap-[15px] items-center">
                        <h1
                            class="max-[1024px]:w-full text-white text-[30px] lg:text-[36px] font-semibold tracking-[-0.72px]">
                            <?php echo get_the_title(); ?></h1>
                        <span class="text-[#FFFFFF99] text-[14px] font-normal leading-[30px]">Age:
                            <span class="text-white text-[14px] font-bold leading-[30px]">
                                <?php echo get_field('age'); ?></span>
                        </span>
                        <span class="text-[#FFFFFF99] text-[14px] font-normal leading-[30px]">Height:
                            <span class="text-white text-[14px] font-bold leading-[30px]">
                                <?php echo get_field('height'); ?></span>
                        </span>
                    </div>
                    <p class="text-[#FFFFFF99] text-[14px] font-normal leading-[30px] my-[20px]">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                    <p class="text-white text-[18px] font-semibold leading-[28px]">
                        Checkout Videos from <?php echo get_the_title(); ?> Below
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="block_content">
            <div class="flex flex-wrap lg:flex-nowrap">
                <div class="block lg:hidden py-[60px] px-[30px] w-full">
                    <form class="search-videos flex relative gap-4">
                        <input type="text"
                            class="w-full border border-[#D0D5DD] rounded-[8px] px-3 py-3 text-gray-paragrah"
                            placeholder="Search">
                        <button type="submit"
                            class="flex items-center gap-2 bg-[#0E375E] rounded-[8px] px-[18px] py-[10px] text-white font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18"
                                fill="none">
                                <path
                                    d="M16 16.5L13.0834 13.5833M15.1667 8.58333C15.1667 12.4954 11.9954 15.6667 8.08333 15.6667C4.17132 15.6667 1 12.4954 1 8.58333C1 4.67132 4.17132 1.5 8.08333 1.5C11.9954 1.5 15.1667 4.67132 15.1667 8.58333Z"
                                    stroke="white" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Search
                        </button>
                    </form>
                </div>
                <div
                    class="w-full lg:w-1/4 bg-[#FAFBFC] py-[30px] lg:py-[100px] px-[30px] xl:px-[50px] max-[1024px]:mx-[30px] max-[1024px]:rounded-[20px]">
                    <p class="text-caribbean-green  font-semibold mb-5 flex justify-between">
                        Categories
                        <span id="open-close" class="block lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="24" y="24" width="24" height="24" rx="12" transform="rotate(180 24 24)"
                                    fill="#E9EAED" fill-opacity="0.866667" />
                                <path d="M17 14L12 9L7 14" stroke="#404D61" stroke-opacity="0.6" stroke-width="1.66667"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </p>
                    <ul id="video-categories">
                        <?php foreach ($course_categories as $key => $cat) {
                            echo '<li class="py-[10px]"><a value="' . $cat . '" class="cursor-pointer text-gray-paragrah font-semibold">' . $cat . '</a></li>';
                        } ?>
                    </ul>
                </div>
                <div class="w-full lg:w-3/4 py-[60px] lg:py-[100px] px-[30px] lg:px-[60px]">
                    <form class="search-videos hidden lg:flex relative gap-4">
                        <input type="text"
                            class="w-full border border-[#D0D5DD] rounded-[8px] px-3 py-3 text-gray-paragrah"
                            placeholder="Search">
                        <input type="hidden" name="instructor_id" value="<?php echo get_the_ID(); ?>">
                        <button type="submit"
                            class="flex items-center gap-2 bg-[#0E375E] rounded-[8px] px-[18px] py-[10px] text-white font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18"
                                fill="none">
                                <path
                                    d="M16 16.5L13.0834 13.5833M15.1667 8.58333C15.1667 12.4954 11.9954 15.6667 8.08333 15.6667C4.17132 15.6667 1 12.4954 1 8.58333C1 4.67132 4.17132 1.5 8.08333 1.5C11.9954 1.5 15.1667 4.67132 15.1667 8.58333Z"
                                    stroke="white" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Search
                        </button>
                    </form>
                    <div class="lg:mt-20">
                        <div id="videos-container" class="flex flex-wrap gap-[2%] gap-y-10 lg:gap-y-[80px]"></div>
                        <!-- print videos -->
                    </div>
                </div>
            </div>
    </section>
</main>



<?php get_footer(); ?>