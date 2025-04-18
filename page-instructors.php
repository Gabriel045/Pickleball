<?php get_header(); ?>

<main>
    <section
        style="background: linear-gradient(358deg, #0E375E 1.21%, #0B2C4A 98.39%), linear-gradient(180deg, #060843 0%, #02031B 100%)">
        <div class="block_content px-[60px] lg:px-[100px] py-[64px]">
            <h1 class="text-[30px] lg:text-[36px] text-white font-semibold tracking-tight ">All Instructors</h1>
        </div>
    </section>
    <section>
        <div class="block_content py-[30px] lg:py-[100px] px-[30px] lg:px-[60px]">
            <form id="search-instructors" class="relative flex gap-4">
                <input type="text" class="w-full border border-[#D0D5DD] rounded-[8px] px-3 py-3 text-gray-paragrah"
                    placeholder="Search">
                <button type="submit"
                    class="flex items-center gap-2 bg-[#0E375E] rounded-[8px] px-[18px] py-[10px] text-white font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                        <path
                            d="M16 16.5L13.0834 13.5833M15.1667 8.58333C15.1667 12.4954 11.9954 15.6667 8.08333 15.6667C4.17132 15.6667 1 12.4954 1 8.58333C1 4.67132 4.17132 1.5 8.08333 1.5C11.9954 1.5 15.1667 4.67132 15.1667 8.58333Z"
                            stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Search
                </button>
            </form>
            <div class="mt-20">
                <div id="instructor-container" class="flex flex-wrap gap-[2%] gap-y-[80px]"></div>
                <!-- print videos -->
            </div>
        </div>
    </section>

</main>





<?php get_footer(); ?>