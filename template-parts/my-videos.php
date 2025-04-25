<?php
$current_user_id = get_current_user_id();

$args = array(
    'customer_id' => $current_user_id, // ID del usuario actual
    'status'      => 'completed',     // Opcional: Filtrar por estado del pedido
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
        );
    }
}

?>


<div class="py-[30px] lg:py-[60px] px-[30px] lg:px-[80px]">
    <h3 class="text-[24px] text-rich-black font-semibold">My Videos Library </h3>
    <div class="mt-10 flex flex-wrap gap-[2%] gap-y-[40px]">
        <?php foreach ($videos as $video) : ?>
        <div class="w-full md:w-[49%] lg:w-[31.33%]">
            <figure>
                <img class="rounded-[10px]" src="<?php echo $video['image'] ?>">
            </figure>
            <div class="flex items-center gap-[10px] mt-6">
                <span class="stars"></span>
                <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59
                    Reviews)</span>
            </div>
            <p class="text-[20px] text-rich-black font-semibold"><?php echo $video['title'] ?></p>
            <p class="mt-2 text-gray-paragrah"><?php echo $video['excerpt'] ?></p>
            <a href="<?php echo esc_url(home_url('/course/' . $video["slug"])); ?>" class="btn">
                Ver Curso
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>