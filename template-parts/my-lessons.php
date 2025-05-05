<?php
$product_id = $_GET["course"];
$lesson = $_GET["lesson"];
$lessons_id = get_field('lessons', $product_id);
$highest_lesson_key = max(array_keys($lessons_id));

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
            <span class="text-[16px] text-gray-paragrah"><?php echo get_the_title($product_id); ?></span>
        </div>
        <div class="flex gap-[10px]">
            <?php if ($lesson > 0): ?>
                <a href="?course=<?php echo $product_id; ?>&lesson=<?php echo $lesson - 1; ?>"
                    class="h-fit cursor-pointer text-white font-semibold bg-[#8F97A2] flex py-[10px] px-[18px] shadow-md rounded-[8px]">
                    ← Prev Lesson
                </a>
            <?php endif; ?>
            <?php if ($lesson != $highest_lesson_key): ?>
                <a href="?course=<?php echo $product_id; ?>&lesson=<?php echo $lesson + 1; ?>"
                    class="h-fit cursor-pointer text-white font-semibold bg-[#8F97A2] flex py-[10px] px-[18px] shadow-md rounded-[8px]">
                    Next Lesson →
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-10 mb-[50px]">
        <figure>
            <img src="/wp-content/uploads/2025/05/Frame-1000006416.png">
        </figure>
    </div>

    <div class="[_&_h4]:w-full [_&_h4]lg::w-[70%] [_&_h4]:lg:text-[20px] [_&_h4]:text-[18px] [_&_h4]:font-semibold [_&_h4]:text-rich-black [_&_h4]:mb-[15px]
    [_&_p]:text-gray-paragrah [_&_p]:lg:text-[16px] [_&_p]:text-[14px] relative">
        <div class="flex items-center gap-[10px] absolute top-[-35px] lg:top-0 right-0">
            <span class="stars"></span>
            <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                Reviews)</span>
        </div>
        <?php echo get_the_content(null, false, $lessons_id[$lesson]); ?>
    </div>

    <?php if (!empty($purchased_products)): ?>
        <div>
            <h3 class="text-[24px] font-semibold text-rich-black py-10">My Videos Library</h3>
            <div class="flex gap-4 lg:flex-nowrap flex-wrap gap-y-[40px]">
                <?php foreach ($purchased_products as $product_id):
                    $product = wc_get_product($product_id);
                    $image = get_the_post_thumbnail_url($product_id, 'full');
                    $title = $product->get_name();
                    $excerpt = $product->get_short_description(); ?>
                    <div class="w-full md:w-[49%] lg:w-[31.33%]">
                        <figure>
                            <img class="rounded-[10px]" src="<?php echo esc_url($image); ?>">
                        </figure>
                        <div class="flex items-center gap-[10px] mt-6">
                            <span class="stars"></span>
                            <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0
                                (59 Reviews)</span>
                        </div>
                        <h4 class="text-[20px] font-semibold text-rich-black"><?php echo esc_html($title); ?></h4>
                        <p class="text-[16px] text-gray-paragrah"><?php echo esc_html($excerpt); ?></p>
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



<script>
    document.querySelector(".woocommerce-MyAccount-navigation-link--my-videos").classList.add("is-active");
</script>