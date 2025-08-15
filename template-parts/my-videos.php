<?php
$current_user_id = get_current_user_id();

$args = array(
    'customer_id' => $current_user_id, // Current user ID
    'status'      => 'completed',      // Optional: Filter by order status
    'exclude' => wc_get_products(array('status' => 'trash', 'return' => 'ids')),
);

$orders = wc_get_orders($args);

$product_ids = array();

foreach ($orders as $order) {
    $items = $order->get_items();

    foreach ($items as $item) {
        $product_ids[] = $item->get_product_id();
    }
}

$product_ids = array_unique($product_ids);

$videos = array();

foreach ($product_ids as $product_id) {
    $product = wc_get_product($product_id);

    if ($product) {
        $videos[] = array(
            'title'   => $product->get_name(),
            'excerpt' => $product->get_short_description(),
            'image'   => get_the_post_thumbnail_url($product_id, 'full'),
            'slug'    => $product->get_slug(),
            'id' => $product_id,
        );
    }
}

?>


<div class="">
    <h3 class="text-[24px] text-rich-black font-semibold">My Videos Library </h3>
    <div class="mt-10 flex flex-wrap gap-[2%] gap-y-[40px]">
        <?php foreach ($videos as $video) :  ?>
            <div class="w-[49%] md:w-[31.33%] lg:w-[23.5%] gap-[5px] flex flex-col justify-between">
                <a href="/my-account/my-lessons/?course=<?php echo $video['id'] ?>&lesson=0">
                    <figure>
                        <img loading="lazy" class="w-fullm aspect-[0.8] object-cover rounded-[10px]" src="<?php echo $video['image'] ?>">
                    </figure>
                    <span class="stars mt-4 block"></span>
                    <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                        Reviews)</span>
                    <h4 class="text-[22px] mt-2 leading-[20px] text-rich-black font-semibold"><?php echo $video['title'] ?>
                    </h4>
                    <p class="mt-2 text-gray-paragraph mb-3"><?php echo $video['excerpt'] ?></p>
                    <a href="/my-account/my-lessons/?course=<?php echo $video['id'] ?>&lesson=0" class="btn w-full">
                        See Instructionals</a>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<style>
    .woocommerce-MyAccount-content>p {
        display: none !important;
    }
</style>