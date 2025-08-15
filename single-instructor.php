<?php get_header(); ?>
<!-- instructor -->
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


$social_media = get_field('social_media');

?>


<main id="shop">
    <section class="bg-black">
        <div class="block_content px-[30px] lg:px-[50px] py-[20px]">
            <div class="flex flex-wrap lg:flex-nowrap lg:gap-[64px]">
                <div class="w-full lg:w-1/5  max-[1024px]:mb-14">
                    <figure>
                        <img loading="lazy" class="max-[1024px]:w-[150px] max-[1024px]:h-[150px]"
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
                        <span class="text-[#FFFFFF99] text-[14px] font-normal leading-[30px]">Nationality:
                            <span class="text-white text-[14px] font-bold leading-[30px]">
                                <?php echo get_field('nationality'); ?></span>
                        </span>
                    </div>
                    <p class="text-[#FFFFFF99] text-[14px] font-normal leading-[30px] my-2">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                    <p class="text-white text-[18px] font-semibold leading-[28px]">
                        Checkout Videos from <?php echo get_the_title(); ?> Below
                    </p>
                    <div class="flex gap-[15px] mt-4">
                        <?php if (!empty($social_media['instagram']['url'])) : ?>
                            <a target="_blank" href="<?php echo $social_media['instagram']['url']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 13 13"
                                    fill="none">
                                    <path
                                        d="M6.87279 4.91031C6.473 4.91031 6.08959 5.06912 5.8069 5.35181C5.52421 5.6345 5.3654 6.01791 5.3654 6.4177C5.3654 6.81748 5.52421 7.20089 5.8069 7.48358C6.08959 7.76627 6.473 7.92509 6.87279 7.92509C7.27257 7.92509 7.65598 7.76627 7.93867 7.48358C8.22136 7.20089 8.38018 6.81748 8.38018 6.4177C8.38018 6.01791 8.22136 5.6345 7.93867 5.35181C7.65598 5.06912 7.27257 4.91031 6.87279 4.91031ZM6.87279 3.90538C7.5391 3.90538 8.17811 4.17007 8.64926 4.64122C9.12042 5.11237 9.3851 5.75139 9.3851 6.4177C9.3851 7.084 9.12042 7.72302 8.64926 8.19417C8.17811 8.66532 7.5391 8.93001 6.87279 8.93001C6.20648 8.93001 5.56746 8.66532 5.09631 8.19417C4.62516 7.72302 4.36047 7.084 4.36047 6.4177C4.36047 5.75139 4.62516 5.11237 5.09631 4.64122C5.56746 4.17007 6.20648 3.90538 6.87279 3.90538ZM10.1388 3.77977C10.1388 3.94634 10.0726 4.1061 9.95484 4.22388C9.83705 4.34167 9.6773 4.40784 9.51072 4.40784C9.34414 4.40784 9.18439 4.34167 9.0666 4.22388C8.94881 4.1061 8.88264 3.94634 8.88264 3.77977C8.88264 3.61319 8.94881 3.45343 9.0666 3.33565C9.18439 3.21786 9.34414 3.15169 9.51072 3.15169C9.6773 3.15169 9.83705 3.21786 9.95484 3.33565C10.0726 3.45343 10.1388 3.61319 10.1388 3.77977ZM6.87279 2.39799C5.6297 2.39799 5.4267 2.40151 4.84837 2.42714C4.45443 2.44573 4.19014 2.49849 3.94494 2.59395C3.73985 2.66951 3.55438 2.79023 3.40228 2.94718C3.24514 3.09924 3.12424 3.28471 3.04854 3.48984C2.95307 3.73605 2.90032 3.99984 2.88223 4.39327C2.8561 4.94799 2.85258 5.14194 2.85258 6.4177C2.85258 7.66129 2.8561 7.86379 2.88173 8.44212C2.90032 8.83555 2.95307 9.10035 3.04804 9.34505C3.13346 9.56362 3.23395 9.72089 3.40077 9.88771C3.5701 10.0565 3.72737 10.1575 3.94343 10.2409C4.19165 10.3369 4.45594 10.3902 4.84786 10.4083C5.40258 10.4344 5.59653 10.4374 6.87229 10.4374C8.11588 10.4374 8.31838 10.4339 8.89671 10.4083C9.28964 10.3897 9.55393 10.3369 9.79964 10.2419C10.0047 10.1664 10.1902 10.0457 10.3423 9.88871C10.5116 9.71988 10.6126 9.56261 10.696 9.34605C10.7915 9.09884 10.8448 8.83454 10.8628 8.44162C10.889 7.8874 10.892 7.69295 10.892 6.4177C10.892 5.1746 10.8885 4.97161 10.8628 4.39327C10.8443 4.00035 10.791 3.73505 10.696 3.48984C10.6205 3.28476 10.4998 3.09929 10.3428 2.94718C10.1907 2.79005 10.0053 2.66915 9.80014 2.59345C9.55393 2.49798 9.28964 2.44522 8.89671 2.42714C8.34249 2.40101 8.14854 2.39799 6.87229 2.39799M6.87229 1.39307C8.23748 1.39307 8.40781 1.39809 8.94394 1.42321C9.47856 1.44834 9.84335 1.53225 10.1634 1.65686C10.495 1.78449 10.7744 1.95733 11.0538 2.2362C11.3094 2.4873 11.5071 2.79116 11.6331 3.12656C11.7572 3.44663 11.8416 3.81142 11.8668 4.34654C11.8904 4.88217 11.8969 5.0525 11.8969 6.4177C11.8969 7.78289 11.8919 7.95322 11.8668 8.48885C11.8416 9.02448 11.7572 9.38826 11.6331 9.70883C11.5071 10.0442 11.3094 10.3481 11.0538 10.5992C10.8027 10.8548 10.4988 11.0525 10.1634 11.1785C9.84335 11.3026 9.47856 11.3871 8.94394 11.4122C8.40781 11.4358 8.23748 11.4423 6.87229 11.4423C5.50709 11.4423 5.33676 11.4373 4.80063 11.4122C4.26601 11.3871 3.90173 11.3026 3.58115 11.1785C3.24575 11.0525 2.94189 10.8548 2.69079 10.5992C2.43519 10.3481 2.23748 10.0442 2.11145 9.70883C1.98684 9.38876 1.90293 9.02397 1.8778 8.48885C1.85369 7.95322 1.84766 7.78289 1.84766 6.4177C1.84766 5.0525 1.85268 4.88217 1.8778 4.34654C1.90293 3.81092 1.98684 3.44714 2.11145 3.12656C2.23748 2.79116 2.43519 2.4873 2.69079 2.2362C2.94189 1.9806 3.24575 1.78289 3.58115 1.65686C3.90122 1.53225 4.26551 1.44834 4.80063 1.42321C5.33726 1.3996 5.5076 1.39307 6.87279 1.39307"
                                        fill="white"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($social_media['x']['url'])) : ?>
                            <a target="_blank" href="<?php echo $social_media['x']['url']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 12 12"
                                    fill="none">
                                    <g clip-path="url(#clip0_27_9701)">
                                        <mask id="mask0_27_9701" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="12" height="12">
                                            <path d="M0.330078 0.963379H11.2379V11.8712H0.330078V0.963379Z" fill="white">
                                            </path>
                                        </mask>
                                        <g mask="url(#mask0_27_9701)">
                                            <path
                                                d="M8.91997 1.47461H10.5928L6.93864 5.66164L11.2379 11.3602H7.87204L5.23391 7.90475L2.21868 11.3602H0.544338L4.45245 6.8802L0.330078 1.47539H3.78162L6.16263 4.63319L8.91997 1.47461ZM8.33173 10.3567H9.25889L3.27518 2.42592H2.28102L8.33173 10.3567Z"
                                                fill="white"></path>
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_27_9701">
                                            <rect width="10.9078" height="10.9078" fill="white"
                                                transform="translate(0.330078 0.963379)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($social_media['tiktok']['url'])) : ?>

                            <a target="_blank" href="<?php echo $social_media['tiktok']['url']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 11 11"
                                    fill="none">
                                    <g clip-path="url(#clip0_27_9712)">
                                        <path
                                            d="M8.26237 2.72093C8.19873 2.68811 8.13682 2.65205 8.07688 2.6129C7.90248 2.49772 7.74263 2.36191 7.6008 2.20841C7.2453 1.80184 7.11257 1.3894 7.064 1.10091H7.06567C7.02506 0.86098 7.04181 0.706055 7.04474 0.706055H5.42639V6.96296C5.42695 7.0467 5.42584 7.12975 5.42304 7.21209L5.42137 7.24266C5.42137 7.24713 5.42095 7.25173 5.42011 7.25648V7.26025C5.40312 7.48469 5.33122 7.70151 5.21075 7.89164C5.09027 8.08177 4.92492 8.23938 4.72923 8.35059C4.52527 8.46721 4.29423 8.52814 4.05928 8.52729C3.30559 8.52729 2.69426 7.91261 2.69426 7.15347C2.69426 6.39434 3.30559 5.77924 4.05928 5.77924C4.20206 5.77924 4.34401 5.80185 4.47967 5.84624L4.48177 4.19816C4.06975 4.14506 3.65121 4.17792 3.25253 4.29467C2.85386 4.41141 2.4837 4.60952 2.16542 4.87649C1.8866 5.11883 1.6521 5.40788 1.47244 5.73067C1.40419 5.84833 1.14626 6.3219 1.11527 7.08983C1.09559 7.5253 1.22665 7.97751 1.28904 8.16384V8.16803C1.32798 8.27773 1.4804 8.6529 1.72828 8.96903C1.92837 9.2226 2.16452 9.44549 2.42921 9.63061V9.62642L2.43298 9.63061C3.21598 10.1624 4.08482 10.1276 4.08482 10.1276C4.23514 10.1213 4.73886 10.1276 5.31083 9.85672C5.94519 9.55608 6.30612 9.10847 6.30612 9.10847C6.53708 8.8411 6.72061 8.53621 6.84878 8.20697C6.99533 7.82175 7.0439 7.36032 7.0439 7.17608V3.85607C7.06358 3.86779 7.32528 4.04072 7.32528 4.04072C7.32528 4.04072 7.70213 4.28232 8.28959 4.43934C8.71082 4.55114 9.27902 4.57501 9.27902 4.57501V2.96839C9.08013 2.99016 8.67606 2.92735 8.26195 2.72134"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_27_9712">
                                            <rect width="10.0492" height="10.0492" fill="white"
                                                transform="translate(0.171875 0.392578)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($social_media['facebook']['url'])) : ?>
                            <a target="_blank" href="<?php echo $social_media['facebook']['url']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 13 13"
                                    fill="none">
                                    <path
                                        d="M11.0532 6.4177C11.0532 3.6441 8.80213 1.39307 6.02854 1.39307C3.25494 1.39307 1.00391 3.6441 1.00391 6.4177C1.00391 8.84962 2.73238 10.8745 5.02361 11.3418V7.92509H4.01868V6.4177H5.02361V5.16154C5.02361 4.19179 5.81248 3.40292 6.78223 3.40292H8.03839V4.91031H7.03346C6.75711 4.91031 6.531 5.13642 6.531 5.41277V6.4177H8.03839V7.92509H6.531V11.4172C9.06844 11.166 11.0532 9.02548 11.0532 6.4177Z"
                                        fill="white"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="block_content">
            <div class="flex flex-wrap lg:flex-nowrap">
                <!-- <div class="block lg:hidden py-[60px] px-[30px] w-full">
                    <form class="search-videos flex relative gap-4">
                        <input type="text"
                            class="w-full border border-[#D0D5DD] rounded-[8px] px-3 py-3 text-gray-paragraph"
                            placeholder="Search">
                        <button type="submit"
                            class="flex items-center gap-2 bg-black rounded-[8px] px-[18px] py-[10px] text-white font-semibold">
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
                    <h3 class="text-caribbean-green  font-semibold mb-5 flex justify-between">
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
                    </h3>
                    <ul id="video-categories">
                        <?php foreach ($course_categories as $key => $cat) {
                            echo '<li class="py-[10px]"><a value="' . $cat . '" class="cursor-pointer text-gray-paragraph font-semibold">' . $cat . '</a></li>';
                        } ?>
                    </ul>
                </div> -->
                <div class="w-full py-[60px] lg:py-[100px] px-[30px] lg:px-[60px]">
                    <div class="hidden gap-8 gap-y-4 flex-wrap">
                        <form class="search-videos w-full md:w-[75%] search-videos flex relative gap-4">
                            <input type="text"
                                class="w-full border border-[#D0D5DD] rounded-[8px] px-3 py-3 text-gray-paragraph"
                                placeholder="Search">
                            <input type="hidden" name="instructor_id" value="<?php echo get_the_ID(); ?>">
                            <button type="submit"
                                class="flex items-center gap-2 bg-black rounded-[8px] px-[18px] py-[10px] text-white font-semibold">
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
                        <div class="select-wrapper w-fit md:w-[22%] lg:justify-end justify-start flex relative">
                            <select id="video-categories"
                                class="border border-[#D0D5DD] rounded-[8px] px-5 py-3 text-gray-paragraph font-semibold pr-8">
                                <option value="">Select Category</option>
                                <?php foreach ($course_categories as $key => $cat) {
                                    echo '<option value="' . esc_attr($cat) . '">' . esc_html($cat) . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div id="videos-container" class="flex  flex-wrap gap-[2%] gap-y-10 lg:gap-y-[60px]"></div>
                        <!-- print videos -->
                    </div>
                </div>
            </div>
    </section>
</main>



<?php get_footer(); ?>