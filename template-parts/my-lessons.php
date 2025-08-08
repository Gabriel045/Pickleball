<?php
$product_id = $_GET["course"];
$lesson = $_GET["lesson"];
$lessons_id = get_field('lessons', $product_id);
$highest_lesson_key = !empty(get_field('lessons', $product_id)) ? max(array_keys($lessons_id)) : 0;
$video_iframe = get_field('video_iframe', $lessons_id[$lesson]);
$purchased_products = [];
$current_user_id = get_current_user_id();

if (function_exists('wc_get_orders') && $current_user_id) {
    $orders = wc_get_orders(['customer_id' => $current_user_id]);
    foreach ($orders as $order) {
        foreach ($order->get_items() as $item) {
            $purchased_products[] = $item->get_product_id();
        }
    }
}
$purchased_products = array_slice(array_unique($purchased_products), 0, 3);


if (!empty($lessons_id) && wc_customer_bought_product('', get_current_user_id(), $product_id)) { ?>
    <div class="flex justify-between flex-wrap lg:flex-nowrap gap-y-[20px]">
        <div class="w-full lg:w-[60%]">
            <h2 class="text-[24px] text-rich-black font-semibold mb-5">
                <?php echo get_the_title($lessons_id[$lesson]); ?>
            </h2>
            <span class="text-[16px] text-gray-paragraph"><?php echo get_the_title($product_id); ?></span>
        </div>
        <div class="flex gap-[10px]">
            <?php if ($lesson > 0): ?>
                <a href="?course=<?php echo $product_id; ?>&lesson=<?php echo $lesson - 1; ?>"
                    class="items-center gap-2 h-fit cursor-pointer text-white font-semibold bg-berkley-blue flex py-[10px] px-[18px] shadow-md rounded-[8px] hover:translate-y-[-2px] transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-180" width="16" height="16" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                    </svg> Prev Lesson
                </a>
            <?php endif; ?>
            <?php if ($lesson != $highest_lesson_key): ?>
                <a href="?course=<?php echo $product_id; ?>&lesson=<?php echo $lesson + 1; ?>"
                    class="items-center gap-2 h-fit cursor-pointer text-white font-semibold bg-berkley-blue flex py-[10px] px-[18px] shadow-md rounded-[8px] hover:translate-y-[-2px] transition-transform">
                    Next Lesson <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-10 mb-[50px]">
        <?php if (empty($video_iframe)): ?>
            <figure>
                <img src="/wp-content/uploads/2025/05/Frame-1000006416.png">
            </figure>
        <?php else: ?>
            <script src="https://player.vdocipher.com/v2/api.js"></script>
            <div class="flex gap-[30px]">
                <div class="lg:w-[70%]">
                    <?php echo $video_iframe; ?>

                    <div class="tabs mb-8"></div>
                    <ul class="flex border-b">
                        <!-- <li class="mr-4">
                            <button
                                class="tab-btn py-2 px-4 font-semibold text-rich-black border-b-2 border-transparent focus:outline-none active"
                                data-tab="overview">Overview</button>
                        </li> -->
                        <li>
                            <button
                                class="tab-btn py-2 px-4 font-semibold text-rich-black border-b-2 border-transparent focus:outline-none"
                                data-tab="recommended">Recommended</button>
                        </li>
                        <li>
                            <button
                                class="tab-btn py-2 px-4 font-semibold text-rich-black border-b-2 border-transparent focus:outline-none"
                                data-tab="offer">Special Offer</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="tab-recommended">
                        <?php
                        $user_orders = wc_get_orders(['customer_id' => get_current_user_id()]);
                        $purchased_product_ids = [];
                        foreach ($user_orders as $order) {
                            foreach ($order->get_items() as $item) {
                                $purchased_product_ids[] = $item->get_product_id();
                            }
                        }
                        $purchased_product_ids = array_unique($purchased_product_ids);


                        // Get the most selling product except the current one
                        $best_selling_args = [
                            'post_type'      => 'product',
                            'posts_per_page' => 4,
                            'post__not_in'   => $purchased_product_ids,
                            'meta_key'       => 'total_sales',
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC',
                            'fields'         => 'ids',
                        ];
                        $best_selling_query = new WP_Query($best_selling_args);
                        $best_selling =  $best_selling_query->posts;

                        foreach ($best_selling as $key => $items) {
                            $product = wc_get_product($items);
                            $image = get_the_post_thumbnail_url($items, 'full');
                            $title = $product->get_name();
                            $excerpt = $product->get_short_description();
                            $regular_price      = wc_price($product->get_regular_price());
                            $sale_price         = wc_price($product->get_sale_price());
                        ?>

                            <li class="first:pt-[35px] flex items-center gap-5 border-t border-gray-200 py-4 first:border-t-0 ">
                                <a href="<?php echo esc_url(get_permalink($items)); ?>">
                                    <figure class="figure-product w-[150px]">
                                        <img class="rounded-lg !m-0 object-cover aspect-[0.8] w-full"
                                            src="<?php echo esc_url($image); ?>">
                                    </figure>
                                </a>
                                <div class="flex flex-col w-1/2">
                                    <h4 class="product-name text-gray-900 font-semibold leading-[18px] text-[16px]">
                                        <a class="hover:underline" href="<?php echo esc_url(get_permalink($items)); ?>">
                                            <?php echo $title ?> </a>
                                    </h4>
                                    <p class="text-[16px] text-gray-paragraph"><?php echo esc_html($excerpt); ?></p>
                                    <div class="flex items-center gap-[10px]">
                                        <p class="text-red-500 text-[16px]">
                                            <s><?php echo $regular_price ?></s>
                                        </p>
                                        <p
                                            class="product-price [_&_span]:text-[#13A513] [_&_span]:text-[20px] lg:[_&_span]:text-[25px] [_&_span]:font-semibold [_&_span]:leading-[32px]">
                                            <?php echo $sale_price; ?></p>
                                    </div>
                                </div>
                            </li>
                        <?php }
                        wp_reset_postdata(); ?>
                    </div>

                    <!-- <div class="tab-content mt-6" id="tab-overview">
                        <div class="[_&_h4]:w-full [_&_h4]lg::w-[70%] [_&_h4]:lg:text-[20px] [_&_h4]:text-[18px] [_&_h4]:font-semibold [_&_h4]:text-rich-black [_&_h4]:mb-[15px]
    [_&_p]:text-gray-paragraph [_&_p]:lg:text-[16px] [_&_p]:text-[14px] relative">
                            <div class="flex items-center gap-[10px] absolute top-[-35px] lg:top-0 right-0">
                                <span class="stars mt-4 block"></span>
                                <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                                    Reviews)</span>
                            </div>
                            <?php get_the_content(null, false, $lessons_id[$lesson]); ?>
                        </div>
                    </div> -->
                    <div class="tab-content hidden" id="tab-offer">
                        <?php
                        $current_user_id = get_current_user_id();
                        $cupon_code = get_user_meta($current_user_id, 'coupon_generated', true);
                        ?>
                        <p class="text-[16px] text-gray-paragraph my-4">
                            Unlock exclusive savings! Use your special coupon code below to get a discount on your next
                            purchase. This offer is available only for our valued members.
                        </p>
                        <?php if ($cupon_code): ?>
                            <div class="bg-[#f0f8e8] border border-[#13A513] rounded p-4 mb-4">
                                <strong>Your Coupon Code:</strong>
                                <span class="text-[#13A513] font-bold text-lg"><?php echo esc_html($cupon_code); ?></span>
                            </div>
                        <?php else: ?>
                            <p class="text-[16px] text-gray-paragraph">No special coupon available at this time. Please check back
                                later!</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="lg:w-[30%]">
                    <div>
                        <h4 class="text-[24px] text-rich-black font-semibold mb-5">Chapters</h4>
                        <ul id="chapter-box"></ul>
                    </div>
                    <div class="mt-16">
                        <h4 class="text-[24px] text-rich-black font-semibold mb-5">Instrucional overview</h4>
                        <ul id="instructional-overview-box">
                            <?php foreach ($lessons_id as $key => $lesson_id): ?>
                                <li class="flex items-center gap-[10px] mb-3 py-[10px] border-b-[1px] border-[#E9EAED]">
                                    <span class="icon"></span>
                                    <a href="?course=<?php echo $product_id; ?>&lesson=<?php echo $key; ?>" class="text-[16px]">
                                        <?php echo get_the_title($lesson_id); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <?php if (!empty($purchased_products)): ?>
        <div>
            <h3 class="text-[24px] font-semibold text-rich-black py-10">My Videos Library</h3>
            <div class="flex gap-4 lg:flex-nowrap flex-wrap gap-y-[40px]">
                <?php
                $purchased_products = array_filter($purchased_products);
                foreach ($purchased_products as $product_id):
                    $product = wc_get_product($product_id);
                    $image = get_the_post_thumbnail_url($product_id, 'full');
                    $title = $product->get_name();
                    $excerpt = $product->get_short_description();
                ?>
                    <div class="w-full md:w-[49%] lg:w-[31.33%] gap-[5px] flex flex-col justify-between">
                        <figure>
                            <img class="aspect-[0.8] object-cover w-full rounded-[10px]" src="<?php echo esc_url($image); ?>">
                        </figure>
                        <span class="stars"></span>
                        <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0
                            (59 Reviews)</span>
                        <h4 class="text-[20px] font-semibold text-rich-black"><?php echo esc_html($title); ?></h4>
                        <p class="text-[16px] text-gray-paragraph"><?php echo esc_html($excerpt); ?></p>
                        <a href="/my-account/my-lessons/?course=<?php echo esc_attr($product_id); ?>&lesson=0" class="btn w-full">
                            See Instructionals</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php } else {
    wp_redirect(get_permalink($product_id));
    exit;
}
?>

<style>
    iframe {
        width: 100% !important;
        height: 577px !important;
        border-radius: 20px;
    }

    @media screen and (max-width: 768px) {
        iframe {
            height: auto !important;
            aspect-ratio: 4 / 3 !important;

        }
    }
</style>


<script>
    document.querySelector(".woocommerce-MyAccount-navigation-link--dashboard").classList.add("is-active");


    // custom chapters navigation
    const iframe = document.querySelector('iframe');
    const chapterBox = document.querySelector('#chapter-box');
    const player = VdoPlayer.getInstance(iframe);

    (async function() {
        const meta = await player.api.getMetaData();
        meta.chapters.forEach(({
            title,
            startTime
        }) => {

            const chapterLine = document.createElement('li');
            chapterLine.classList.add('chapter-item');
            // Formatea el tiempo en mm:ss
            const minutes = Math.floor(startTime / 60).toString().padStart(2, '0');
            const seconds = Math.floor(startTime % 60).toString().padStart(2, '0');
            const formattedTime = `${minutes}:${seconds}`;

            chapterLine.innerHTML =
                `<span class="icon"></span><span>${title}</span> <span>${formattedTime}</span>`;
            chapterLine.addEventListener('click', () => {
                // VdoCipher Custom API
                // player.api.getMetaData().then(function(data) {
                //     console.log('Video playback: ', data);
                // });

                player.video.currentTime = startTime;
                player.video.play();
            });
            chapterBox.appendChild(chapterLine);
        });
    })();


    // Tabs logic
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active',
                'border-berkley-blue'));
            this.classList.add('active', 'border-berkley-blue');
            document.querySelectorAll('.tab-content').forEach(tc => tc.classList.add('hidden'));
            document.getElementById('tab-' + this.dataset.tab).classList.remove('hidden');
        });
    });

    window.onload = function() {
        const activeLesson = <?php echo $lesson ?>;
        const lessonList = document.querySelectorAll("#instructional-overview-box li")
        lessonList.forEach((lesson, key) => {
            if (key == activeLesson) {
                lesson.querySelector("a").style.color = "#13A513"
                lesson.querySelector("a").style.fontWeight = "500"
            }

        })

    };
</script>