<?php

get_header();

global $post;
$product = wc_get_product($post->ID);

$regular_price = wc_price($product->get_regular_price());
$sale_price = wc_price($product->get_sale_price());
$product_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
$trailer_video =  get_field('trailer_video', $post->ID);
$add_video_optional = get_field('add_video_optional', $post->ID);
$description_list_title = get_field('description_list_title', $post->ID);
$description_list = get_field('description_list', $post->ID);
$details_content = get_field('details_content', $post->ID);
$flow_chart_content = get_field('flow_chart_content', $post->ID);
$contents = get_field('contents', $post->ID);
$text_image = get_field('text_image', $post->ID);
$text_image_2 = get_field('text_image_2', $post->ID);
$best_seller_title = get_field('best_seller_title', $post->ID);
$volumes = get_field('volumes', $post->ID);
$video_iframe = get_field('video_iframe', $post->ID);
$add_video_optional_2 = get_field('add_video_optional_2', $post->ID);


?>

<main>
    <section class="bg-[#F9FAFB]">
        <div class="block_content">
            <div class="flex lg:flex-nowrap flex-wrap lg:flex-row flex-col-reverse py-[64px]">
                <!-- left Side  -->
                <div class="w-full lg:w-1/2">
                    <div class="hidden lg:block">
                        <?php
                        if (!empty($trailer_video)) {
                            echo $trailer_video;
                        } elseif (!empty($add_video_optional)) {
                            if ($add_video_optional["mime_type"] == "video/mp4") {
                                echo '<video class="h-auto aspect-video object-cover" preload="metadata" loop autoplay playsinline muted poster="' . get_stylesheet_directory_uri() . '/assets/images/Rectangle.webp">
                                <source src="' . esc_url($add_video_optional["url"]) . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>';
                            }
                        } else {
                            echo '<img loading="lazy" src="' . esc_url($product_image) . '" alt="' . esc_attr(get_the_title($product_id)) . '"
                        class="featured-image">';
                        } ?>
                    </div>
                    <div class="bg-[#F9FAFB] lg:p-[60px] px-[40px] py-[30px]">
                        <div class="tabs"></div>
                        <ul class="tab-list flex max-[1024px]:justify-between gap-0 lg:gap-4 border-b border-gray-300">
                            <li class="tab-item cursor-pointer py-2 px-4 text-gray-600 border-b-2 border-transparent active-tab"
                                data-tab="tab1">Details</li>
                            <li class="tab-item cursor-pointer py-2 px-4 text-gray-600 border-b-2 border-transparent"
                                data-tab="tab2">Flow Chart</li>
                            <li class="tab-item cursor-pointer py-2 px-4 text-gray-600 border-b-2 border-transparent"
                                data-tab="tab3">Contents</li>
                        </ul>
                        <div class="tab-content mt-4">
                            <div id="tab1" class="tab-pane active">
                                <div class="text-gray-paragraph tex-[16px] lg:text-[18px] leading-[28px]">
                                    <?php echo $details_content ?></div>
                            </div>
                            <div id="tab2" class="tab-pane hidden">
                                <div class="text-gray-paragraph text-[18px] leading-[28px]">
                                    <?php echo $flow_chart_content ?></div>
                            </div>
                            <div id="tab3" class="tab-pane hidden">
                                <div class="text-gray-paragraph text-[18px] leading-[28px]"><?php echo $contents ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:p-[60px] px-[40px] py-[60px]">
                        <div class="flex justify-between mb-10">
                            <h3 class="text-[24px] font-semibold text-rich-black">Course Content</h3>
                            <span id="expand-all" class="text-[14px] text-gray-paragraph cursor-pointer">Expand all
                                Sections</span>
                        </div>
                        <div id="course-tabs" class='py-[25px] px-[40px] bg-white'>
                            <?php foreach ($volumes as $key => $volume) {  ?>
                            <details class=" pb-[15px] last:pb-0">
                                <summary class="font-semibold text-[18px] text-rich-black cursor-pointer">
                                    Module <?php echo $key + 1 ?>
                                </summary>
                                <div class="sumary content mt-2">
                                    <table class="table-fixed w-full border-collapse">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="border-r-[1px]  border-black text-left font-semibold p-[10px] text-rich-black opacity-[0.6]">
                                                    Chapter Title</th>
                                                <th
                                                    class="text-center font-semibold p-[10px] text-rich-black opacity-[0.6]">
                                                    Start Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($volume["volumes"] as $key => $value) { ?>
                                            <tr>
                                                <td
                                                    class="border-r-[1px]  border-black p-[10px] opacity-[0.6] text-gray-paragraph">
                                                    <?php echo $value["chapter"] ?>
                                                </td>
                                                <td class=" text-gray-paragraph p-[10px] text-center">
                                                    <?php echo $value["hours"] ?>

                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </details>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- right Side -->
                <div class="w-full lg:w-1/2 px-[30px] lg:px-[60px]">
                    <h1 class="text-[30px] lg:text-[36px] font-[600] text-rich-black leading-[38px]">
                        <?php echo esc_html(get_the_title($post->ID)); ?>
                    </h1>
                    <div class="flex items-center gap-[10px] my-4">
                        <span class="stars"></span>
                        <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">
                            5.0 based on 543 reviews
                        </span>
                    </div>
                    <!-- video mobile -->
                    <div class="block lg:hidden mb-[30px]">
                        <?php
                        if (!empty($trailer_video)) {
                            echo $trailer_video;
                        } elseif (!empty($add_video_optional)) {
                            if ($add_video_optional["mime_type"] == "video/mp4") {
                                echo '<video class="h-auto aspect-video object-cover" preload="metadata" loop autoplay playsinline muted poster="' . get_stylesheet_directory_uri() . '/assets/images/Rectangle.webp">
                                <source src="' . esc_url($add_video_optional["url"]) . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>';
                            }
                        } else {
                            echo '<img loading="lazy" src="' . esc_url($product_image) . '" alt="' . esc_attr(get_the_title($product_id)) . '"
                        class="featured-image">';
                        } ?>
                    </div>
                    <div class="text-[18px] text-gray-paragraph leading-[28px]">
                        <?php echo get_the_content($post->ID); ?>
                    </div>
                    <div class="my-[30px] flex items-center">
                        <span class="mr-4 text-red-500 text-[20px] line-through"><?php echo $regular_price ?></span>
                        <span
                            class="text-[#13A513] text-[36px] font-semibold leading-[32px]"><?php echo $sale_price ?></span>
                    </div>
                    <div class="woocommerce-variation-add-to-cart variations_button">
                        <button type="submit" class="custom_add_to_cart btn !w-fit single_add_to_cart_button button">+
                            Add to Cart</button>
                        <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
                        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                    </div>
                    <p class="py-8 text-gray-paragraph text-[18px] font-semibold"><?php echo $description_list_title ?>
                    </p>
                    <ul class="flex flex-col gap-y-5">
                        <?php foreach ($description_list as $key => $item) {

                        ?>
                        <li class="flex gap-3 lg:gap-2">
                            <svg class="max-[1024px]:w-[72px] w-[4%]" xmlns="http://www.w3.org/2000/svg" width="28"
                                height="29" viewBox="0 0 28 29" fill="none">
                                <rect y="0.5" width="28" height="28" rx="14" fill="#0B141D" fill-opacity="0.09" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.9476 9.12169L11.5943 17.1834L9.37763 14.815C8.9693 14.43 8.32763 14.4067 7.86096 14.7334C7.40596 15.0717 7.27763 15.6667 7.55763 16.145L10.1826 20.415C10.4393 20.8117 10.8826 21.0567 11.3843 21.0567C11.8626 21.0567 12.3176 20.8117 12.5743 20.415C12.9943 19.8667 21.0093 10.3117 21.0093 10.3117C22.0593 9.23836 20.7876 8.29336 19.9476 9.11002V9.12169Z"
                                    fill="#0B141D" />
                            </svg>
                            <div class="text-[18px] text-gray-paragraph leading-7 lg:w-[96%]">
                                <?php echo $item["items"] ?></div>
                        </li>
                        <?php } ?>
                    </ul>

                    <div
                        class="[&_h3]:text-rich-black [&_h3]:font-semibold [&_h3]:text-[24px] [&_h3]:leading-[28px] [&_h3]:mb-10 mt-14">
                        <?php echo  $text_image ?>
                        <?php
                        if (!empty($add_video_optional_2)) {
                            echo '<img loading="lazy" src="' . esc_url($add_video_optional_2["url"]) . '" alt="Optional Image" class="">';
                        } else {
                            echo $video_iframe;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="bg-[#F9FAFB] hidden lg:flex">
        <div class="block_content py-[80px] px-[60px]">
            <div class="gap-[100px] flex">
                <div class="w-1/2">

                </div>
                <div class="w-1/2">
                </div>
            </div>
        </div>
    </section> -->
    <section>
        <div class="block_content py-[80px] lg:px-[60px] px-[30px]">
            <div class="[&_h3]:text-rich-black [&_h3]:font-semibold [&_h3]:text-[20px] [&_h3]:lg:text-[24px] [&_h3]:leading-[28px]
            [&_p]:text-[16px] [&_p]:lg:text-[18px] [&_p]:text-gray-paragraph [&_p]:leading-7
            [&_img]:lg:h-[570px] [&_img]:object-cover [&_img]:lg:rounded-[10px]
            [&_li]:text-[16px] [&_li]:lg:text-[18px]  [&_li]:text-gray-paragraph">
                <?php echo $text_image_2 ?>
            </div>
        </div>
    </section>
    <?php
    get_template_part('/blocks/product-slider/product-slider', null, array('best_seller_title' => $best_seller_title));
    ?>

    <?php
    get_template_part('/template-parts/review-slider', null, array('slidesToShow' => '4'));
    ?>

    <?php
    get_template_part('/blocks/faq/faq');
    ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-item');
    const panes = document.querySelectorAll('.tab-pane');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active-tab',
                'border-rich-black'));
            panes.forEach(p => p.classList.add('hidden'));

            this.classList.add('active-tab', 'border-rich-black');
            document.getElementById(this.dataset.tab).classList.remove(
                'hidden');
        });
    });


});

document.addEventListener('DOMContentLoaded', function() {
    const videos = document.querySelectorAll('#product-video');
    const playIcons = document.querySelectorAll('#play-icon')
    videos.forEach((video, index) => {
        const playIcon = playIcons[index];

        video.addEventListener('touchstart', function() {
            console.log("click")
            if (video.paused) {
                video.play();
            } else {
                video.pause();

            }
        });

        video.addEventListener('play', function() {
            if (playIcon) {
                playIcon.style.display = 'none';
            }
        });

        video.addEventListener('pause', function() {
            if (playIcon) {
                playIcon.style.display = 'block';
            }
        });


    });


    const expandAll = document.getElementById('expand-all');
    const modules = document.querySelectorAll('#course-tabs details');
    expandAll.addEventListener("click", () => {
        const allOpen = Array.from(modules).every(mod => mod.hasAttribute('open'));
        modules.forEach((mod) => {
            if (allOpen) {
                mod.removeAttribute('open');
            } else {
                mod.setAttribute('open', '');
            }
        });
    });



    const volume = document.querySelector('#course-tabs details');
    volume.setAttribute('open', '');

});
</script>


<?php get_footer() ?>