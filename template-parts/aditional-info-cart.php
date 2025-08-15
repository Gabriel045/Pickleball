<div class="px-[10px] lg:px-[40px] pt-[40px] ">
    <div class="flex items-center gap-3">
        <span class="w-[45%] h-[1px] bg-gray-200"></span>
        <p class="text-center w-full font-semibold">Why buy from Pickleball Hub</p>
        <span class="w-[45%] h-[1px] bg-gray-200"></span>
    </div>
    <div class="flex gap-4 mt-8">
        <figure class="w-[24%]">
            <img loading="lazy" class="w-[80px] h-[80px]"
                src="<?php echo get_template_directory_uri(); ?>/assets/images/logo money back.webp"
                alt="Money Back Guarantee">
        </figure>
        <div class="w-[76%]">
            <p class="font-[500]">30 Day Money Back Guarantee </p>
            <p>If you’re not completely satisfied, we’ll refund your
                purchase within 30 days—no questions asked.</p>
        </div>
    </div>

    <div class="flex gap-4 mt-6">
        <figure class="w-[24%]">
            <img loading="lazy" class="w-[80px] h-[80px]" src="<?php echo get_template_directory_uri(); ?>/assets/images/unlock.webp"
                alt="Unlock">
        </figure>
        <div class="w-[76%]">
            <p class="font-[500]">Trusted by Pickleball Players Worldwide </p>
            <p>Thousands of players, from beginners to pros, train with our instructionals. Join a growing global
                community leveling up their game.</p>
        </div>
    </div>

    <?php if (is_page('checkout')): ?>
        <div class="flex items-center gap-3 mt-10">
            <span class="w-[45%] h-[1px] bg-gray-200"></span>
            <p class="text-center w-full font-semibold">Real Customer Reviews</p>
            <span class="w-[45%] h-[1px] bg-gray-200"></span>
        </div>

        <div class="mt-6">
            <span class="stars before:w-[117px] before:h-[20px]"></span>
            <p class="mt-2">"Excellent quality and fast shipping. Highly recommend for any pickleball enthusiast!"</p>
        </div>
        <div class="mt-6">
            <span class="stars before:w-[117px] before:h-[20px]"></span>
            <p class="mt-2">"Great customer service and top-notch products. I noticed an improvement in my game right away!"
            </p>
        </div>
        <div class="mt-6">
            <span class="stars before:w-[117px] before:h-[20px]"></span>
            <p class="mt-2">"Fantastic experience from start to finish. The instructional videos are clear and easy to
                follow—my skills have improved so much!"</p>
        </div>
    <?php endif; ?>
</div>