<?php

get_header();
?>


<main>
    <section>
        <div class="block_content">
            <div class="flex">
                <!-- Right Side  -->
                <div class="w-1/2">
                    <?php
                    global $post;
                    $product = wc_get_product($post->ID);

                    $product_price = $product ? $product->get_price_html() : '';
                    $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
                    $trailer_video =  get_field('trailer_video', $post->ID)["url"];
                    $description_list_title = get_field('description_list_title', $post->ID);
                    $description_list = get_field('description_list', $post->ID);
                    $details_content = get_field('details_content', $post->ID);
                    $flow_chart_content = get_field('flow_chart_content', $post->ID);
                    $contents = get_field('contents', $post->ID);
                    $text_image = get_field('text_image', $post->ID);
                    $text_image_2 = get_field('text_image_2', $post->ID);
                    $best_seller_title = get_field('best_seller_title', $post->ID);


                    if (!empty($trailer_video)) { ?>
                        <div class="relative cursor-pointer">
                            <svg id="play-icon" class="absolute top-1/2 left-1/2" style="transform: translate(-50%, -50%);"
                                xmlns="http://www.w3.org/2000/svg" width="68" height="78" viewBox="0 0 68 78" fill="none">
                                <path d="M67.3047 39L0.847416 77.3691L0.847419 0.630879L67.3047 39Z" fill="white" />
                            </svg>

                            <video id="product-video" class="h-auto aspect-video object-cover" controls
                                poster="<?php echo esc_url($product_image) ?>">
                                <source src="<?php echo esc_url($trailer_video) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php  } else {
                        echo '<img src="' . esc_url($product_image) . '" alt="' . esc_attr(get_the_title($product_id)) . '"
                        class="featured-image">';
                    } ?>
                    <div class="bg-[#F9FAFB] p-[60px]">
                        <div class="tabs"></div>
                        <ul class="tab-list flex gap-4 border-b border-gray-300">
                            <li class="tab-item cursor-pointer py-2 px-4 text-gray-600 border-b-2 border-transparent active-tab"
                                data-tab="tab1">Details</li>
                            <li class="tab-item cursor-pointer py-2 px-4 text-gray-600 border-b-2 border-transparent"
                                data-tab="tab2">Flow Chart</li>
                            <li class="tab-item cursor-pointer py-2 px-4 text-gray-600 border-b-2 border-transparent"
                                data-tab="tab3">Contents</li>
                        </ul>
                        <div class="tab-content mt-4">
                            <div id="tab1" class="tab-pane active">
                                <div class="text-gray-paragrah text-[18px] leading-[28px]">
                                    <?php echo $details_content ?></div>
                            </div>
                            <div id="tab2" class="tab-pane hidden">
                                <div class="text-gray-paragrah text-[18px] leading-[28px]">
                                    <?php echo $flow_chart_content ?></div>
                            </div>
                            <div id="tab3" class="tab-pane hidden">
                                <div class="text-gray-paragrah text-[18px] leading-[28px]"><?php echo $contents ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Left Side -->
                <div class="w-1/2 py-[64px] px-[60px]">
                    <h1 class="text-[36px] font-[600] text-rich-black leading-[38px]">
                        <?php echo esc_html(get_the_title($post->ID)); ?>
                    </h1>
                    <div class="flex items-center gap-[10px] my-4">
                        <span class="stars"></span>
                        <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">
                            5.0 based on 543 reviews
                        </span>
                    </div>
                    <p class="text-[18px] text-gray-paragrah leading-[28px]">
                        <?php echo esc_html(get_the_content($post->ID)); ?>
                    </p>
                    <div class="my-[30px] flex items-center">
                        <span
                            class="mr-4 text-[#8498AB] text-[20px] line-through">$<?php echo $product->get_price() * 2 ?></span>
                        <span
                            class="text-[#13A513] text-[36px] font-semibold leading-[32px]"><?php echo $product_price ?></span>
                    </div>
                    <div class="woocommerce-variation-add-to-cart variations_button">
                        <button type="submit" class="custom_add_to_cart btn !w-fit single_add_to_cart_button button">+
                            Add to Cart</button>
                        <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
                        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                    </div>
                    <p class="py-8 text-gray-paragrah text-[18px] font-semibold"><?php echo $description_list_title ?>
                    </p>
                    <ul class="flex flex-col gap-y-5">
                        <?php foreach ($description_list as $key => $item) {

                        ?>
                            <li class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29"
                                    fill="none">
                                    <rect y="0.5" width="28" height="28" rx="14" fill="#0B141D" fill-opacity="0.09" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M19.9476 9.12169L11.5943 17.1834L9.37763 14.815C8.9693 14.43 8.32763 14.4067 7.86096 14.7334C7.40596 15.0717 7.27763 15.6667 7.55763 16.145L10.1826 20.415C10.4393 20.8117 10.8826 21.0567 11.3843 21.0567C11.8626 21.0567 12.3176 20.8117 12.5743 20.415C12.9943 19.8667 21.0093 10.3117 21.0093 10.3117C22.0593 9.23836 20.7876 8.29336 19.9476 9.11002V9.12169Z"
                                        fill="#0B141D" />
                                </svg>
                                <p class="text-[18px] text-gray-paragrah leading-7"><?php echo $item["items"] ?></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#F9FAFB]">
        <div class="block_content py-[80px] px-[60px]">
            <div class="flex gap-[100px]">
                <div class="w-1/2">
                    <div class="flex justify-between mb-10">
                        <h3 class="text-[24px] font-semibold text-rich-black">Course Content</h3>
                        <span class="text-[14px] text-gray-paragrah">Expant all Sections</span>
                    </div>
                    <div id="course-tabs">
                        <details open class="bg-white py-[23px] px-[40px]">
                            <summary class="font-semibold text-[18px] text-rich-black cursor-pointer">
                                Volume 1
                            </summary>
                            <div class="sumary content mt-5">
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
                                        <?php for ($i = 0; $i < 7; $i++) { ?>
                                            <tr>
                                                <td
                                                    class="border-r-[1px]  border-black p-[10px] opacity-[0.6] text-gray-paragrah">
                                                    Lorem
                                                    Ipsum Dolor</td>
                                                <td class=" text-gray-paragrah p-[10px] text-center">9am to 10am
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="w-1/2">
                    <div
                        class="[&_h3]:text-rich-black [&_h3]:font-semibold [&_h3]:text-[24px] [&_h3]:leading-[28px] [&_h3]:mb-10">
                        <?php echo  $text_image ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="block_content py-[80px] px-[60px]">
            <div class="[&_h3]:text-rich-black [&_h3]:font-semibold [&_h3]:text-[24px] [&_h3]:leading-[28px]
            [&_p]:text-[18px] [&_p]:text-gray-paragrah [&_p]:leading-7
            [&_img]:h-[570px] [&_img]:object-cover">
                <?php echo $text_image_2 ?>
            </div>
        </div>
    </section>
    <?php
    get_template_part('/blocks/product-slider/product-slider', null, array('best_seller_title' => $best_seller_title));
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
        const video = document.getElementById('product-video');
        const playIcon = document.getElementById('play-icon');

        video.addEventListener('play', function() {
            console.log("playdock")
            playIcon.style.display = 'none';
        });

        video.addEventListener('pause', function() {
            playIcon.style.display = 'block';
        });
    });
</script>


<?php get_footer() ?>