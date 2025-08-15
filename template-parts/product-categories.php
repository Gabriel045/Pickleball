<?php
/*
Template Name: Product Categories
Description: A template to display product categories and videos.
*/


get_header();


$categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
)); ?>

<main id="shop">
    <section class="bg-black">
        <div class="block_content px-[60px] lg:px-[100px] py-[64px]">
            <h1 class="text-[36px] text-white font-semibold tracking-tight">All Videos</h1>
        </div>
    </section>
    <section>
        <div class="block_content">
            <div class="flex flex-wrap lg:flex-nowrap">
                <div class="w-full py-[30px] px-[30px] lg:px-[60px]">
                    <div class="flex gap-8 gap-y-4 flex-wrap">
                        <form class="w-full md:w-[83%] search-videos flex relative gap-4">
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
                        <div class="select-wrapper w-fit md:w-[14%] lg:justify-end justify-start flex relative">
                            <select id="video-categories"
                                class="border border-[#D0D5DD] rounded-[8px] px-5 py-3 text-gray-paragraph font-semibold pr-8">
                                <option value="">Select Skill Level</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>

                    </div>
                    <div class="mt-20">
                        <div id="videos-container" class="flex  flex-wrap gap-[2%] gap-y-10 lg:gap-y-[60px]"></div>
                        <!-- print videos -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>