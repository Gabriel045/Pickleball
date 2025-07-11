<?php

$title   = get_field('title');
$steps   = get_field('steps');
$columns = get_field('columns');

?>

<section class=" bg-black">
    <div class="block_content py-[60px] lg:py-24 px-[30px] lg:px-[60px]">
        <div class="[_&_h2]:text-white  [_&_h2]:text-[30px] lg:[_&_h2]:text-[36px] [_&_h2]:font-semibold [_&_h2]:leading-[60px] 
            [_&_h2]:tracking-tight [_&_p]:text-white [_&_p]:text-[16px] lg:[_&_p]:text-[20px]
            [_&_span]:text-[#FFFFFF99] [_&_span]:text-[16px]">
            <?php echo $title ?>
        </div>
        <div class="pt-[50px]">
            <div id="how-it-works-slider" class="slider-container relative">
                <?php foreach ($steps as $key => $step) : ?>
                    <div class="w-full h-auto lg:h-[516px] slider-item rounded-[20px] <?php echo $key === 0 ? 'active' : ''; ?>"
                        style="background: linear-gradient(180deg, rgba(9, 40, 68, 0.13) 0%, rgba(14, 55, 94, 0.76) 100%), url(<?php echo $step["image"]['sizes']['large']; ?>) lightgray 50% / cover no-repeat;">
                        <div
                            class="text-content max-    [1024px]:flex  max-[1024px]:items-end lg:absolute bottom-16 left-16 text-white max-w-[890px]">
                            <div class="max-[1024px]:px-6 max-[1024px]:py-10 [_&_h2]:text-[24px] lg:[_&_h2]:text-[36px] [_&_h2]:font-semibold [_&_h2]:tracking-tight 
                            [_&_p]:text-white [_&_p]:text-[16px] lg:[_&_p]:text-[18px]">
                                <span class="text-white text-[16px] font-semibold leading-[24px]">
                                    Step <?php echo $key + 1; ?>
                                </span>
                                <?php echo $step['text']; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="slider-navigation flex justify-between flex-wrap lg:flex-nowrap gap-4 mt-16 w-full px-[20px]">
                <?php foreach ($steps as $key => $step) : ?>
                    <div class="cursor-pointer flex flex-col w-full nav-dot <?php echo $key === 0 ? 'active' : ''; ?>"
                        data-index="<?php echo $key; ?>">
                        <span class="line relative w-full h-[4px] bg-[#FFFFFF66] rounded-full block"></span>
                        <button
                            class="text-start text-white text-opacity-40 text-[16px] font-semibold leading-[24px] mt-[20px]">
                            <?php echo $step["progress_title"] ?>
                        </button>
                        <span class="text-white/40"> <?php echo $step["progress_text"] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function($) {
        "use strict";

        const $sliderItems = $('.slider-item');
        const $navDots = $('.nav-dot');
        let currentIndex = 0;
        let autoplayInterval;

        function showSlide(index) {
            // Hide all slides and remove the active class
            $sliderItems.removeClass('active').hide();
            $navDots.removeClass('active');

            // Show the corresponding slide and activate the button
            $sliderItems.eq(index).fadeIn(300).addClass('active');
            $navDots.eq(index).addClass('active');
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % $sliderItems.length; // Go to the next slide (circular)
            showSlide(currentIndex);
        }

        // Handle clicks on navigation buttons
        $navDots.click(function() {
            const index = $(this).data('index');
            currentIndex = index; // Update the current index
            showSlide(index);

            // Reset autoplay when clicking a button
            resetAutoplay();
        });

        // Start autoplay
        function startAutoplay() {
            autoplayInterval = setInterval(nextSlide, 7000); // Change slide every 7000ms
        }

        // Stop autoplay
        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        // Reset autoplay
        function resetAutoplay() {
            stopAutoplay();
            startAutoplay();
        }

        // Show the first slide when the page loads
        // showSlide(currentIndex);

        // Start autoplay
        startAutoplay();
    });
</script>